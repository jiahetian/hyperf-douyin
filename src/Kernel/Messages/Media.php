<?php


namespace Jiahetian\HyperfDouyin\Kernel\Messages;


use EasySwoole\Utility\Str;
use Jiahetian\HyperfDouyin\Kernel\Contracts\MediaInterface;

/**
 * Class Media
 * @package Jiahetian\HyperfDouyin\Kernel\Messages
 * @property string $mediaId
 */
class Media extends Message implements MediaInterface
{
    /**
     * Media constructor.
     * @param string $mediaId
     * @param null $type
     */
    public function __construct(string $mediaId, $type = null)
    {
        parent::__construct(['media_id' => $mediaId]);

        !empty($type) && $this->setType($type);
    }

    /**
     * @return string
     */
    public function getMediaId(): string
    {
        return $this->get('media_id', '');
    }

    /**
     * @return array[]
     */
    public function toXmlArray(): array
    {
        return [
            Str::studly($this->getType()) => [
                'MediaId' => $this->get('media_id'),
            ],
        ];
    }
}
