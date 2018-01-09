<?php
/**
 * Created by PhpStorm.
 * User: intern
 * Date: 2017/11/30
 * Time: 上午10:35
 */
namespace app\api\controller\v1;

use app\api\controller\Common;
use app\common\lib\exception\ApiException;
use think\Validate;

class Home extends Common {
    //想试着用数组拼接的方法?
    public function index() {
        $cats = model('Cat')->getCatName();
        $contents = model('Content')->getContent();
        $contents = array_merge($contents + $cats);
//        halt($contents);

        return show(0,'ok',$contents,200);
    }

    //首页:需求是--->头部信息和推荐位信息
    public function header() {
        $arr = [];
        $offset = input('param.offset',0,'intval');
        $limit = input('param.limit',3,'intval');

        $header = model('Content')->getHeader($limit,$offset);
        $arr['header'] = $header;

        $position = model('Content')->getPosition($limit,$offset);
        $arr['position'] = $position;

        return show(0,'ok',$arr,200);

    }

    /**
     *app版本升级接口
     */
    public function init() {
        //获取请求参数
        $data = input('param.');
        //验证参数是否规范 正确的是: app_type:ios/android; version:2.1.3
        $validate = new Validate ([
            'app_type' => ['require','regex'=>'/^(ios|Android)$/i'],
            'version' => ['require','regex'=>'/^[0-9]\.[0-9]\.[0-9]$/']
        ]);
        if (!$validate->check($data)) {
            throw new ApiException($validate->getError(),400,1001);
        }

        //获取数据库数据

        $appVersion = model('Version')->getApp($data['app_type']);

        $newVersion_name = explode('.',$appVersion['version_name']);
        halt($newVersion_name);
        $version_name = explode('.',$data['version_name']);
//        halt($newVersion_name);

        $is_uploaded = 0;
        for ($i=0; $i < 3; $i++) {
           if ($version_name[$i] < $newVersion_name[$i]) {
               //需要更新
               $uploader = $appVersion['is_force'] ? 2 : 1;
           }
             break;
        }
        $result = [
            $uploader => $is_uploaded,
            'apk_url' => $data['apk_url'],
            'version_name' => $version_name,
            'upgrade_point' => $data['upgrade_point'],
            'app_type' => $data['app_type'],
            'create_time' => $data['create_time']
        ];

        //返回数据
        return show(0,'ok',$result,200);
    }

}