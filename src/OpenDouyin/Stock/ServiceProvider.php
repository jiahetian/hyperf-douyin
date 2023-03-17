<?php


namespace Jiahetian\HyperfDouyin\OpenDouyin\Stock;


use Jiahetian\HyperfDouyin\Kernel\ServiceContainer;
use Jiahetian\HyperfDouyin\Kernel\ServiceProviders;
use Jiahetian\HyperfDouyin\OpenDouyin\Application;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

class ServiceProvider implements ServiceProviderInterface
{
    public function register(Container $app)
    {
        if (!isset($app[ServiceProviders::AccessToken])) {
            $app[ServiceProviders::AccessToken] = function (ServiceContainer $app) {
                return new AccessToken($app);
            };
        }

        $app[Application::Stock] = function ($app) {
            return new Client($app);
        };
    }
}
