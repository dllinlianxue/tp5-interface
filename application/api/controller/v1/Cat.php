<?php
/**
 * Created by PhpStorm.
 * User: intern
 * Date: 2017/11/29
 * Time: 下午4:56
 */
namespace app\api\controller\v1;

use app\api\controller\Common;
use app\common\lib\exception\ApiException;

class Cat extends Common {
    public function index() {


        $cats = model('Cat')->getCat();

        if (!$cats) {
//            var_dump('000');
            throw new ApiException('未获取到数据',404);
        }

        return show(0,'ok',$cats,200);
    }


}