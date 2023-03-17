<?php


namespace Jiahetian\HyperfDouyin\Kernel\Messages;

/**
 * Class Voice
 * @property string $media_id
 * @package Jiahetian\HyperfDouyin\Kernel\Messages
 */
class Voice extends Media
{
    protected $type = Message::VOICE;
}
