<?php
namespace VirtualPersistAPI\VirtualPersistBundle\Controller;

use Doctrine\DBAL\Connection;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use VirtualPersistAPI\VirtualPersistBundle\Entity\User;
use VirtualPersistAPI\VirtualPersistBundle\Entity\Record;
use VirtualPersistAPI\VirtualPersistBundle\Entity\Log;
use VirtualPersistAPI\VirtualPersistBundle\Response\TextPlainResponse;
use VirtualPersistAPI\VirtualPersistBundle\Response\VirtualPersistAPIResponse;
use VirtualPersistAPI\VirtualPersistBundle\Response\ResponseDebugInfoInjector;

/**
 * Our prefix:
 * @Route("/api")
 */
class APIController extends Controller {

  public function addDebugInfo(Response $response) {
    $debug = $this->getRequest()->query->get('debug');
    if (!$debug) $debug = $this->getRequest()->request->get('debug');
    if ($debug) {
      $response->headers->set('X-VPA-Debug', 'debuggy!', TRUE);
    }
    return $response;
  }

  /**
   * Get all the records for a given category, keyed by their key.
   *
   * @Route("/{uuid}/{category}", requirements={"uuid" = "[a-fA-F0-9]{8}-[a-fA-F0-9]{4}-[a-fA-F0-9]{4}-[a-fA-F0-9]{4}-[a-fA-F0-9]{12}"})
   * @Method({"GET"})
   */
  public function getCategoryAction(Request $request, $uuid, $category) {
    // Return 404 by default so no one can brute-force hack the
    // UUIDs or categories or keys.
    $response = new TextPlainResponse('404: No Such Item.', 404);
    try {
      $doctrine = $this->getDoctrine();
      $user = $doctrine
        ->getRepository('VirtualPersistBundle:User')
        ->findOneByUuid($uuid);
      if ($user && $user->isEnabled()) {
        $records = $doctrine
          ->getRepository('VirtualPersistBundle:Record')
          ->findByUserCategory($user, $category);
        // Did we get a record?
        if (count($records)) {
          error_log(print_r($records,true));
          $response = new JsonResponse($records, 200);
        }
      }
    } catch (\Exception $e) {
      // Catch exceptions so GET always results in 404.
      //throw $e;
    }
    return $this->addDebugInfo($response);
  }


  /**
   * @Route("/{uuid}/{category}/{key}", requirements={"uuid" = "[a-fA-F0-9]{8}-[a-fA-F0-9]{4}-[a-fA-F0-9]{4}-[a-fA-F0-9]{4}-[a-fA-F0-9]{12}"})
   * @Method({"GET"})
   */
  public function getAction(Request $request, $uuid, $category, $key) {
    // Return 404 by default so no one can brute-force hack the
    // UUIDs or categories or keys.
    $response = new TextPlainResponse('404: No Such Item.', 404);
    try {
      $doctrine = $this->getDoctrine();
      $user = $doctrine
        ->getRepository('VirtualPersistBundle:User')
        ->findOneByUuid($uuid);
      if ($user && $user->isEnabled()) {
        $record = $doctrine
          ->getRepository('VirtualPersistBundle:Record')
          ->findOneByUuidCategoryKey_View($uuid, $category, $key);
        // Did we get a record?
        if ($record) {
          $response = new TextPlainResponse($record->getData(), 200);
        }
      }
    } catch (\Exception $e) {
      // Catch exceptions so GET always results in 404.
      //throw $e;
    }
    return $this->addDebugInfo($response);
  }

  /**
   * @Route("/{uuid}/{category}/{key}", requirements={"uuid" = "[a-fA-F0-9]{8}-[a-fA-F0-9]{4}-[a-fA-F0-9]{4}-[a-fA-F0-9]{4}-[a-fA-F0-9]{12}"})
   * @Method({"POST"})
   */
  public function postAction(Request $request, $uuid, $category, $key) {
    $response = new TextPlainResponse('Huh?', 503);
    $doctrine = $this->getDoctrine();
    $em = $doctrine->getEntityManager();

    $user = $doctrine
      ->getRepository('VirtualPersistBundle:User')
      ->findOneByUuid($uuid);
    if ($user) {
      // Perform bogus locking strategy.
      // Should really be pessimistic locking:
      // http://docs.doctrine-project.org/en/latest/reference/transactions-and-concurrency.html#pessimistic-locking
      $oldTransactionIsolation = $em->getConnection()->getTransactionIsolation();
      $em->getConnection()->setTransactionIsolation(Connection::TRANSACTION_SERIALIZABLE);
      $records = $doctrine
        ->getRepository('VirtualPersistBundle:Record')
        ->findByUserCategoryKey($user, $category, $key);
      if (count($records)) {
        $em->getConnection()->beginTransaction();
        try {
          foreach($records as $record) {
            $em->remove($record);
          }
          $em->flush();
          $em->getConnection()->commit();
        } catch (\Exception $e) {
          $em->rollback();
          $em->close();
          throw $e;
        }
      }
      
      // Glean the data to post.
      $data = $request->request->get('data', '');

      // Isolate writing the new record in a transaction.
      $em->getConnection()->beginTransaction();
      try {
        $record = new Record();
        $record->setOwner($user);
        $record->setCategory($category);
        $record->setKey($key);
        $record->setData($data);
        $em->persist($record);
        $em->flush();
        $em->getConnection()->commit();
      } catch (\Exception $e) {
        $em->getConnection()->rollback();
        $em->close();
        throw $e;
      }

      // Re-set the transaction isolation.
      $em->getConnection()->setTransactionIsolation($oldTransactionIsolation);

/*      $log = new Log();
      $log->setType('post')
        ->setUser($user)
        ->setMessage('Added data: ' . md5($data));
      $entityManager->persist($log);
      $entityManager->flush();
*/

      $response = new TextPlainResponse('Item added.', 200);
    } else {
      $response = new TextPlainResponse('No such item.', 404);
    }
    return $this->addDebugInfo($response);
  }

  /**
   * @Route("/{uuid}/{category}/{key}", requirements={"uuid" = "[a-fA-F0-9]{8}-[a-fA-F0-9]{4}-[a-fA-F0-9]{4}-[a-fA-F0-9]{4}-[a-fA-F0-9]{12}"})
   * @Method({"DELETE"})
   */
  public function deleteAction($uuid, $category, $key) {
    $response = new TextPlainResponse('No Such Item.', 404);
    $doctrine = $this->getDoctrine();
    $user = $doctrine
      ->getRepository('VirtualPersistBundle:User')
      ->findOneByUuid($uuid);
    if ($user) { // if($user->has_authentication)
      // Get all the records that match.
      $records = $doctrine
        ->getRepository('VirtualPersistBundle:Record')
        ->findByUserCategoryKey($user, $category, $key);
      // Did we get any records?
      if (count($records)) {
        $entityManager = $doctrine->getEntityManager();
        foreach($records as $record) {
          // Tell ORM to remove.
          $entityManager->remove($record);
        }
        $entityManager->flush();
        // Tell the user.
        $response = new TextPlainResponse('Item deleted.', 200);
      }
    }
    return $this->addDebugInfo($response);
  }

  /**
   * @Route("/keys/{uuid}/{category}", requirements={"uuid" = "[a-fA-F0-9]{8}-[a-fA-F0-9]{4}-[a-fA-F0-9]{4}-[a-fA-F0-9]{4}-[a-fA-F0-9]{12}"})
   * @Method({"GET"})
   */
  public function keysAction($uuid, $category) {
    try {
      $doctrine = $this->getDoctrine();
      $keys = $doctrine
        ->getRepository('VirtualPersistBundle:Record')
        ->keysForUUIDCategory($uuid, $category);

      // Did we get an answer?
      if ($keys) {
        $user = $doctrine
          ->getRepository('VirtualPersistBundle:User')
          ->findOneByUuid($uuid);
        if ($user && $user->isEnabled()) { // if($user->has_authentication)
          $keyArray = array();
          foreach ($keys as $key) {
            $keyArray[] = $key['aKey'];
          }
          // for now we just return json.
          return new Response(
            json_encode($keyArray),
            200,
            array('content-type' => 'application/json')
          );
        }
      }

      return new Response('Item not found.', 404, array('content-type' => 'text/plain'));
    } catch (\Exception $e) {
    }
    return new Response('Item not found.', 404);
  }

  /**
   * @Route("/categories/{uuid}", requirements={"uuid" = "[a-fA-F0-9]{8}-[a-fA-F0-9]{4}-[a-fA-F0-9]{4}-[a-fA-F0-9]{4}-[a-fA-F0-9]{12}"})
   * @Method({"GET"})
   */
  public function categoriesAction($uuid) {
    try {
      $doctrine = $this->getDoctrine();
      $categories = $doctrine
        ->getRepository('VirtualPersistBundle:Record')
        ->categoriesForUUID($uuid);

      // Did we get an answer?
      if ($categories) {
        $user = $doctrine
          ->getRepository('VirtualPersistBundle:User')
          ->findOneByUuid($uuid);
        if ($user && $user->isEnabled()) { // if($user->has_authentication)
          $categoryArray = array();
          foreach ($categories as $category) {
            $categoryArray[] = $category['category'];
          }
          // for now we just return json.
          return new Response(
            json_encode($categoryArray),
            200,
            array('content-type' => 'application/json')
          );
        }
      }

      return new Response('Item not found.', 404, array('content-type' => 'text/plain'));
    } catch (\Exception $e) {
    }
    return new Response('Item not found.', 404);
  }

  /**
   * @Route("/user/{uuid}", requirements={"uuid" = "[a-fA-F0-9]{8}-[a-fA-F0-9]{4}-[a-fA-F0-9]{4}-[a-fA-F0-9]{4}-[a-fA-F0-9]{12}"})
   * @Method({"GET"})
   */
  public function userGetAction($uuid) {
    $user = $this->getDoctrine()
      ->getRepository('VirtualPersistBundle:User')
      ->findOneByUuid($uuid);
    if ($user && $user->isEnabled()) {
      return new Response('User: ' . $user->getUUID());
    }
    return new Response('User? LOSER!', 404);
  }

}

