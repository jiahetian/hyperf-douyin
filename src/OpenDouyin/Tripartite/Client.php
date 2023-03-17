<?php

/*
 * Author: cc
 *  Created by PhpStorm.
 *  Copyright (c)  cc Inc. All rights reserved.
 */

namespace Jiahetian\HyperfDouyin\Tripartite;

use Jiahetian\HyperfDouyin\Kernel\ServiceProviders;
use Jiahetian\HyperfDouyin\OpenDouyin\BaseClient;

class Client extends BaseClient
{
    public function handle()
    {
        \Yii::warning($this->httpClient()->requestQuery());
        parse_str($this->httpClient()->requestQuery(), $data);
        \Yii::warning($data);
        $http_body = $this->httpClient()->requestContent();
        \Yii::warning($http_body);
        return $this->validate($data,$http_body);
    }

    /**
     * 验证签名
     * 1、以三方服务商的 client_secret 开头; 然后将除 sign 之外的 URL 参数以 key=value 的形式按 key 的字典升序排列; 若为 POST 请求, 还需要加上 HTTP 的 BODY, key 固定为 http_body. 最后所有的这些项以字符'&'串联起来即为待签名内容 str1. 发码接口的示例如下(假设 client_secret 为 yyyyyy):
     * 2、str1 的内容是 yyyyyy&client_key=xxxxxx×tamp=1624293280123&http_body=zzzzzz
     * 3、然后将待签名内容 str1 计算 md5 值, 得到的结果即为 sign
     * 4、抖音将用于签名生成的 httpBody 以[]byte 类型请求服务商，服务商请不要将[]byte 反序列化成 object 再序列化 string 用于签名校验。这样会导致 json 中的字段顺序与抖音不符，同时若抖音侧将 httpBody 进行改动，也会导致签名校验不通过
     * @param $data
     * @return bool
     */
    protected function validate($data,$http_body)
    {
        if (!isset($data['sign'])) {
            return false;
        }

        $sign = $data['sign'];
        unset($data['sign']);
        ksort($data);
        $signStr = $this->appRunConfig['app_secret'] . '&' . http_build_query($data) . '&http_body=' . $http_body;
        $makeSign = md5($signStr);

        return $sign == $makeSign;
    }
}
