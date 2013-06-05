<?php

namespace VirtualPersistAPI\VirtualPersistBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\EventDispatcher\EventDispatcher;
use VirtualPersistAPI\VirtualPersistBundle\EventListener\VPADebugListener;
use Symfony\Component\HttpKernel\KernelEvents;

class VirtualPersistBundle extends Bundle
{
/*
  public function __construct() {
    error_log('bundle');
    $listener = new VPADebugListener();
    $dispatcher = new EventDispatcher();
    $dispatcher->addListener(KernelEvents::REQUEST, array($listener, 'onKernelResponse', -128));
  }*/

}
