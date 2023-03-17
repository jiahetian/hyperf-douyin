<?php

namespace Jiahetian\HyperfDouyin\OpenDouyin;


use Jiahetian\HyperfDouyin\Kernel\ServiceContainer;
use Jiahetian\HyperfDouyin\BasicService;

/**
 * Class Application
 * @package Jiahetian\HyperfDouyin\OpenDouyin
 * @property AfterSale\Client $afterSale
 * @property Auth\AccessToken $accessToken
 * @property Certificate\Client $certificate
 * @property Order\Client $order
 * @property Product\Client $product
 * @property Shop\Client $shop
 * @property Stock\Client $stock
 * @property Tripartite\Client $tripartite
 * @property User\Client $user
 */
class Application extends ServiceContainer
{
    const AfterSale = 'afterSale';
    const Auth = 'auth';
    const Certificate = 'Certificate';
    const Order = 'order';
    const Product = 'product';
    const Shop = 'shop';
    const Stock = 'stock';
    const Tripartite = 'tripartite';
    const User = 'user';

    protected $providers = [
        AfterSale\ServiceProvider::class,
        Auth\ServiceProvider::class,
        Certificate\ServiceProvider::class,
        Order\ServiceProvider::class,
        Product\ServiceProvider::class,
        Shop\ServiceProvider::class,
        Stock\ServiceProvider::class,
        Tripartite\ServiceProvider::class,
        User\ServiceProvider::class,
    ];

    /**
     * Handle dynamic calls.
     *
     * @param string $method
     * @param array  $args
     *
     * @return mixed
     */
    public function __call($method, $args)
    {
        return $this->base->$method(...$args);
    }
}
