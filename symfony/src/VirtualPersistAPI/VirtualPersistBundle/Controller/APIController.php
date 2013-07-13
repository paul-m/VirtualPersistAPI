<?php
namespace VirtualPersistAPI\VirtualPersistBundle\Controller;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\LockMode;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use VirtualPersistAPI\VirtualPersistBundle\Entity\User;
use VirtualPersistAPI\VirtualPersistBundle\Entity\Record;
use VirtualPersistAPI\VirtualPersistBundle\Response\TextPlainResponse;

/**
 * Our prefix:
 * @Route("/api")
 */
class APIController extends Controller {

  /**
   * Extract all inworld-related headers.
   */
  public function inworldHeaders(Request $request) {
    $result = array();
    $headersWeLike = array('User-Agent', 'X-SecondLife-Shard', 'X-SecondLife-Object-Name',
      'X-SecondLife-Object-Key', 'X-SecondLife-Region', 'X-SecondLife-OwnerName',
      'X-SecondLife-Owner-Key');
    $headerBag = $request->headers;
    foreach($headersWeLike as $query) {
      if ($headerBag->has($query)) {
        $result[$query] = $headerBag->get($query, '');
      }
    }
    return new HeaderBag($result);
  }

  public function jsonpCallback(Request $request, $response) {
    if (is_a($response, 'Symfony\Component\HttpFoundation\JsonResponse')) {
      $callback = '';
      if ($request->query->has('callback')) {
        $callback = $request->query->get('callback');
      }
      else if ($request->request->has('callback')) {
        $callback = $request->request->get('callback');
      }
      if ($callback) {
        $response->setCallback($callback);
      }
    }
    return $response;
  }

  /**
   * Pull a 'since' value out of request parameters, convert to DateTime.
   *
   * @param $request the request in question.
   * @param $default the unix timestamp to use if no 'since' is found.
   * @return /DateTime for 'since.'
   */
  public function requestSince(Request $request, $default = 0) {
    $timestamp = $default;
    if ($request->query->has('since')) {
      $timestamp = $request->query->get('since');
    }
    else if ($request->request->has('since')) {
      $timestamp = $request->request->get('since');
    }
    $since = new \DateTime();
    return $since->setTimestamp($timestamp);
  }

  /**
   * Add X-VPA-Debug header if appropriate.
   *
   * @todo: Make this meaningful.
   */
  public function addDebugInfo(Response $response) {
    $debug = $this->getRequest()->query->get('debug');
    if (!$debug) $debug = $this->getRequest()->request->get('debug');
    if ($debug) {
      $response->headers->set('X-VPA-Debug', 'debuggy!', TRUE);
    }
    return $response;
  }

  /**
   * Get all the records for a given category.
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
      if ($user) { // && $user->isEnabled()) {
        $records = $doctrine
          ->getRepository('VirtualPersistBundle:Record')
          ->findByUserCategorySince($user, $category, $this->requestSince($request, 0));
        // Did we get a record?
        if (count($records)) {
          $resultRecords = array('category' => $category);
          foreach ($records as $record) {
            $resultRecords['results'][] = array(
              'key' => $record->getKey(),
              'data' => $record->getData(),
              'timestamp' => $record->getTimestamp()->getTimestamp(), // extract unixtime
            );
          }
          $response = new JsonResponse($resultRecords, 200);
        }
      }
    } catch (\Exception $e) {
    }
    $response = $this->jsonpCallback($request, $response);
    return $this->addDebugInfo($response);
  }


  /**
   * @Route("/{uuid}/{category}/{key}", requirements={"uuid" = "[a-fA-F0-9]{8}-[a-fA-F0-9]{4}-[a-fA-F0-9]{4}-[a-fA-F0-9]{4}-[a-fA-F0-9]{12}"})
   * @Method({"GET"})
   */
  public function getAction(Request $request, $uuid, $category, $key) {
    // Return 404 by default so no one can brute-force hack the
    // UUIDs or categories or keys.
//    $this->requestIsInworld($request);
    $response = new TextPlainResponse('404: No Such Item.', 404);
    try {
      $doctrine = $this->getDoctrine();
      $user = $doctrine
        ->getRepository('VirtualPersistBundle:User')
        ->findOneByUuid($uuid);
      if ($user && $user->isEnabled()) {
        $record = $doctrine
          ->getRepository('VirtualPersistBundle:Record')
          ->findOneByUserCategoryKey($user, $category, $key);
        // Did we get a record?
        if ($record) {
          $response = new TextPlainResponse($record->getData(), 200);
        }
      }
    } catch (\Exception $e) {
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
    $conn = $em->getConnection();
    $recordRepository = $doctrine->getRepository('VirtualPersistBundle:Record');

    $user = $doctrine
      ->getRepository('VirtualPersistBundle:User')
      ->findOneByUuid($uuid);
    if ($user) {
      $record = $recordRepository
        ->findOneByUserCategoryKey($user, $category, $key);
      if ($record) {
        try {
          $conn->beginTransaction();
          $record->setData($request->request->get('data', ''));
          $record->setTimestamp(new \DateTime('now'));
          $em->persist($record);
          $em->flush();
          $conn->commit();
        } catch (\Exception $e) {
          $conn->rollback();
          $em->close();
          throw $e;
        }
      }
      else { // no record
        // Glean the data to post.
        $data = $request->request->get('data', '');

        $record = new Record();
        $record->setOwner($user);
        $record->setCategory($category);
        $record->setKey($key);
        $record->setData($data);
        $record->setTimestamp(new \DateTime('now'));
        // Isolate writing the new record in a transaction.
        $conn->beginTransaction();
        try {
          $em->persist($record);
          $em->flush();
          $conn->commit();
        } catch (\Exception $e) {
          $conn->rollback();
          $em->close();
          throw $e;
        }
      }
      $response = new TextPlainResponse('Item added.', 200);
    }
    else { // no such user
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
    if ($user) { // && $user->isActive()) {
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
    $response = new TextPlainResponse('Keys not found.', 404);
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
          $response = new JsonResponse($keyArray, 200);
        }
      }
    } catch (\Exception $e) {
    }
    return $this->addDebugInfo($response);
  }

  /**
   * @Route("/categories/{uuid}", requirements={"uuid" = "[a-fA-F0-9]{8}-[a-fA-F0-9]{4}-[a-fA-F0-9]{4}-[a-fA-F0-9]{4}-[a-fA-F0-9]{12}"})
   * @Method({"GET"})
   */
  public function categoriesAction($uuid) {
    $response = new TextPlainResponse('Categories not found.', 404);
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
          $response = new JsonResponse($categoryArray, 200);
        }
      }
    } catch (\Exception $e) {
    }
    return $this->addDebugInfo($response);
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

