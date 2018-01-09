<?php
/**
 * Created by PhpStorm.
 * User: intern
 * Date: 2017/12/4
 * Time: 上午11:59
 */
namespace app\api\controller\v1;

use aliyun\api_demo\SmsDemo;
use app\api\controller\Common;
use app\common\lib\exception\ApiException;
use app\common\lib;
use app\common\model\Version;

class SignName extends Common {
    public function save() {

        $validate = new Version([
           'phone' => 'require|number|length:11'
        ]);
        //??????????????????////???????????????校验的合法性
        if (!$validate->check(input('post.'))) {
            throw new ApiException($validate->getError(),400,3002);
        }
        $result = lib\SignName::sendSign(input('post.phoneNumber'));

        if (!$result) {
            throw new ApiException('验证码获取失败',500,3003);
        }
        return show(0,'发送成功',200);

//        $phoneNumber = input('post.phoneNumber');
//
//        if (!$phoneNumber) {
//            throw new ApiException('未获取到手机号码',400);
//        }
//
//        lib\SignName::sendSign($phoneNumber);
    }


}