<?php

namespace VirtualPersistAPI\VirtualPersistBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use VirtualPersistAPI\VirtualPersistBundle\Entity\User;
use VirtualPersistAPI\VirtualPersistBundle\Entity\Record;

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
    $doctrine = $this->getDoctrine();
    $record = $doctrine
            ->getRepository('VirtualPersistBundle:Record')
            ->findOneByUUIDCategoryKey($uuid, $category, $key);

    // Did we get a record?
    if ($record) {
      $user = $doctrine
              ->getRepository('VirtualPersistBundle:User')
              ->findOneByUuid($uuid);
      if ($user) { // if($user->has_authentication)
        $response = new Response(
                  $record->getData(),
                  200,
                  array('content-type' => 'text/plain')
        );
        return $response;
      }
      return new Response('bad access.', 401);
    }
    return new Response('404: No Such Item.', 404);
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
        ->findAllByUUIDCategoryKey($uuid, $category, $key);
      if (!empty($records)) {
        foreach($records as $record) {
          $entityManager->remove($record);
        }
        $entityManager->flush();
      }

      $request = Request::createFromGlobals();
      $data = $request->get('data');
      $record = new Record();
      $record->setOwnerUUID($uuid);
      $record->setCategory($category);
      $record->setKey($key);
      $record->setData($data);

      $entityManager->persist($record);
      $entityManager->flush();

      return new Response('Item added.', 200);
    } else {
      return new Response('bad access.', 401);
    }
    return new Response('Huh?', 503);
  }

  /**
   * TODO: Delete action works from cli curl, hopefully we can get
   * fixtures working soon.
   * @Route("/{uuid}/{category}/{key}", requirements={"uuid" = "[a-fA-F0-9]{8}-[a-fA-F0-9]{4}-[a-fA-F0-9]{4}-[a-fA-F0-9]{4}-[a-fA-F0-9]{12}"})
   * @Method({"DELETE"})
   */
  public function deleteAction($uuid, $category, $key) {
    $doctrine = $this->getDoctrine();
    $record = $doctrine
            ->getRepository('VirtualPersistBundle:Record')
            ->findOneByUUIDCategoryKey($uuid, $category, $key);

    // Did we get a record?
    if ($record) {
      $user = $doctrine
              ->getRepository('VirtualPersistBundle:User')
              ->findOneByUuid($uuid);
      if ($user) { // if($user->has_authentication)
        // Do the delete.
        $entityManager = $doctrine->getEntityManager();
        $entityManager->remove($record);
        $entityManager->flush();

        // Tell the user.
        $response = new Response('Item deleted.', 200);
        return $response;
      }
    }

    return new Response('No Such Item.', 404);
  }

  /**
   * @Route("/categories/{uuid}", requirements={"uuid" = "[a-fA-F0-9]{8}-[a-fA-F0-9]{4}-[a-fA-F0-9]{4}-[a-fA-F0-9]{4}-[a-fA-F0-9]{12}"})
   * @Method({"GET"})
   */
  public function categoriesAction($uuid) {
    $doctrine = $this->getDoctrine();
    $categories = $doctrine
            ->getRepository('VirtualPersistBundle:Record')
            ->categoriesForUUID($uuid);

    // Did we get an answer?
    if ($categories) {
      $user = $doctrine
              ->getRepository('VirtualPersistBundle:User')
              ->findOneByUuid($uuid);
      if ($user) { // if($user->has_authentication)
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
  }

  /**
   * @Route("/keys/{uuid}/{category}", requirements={"uuid" = "[a-fA-F0-9]{8}-[a-fA-F0-9]{4}-[a-fA-F0-9]{4}-[a-fA-F0-9]{4}-[a-fA-F0-9]{12}"})
   * @Method({"GET"})
   */
  public function keysAction($uuid, $category) {
    $doctrine = $this->getDoctrine();
    $keys = $doctrine
            ->getRepository('VirtualPersistBundle:Record')
            ->keysForUUIDCategory($uuid, $category);

    // Did we get an answer?
    if ($keys) {
      $user = $doctrine
              ->getRepository('VirtualPersistBundle:User')
              ->findOneByUuid($uuid);
      if ($user) { // if($user->has_authentication)
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
  }

}

