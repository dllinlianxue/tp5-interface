<?php
/**
 * Created by PhpStorm.
 * User: intern
 * Date: 2017/11/28
 * Time: 下午4:36
 */
namespace app\api\controller;

use aliyun\api_demo\SmsDemo;
use app\common\lib\Aes;
use app\common\lib\JPush;
use app\common\lib\OpenSSLAES;


use app\common\lib\SignName;

use think\Controller;

class Test extends Controller
{
    public function aes()
    {
        //对aedfghjkl 进行加密
        $str = (new Aes())->encrypt('sedfghjkl');
        dump('加密');
        dump($str);

        //解密
        $desStr = (new Aes())->decrypt($str);
        dump('解密');
        dump($desStr);
    }

    public function openSSL()
    {
        dump(openssl_get_cipher_methods());

        $openSSL = new OpenSSLAES(config('app.aes_key'));

        $str = $openSSL->encrypt('tyui');
        dump('加密');
        dump($str);

        $str2 = $openSSL->decrypt($str);
        dump('解密');
        dump($str2);
    }

    public function push()
    {
        //静态方法直接用类调用
        JPush::push('hello', 3);
    }

    public function sendSign()
    {
////        set_time_limit(0);
//        header('Content-Type: text/plain; charset=utf-8');
//
//        $response = SmsDemo::sendSms(
//            "源文科技", // 短信签名
//            "SMS_109405011", // 短信模板编号
//            "13050548600", // 短信接收者
//            Array(  // 短信模板中字段的值
//                "code"=>"12345",
//                "product"=>"dsd"
//            ),
//            "123"   // 流水号,选填
//        );
//        echo "发送短信(sendSms)接口返回的结果:\n";
//
//        print_r($response);
//    }
        SignName::sendSign('13050548600');
    }
}
