<?php

/*
 * Author: cc
 *  Created by PhpStorm.
 *  Copyright (c)  cc Inc. All rights reserved.
 */

namespace Jiahetian\HyperfDouyin\User;

use Jiahetian\HyperfDouyin\Core\BaseService;

class User extends BaseService
{
    /**
     * 会员数据更新
     * 商家侧会员数据发生更新后，开发者可以调用抖音开放平台的接口进行积分/等级的更新，确保用户在抖音端看到正确的数据。
     * @param array $params
     * @return mixed
     */
    public function updateUser(array $params)
    {
        return $this->post('goodlife/v1/member/user/update/', $params);
    }
}
