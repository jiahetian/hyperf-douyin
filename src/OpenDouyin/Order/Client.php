<?php

/*
 * Author: cc
 *  Created by PhpStorm.
 *  Copyright (c)  cc Inc. All rights reserved.
 */

namespace Jiahetian\HyperfDouyin\Order;

use Jiahetian\HyperfDouyin\OpenDouyin\BaseClient;

class Client extends BaseClient
{
    /**
     * 订单查询
     * 1、服务商通过接口查询订单详情，支持三种查询方式：
     * （1）根据订单 ID 或第三方订单号，查询对应订单详情，入参：订单 ID/第三方订单号、商户 id；order_id or ext_order_id
     * （2）根据订单状态和商户 id，查询指定时间内该商户下的订单列表，入参：商户 id、订单状态、创单起止时间/修改起止时间；account_id
     * （3）根据用户 id 和商户 id，查询某用户在该商户下的所有订单，入参：商户 id、用户 id、创单起止时间/修改起止时间；open_id
     * 2、支付后未发码/发码失败订单查询方式：限定订单状态为“已支付”，如用户下单后超过 10 分钟未发码会发起退款；
     * 3、退款申请待审核订单查询方式：限定券状态为“退款中”，如退款状态未响应超过 72 小时会自动退款。
     * @param array $params
     * @return mixed
     * @throws \EasySwoole\WeChat\Kernel\Exceptions\HttpException
     * User: jiahe
     * Date: 2023/3/17
     */
    public function getOrderList(array $params)
    {
        return $this->query('/goodlife/v1/trade/order/query/', $params);
    }

}
