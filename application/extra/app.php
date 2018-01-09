<?php
/**
 * Created by PhpStorm.
 * User: intern
 * Date: 2017/11/28
 * Time: 下午2:45
 */
return [
//    'password_pre_halt' => '_#rain_',//密码加密盐
    'sign_time' => 10,//sign请求时间
    'sign_pre_halt' => 'rain_api',//sign签名算法拼接
    'cache_pre_halt' => 20,//sign缓存清空时间
    'aes_key' => 'jiamijiamijiami9'//AES加密的密钥
];