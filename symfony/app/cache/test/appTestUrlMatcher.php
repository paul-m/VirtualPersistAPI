<?php

use Symfony\Component\Routing\Exception\MethodNotAllowedException;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\RequestContext;

/**
 * appTestUrlMatcher
 *
 * This class has been auto-generated
 * by the Symfony Routing Component.
 */
class appTestUrlMatcher extends Symfony\Bundle\FrameworkBundle\Routing\RedirectableUrlMatcher
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

        if (0 === strpos($pathinfo, '/css/bootstrap')) {
            // _assetic_bootstrap_css
            if ($pathinfo === '/css/bootstrap.css') {
                return array (  '_controller' => 'assetic.controller:render',  'name' => 'bootstrap_css',  'pos' => NULL,  '_format' => 'css',  '_route' => '_assetic_bootstrap_css',);
            }

            if (0 === strpos($pathinfo, '/css/bootstrap_')) {
                // _assetic_bootstrap_css_0
                if ($pathinfo === '/css/bootstrap_bootstrap_1.css') {
                    return array (  '_controller' => 'assetic.controller:render',  'name' => 'bootstrap_css',  'pos' => 0,  '_format' => 'css',  '_route' => '_assetic_bootstrap_css_0',);
                }

                // _assetic_bootstrap_css_1
                if ($pathinfo === '/css/bootstrap_responsive_2.css') {
                    return array (  '_controller' => 'assetic.controller:render',  'name' => 'bootstrap_css',  'pos' => 1,  '_format' => 'css',  '_route' => '_assetic_bootstrap_css_1',);
                }

            }

        }

        if (0 === strpos($pathinfo, '/js')) {
            if (0 === strpos($pathinfo, '/js/bootstrap')) {
                // _assetic_bootstrap_js
                if ($pathinfo === '/js/bootstrap.js') {
                    return array (  '_controller' => 'assetic.controller:render',  'name' => 'bootstrap_js',  'pos' => NULL,  '_format' => 'js',  '_route' => '_assetic_bootstrap_js',);
                }

                if (0 === strpos($pathinfo, '/js/bootstrap_bootstrap-')) {
                    // _assetic_bootstrap_js_0
                    if ($pathinfo === '/js/bootstrap_bootstrap-transition_1.js') {
                        return array (  '_controller' => 'assetic.controller:render',  'name' => 'bootstrap_js',  'pos' => 0,  '_format' => 'js',  '_route' => '_assetic_bootstrap_js_0',);
                    }

                    // _assetic_bootstrap_js_1
                    if ($pathinfo === '/js/bootstrap_bootstrap-alert_2.js') {
                        return array (  '_controller' => 'assetic.controller:render',  'name' => 'bootstrap_js',  'pos' => 1,  '_format' => 'js',  '_route' => '_assetic_bootstrap_js_1',);
                    }

                    // _assetic_bootstrap_js_2
                    if ($pathinfo === '/js/bootstrap_bootstrap-button_3.js') {
                        return array (  '_controller' => 'assetic.controller:render',  'name' => 'bootstrap_js',  'pos' => 2,  '_format' => 'js',  '_route' => '_assetic_bootstrap_js_2',);
                    }

                    if (0 === strpos($pathinfo, '/js/bootstrap_bootstrap-c')) {
                        // _assetic_bootstrap_js_3
                        if ($pathinfo === '/js/bootstrap_bootstrap-carousel_4.js') {
                            return array (  '_controller' => 'assetic.controller:render',  'name' => 'bootstrap_js',  'pos' => 3,  '_format' => 'js',  '_route' => '_assetic_bootstrap_js_3',);
                        }

                        // _assetic_bootstrap_js_4
                        if ($pathinfo === '/js/bootstrap_bootstrap-collapse_5.js') {
                            return array (  '_controller' => 'assetic.controller:render',  'name' => 'bootstrap_js',  'pos' => 4,  '_format' => 'js',  '_route' => '_assetic_bootstrap_js_4',);
                        }

                    }

                    // _assetic_bootstrap_js_5
                    if ($pathinfo === '/js/bootstrap_bootstrap-dropdown_6.js') {
                        return array (  '_controller' => 'assetic.controller:render',  'name' => 'bootstrap_js',  'pos' => 5,  '_format' => 'js',  '_route' => '_assetic_bootstrap_js_5',);
                    }

                    // _assetic_bootstrap_js_6
                    if ($pathinfo === '/js/bootstrap_bootstrap-modal_7.js') {
                        return array (  '_controller' => 'assetic.controller:render',  'name' => 'bootstrap_js',  'pos' => 6,  '_format' => 'js',  '_route' => '_assetic_bootstrap_js_6',);
                    }

                    // _assetic_bootstrap_js_7
                    if ($pathinfo === '/js/bootstrap_bootstrap-tooltip_8.js') {
                        return array (  '_controller' => 'assetic.controller:render',  'name' => 'bootstrap_js',  'pos' => 7,  '_format' => 'js',  '_route' => '_assetic_bootstrap_js_7',);
                    }

                    // _assetic_bootstrap_js_8
                    if ($pathinfo === '/js/bootstrap_bootstrap-popover_9.js') {
                        return array (  '_controller' => 'assetic.controller:render',  'name' => 'bootstrap_js',  'pos' => 8,  '_format' => 'js',  '_route' => '_assetic_bootstrap_js_8',);
                    }

                    // _assetic_bootstrap_js_9
                    if ($pathinfo === '/js/bootstrap_bootstrap-scrollspy_10.js') {
                        return array (  '_controller' => 'assetic.controller:render',  'name' => 'bootstrap_js',  'pos' => 9,  '_format' => 'js',  '_route' => '_assetic_bootstrap_js_9',);
                    }

                    if (0 === strpos($pathinfo, '/js/bootstrap_bootstrap-t')) {
                        // _assetic_bootstrap_js_10
                        if ($pathinfo === '/js/bootstrap_bootstrap-tab_11.js') {
                            return array (  '_controller' => 'assetic.controller:render',  'name' => 'bootstrap_js',  'pos' => 10,  '_format' => 'js',  '_route' => '_assetic_bootstrap_js_10',);
                        }

                        // _assetic_bootstrap_js_11
                        if ($pathinfo === '/js/bootstrap_bootstrap-typeahead_12.js') {
                            return array (  '_controller' => 'assetic.controller:render',  'name' => 'bootstrap_js',  'pos' => 11,  '_format' => 'js',  '_route' => '_assetic_bootstrap_js_11',);
                        }

                    }

                    // _assetic_bootstrap_js_12
                    if ($pathinfo === '/js/bootstrap_bootstrap-affix_13.js') {
                        return array (  '_controller' => 'assetic.controller:render',  'name' => 'bootstrap_js',  'pos' => 12,  '_format' => 'js',  '_route' => '_assetic_bootstrap_js_12',);
                    }

                }

            }

            if (0 === strpos($pathinfo, '/js/jquery')) {
                // _assetic_jquery
                if ($pathinfo === '/js/jquery.js') {
                    return array (  '_controller' => 'assetic.controller:render',  'name' => 'jquery',  'pos' => NULL,  '_format' => 'js',  '_route' => '_assetic_jquery',);
                }

                // _assetic_jquery_0
                if ($pathinfo === '/js/jquery_jquery-1.9.1_1.js') {
                    return array (  '_controller' => 'assetic.controller:render',  'name' => 'jquery',  'pos' => 0,  '_format' => 'js',  '_route' => '_assetic_jquery_0',);
                }

            }

            if (0 === strpos($pathinfo, '/js/ff5fb4a')) {
                // _assetic_ff5fb4a
                if ($pathinfo === '/js/ff5fb4a.js') {
                    return array (  '_controller' => 'assetic.controller:render',  'name' => 'ff5fb4a',  'pos' => NULL,  '_format' => 'js',  '_route' => '_assetic_ff5fb4a',);
                }

                // _assetic_ff5fb4a_0
                if ($pathinfo === '/js/ff5fb4a_part_1_trafficStats_1.js') {
                    return array (  '_controller' => 'assetic.controller:render',  'name' => 'ff5fb4a',  'pos' => 0,  '_format' => 'js',  '_route' => '_assetic_ff5fb4a_0',);
                }

            }

            if (0 === strpos($pathinfo, '/js/compiled/traffic')) {
                // _assetic_4d7307e
                if ($pathinfo === '/js/compiled/traffic.js') {
                    return array (  '_controller' => 'assetic.controller:render',  'name' => '4d7307e',  'pos' => NULL,  '_format' => 'js',  '_route' => '_assetic_4d7307e',);
                }

                if (0 === strpos($pathinfo, '/js/compiled/traffic_')) {
                    if (0 === strpos($pathinfo, '/js/compiled/traffic_jq')) {
                        // _assetic_4d7307e_0
                        if ($pathinfo === '/js/compiled/traffic_jquery.jqplot.min_1.js') {
                            return array (  '_controller' => 'assetic.controller:render',  'name' => '4d7307e',  'pos' => 0,  '_format' => 'js',  '_route' => '_assetic_4d7307e_0',);
                        }

                        // _assetic_4d7307e_1
                        if ($pathinfo === '/js/compiled/traffic_jqplot.dateAxisRenderer.min_2.js') {
                            return array (  '_controller' => 'assetic.controller:render',  'name' => '4d7307e',  'pos' => 1,  '_format' => 'js',  '_route' => '_assetic_4d7307e_1',);
                        }

                    }

                    // _assetic_4d7307e_2
                    if ($pathinfo === '/js/compiled/traffic_part_3_primStats_1.js') {
                        return array (  '_controller' => 'assetic.controller:render',  'name' => '4d7307e',  'pos' => 2,  '_format' => 'js',  '_route' => '_assetic_4d7307e_2',);
                    }

                }

                // _assetic_f461006
                if ($pathinfo === '/js/compiled/traffic.js') {
                    return array (  '_controller' => 'assetic.controller:render',  'name' => 'f461006',  'pos' => NULL,  '_format' => 'js',  '_route' => '_assetic_f461006',);
                }

                if (0 === strpos($pathinfo, '/js/compiled/traffic_')) {
                    if (0 === strpos($pathinfo, '/js/compiled/traffic_jq')) {
                        // _assetic_f461006_0
                        if ($pathinfo === '/js/compiled/traffic_jquery.jqplot.min_1.js') {
                            return array (  '_controller' => 'assetic.controller:render',  'name' => 'f461006',  'pos' => 0,  '_format' => 'js',  '_route' => '_assetic_f461006_0',);
                        }

                        // _assetic_f461006_1
                        if ($pathinfo === '/js/compiled/traffic_jqplot.dateAxisRenderer.min_2.js') {
                            return array (  '_controller' => 'assetic.controller:render',  'name' => 'f461006',  'pos' => 1,  '_format' => 'js',  '_route' => '_assetic_f461006_1',);
                        }

                    }

                    // _assetic_f461006_2
                    if ($pathinfo === '/js/compiled/traffic_part_3_trafficStats_1.js') {
                        return array (  '_controller' => 'assetic.controller:render',  'name' => 'f461006',  'pos' => 2,  '_format' => 'js',  '_route' => '_assetic_f461006_2',);
                    }

                }

            }

            // _assetic_a13db7d
            if ($pathinfo === '/js/a13db7d.js') {
                return array (  '_controller' => 'assetic.controller:render',  'name' => 'a13db7d',  'pos' => NULL,  '_format' => 'js',  '_route' => '_assetic_a13db7d',);
            }

        }

        if (0 === strpos($pathinfo, '/_')) {
            // _wdt
            if (0 === strpos($pathinfo, '/_wdt') && preg_match('#^/_wdt/(?P<token>[^/]++)$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => '_wdt')), array (  '_controller' => 'web_profiler.controller.profiler:toolbarAction',));
            }

            if (0 === strpos($pathinfo, '/_profiler')) {
                // _profiler_home
                if (rtrim($pathinfo, '/') === '/_profiler') {
                    if (substr($pathinfo, -1) !== '/') {
                        return $this->redirect($pathinfo.'/', '_profiler_home');
                    }

                    return array (  '_controller' => 'web_profiler.controller.profiler:homeAction',  '_route' => '_profiler_home',);
                }

                if (0 === strpos($pathinfo, '/_profiler/search')) {
                    // _profiler_search
                    if ($pathinfo === '/_profiler/search') {
                        return array (  '_controller' => 'web_profiler.controller.profiler:searchAction',  '_route' => '_profiler_search',);
                    }

                    // _profiler_search_bar
                    if ($pathinfo === '/_profiler/search_bar') {
                        return array (  '_controller' => 'web_profiler.controller.profiler:searchBarAction',  '_route' => '_profiler_search_bar',);
                    }

                }

                // _profiler_purge
                if ($pathinfo === '/_profiler/purge') {
                    return array (  '_controller' => 'web_profiler.controller.profiler:purgeAction',  '_route' => '_profiler_purge',);
                }

                if (0 === strpos($pathinfo, '/_profiler/i')) {
                    // _profiler_info
                    if (0 === strpos($pathinfo, '/_profiler/info') && preg_match('#^/_profiler/info/(?P<about>[^/]++)$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => '_profiler_info')), array (  '_controller' => 'web_profiler.controller.profiler:infoAction',));
                    }

                    // _profiler_import
                    if ($pathinfo === '/_profiler/import') {
                        return array (  '_controller' => 'web_profiler.controller.profiler:importAction',  '_route' => '_profiler_import',);
                    }

                }

                // _profiler_export
                if (0 === strpos($pathinfo, '/_profiler/export') && preg_match('#^/_profiler/export/(?P<token>[^/\\.]++)\\.txt$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_profiler_export')), array (  '_controller' => 'web_profiler.controller.profiler:exportAction',));
                }

                // _profiler_phpinfo
                if ($pathinfo === '/_profiler/phpinfo') {
                    return array (  '_controller' => 'web_profiler.controller.profiler:phpinfoAction',  '_route' => '_profiler_phpinfo',);
                }

                // _profiler_search_results
                if (preg_match('#^/_profiler/(?P<token>[^/]++)/search/results$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_profiler_search_results')), array (  '_controller' => 'web_profiler.controller.profiler:searchResultsAction',));
                }

                // _profiler
                if (preg_match('#^/_profiler/(?P<token>[^/]++)$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_profiler')), array (  '_controller' => 'web_profiler.controller.profiler:panelAction',));
                }

                // _profiler_router
                if (preg_match('#^/_profiler/(?P<token>[^/]++)/router$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_profiler_router')), array (  '_controller' => 'web_profiler.controller.router:panelAction',));
                }

                // _profiler_exception
                if (preg_match('#^/_profiler/(?P<token>[^/]++)/exception$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_profiler_exception')), array (  '_controller' => 'web_profiler.controller.exception:showAction',));
                }

                // _profiler_exception_css
                if (preg_match('#^/_profiler/(?P<token>[^/]++)/exception\\.css$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_profiler_exception_css')), array (  '_controller' => 'web_profiler.controller.exception:cssAction',));
                }

            }

            if (0 === strpos($pathinfo, '/_configurator')) {
                // _configurator_home
                if (rtrim($pathinfo, '/') === '/_configurator') {
                    if (substr($pathinfo, -1) !== '/') {
                        return $this->redirect($pathinfo.'/', '_configurator_home');
                    }

                    return array (  '_controller' => 'Sensio\\Bundle\\DistributionBundle\\Controller\\ConfiguratorController::checkAction',  '_route' => '_configurator_home',);
                }

                // _configurator_step
                if (0 === strpos($pathinfo, '/_configurator/step') && preg_match('#^/_configurator/step/(?P<index>[^/]++)$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_configurator_step')), array (  '_controller' => 'Sensio\\Bundle\\DistributionBundle\\Controller\\ConfiguratorController::stepAction',));
                }

                // _configurator_final
                if ($pathinfo === '/_configurator/final') {
                    return array (  '_controller' => 'Sensio\\Bundle\\DistributionBundle\\Controller\\ConfiguratorController::finalAction',  '_route' => '_configurator_final',);
                }

            }

        }

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

        if (0 === strpos($pathinfo, '/regi')) {
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

            if (0 === strpos($pathinfo, '/register')) {
                // account_register
                if ($pathinfo === '/register') {
                    return array (  '_controller' => 'VirtualPersistAPI\\VirtualPersistBundle\\Controller\\AccountController::registerAction',  '_route' => 'account_register',);
                }

                // account_create
                if ($pathinfo === '/register/create') {
                    return array (  '_controller' => 'VirtualPersistAPI\\VirtualPersistBundle\\Controller\\AccountController::createAction',  '_route' => 'account_create',);
                }

            }

        }

        throw 0 < count($allow) ? new MethodNotAllowedException(array_unique($allow)) : new ResourceNotFoundException();
    }
}
