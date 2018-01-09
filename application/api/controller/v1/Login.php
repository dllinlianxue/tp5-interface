<?php
/**
 * Created by PhpStorm.
 * User: intern
 * Date: 2017/12/4
 * Time: 下午1:58
 */
namespace app\api\controller\v1;

use app\api\controller\Common;
use app\common\lib\exception\ApiException;
use app\common\lib\OpenSSLAES;
use think\Cache;
use think\Validate;

class Login extends Common {
    public function save($code,$phoneNumber) {
        //获取请求参数 得到一组数据
        $data = input('param.');
        //校验规则
        $Validate = new Validate([
            'phoneNumber' => 'require|number|length:11',
            'code' => 'require|number|length:4'
        ]);
        //校验验证码的合法性
        if (!$Validate->check($data)) {
            throw new ApiException($Validate->getError(),400,3003);
        }
        //获取缓存中的验证码?????????????
        $cacheCode = Cache::get($data['phoneNumber']);
        if ($data['code'] != $cacheCode) {
            throw new ApiException('获取验证码失败',401,3005);
        }
        //生成token值
        $token = $this->getToken($data['phone']);

        $userData = [
            'token' => $token,
            'token_time' => strtotime('+7days')//七天以后,strtotime
        ];
        //判断此手机号是否是第一次登陆
        $user = model('User')->where(['phone'=>$data['phone']])->find();
        //第一次登陆
        if (!$user) {
            $userData['username'] = 'tom';
            $userData['phone'] = input('post.phone');
            $userData['status'] = 1;
            $user_id = model('User')->save($userData);
        } else {
            //不是第一次登陆
            $user_id = $user['id'];
            $userData['update_time'] = time();
            $userData['status'] = 1;
            model('User')->save($userData,['id'=>$user_id]);
        }

        //返回数据
        $openSSl = new OpenSSLAES(config('app.aes_key'));

        //encrypt()进行加密
        $result = [
            'token' => $openSSl->encrypt($token.'||'.$user_id)
        ];

        return show(0,'ok',$result);

    }
   public function getToken($phone) {
        $str = md5(uniqid(md5(microtime(true)),true));
        //uniqid获取唯一的id(长度为23,第二个参数是true);
        $str = sha1($str.$phone);
        return $str;
   }
}