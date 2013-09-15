<?php

use Symfony\Component\Routing\Exception\MethodNotAllowedException;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\RequestContext;

/**
 * appProdUrlMatcher
 *
 * This class has been auto-generated
 * by the Symfony Routing Component.
 */
class appProdUrlMatcher extends Symfony\Bundle\FrameworkBundle\Routing\RedirectableUrlMatcher
{
    /**
     * Constructor.
     */
    public function __construct(RequestContext $context)
    {
        $this->context = $context;
    }

    public function match($pathinfo)
    {
        $allow = array();
        $pathinfo = rawurldecode($pathinfo);

        if (0 === strpos($pathinfo, '/api')) {
            // virtualpersistapi_virtualpersist_api_getcategory
            if (preg_match('#^/api/(?P<uuid>[a-fA-F0-9]{8}-[a-fA-F0-9]{4}-[a-fA-F0-9]{4}-[a-fA-F0-9]{4}-[a-fA-F0-9]{12})/(?P<category>[^/]++)$#s', $pathinfo, $matches)) {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_virtualpersistapi_virtualpersist_api_getcategory;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'virtualpersistapi_virtualpersist_api_getcategory')), array (  '_controller' => 'VirtualPersistAPI\\VirtualPersistBundle\\Controller\\APIController::getCategoryAction',));
            }
            not_virtualpersistapi_virtualpersist_api_getcategory:

            // virtualpersistapi_virtualpersist_api_gettimestamp
            if (0 === strpos($pathinfo, '/api/timestamp') && preg_match('#^/api/timestamp/(?P<uuid>[a-fA-F0-9]{8}-[a-fA-F0-9]{4}-[a-fA-F0-9]{4}-[a-fA-F0-9]{4}-[a-fA-F0-9]{12})/(?P<category>[^/]++)/(?P<key>[^/]++)$#s', $pathinfo, $matches)) {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_virtualpersistapi_virtualpersist_api_gettimestamp;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'virtualpersistapi_virtualpersist_api_gettimestamp')), array (  '_controller' => 'VirtualPersistAPI\\VirtualPersistBundle\\Controller\\APIController::getTimestampAction',));
            }
            not_virtualpersistapi_virtualpersist_api_gettimestamp:

            // virtualpersistapi_virtualpersist_api_get
            if (preg_match('#^/api/(?P<uuid>[a-fA-F0-9]{8}-[a-fA-F0-9]{4}-[a-fA-F0-9]{4}-[a-fA-F0-9]{4}-[a-fA-F0-9]{12})/(?P<category>[^/]++)/(?P<key>[^/]++)$#s', $pathinfo, $matches)) {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_virtualpersistapi_virtualpersist_api_get;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'virtualpersistapi_virtualpersist_api_get')), array (  '_controller' => 'VirtualPersistAPI\\VirtualPersistBundle\\Controller\\APIController::getAction',));
            }
            not_virtualpersistapi_virtualpersist_api_get:

            // virtualpersistapi_virtualpersist_api_post
            if (preg_match('#^/api/(?P<uuid>[a-fA-F0-9]{8}-[a-fA-F0-9]{4}-[a-fA-F0-9]{4}-[a-fA-F0-9]{4}-[a-fA-F0-9]{12})/(?P<category>[^/]++)/(?P<key>[^/]++)$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_virtualpersistapi_virtualpersist_api_post;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'virtualpersistapi_virtualpersist_api_post')), array (  '_controller' => 'VirtualPersistAPI\\VirtualPersistBundle\\Controller\\APIController::postAction',));
            }
            not_virtualpersistapi_virtualpersist_api_post:

            // virtualpersistapi_virtualpersist_api_delete
            if (preg_match('#^/api/(?P<uuid>[a-fA-F0-9]{8}-[a-fA-F0-9]{4}-[a-fA-F0-9]{4}-[a-fA-F0-9]{4}-[a-fA-F0-9]{12})/(?P<category>[^/]++)/(?P<key>[^/]++)$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'DELETE') {
                    $allow[] = 'DELETE';
                    goto not_virtualpersistapi_virtualpersist_api_delete;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'virtualpersistapi_virtualpersist_api_delete')), array (  '_controller' => 'VirtualPersistAPI\\VirtualPersistBundle\\Controller\\APIController::deleteAction',));
            }
            not_virtualpersistapi_virtualpersist_api_delete:

            // virtualpersistapi_virtualpersist_api_keys
            if (0 === strpos($pathinfo, '/api/keys') && preg_match('#^/api/keys/(?P<uuid>[a-fA-F0-9]{8}-[a-fA-F0-9]{4}-[a-fA-F0-9]{4}-[a-fA-F0-9]{4}-[a-fA-F0-9]{12})/(?P<category>[^/]++)$#s', $pathinfo, $matches)) {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_virtualpersistapi_virtualpersist_api_keys;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'virtualpersistapi_virtualpersist_api_keys')), array (  '_controller' => 'VirtualPersistAPI\\VirtualPersistBundle\\Controller\\APIController::keysAction',));
            }
            not_virtualpersistapi_virtualpersist_api_keys:

            // virtualpersistapi_virtualpersist_api_categories
            if (0 === strpos($pathinfo, '/api/categories') && preg_match('#^/api/categories/(?P<uuid>[a-fA-F0-9]{8}-[a-fA-F0-9]{4}-[a-fA-F0-9]{4}-[a-fA-F0-9]{4}-[a-fA-F0-9]{12})$#s', $pathinfo, $matches)) {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_virtualpersistapi_virtualpersist_api_categories;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'virtualpersistapi_virtualpersist_api_categories')), array (  '_controller' => 'VirtualPersistAPI\\VirtualPersistBundle\\Controller\\APIController::categoriesAction',));
            }
            not_virtualpersistapi_virtualpersist_api_categories:

            // virtualpersistapi_virtualpersist_api_userget
            if (0 === strpos($pathinfo, '/api/user') && preg_match('#^/api/user/(?P<uuid>[a-fA-F0-9]{8}-[a-fA-F0-9]{4}-[a-fA-F0-9]{4}-[a-fA-F0-9]{4}-[a-fA-F0-9]{12})$#s', $pathinfo, $matches)) {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_virtualpersistapi_virtualpersist_api_userget;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'virtualpersistapi_virtualpersist_api_userget')), array (  '_controller' => 'VirtualPersistAPI\\VirtualPersistBundle\\Controller\\APIController::userGetAction',));
            }
            not_virtualpersistapi_virtualpersist_api_userget:

        }

        // virtualpersistapi_virtualpersist_default_index
        if (rtrim($pathinfo, '/') === '') {
            if (substr($pathinfo, -1) !== '/') {
                return $this->redirect($pathinfo.'/', 'virtualpersistapi_virtualpersist_default_index');
            }

            return array (  '_controller' => 'VirtualPersistAPI\\VirtualPersistBundle\\Controller\\DefaultController::indexAction',  '_route' => 'virtualpersistapi_virtualpersist_default_index',);
        }

        // virtualpersistapi_virtualpersist_default_logs
        if ($pathinfo === '/logs') {
            return array (  '_controller' => 'VirtualPersistAPI\\VirtualPersistBundle\\Controller\\DefaultController::logsAction',  '_route' => 'virtualpersistapi_virtualpersist_default_logs',);
        }

        // virtualpersistapi_virtualpersist_default_useage
        if ($pathinfo === '/useage') {
            return array (  '_controller' => 'VirtualPersistAPI\\VirtualPersistBundle\\Controller\\DefaultController::useageAction',  '_route' => 'virtualpersistapi_virtualpersist_default_useage',);
        }

        if (0 === strpos($pathinfo, '/region')) {
            // virtualpersistapi_virtualpersist_default_region
            if (preg_match('#^/region/(?P<region>[^/]++)$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'virtualpersistapi_virtualpersist_default_region')), array (  '_controller' => 'VirtualPersistAPI\\VirtualPersistBundle\\Controller\\DefaultController::regionAction',));
            }

            // virtualpersistapi_virtualpersist_default_regiontraffic
            if (0 === strpos($pathinfo, '/region/traffic') && preg_match('#^/region/traffic/(?P<region>[^/]++)$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'virtualpersistapi_virtualpersist_default_regiontraffic')), array (  '_controller' => 'VirtualPersistAPI\\VirtualPersistBundle\\Controller\\DefaultController::regionTrafficAction',));
            }

            // virtualpersistapi_virtualpersist_default_regionprimuse
            if (0 === strpos($pathinfo, '/region/primuse') && preg_match('#^/region/primuse/(?P<region>[^/]++)$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'virtualpersistapi_virtualpersist_default_regionprimuse')), array (  '_controller' => 'VirtualPersistAPI\\VirtualPersistBundle\\Controller\\DefaultController::regionPrimuseAction',));
            }

        }

        throw 0 < count($allow) ? new MethodNotAllowedException(array_unique($allow)) : new ResourceNotFoundException();
    }
}
