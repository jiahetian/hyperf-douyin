<?php


namespace Jiahetian\HyperfDouyin\Kernel\Providers;


use Jiahetian\HyperfDouyin\Kernel\HttpClient\HttpClientManager;
use Jiahetian\HyperfDouyin\Kernel\HttpClient\SwooleClientDriver;
use Jiahetian\HyperfDouyin\Kernel\ServiceContainer;
use Jiahetian\HyperfDouyin\Kernel\ServiceProviders;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

class HttpClientServiceProvider implements ServiceProviderInterface
{
    public function register(Container $pimple)
    {
        if (!isset($pimple[ServiceProviders::HttpClientManager])) {
            $pimple[ServiceProviders::HttpClientManager] = function (ServiceContainer $app) {
                return new HttpClientManager(
                    $app[ServiceProviders::Config]->get('request.httpClientDriver') ?? SwooleClientDriver::class
                );
            };
        }
    }
}