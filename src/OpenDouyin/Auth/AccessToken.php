<?php


namespace Jiahetian\HyperfDouyin\OpenDouyin\Auth;

use Jiahetian\HyperfDouyin\Kernel\AccessToken as BaseAccessToken;
use Jiahetian\HyperfDouyin\Kernel\ServiceProviders;

class AccessToken extends BaseAccessToken
{
    protected function getEndpoint(): string
    {
        return 'https://open.douyin.com/oauth/client_token';
    }

    protected function getCredentials(): array
    {
        return [
            'grant_type' => 'client_credential',
            'client_key' => $this->app[ServiceProviders::Config]->get('appId'),
            'client_secret' => $this->app[ServiceProviders::Config]->get('appSecret')
        ];
    }
}
