# hyperf-douyin
a douyin open platform component for hyperf

## 依赖环境

- PHP >= 7.1 (推荐使用 PHP >= 7.2)
- [composer](https://getcomposer.org/)
- [swoole](https://github.com/swoole/swoole-src) 扩展 >= 4.4.19 (推荐使用 Swoole >= 4.4.23)
- openssl 扩展

## 安装

```shell
$ composer require jiahetian/hyperf-douyin
```

## 基本使用

以服务端为例

```php

    $config = [
        'appId' => 'wxefe41fdeexxxxxx',
        'appSecret' => 'dczmnau31ea9nzcnxxxxxxxxx',
        'acountId' => '123456'
    ];

    $officialAccount = \OpenDouyin\Factory::officialAccount($config);

    $server = $officialAccount->server;

    /** 注册消息事件回调 */
    $server->push(function (\OpenDouyin\Kernel\Contracts\MessageInterface $message) {
        return new \OpenDouyin\Kernel\Messages\Text(implode(",", $message->transformForJsonRequest()));
    });

    /** @var \Psr\Http\Message\ServerRequestInterface $psr7Request  */
    $psr7Request = mockRequest();

    /**
    * @var \Psr\Http\Message\ResponseInterface $reply
    * forceValidate() 表示启用请求验证，以确保请求来自微信发送。默认不启用验证
    * serve() 会解析本次请求后回调之前注册的事件（包括AES解密和解析XML）
    * server() 接受一个显式实现了 \Psr\Http\Message\ServerRequestInterface 的request对象
    */
    $reply = $server->forceValidate()->serve($psr7Request);

    /**
    * $reply 是一个显式实现了PSR-7的对象，用户只需要处理该对象即可正确响应给微信
    * 下面是一个原生swoole的响应方法
    */
    $swooleResponse->status($reply->getStatusCode());

    /**
     * PSR-7 的Header并不是单纯的k => v 结构
     */
    foreach ($reply->getHeaders() as $name => $values) {
        $swooleResponse->header($name, implode(", ", $values));
    }

    $swooleResponse->write($reply->getBody()->__toString());
```

以客户端为例

```php

    $config = [
        'appId' => 'wxefe41fdeexxxxxx',
        'token' => 'dczmnau31ea9nzcnxxxxxxxxx',
        'aesKey' => 'easyswoole'
    ];

    $officialAccount = \OpenDouyin\Factory::officialAccount($config);

    /** 获取用户列表 */
    $list = $officialAccount->user->list();
```
