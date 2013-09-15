<?php

use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Exception\RouteNotFoundException;
use Psr\Log\LoggerInterface;

/**
 * appProdUrlGenerator
 *
 * This class has been auto-generated
 * by the Symfony Routing Component.
 */
class appProdUrlGenerator extends Symfony\Component\Routing\Generator\UrlGenerator
{
    static private $declaredRoutes = array(
        'virtualpersistapi_virtualpersist_api_getcategory' => array (  0 =>   array (    0 => 'uuid',    1 => 'category',  ),  1 =>   array (    '_controller' => 'VirtualPersistAPI\\VirtualPersistBundle\\Controller\\APIController::getCategoryAction',  ),  2 =>   array (    'uuid' => '[a-fA-F0-9]{8}-[a-fA-F0-9]{4}-[a-fA-F0-9]{4}-[a-fA-F0-9]{4}-[a-fA-F0-9]{12}',    '_method' => 'GET',  ),  3 =>   array (    0 =>     array (      0 => 'variable',      1 => '/',      2 => '[^/]++',      3 => 'category',    ),    1 =>     array (      0 => 'variable',      1 => '/',      2 => '[a-fA-F0-9]{8}-[a-fA-F0-9]{4}-[a-fA-F0-9]{4}-[a-fA-F0-9]{4}-[a-fA-F0-9]{12}',      3 => 'uuid',    ),    2 =>     array (      0 => 'text',      1 => '/api',    ),  ),  4 =>   array (  ),),
        'virtualpersistapi_virtualpersist_api_gettimestamp' => array (  0 =>   array (    0 => 'uuid',    1 => 'category',    2 => 'key',  ),  1 =>   array (    '_controller' => 'VirtualPersistAPI\\VirtualPersistBundle\\Controller\\APIController::getTimestampAction',  ),  2 =>   array (    'uuid' => '[a-fA-F0-9]{8}-[a-fA-F0-9]{4}-[a-fA-F0-9]{4}-[a-fA-F0-9]{4}-[a-fA-F0-9]{12}',    '_method' => 'GET',  ),  3 =>   array (    0 =>     array (      0 => 'variable',      1 => '/',      2 => '[^/]++',      3 => 'key',    ),    1 =>     array (      0 => 'variable',      1 => '/',      2 => '[^/]++',      3 => 'category',    ),    2 =>     array (      0 => 'variable',      1 => '/',      2 => '[a-fA-F0-9]{8}-[a-fA-F0-9]{4}-[a-fA-F0-9]{4}-[a-fA-F0-9]{4}-[a-fA-F0-9]{12}',      3 => 'uuid',    ),    3 =>     array (      0 => 'text',      1 => '/api/timestamp',    ),  ),  4 =>   array (  ),),
        'virtualpersistapi_virtualpersist_api_get' => array (  0 =>   array (    0 => 'uuid',    1 => 'category',    2 => 'key',  ),  1 =>   array (    '_controller' => 'VirtualPersistAPI\\VirtualPersistBundle\\Controller\\APIController::getAction',  ),  2 =>   array (    'uuid' => '[a-fA-F0-9]{8}-[a-fA-F0-9]{4}-[a-fA-F0-9]{4}-[a-fA-F0-9]{4}-[a-fA-F0-9]{12}',    '_method' => 'GET',  ),  3 =>   array (    0 =>     array (      0 => 'variable',      1 => '/',      2 => '[^/]++',      3 => 'key',    ),    1 =>     array (      0 => 'variable',      1 => '/',      2 => '[^/]++',      3 => 'category',    ),    2 =>     array (      0 => 'variable',      1 => '/',      2 => '[a-fA-F0-9]{8}-[a-fA-F0-9]{4}-[a-fA-F0-9]{4}-[a-fA-F0-9]{4}-[a-fA-F0-9]{12}',      3 => 'uuid',    ),    3 =>     array (      0 => 'text',      1 => '/api',    ),  ),  4 =>   array (  ),),
        'virtualpersistapi_virtualpersist_api_post' => array (  0 =>   array (    0 => 'uuid',    1 => 'category',    2 => 'key',  ),  1 =>   array (    '_controller' => 'VirtualPersistAPI\\VirtualPersistBundle\\Controller\\APIController::postAction',  ),  2 =>   array (    'uuid' => '[a-fA-F0-9]{8}-[a-fA-F0-9]{4}-[a-fA-F0-9]{4}-[a-fA-F0-9]{4}-[a-fA-F0-9]{12}',    '_method' => 'POST',  ),  3 =>   array (    0 =>     array (      0 => 'variable',      1 => '/',      2 => '[^/]++',      3 => 'key',    ),    1 =>     array (      0 => 'variable',      1 => '/',      2 => '[^/]++',      3 => 'category',    ),    2 =>     array (      0 => 'variable',      1 => '/',      2 => '[a-fA-F0-9]{8}-[a-fA-F0-9]{4}-[a-fA-F0-9]{4}-[a-fA-F0-9]{4}-[a-fA-F0-9]{12}',      3 => 'uuid',    ),    3 =>     array (      0 => 'text',      1 => '/api',    ),  ),  4 =>   array (  ),),
        'virtualpersistapi_virtualpersist_api_delete' => array (  0 =>   array (    0 => 'uuid',    1 => 'category',    2 => 'key',  ),  1 =>   array (    '_controller' => 'VirtualPersistAPI\\VirtualPersistBundle\\Controller\\APIController::deleteAction',  ),  2 =>   array (    'uuid' => '[a-fA-F0-9]{8}-[a-fA-F0-9]{4}-[a-fA-F0-9]{4}-[a-fA-F0-9]{4}-[a-fA-F0-9]{12}',    '_method' => 'DELETE',  ),  3 =>   array (    0 =>     array (      0 => 'variable',      1 => '/',      2 => '[^/]++',      3 => 'key',    ),    1 =>     array (      0 => 'variable',      1 => '/',      2 => '[^/]++',      3 => 'category',    ),    2 =>     array (      0 => 'variable',      1 => '/',      2 => '[a-fA-F0-9]{8}-[a-fA-F0-9]{4}-[a-fA-F0-9]{4}-[a-fA-F0-9]{4}-[a-fA-F0-9]{12}',      3 => 'uuid',    ),    3 =>     array (      0 => 'text',      1 => '/api',    ),  ),  4 =>   array (  ),),
        'virtualpersistapi_virtualpersist_api_keys' => array (  0 =>   array (    0 => 'uuid',    1 => 'category',  ),  1 =>   array (    '_controller' => 'VirtualPersistAPI\\VirtualPersistBundle\\Controller\\APIController::keysAction',  ),  2 =>   array (    'uuid' => '[a-fA-F0-9]{8}-[a-fA-F0-9]{4}-[a-fA-F0-9]{4}-[a-fA-F0-9]{4}-[a-fA-F0-9]{12}',    '_method' => 'GET',  ),  3 =>   array (    0 =>     array (      0 => 'variable',      1 => '/',      2 => '[^/]++',      3 => 'category',    ),    1 =>     array (      0 => 'variable',      1 => '/',      2 => '[a-fA-F0-9]{8}-[a-fA-F0-9]{4}-[a-fA-F0-9]{4}-[a-fA-F0-9]{4}-[a-fA-F0-9]{12}',      3 => 'uuid',    ),    2 =>     array (      0 => 'text',      1 => '/api/keys',    ),  ),  4 =>   array (  ),),
        'virtualpersistapi_virtualpersist_api_categories' => array (  0 =>   array (    0 => 'uuid',  ),  1 =>   array (    '_controller' => 'VirtualPersistAPI\\VirtualPersistBundle\\Controller\\APIController::categoriesAction',  ),  2 =>   array (    'uuid' => '[a-fA-F0-9]{8}-[a-fA-F0-9]{4}-[a-fA-F0-9]{4}-[a-fA-F0-9]{4}-[a-fA-F0-9]{12}',    '_method' => 'GET',  ),  3 =>   array (    0 =>     array (      0 => 'variable',      1 => '/',      2 => '[a-fA-F0-9]{8}-[a-fA-F0-9]{4}-[a-fA-F0-9]{4}-[a-fA-F0-9]{4}-[a-fA-F0-9]{12}',      3 => 'uuid',    ),    1 =>     array (      0 => 'text',      1 => '/api/categories',    ),  ),  4 =>   array (  ),),
        'virtualpersistapi_virtualpersist_api_userget' => array (  0 =>   array (    0 => 'uuid',  ),  1 =>   array (    '_controller' => 'VirtualPersistAPI\\VirtualPersistBundle\\Controller\\APIController::userGetAction',  ),  2 =>   array (    'uuid' => '[a-fA-F0-9]{8}-[a-fA-F0-9]{4}-[a-fA-F0-9]{4}-[a-fA-F0-9]{4}-[a-fA-F0-9]{12}',    '_method' => 'GET',  ),  3 =>   array (    0 =>     array (      0 => 'variable',      1 => '/',      2 => '[a-fA-F0-9]{8}-[a-fA-F0-9]{4}-[a-fA-F0-9]{4}-[a-fA-F0-9]{4}-[a-fA-F0-9]{12}',      3 => 'uuid',    ),    1 =>     array (      0 => 'text',      1 => '/api/user',    ),  ),  4 =>   array (  ),),
        'virtualpersistapi_virtualpersist_default_index' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'VirtualPersistAPI\\VirtualPersistBundle\\Controller\\DefaultController::indexAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/',    ),  ),  4 =>   array (  ),),
        'virtualpersistapi_virtualpersist_default_logs' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'VirtualPersistAPI\\VirtualPersistBundle\\Controller\\DefaultController::logsAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/logs',    ),  ),  4 =>   array (  ),),
        'virtualpersistapi_virtualpersist_default_useage' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'VirtualPersistAPI\\VirtualPersistBundle\\Controller\\DefaultController::useageAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/useage',    ),  ),  4 =>   array (  ),),
        'virtualpersistapi_virtualpersist_default_region' => array (  0 =>   array (    0 => 'region',  ),  1 =>   array (    '_controller' => 'VirtualPersistAPI\\VirtualPersistBundle\\Controller\\DefaultController::regionAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'variable',      1 => '/',      2 => '[^/]++',      3 => 'region',    ),    1 =>     array (      0 => 'text',      1 => '/region',    ),  ),  4 =>   array (  ),),
        'virtualpersistapi_virtualpersist_default_regiontraffic' => array (  0 =>   array (    0 => 'region',  ),  1 =>   array (    '_controller' => 'VirtualPersistAPI\\VirtualPersistBundle\\Controller\\DefaultController::regionTrafficAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'variable',      1 => '/',      2 => '[^/]++',      3 => 'region',    ),    1 =>     array (      0 => 'text',      1 => '/region/traffic',    ),  ),  4 =>   array (  ),),
        'virtualpersistapi_virtualpersist_default_regionprimuse' => array (  0 =>   array (    0 => 'region',  ),  1 =>   array (    '_controller' => 'VirtualPersistAPI\\VirtualPersistBundle\\Controller\\DefaultController::regionPrimuseAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'variable',      1 => '/',      2 => '[^/]++',      3 => 'region',    ),    1 =>     array (      0 => 'text',      1 => '/region/primuse',    ),  ),  4 =>   array (  ),),
    );

    /**
     * Constructor.
     */
    public function __construct(RequestContext $context, LoggerInterface $logger = null)
    {
        $this->context = $context;
        $this->logger = $logger;
    }

    public function generate($name, $parameters = array(), $referenceType = self::ABSOLUTE_PATH)
    {
        if (!isset(self::$declaredRoutes[$name])) {
            throw new RouteNotFoundException(sprintf('Unable to generate a URL for the named route "%s" as such route does not exist.', $name));
        }

        list($variables, $defaults, $requirements, $tokens, $hostTokens) = self::$declaredRoutes[$name];

        return $this->doGenerate($variables, $defaults, $requirements, $tokens, $parameters, $name, $referenceType, $hostTokens);
    }
}
