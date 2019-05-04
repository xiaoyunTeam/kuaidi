<?php

namespace XiaoYun\Trackers;

use XiaoYun\Kuaidi;

interface TrackerInterface
{
    /**
     * 追踪运单（即：查快递）
     *
     * @param Kuaidi $kuaidi
     *
     * @return void
     *@throws \XiaoYun\Exceptions\TrackingException
     *
     */
    public function track(Kuaidi $kuaidi);

    /**
     * 获取完整的快递公司支持列表
     *
     * @return array
     */
    public static function getSupportedExpresses();
}
