<?php
/**
 * Created by PhpStorm.
 * User: intern
 * Date: 2017/11/28
 * Time: 下午2:01
 */
namespace app\api\controller;

use think\Controller;

class Time extends Controller
{
    public function time()
    {
        $time = [
          'server_time' => time()
        ];
        return show(0,'ok',$time);
    }


}