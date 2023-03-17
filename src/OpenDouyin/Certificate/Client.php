<?php

/*
 * Author: cc
 *  Created by PhpStorm.
 *  Copyright (c)  cc Inc. All rights reserved.
 */

namespace Jiahetian\HyperfDouyin\Certificate;

use Jiahetian\HyperfDouyin\OpenDouyin\BaseClient;

class Client extends BaseClient
{
    /**
     * 验券准备
     * 抖音团购券码的核销, 需要先调用本接口, 查询订单的券列表，选择要验的券，再调用验券接口，核销券码
     * 接口说明
     * 1、抖音团购券码的核销, 需要先调用本接口, 查询订单的券列表，选择要验的券，再调用验券接口，核销券码
     * 2、二维码扫出来是一个短链, 示例: https://v.douyin.com/eHHc1ft/
     * 3、对应的长链接是 :https://www.iesdouyin.com/share/commerce/coupon/I0ZwZEZpb2U1N0pjQVZxS2NJRTFSQW5WK1c4bmxvbnNWdUQ2Wk85Y1N0eHpRUFpMMmZwNTdFM2NKeWlFNDM2QT0/?schema_type=13&object_id=I0ZwZEZpb2U1N0pjQVZxS2NJRTFSQW5WK1c4bmxvbnNWdUQ2Wk85Y1N0eHpRUFpMMmZwNTdFM2NKeWlFNDM2QT0&utm_campaign=client_scan_share&app=aweme&utm_medium=ios&tt_from=scan_share&iid=&utm_source=scan_share
     * 4、链接中 object_id 参数的值即为本接口传入的 encrypted_data 参数 I0ZwZEZpb2U1N0pjQVZxS2NJRTFSQW5WK1c4bmxvbnNWdUQ2Wk85Y1N0eHpRUFpMMmZwNTdFM2NKeWlFNDM2QT0
     * 5、备注: 请仅仅感知链接中的 object_id 参数. 其他的参数,域名,路径等信息请不要感知, 以后都有优化和调整的可能
     * 6、定期清理过期券，在清理前可以获取到已经过期的券，用此券核销会报错
     * @param array $params
     * @return mixed
     */
    public function prepareCertificate(array $params)
    {
        return $this->query('/goodlife/v1/fulfilment/certificate/prepare/', $params);
    }

    /**
     * 验券
     * 1、同时适用于抖音团购券码与三方券码
     * 2、抖音团购券码的核销需要先调用验券准备接口, 再调用本接口
     * 3、三方券码的核销直接调用本接口即可
     * 4、实时发码模式的三方券码（不针对使用抖音团购券码的服务商）可支持多个批量验券, 但不可跨订单, 且抖音侧订单 ID 参数必传
     * 5、每次验券的 verify_token 参数都应该生成新的值(可用 uuid), 仅一种情况除外, 那就是前一次验券请求超时, 想再次重试, 此时 verify_token 要保持不变, 其他参数也要保持不变, 不可修改
     * 6、调用验券接口失败, 请服务商侧主动发起重试
     * @param array $params
     * @return mixed
     */
    public function verifyCertificate(array $params)
    {
        return $this->query('/goodlife/v1/fulfilment/certificate/verify/', $params);
    }

    /**
     * 撤销核销
     * 1、针对“抖音团购券码、三方券码”两种券码误核销之后的撤销操作，订单状态由“已使用”回改为“待使用”，用于验券错误需要撤回验券等场景， 有时间限制，验券超过一个小时就不可再撤销。
     * @param array $params
     * @return mixed
     */
    public function certificateCancel(array $params)
    {
        return $this->query('/goodlife/v1/fulfilment/certificate/cancel/', $params);
    }

    /**
     * 券状态查询
     * 1、仅支持查询抖音团购券码的状态
     * 2、核销开放过程中，如存在断网情况下，商家系统没办法及时收到核销状态，增加券状态查询接口，方便商家系统查询券码状态
     * 3、通过验券准备接口返回的加密 code 查询抖音团购券码状态
     * @param array $params
     * @return mixed
     */
    public function getCertificateStatus(array $params)
    {
        return $this->query('/goodlife/v1/fulfilment/certificate/get/', $params);
    }

    /**
     * 券状态批量查询
     * 1、支持查询抖音团购券码和三方券码的状态。
     * 2、核销开放过程中，如存在断网情况下，商家系统没办法及时收到核销状态，增加券状态查询接口，方便商家系统查询券码状态。
     * 3、通过验券准备接口返回的加密 code 查询抖音团购券码状态。
     * @param array $params
     * @return mixed
     */
    public function getCertificateList(array $params)
    {
        return $this->query('/goodlife/v1/fulfilment/certificate/query/', $params);
    }

    /**
     * 验券历史查询
     * 1、查询某个企业号下的一个或多个门店在一段时间内的全部验券历史
     * 2、通过 size 与 cursor 参数进行分页查询
     * @param array $params
     * @return mixed
     */
    public function getCertificateVerifyRecord(array $params)
    {
        return $this->query('/goodlife/v1/fulfilment/certificate/verify_record/query/', $params);
    }

    /**
     * 分账明细查询
     * 1、券码核销之后查询对应的分账单
     * 2、券码核销 1h 后（未撤销）生成分账单，记录预计分账的金额，实际的分账动作、提现动作并未发生
     * 3、没有操作权限的券码对应分账单为空、券码未核销时对应的分账单为空、券码已核销 1h 内对应分的账单为空
     * @param array $params
     * @return mixed
     */
    public function getLedgerRecordByCert(array $params)
    {
        return $this->query('/goodlife/v1/settle/ledger/query_record_by_cert/', $params);
    }

    /**
     * 账单详细查询
     * @param array $params
     * @return mixed
     */
    public function getLedgerDetail(array $params)
    {
        return $this->query('/goodlife/v1/settle/ledger/detailed_query/', $params);
    }

    /**
     * 账单查询
     * @param array $params
     * @return mixed
     */
    public function getLedgerList(array $params)
    {
        return $this->query('/goodlife/v1/settle/ledger/query/', $params);
    }

    /**
     * 从短链获取长链接
     * @param $url
     * @return mixed
     */
    private function get_headers_location($url) {
        $stream_opts = [
            'ssl' => [
                'verify_host' => false,
                'verify_peer' => false,
                'verify_peer_name' => false,
            ],
        ];

        $headers = get_headers($url, 1, stream_context_create($stream_opts));

        if (strpos($headers[0], '301') || strpos($headers[0], '302')) {
            if (is_array($headers['Location'])) {
                return $headers['Location'][count($headers['Location']) - 1];
            } else {
                return $headers['Location'];
            }
        } else {
            return $url;
        }
    }
}
