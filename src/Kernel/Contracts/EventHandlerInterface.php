<?php


namespace Jiahetian\HyperfDouyin\Kernel\Contracts;


interface EventHandlerInterface
{
    /**
     * @param null $payload
     * @return mixed
     */
    public function handle($payload = null);
}