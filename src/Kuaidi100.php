<?php


namespace XiaoYun;


class Kuaidi100
{
    const site = 'http://www.kuaidi100.com'; // 快递100 API接口

    public static function track($postid)
    {
        $client = new \GuzzleHttp\Client(['base_uri' => static::site]);
        $result = $client->request('GET', '/query', [
            'query' => [
                'postid' => $postid,
                'type' => 1,
                'temp' => '0.' . self::getRandom(16)
            ]
        ]);
        return (String)$result->getBody();
    }

    public static function detect($postid)
    {
        $client = new \GuzzleHttp\Client(['base_uri' => static::site]);
        $result = $client->request('GET', '/autonumber/auto', [
            'query' => [
                'num' => $postid
            ]
        ]);
        return (String)$result->getBody();
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