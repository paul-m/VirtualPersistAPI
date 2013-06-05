<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace VirtualPersistAPI\VirtualPersistBundle\EventListener;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Flash\AutoExpireFlashBag;
use Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * WebDebugToolbarListener injects the Web Debug Toolbar.
 *
 * The onKernelResponse method must be connected to the kernel.response event.
 *
 * The WDT is only injected on well-formed HTML (with a proper </body> tag).
 * This means that the WDT is never included in sub-requests or ESI requests.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 */
class VPADebugListener { // implements EventSubscriberInterface

    public function onKernelResponse(FilterResponseEvent $event)
    {
        error_log("eventy!");
/*        if (HttpKernelInterface::MASTER_REQUEST !== $event->getRequestType()) {
            return;
        }*/

        $response = $event->getResponse();
        $request = $event->getRequest();
        if ($request->query->get('debug', 0) || $request->request->get('debug', 0)) {
          $response->headers->set('X-VPA-Debug', 'Some woot info.', TRUE);
        }
    }

/*    public static function getSubscribedEvents()
    {
        return array(
            KernelEvents::RESPONSE => array('onKernelResponse', -128),
        );
    }*/
}
