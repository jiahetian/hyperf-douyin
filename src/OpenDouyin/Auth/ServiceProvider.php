<?php


namespace Jiahetian\HyperfDouyin\OpenDouyin\Auth;


use Jiahetian\HyperfDouyin\Kernel\ServiceContainer;
use Jiahetian\HyperfDouyin\Kernel\ServiceProviders;
use Jiahetian\HyperfDouyin\MiniProgram\Application;
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

        $app[Application::Auth] = function ($app) {
            return new Client($app);
        };
    }
}
