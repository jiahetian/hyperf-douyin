<?php

/*
 * Author: cc
 *  Created by PhpStorm.
 *  Copyright (c)  cc Inc. All rights reserved.
 */

namespace Jiahetian\HyperfDouyin\OpenDouyin\Shop;


use Jiahetian\HyperfDouyin\OpenDouyin\BaseClient;

/**
 * 店铺 API
 * Class Client.
 */
class Client extends BaseClient
{
    /**
     * 门店信息查询
     * account_id   本地生活账户ID 非必填
     * page   页码 （从1开始）
     * size   页大小
     * third_id 三方ID 非必填
     * poi_id   抖音门店POI_ID 非必填
     * 通过接口查询认领的门店列表，用于商家/服务商映射与抖音 POI 的门店关系。
     * @param $params
     * @return mixed
     * @throws \EasySwoole\WeChat\Kernel\Exceptions\HttpException
     * User: jiahe
     * Date: 2023/3/17
     */
    public function getShopPoiList($params)
    {
        return $this->query('/goodlife/v1/shop/poi/query/', $params);
    }
}
