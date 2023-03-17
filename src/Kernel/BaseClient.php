<?php


namespace Jiahetian\HyperfDouyin\Kernel;


use Jiahetian\HyperfDouyin\Kernel\Contracts\ClientInterface;
use Jiahetian\HyperfDouyin\Kernel\Exceptions\HttpException;
use Jiahetian\HyperfDouyin\Kernel\Psr\Stream;
use Psr\Http\Message\ResponseInterface;

class BaseClient
{
    protected $baseUrl = 'https://open.douyin.com';
    protected $app;

    public function __construct(ServiceContainer $app)
    {
        $this->app = $app;
    }

    /**
     * @param string $path
     * @param array $params
     * @return string
     */
    protected function buildUrl(string $path, array $params = []): string
    {
        if (!empty($params)) {
            $path .= '?'. http_build_query($params);
        }
        return $this->baseUrl. $path;
    }

    /**
     * @return ClientInterface
     */
    protected function getClient():ClientInterface
    {
        /** @var ClientInterface $httpClient */
        $httpClient = $this->app[ServiceProviders::HttpClientManager]->getClient();
        $timeout = $this->app[ServiceProviders::Config]->get('request.timeout');
        if (!is_null($timeout)) {
            $httpClient->setTimeout($timeout);
        }
        return $httpClient;
    }

    /**
     * @param ResponseInterface $response
     * @param null $parseData
     * @return bool
     * @throws HttpException
     */
    protected function checkResponse(ResponseInterface $response, &$parseData = null): bool
    {
        if (!in_array($response->getStatusCode(), [200])) {
            throw new HttpException(
                $response->getBody()->__toString(),
                $response
            );
        }

        $data = $this->parseData($response);
        $parseData = $data;

        if (isset($data['error_code']) && (int)$data['error_code'] !== 0) {
            throw new HttpException(
                "refresh access_token fail, message: ({$data['error_code']}) {$data['description']}",
                $response,
                $data['error_code']
            );
        }

        return true;
    }

    /**
     * @param ResponseInterface $response
     * @return array
     * @throws HttpException
     */
    protected function parseData(ResponseInterface $response):array
    {
        $data = json_decode($response->getBody()->__toString(), true);
        if (is_null($data) || (JSON_ERROR_NONE !== json_last_error())) {
            throw new HttpException("parse response body fail.", $response);
        }
        return $data['data'];
    }

    /**
     * @param array $json
     * @return Stream
     */
    protected function jsonDataToStream(array $json):Stream
    {
        return new Stream(json_encode($json, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE));
    }

    /**
     * Unify query.
     *
     * @param string $endpoint
     * @param array $param
     *
     * @return mixed
     * @throws \EasySwoole\WeChat\Kernel\Exceptions\HttpException
     */
    protected function query(string $endpoint, array $param)
    {
        $response = $this->getClient()
            ->setMethod('GET')
            ->setHeaders([
                'Content-Type' => 'application/json',
                'access-token' => $this->app[ServiceProviders::AccessToken]->getToken(),
            ])
            ->send($this->buildUrl($endpoint, $param));

        $this->checkResponse($response, $parseData);

        return $parseData;
    }

    /**
     * queryPost
     * @param string $endpoint
     * @param array $param
     * @return mixed
     * @throws HttpException
     * User: jiahe
     * Date: 2023/3/17
     */
    protected function queryPost(string $endpoint, array $param)
    {
        $response = $this->getClient()
            ->setMethod('POST')
            ->setHeaders([
                'Content-Type' => 'application/json',
                'access-token' => $this->app[ServiceProviders::AccessToken]->getToken(),
            ])
            ->setBody($this->jsonDataToStream($param))
            ->send($this->buildUrl($endpoint));

        $this->checkResponse($response, $parseData);

        return $parseData;
    }
}
