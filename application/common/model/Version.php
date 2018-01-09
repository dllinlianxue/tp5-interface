<?php
/**
 * Created by PhpStorm.
 * User: intern
 * Date: 2017/12/1
 * Time: 下午2:10
 */
namespace app\common\model;

use think\Model;

class Version extends Model {
    public function getApp($app_type) {
        $data = [
            'app_type' => $app_type,
        ];
        $order = [
          'id' => 'desc'
        ];
        return $this->where($data)->order($order)->find();
    }
}