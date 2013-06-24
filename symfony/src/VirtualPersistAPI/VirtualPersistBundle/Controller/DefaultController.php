<?php

namespace VirtualPersistAPI\VirtualPersistBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

use VirtualPersistAPI\VirtualPersistBundle\Entity\Log;
use VirtualPersistAPI\VirtualPersistBundle\Entity\Record;

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

  /**
   * @Route("/useage")
   * @Template()
   */
  public function useageAction() {
    $resultArray = array(
      'header' => 'VPA Useage (sort of)',
      'logs' => array(),
    );
    $resultArray['logs'] = array(new Log());
    return $resultArray;
  }
  
  /**
   * @Route("/region/{region}")
   * @Template()
   */
  public function regionAction(Request $request, $region) {
    $resultArray = array(
      'header' => "Information for $region",
      'logs' => array(),
    );
    return $resultArray;
  }

  /**
   * @Route("/region/traffic/{region}")
   * @Template()
   */
  public function regionTrafficAction(Request $request, $region) {
    $resultArray = array(
      'regionName' => $region,
      'header' => "Traffic For Region: $region",
      'records' => array(),
    );
    $since = new \DateTime();
    $since->setTimestamp(0);
//    $since->sub(new \DateInterval('P30D'));
    $doctrine = $this->getDoctrine();
    $records = $doctrine
      ->getRepository('VirtualPersistBundle:Record')
      ->findByCategoryKeySince('region_traffic', $region, $since);
    if ($records) $resultArray['records'] = $records;
    return $resultArray;
  }

}

