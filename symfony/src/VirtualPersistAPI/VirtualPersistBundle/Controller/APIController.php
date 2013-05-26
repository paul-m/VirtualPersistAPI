<?php
namespace VirtualPersistAPI\VirtualPersistBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
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
   * @Route("/{uuid}/{category}/{key}", requirements={"uuid" = "[a-fA-F0-9]{8}-[a-fA-F0-9]{4}-[a-fA-F0-9]{4}-[a-fA-F0-9]{4}-[a-fA-F0-9]{12}"})
   * @Method({"GET"})
   */
  public function getAction($uuid, $category, $key) {
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
          return new TextPlainResponse($record->getData(), 200);
        }
      }
    } catch (\Exception $e) {
      // no-op
    }
    // Always return 404 so no one can brute-force hack the
    // UUIDs or categories or keys.
    return new TextPlainResponse('404: No Such Item.', 404);
  }


  /**
   * @Route("/{uuid}/{category}/{key}", requirements={"uuid" = "[a-fA-F0-9]{8}-[a-fA-F0-9]{4}-[a-fA-F0-9]{4}-[a-fA-F0-9]{4}-[a-fA-F0-9]{12}"})
   * @Method({"POST"})
   */
  public function postAction($uuid, $category, $key) {
    $doctrine = $this->getDoctrine();
    $entityManager = $doctrine->getEntityManager();

    $user = $doctrine
      ->getRepository('VirtualPersistBundle:User')
      ->findOneByUuid($uuid);
    if ($user) { // if($user->has_authentication)
      $records = $doctrine
        ->getRepository('VirtualPersistBundle:Record')
        ->findByUserCategoryKey($user, $category, $key);
      foreach($records as $record) {
        $entityManager->remove($record);
      }
      $entityManager->flush();

      $request = $this->get('request');

      $data = $request->request->get('data');
      $record = new Record();
      $record->setOwner($user);
      $record->setCategory($category);
      $record->setKey($key);
      $record->setData($data);

      $entityManager->persist($record);
      $entityManager->flush();

      return new TextPlainResponse('Item added.', 200);
    } else {
      return new TextPlainResponse('bad access.', 401);
    }
    return new TextPlainResponse('Huh?', 503);
  }

  /**
   * TODO: Delete action works from cli curl, hopefully we can get
   * fixtures working soon.
   * @Route("/{uuid}/{category}/{key}", requirements={"uuid" = "[a-fA-F0-9]{8}-[a-fA-F0-9]{4}-[a-fA-F0-9]{4}-[a-fA-F0-9]{4}-[a-fA-F0-9]{12}"})
   * @Method({"DELETE"})
   */
  public function deleteAction($uuid, $category, $key) {
    $doctrine = $this->getDoctrine();
    $user = $doctrine
      ->getRepository('VirtualPersistBundle:User')
      ->findOneByUuid($uuid);
    if ($user) { // if($user->has_authentication)
      $records = $doctrine
        ->getRepository('VirtualPersistBundle:Record')
        ->findByUserCategoryKey($user, $category, $key);
      // Did we get a record?
      if (count($records)) {
        $theRecords = array();
        $entityManager = $doctrine->getEntityManager();
        foreach($records as $record) {
          // Store a reference.
          $theRecords[] = $record;
          // Tell ORM to remove.
          $entityManager->remove($record);
        }
        $entityManager->flush();
        // Tell the user.
        $response = new TextPlainResponse('Item deleted.', 200);
        return $response;
      }
    }
    return new TextPlainResponse('No Such Item.', 404);
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
   * @Route("/user/{uuid}", requirements={"uuid" = "[a-fA-F0-9]{8}-[a-fA-F0-9]{4}-[a-fA-F0-9]{4}-[a-fA-F0-9]{4}-[a-fA-F0-9]{12}"})
   * @Method({"GET"})
   */
  public function userGetAction($uuid) {
    $user = $this->getDoctrine()
      ->getRepository('VirtualPersistBundle:User')
      ->findOneByUuid($uuid);
    $request = $this->get('request');
    if ($user && $user->isEnabled()) {
      return new Response('User: ' . $user->getUUID());
    }
    return new Response('User? LOSER!', 404);
  }

}

