<?php


namespace Jiahetian\HyperfDouyin;

use Jiahetian\HyperfDouyin\OpenDouyin\Application as OpenDouyin;

class Factory
{
    /**
     * @param mixed ...$arguments
     * @return OpenDouyin
     */
    public static function openDouyin(...$arguments)
    {
        return new OpenDouyin(...$arguments);
    }
}
