<?php
/**
 * Created by PhpStorm.
 * User: intern
 * Date: 2017/12/4
 * Time: 上午10:49
 */
namespace app\common\lib;

use aliyun\api_demo\SmsDemo;
use think\Cache;
use think\Log;

class SignName {

    public static function sendSign($phoneNumber) {

        header('Content-Type: text/plain; charset=utf-8');
        $code = rand(1000,9999);

        $response = SmsDemo::sendSms(
            '源文科技',
            'SMS_109405011',
            $phoneNumber,
            Array(
                'code' => $code
            )

        );
        //?????????????????//??????????????????????????//
        if ($response->$code != 'ok') {
            log::write('SignName' . json_encode($response));
            return false;
        }


        Cache::set($phoneNumber,$code,60000);

        return true;
//        print_r($response);
    }
}