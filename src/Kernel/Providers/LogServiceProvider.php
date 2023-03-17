<?php


namespace Jiahetian\HyperfDouyin\Kernel\Providers;


use Jiahetian\HyperfDouyin\Kernel\Log\FileLogDriver;
use Jiahetian\HyperfDouyin\Kernel\ServiceContainer;
use Jiahetian\HyperfDouyin\Kernel\ServiceProviders;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

class LogServiceProvider implements ServiceProviderInterface
{
    public function register(Container $pimple)
    {
        if (!isset($pimple[ServiceProviders::Logger])) {
            $pimple[ServiceProviders::Logger] = function (ServiceContainer $app) {
                return new FileLogDriver($app[ServiceProviders::Config]->get('log.tempDir') ?? sys_get_temp_dir());
            };
        }
    }
}