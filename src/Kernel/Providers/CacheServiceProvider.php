<?php


namespace Jiahetian\HyperfDouyin\Kernel\Providers;


use Jiahetian\HyperfDouyin\Kernel\Cache\FileCacheDriver;
use Jiahetian\HyperfDouyin\Kernel\ServiceContainer;
use Jiahetian\HyperfDouyin\Kernel\ServiceProviders;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

class CacheServiceProvider implements ServiceProviderInterface
{
    public function register(Container $pimple)
    {
        if (!isset($pimple[ServiceProviders::Cache])) {
            $pimple[ServiceProviders::Cache] = function (ServiceContainer $app) {
                return new FileCacheDriver(
                    $app[ServiceProviders::Config]->get('cache.tempDir') ?? sys_get_temp_dir()
                );
            };
        }
    }
}