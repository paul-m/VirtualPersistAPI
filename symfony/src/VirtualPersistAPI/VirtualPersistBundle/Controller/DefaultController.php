<?php

namespace VirtualPersistAPI\VirtualPersistBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

use VirtualPersistAPI\VirtualPersistBundle\Entity\Log;

class DefaultController extends Controller {

  /**
   * @Route("/")
   * @Template()
   */
  public function indexAction() {
    $resultArray = array(
      'header' => "Hi, I'm your VirtualPersistAPI site.",
      'users' => array(),
      'categories' => array(),
    );
//    try {
      $userRepo = $this->getDoctrine()
        ->getRepository('VirtualPersistBundle:User');
      $recordRepo = $this->getDoctrine()
        ->getRepository('VirtualPersistBundle:Record');
  
      $users = $userRepo->getAll();
      $categories = $recordRepo->uniqueCategories();
      $resultArray['users'] = $users;
      $resultArray['categories'] = $categories;
//    } catch (\Exception $e) {
 //   }
    return $resultArray;
  }

  /**
   * @Route("/logs")
   * @Template()
   */
  public function logsAction() {
    $resultArray = array(
      'header' => 'VirtualPersistAPI Log Entries',
      'logs' => array(),
    );
    $logsRepo = $this->getDoctrine()
      ->getRepository('VirtualPersistBundle:Log');

    $logs = $logsRepo->getNewest(30);
    error_log(print_r($logs, TRUE));
    $resultArray['logs'] = $logs;
    return $resultArray;
  }

}

