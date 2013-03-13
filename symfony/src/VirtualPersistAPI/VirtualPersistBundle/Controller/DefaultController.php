<?php

namespace VirtualPersistAPI\VirtualPersistBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class DefaultController extends Controller {

  /**
   * @Route("/")
   * @Template()
   */
  public function indexAction() {
    $userRepo = $this->getDoctrine()
      ->getRepository('VirtualPersistBundle:User');
    $recordRepo = $this->getDoctrine()
      ->getRepository('VirtualPersistBundle:Record');

    $users = $userRepo->getAll();
    $categories = $recordRepo->uniqueCategories();
    return array(
      'header' => "Hi, I'm your VirtualPersistAPI site.",
      'users' => $users,
      'categories' => $categories
    );
  }

}

