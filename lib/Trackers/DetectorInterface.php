<?php

namespace XiaoYun\Trackers;

use XiaoYun\Kuaidi;

interface DetectorInterface
{
    /**
     * 识别快递公司
     *
     * @param Kuaidi $kuaidi
     *
     * @return array
     */
    public function detect(Kuaidi $kuaidi);
}
