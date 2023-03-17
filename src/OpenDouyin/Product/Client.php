<?php

/*
 * Author: cc
 *  Created by PhpStorm.
 *  Copyright (c)  cc Inc. All rights reserved.
 */

namespace Jiahetian\HyperfDouyin\Product;


use Jiahetian\HyperfDouyin\OpenDouyin\BaseClient;

class Client extends BaseClient
{
    /**
     * 创建/修改团购活动
     * 1、创建或更新商品。
     * 2、对于同一服务商，相同的 out_id 会被认为是同一商品，重复创建会被覆盖。
     * 3、商品和 SKU 属性，需要通过模板获取。
     * 4、创建商品时设置金额与前端用户侧展示关系
     */
    public function addProduct(array $params): array
    {
        return $this->queryPost('/goodlife/v1/goods/product/save/', $params);
    }

    /**
     * 免审修改团购活动
     * @param array $params
     * @return array
     */
    public function freeAuditProduct(array $params): array
    {
        return $this->queryPost('/goodlife/v1/goods/product/free_audit/', $params);
    }

    //上下架商品
    public function operateProduct(array $params)
    {
        return $this->queryPost('/goodlife/v1/goods/product/operate/', $params);
    }

    //同步库存
    public function syncStock(array $params)
    {
        return $this->queryPost('/goodlife/v1/goods/stock/sync/', $params);
    }

    /**
     *查询商品模板
     * 1、查询商品模板，创建商品时的属性列表需与该接口保持一致，否则无法识别。
     * 2、类目需要与抖音侧对接人确认。
     * @param array $params
     * @return mixed
     */
    public function getProductTemplate(array $params)
    {
        return $this->query('/goodlife/v1/goods/template/get/', $params);
    }

    /**
     * 查询商品草稿数据
     * 1、使用商品 ID 或外部商品 ID 查询商品草稿
     * 2、处于新建审核中、修改审核中、或审核成功、失败的数据可以通过该接口查询到
     * 3、一次最多查询 10 个草稿数据
     * @param array $params
     * @return mixed
     */
    public function getProductDraft(array $params)
    {
        return $this->query('/goodlife/v1/goods/product/draft/get/', $params);
    }

    /**
     * 查询商品草稿数据列表
     * 1、查询本 client_key（或绑定的账号）对应的商品草稿列表。
     * 2、处于审核中、或审核成功、失败的数据可以通过该接口查询到。
     * @param array $params
     * @return mixed
     */
    public function getProductDraftList(array $params)
    {
        return $this->query('/goodlife/v1/goodlife/v1/goods/product/draft/query/', $params);
    }

    /**
     * 查询商品线上数据
     * 1、使用商品 ID 或外部商品 ID 查询商品线上数据。
     * 2、线上数据是指：通过审核后可以被用户看到的数据，包括在线、下线状态的数据。
     * @param $account_id   本地生活账户ID
     * @param $product_ids  商品ID列表，多个值使用,拼接
     * @param $out_ids      外部商品ID列表，多个值使用,拼接
     * @param array $params
     * @return mixed
     */
    public function getProductOnline(array $params)
    {
        return $this->query('/goodlife/v1/goods/product/online/get/', $params);
    }

    /**
     * 查询商品线上数据列表
     * @param $account_id   本地生活账户ID
     * @param int $status   过滤在线状态 1-在线 2-下线 3-封禁
     * @param int $count 默认5
     * @param array $params
     * @return mixed
     */
    public function getProductOnlineList(array $params)
    {
        return $this->query('/goodlife/v1/goods/product/online/query/', $params);
    }

    /**
     * 创建/更新多 SKU 商品的 SKU 列表
     * 1、创建团购活动列表
     * 2、团购/代金券不用对接这个接口
     * @param array $params
     * @return mixed
     */
    public function saveBatchSku(array $params)
    {
        return $this->queryPost('/goodlife/v1/goods/sku/batch_save/', $params);
    }

    /**
     * 创建或更新 SPU
     * 1、创建或更新 SPU
     * 2、对于同一服务商，相同的 out_id 会被认为是同一 SPU，重复创建会被覆盖
     * 3、SPU 属性，需要通过模板获取
     *
     * @param array $params
     * @return mixed
     */
    public function saveSpu(array $params)
    {
        return $this->queryPost('/goodlife/v1/goods/spu/save/', $params);
    }

    /**
     * 创建或更新商品日历
     * 1、创建或更新商品日历
     * 2、需要在创建了酒旅预定商品后调用
     * 3、Calendar 属性，需要通过模板获取
     * @param array $params
     * @return mixed
     */
    public function saveCalendarAttr(array $params)
    {
        return $this->queryPost('/goodlife/v1/goods/calendar_static_attr_group/save/', $params);
    }

    /**
     * 保存日历库存
     * 1、创建或更新商品日历库存
     * 2、需要在创建了酒旅预定商品后调用
     * @param array $params
     * @return mixed
     */
    public function saveCalendarStock(array $params)
    {
        return $this->queryPost('/goodlife/v1/goods/calendar_stock_group/save/', $params);
    }

    /**
     * 保存日历价格
     * 1、创建或更新商品日历价格
     * 2、需要在创建了酒旅预定商品后调用
     * @param array $params
     * @return mixed
     */
    public function saveCalendarAmount(array $params)
    {
        return $this->queryPost('/goodlife/goodlife/v1/goods/calendar_amount_group/save/', $params);
    }
}
