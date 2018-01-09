<?php
/**
 * Created by PhpStorm.
 * User: intern
 * Date: 2017/11/29
 * Time: 下午4:58
 */
namespace app\common\model;

use think\Model;

class Cat extends Model {


    public function getCat()
    {
        $data = [
          'status' => 1
        ];
        return $this->where($data)->field('id,cat_name')->select();
    }


    public function getCatName() {
        $data = [
            'status' => 1
        ];
        return $this->where($data)->field('cat_name')->select();
    }

}