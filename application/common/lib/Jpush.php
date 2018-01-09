<?php
/**
 * Created by PhpStorm.
 * User: intern
 * Date: 2017/12/1
 * Time: 下午5:17
 */
namespace app\common\lib;

use jpush\src\JPush\Client;

class JPush {

    public static function push($title,$news_id) {
        $app_key = 'f38f19f41afe777f4905f085';
        $master_secret = '3409229ed1c44a2209e03173';
        $client = new Client($app_key,$master_secret);

        $client->push()//表示推送通知
        ->setPlatform('all')//推送的目标平台 all 代表全部
        ->addAllAudience()//推送的人群 广播代表全部
        ->setNotificationAlert($title)//推送通知的内容
        ->iosNotification($title, [
            'sound' => 'sound',
            'badge' => '+1',
            'extras' => [
                'news_id' => $news_id
            ]
        ])
            ->androidNotification($title,[
                'extras' => [
                    'news_id' => $news_id
                ]
            ])
            ->send();//发送通知
    }
}