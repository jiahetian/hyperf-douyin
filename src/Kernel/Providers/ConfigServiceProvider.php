<?php


namespace Jiahetian\HyperfDouyin\Kernel\Providers;


use Jiahetian\HyperfDouyin\Kernel\Config;
use Jiahetian\HyperfDouyin\Kernel\ServiceContainer;
use Jiahetian\HyperfDouyin\Kernel\ServiceProviders;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

class ConfigServiceProvider implements ServiceProviderInterface
{
    public function register(Container $pimple)
    {
        if (!isset($pimple[ServiceProviders::Config])) {
            $pimple[ServiceProviders::Config] = function (ServiceContainer $app) {
                return new Config($app->getConfig());
            };
        }
    }
}