<?php

namespace XiaoYun\Trackers;

use Curl\Curl;
use XiaoYun\Exceptions\TrackingException;
use XiaoYun\Kuaidi;

trait TrackerTrait
{
    /**
     * 解析 JSON 响应
     *
     * @param Curl $curl
     *
     * @return mixed
     */
    protected static function getJsonResponse(Curl $curl, $assoc = false)
    {
        $responseRaw = $curl->response;
        $response = json_decode($responseRaw, $assoc);
        if (json_last_error() !== 0) {
            throw new TrackingException('Response data cannot be decoded as json', $responseRaw);
        }

        return $response;
    }

    /**
     * 获取是否支持某个快递公司
     *
     * @param string $expressName
     *
     * @return bool
     */
    public static function isSupported($expressName)
    {
        $list = static::getSupportedExpresses();

        return isset($list[$expressName]);
    }

    /**
     * 获取快递公司代码
     *
     * @param Kuaidi $kuaidi
     *
     * @return string
     */
    public function getExpressCode(Kuaidi $kuaidi)
    {
        $express = $kuaidi->getExpress();
        if ($express) {
            if (static::isSupported($express)) {
                $list = static::getSupportedExpresses();

                return $list[$express];
            }
            if (ctype_alnum($express)) {
                return $express;
            }
        } elseif ($this instanceof DetectorInterface) {
            $list = $this->detect($kuaidi);
            if (count($list) > 0) {
                return reset($list);
            }
        }

        throw new TrackingException("Unsupported express name: {$express}");
    }
}
