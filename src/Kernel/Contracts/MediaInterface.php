<?php


namespace Jiahetian\HyperfDouyin\Kernel\Contracts;


interface MediaInterface extends MessageInterface
{
    /**
     * @return string
     */
    public function getMediaId(): string;
}