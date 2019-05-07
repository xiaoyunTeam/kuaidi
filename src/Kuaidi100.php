<?php

namespace XiaoYun;


class Kuaidi100
{
    const site = 'http://www.kuaidi100.com'; // 快递100 API接口

    public static function track($postid)
    {
        $detect = self::detect($postid);
        if (!isset($detect[0]['comCode'])) {
            return '不支持查询该物流公司单号，或单号错误！';
        }
        if (!\think\facade\Session::has('csrftoken') or !\think\facade\Session::has('csrftoken')) {

        }
        $client = new \GuzzleHttp\Client(['base_uri' => self::site]);
        $crsf = $client->request('GET');
        $cookies = $crsf->getHeader('Set-Cookie');
        $cookie['HttpOnly'] = true;
        foreach ($cookies as $value) {
            $arrA = explode(';', $value);
            $arrB = explode('=', $value);
            if (isset($arrB[0]) and $arrB[0] == 'csrftoken') {
                $cookie['csrftoken'] = $arrB[1];
            }
            foreach ($arrA as $v) {
                $arr = explode('=', $v);
                if (isset($arr[0]) and $arr[0] == 'WWWID') {
                    $cookie['WWWID'] = $arr[1];
                }
            }
        }
        $result = $client->request('POST', '/query', [
            'headers' => [
                'Content-Type' => 'application/x-www-form-urlencoded',
                'User-Agent' => 'Mozilla/5.0 (iPhone; CPU iPhone OS 11_0 like Mac OS X) AppleWebKit/604.1.38 (KHTML, like Gecko) Version/11.0 Mobile/15A372 Safari/604.1',
                'Referer' => 'http://m.kuaidi100.com/result.jsp?nu=' . $postid,
                'Cookie' => 'closeCodepre=1;WWWID=' . $cookie['WWWID'] . '; csrftoken=' . $cookie['csrftoken'] . '; Hm_lpvt_22ea01af58ba2be0fec7c11b25e88e6c=' . time()
            ],
            'form_params' => [
                'type' => $detect[0]['comCode'],
                'postid' => $postid,
                'temp' => '0.' . self::getRandom(16),
            ]
        ]);
        return json_decode((String)$result->getBody(), true);
    }

    public static function detect($postid)
    {
        $client = new \GuzzleHttp\Client(['base_uri' => static::site]);
        $result = $client->request('GET', '/autonumber/auto', [
            'query' => [
                'num' => $postid
            ]
        ]);
        return json_decode((String)$result->getBody(), true);
    }

    /*
     * 获得32位随机数
     */
    private static function getRandom($param)
    {
        $key = '';
        for ($i = 0; $i < $param; $i++) {
            $key .= rand(1, 9);    //生成php随机数
        }
        return $key;
    }
}