<?php

require_once __DIR__ . '/vendor/autoload.php';

error_reporting(E_ALL);

function track($number, $express = '')
{
    $kuaidi = new \XiaoYun\Kuaidi($number, $express);
    (new \XiaoYun\Trackers\Kuaidi100)->track($kuaidi);
    return $kuaidi->getTraces()->sort();
}

if (php_sapi_name() == 'cli') {
    $traces = track($argv[1], isset($argv[2]) ? $argv[2] : '');
    foreach ($traces as $trace) {
        echo $trace['datetime'] . "\t" . $trace['desc'] . PHP_EOL;
    }
} else {
    $traces = track($_GET['number'], isset($_GET['express']) ? $_GET['express'] : '');
    echo json_encode($traces, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
}
