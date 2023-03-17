<?php

/*
 * Author: cc
 *  Created by PhpStorm.
 *  Copyright (c)  cc Inc. All rights reserved.
 */

namespace Jiahetian\HyperfDouyin\Stock;

use Jiahetian\HyperfDouyin\OpenDouyin\BaseClient;

class Client extends BaseClient
{
    //查询库存 getStockNum()
    public function getStockNum(array $params)
    {
        return $this->queryPost('/sku/stockNum', $params);
    }

    //创建单个区域仓 createWarehouse()
    public function createWarehouse(array $params)
    {
        return $this->queryPost('/warehouse/create', $params);
    }

    //批量创建区域仓 createBatchWarehouse()
    public function createBatchWarehouse(array $params)
    {
        return $this->queryPost('/warehouse/createBatch', $params);
    }

    //编辑区域仓 editWarehouse()
    public function editWarehouse(array $params)
    {
        return $this->queryPost('/warehouse/edit', $params);
    }

    //查询区域仓 getWarehouse()
    public function getWarehouse(array $params)
    {
        return $this->queryPost('/warehouse/info', $params);
    }

    //批量查询区域仓 getWarehouseList()
    public function getWarehouseList(array $params)
    {
        return $this->queryPost('/warehouse/list', $params);
    }

    //地址与区域仓解绑 unbindAddrWarehouse()
    public function unbindAddrWarehouse(array $params)
    {
        return $this->queryPost('/warehouse/removeAddr', $params);
    }

    //绑定单个地址到区域仓 bindAddrWarehouse()
    public function bindAddrWarehouse(array $params)
    {
        return $this->queryPost('/warehouse/setAddr', $params);
    }

    //批量绑定地址与区域仓 bindBatchAddrWarehouse()
    public function setBatchAddrWarehouse(array $params)
    {
        return $this->queryPost('/warehouse/setAddrBatch', $params);
    }

    //设置指定地址下的仓的优先级 setPriorityWarehouse()
    public function setPriorityWarehouse(array $params)
    {
        return $this->queryPost('/warehouse/setPriority', $params);
    }
}
