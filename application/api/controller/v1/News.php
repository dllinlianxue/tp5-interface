<?php
/**
 * Created by PhpStorm.
 * User: intern
 * Date: 2017/11/30
 * Time: 下午2:56
 */
namespace app\api\controller\v1;

use app\api\controller\Common;
use app\common\lib\exception\ApiException;

class News extends Common {
    // 通过cat_id 查找分类栏目的新闻 所以请求参数:cat_id 请求路径:?cat_id=;
    // 搜索 通过模糊查询获取标题中任何几个字
    public function index() {

        $limit = input('get.limit',3,'intval');
        $offset = input('get.offset',0,'intval');

        //请求分类参数,来显示最终新闻页面
        $data = [
            'n.status' => 1,//新闻内容状态为1的显示页面
            'c.status' => 1,//分类状态为1的显示
        ];

        if (!empty(input('get.cat_id'))) {
            $data['cat_id'] = input('get.cat_id');
        }

        else if (!empty(input('get.title'))) {
            $data['title'] = [
                'like',//模糊查询
                '%'. input('get.title').'%'
                //%  % 无论前后有多少字
                ];
        }

        else {
            throw new ApiException('未找到参数',404);
        }

        //连接数据库 通过Model 实现Model里的方法
        $news = model('Count')->getNews($data,$offset,$limit);

        if (!$news) {
            throw new ApiException('未搜索到内容',404);
        }

        //返回json数据格式
        return show(0,'ok',$news);

    }


    public function read($id) {
        //获取路由的id 直接用参数的形式

        $new = model('Content')->getCountById($id);

        if (empty($new)) {
            throw new ApiException('未接收到数据',404);
        }
        return show(0,'ok',$new,200);

    }


    public function rank() {
        $limit = input('get.limit',10);
        $offset = input('get.offset',0);

        $counts = model('Content')->getCount($limit,$offset);

        if (empty($counts)) {
            throw new ApiException('未接收到数据', 404);
        }

        return show(0,'ok',$counts,200);
    }

}