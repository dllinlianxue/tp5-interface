<?php
/**
 * Created by PhpStorm.
 * User: intern
 * Date: 2017/11/27
 * Time: 上午10:40
 */
namespace app\api\controller;

use app\common\lib\exception\ApiException;
use think\Controller;
use think\Request;

//同级不需要引用use
class Persons extends Common {
    //查看好友列表
    public function index() {
        $persons = [
            [
                'id' => 1,
                'name' => 'yy',
                'age' => 20
            ],
            [
                'id' => 2,
                'name' => 'aa',
                'age' => 19
            ],
            [
                'id' => 3,
                'name' => 'uu',
                'age' => 18
            ],
            [
                'id' => 4,
                'name' => 'qq',
                'age' => 22
            ],
            [
                'id' => 5,
                'name' => 'nn',
                'age' => 20
            ]
        ];
//        $this->test();//测试异常跳转
        return show(0,'ok',$persons);
    }
    public function test() {
        throw new ApiException('测试参数异常',400);
    }
    //创建一个好友
    public function save() {
        $post = input('post.');

//        //param 是获取当前请求的变量
//        $param = input('param.');
//        halt($param);

//        $requestParam = request()->param();
//        var_dump($requestParam);
//
//        Request::instance()->param();//TP5中自动识别get() POST() put()变量 写法之一

        return show(0,'ok',$post);
    }
    //更新一个好友的信息
    public function update($id) {
        $put = input('put.');
        $put ['id'] = $id;

        return show(0,'ok',$put);
    }
    //删除一个好友的信息
    public function delete($id) {
        $delete = input('delete.');
        $delete ['id'] = $id;

        return show(0,'ok',$delete);
    }
    //获取一个好友的信息
    public function read($id) {
        return show(0,'ok',$id);
    }


}