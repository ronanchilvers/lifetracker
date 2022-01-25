<?php

namespace App\Facades;

use Psr\Log\LoggerInterface;
use Ronanchilvers\Foundation\Facade\Facade;

/**
 * Session facade class
 *
 * @author Ronan Chilvers <ronan@d3r.com>
 */
class Route extends Facade
{
    /**
     * @var string
     */
    protected static $serviceName = \Slim\App::class;

    public static function getService()
    {
        $name = static::getFacadeName();

        $app = self::$container->get($name);
        
        return $app->getRouteCollector()->getRouteParser();
    }
}
