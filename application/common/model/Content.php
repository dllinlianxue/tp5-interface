<?php
/**
 * Created by PhpStorm.
 * User: intern
 * Date: 2017/11/30
 * Time: 上午10:37
 */
namespace app\common\model;

use think\Model;

class Content extends Model {

    public function getContent() {
        return $this->field('id,title,image,read_count')->select();
    }

    public function getHeader($offset,$limit) {
        $data = [
            'is_header' =>1,
            'n.status' => 1,
        ];
        $order = [
            'n.id' => 'desc',
        ];
        return $this->alias('n')
            ->where($data)
            ->order($order)
            ->field('n.id,title,image,read_count,c.cat_name')
            ->limit($offset,$limit)
            ->join('__CAT__ c','n.cat_id=c.id')
            ->select();
    }

    public function getPosition($offset,$limit) {
        $data = [
            'is_header' => 1,
//            'n.status' => 1,
            'is_position' => 1
        ];
        $order = [
            'n.id' => 'desc'
        ];

        return $this->alias('n')
            ->where($data)
            ->order($order)
            ->field('n.id,title,image,read_count,c.cat_name')
            ->limit($offset,$limit)
            ->join('__CAT__ c','n.cat_id = c.id')
            ->select();
    }

    public function getNews($data,$offset,$limit) {

        $order = [
          'n.id' => 'desc'
        ];

        return $this->alias('n')//起个别名
            ->where($data)
            ->order($order)
            ->field('n.id,n.cat_id,c.cat_name,title,image,read_count,is_position,source')
            //field 返回只要这些数据
            ->join('__CAT__ c','n.cat_id = c.id')
            //__CAT__ 注意:全大写或全小写 , 连接cat这个数据库表,通过content表的cat_id 和 cat表的id 连接
            ->limit($offset,$limit)
            //offset 从什么位置开始偏移;  limit 限制页面浏览的数量
            ->select();
    }

    public function getCount($offset,$limit) {
        $data = [
            'status' => 1
        ];
        $order = [
             'read_count' => 'desc'
        ];
        return $this->where($data)->order($order)->limit($offset,$limit)->field('id,title,image,read_count')->select();
    }

    public function getCountById($id) {
        $data = [
            'status' => 1,
            'id' => $id
        ];
//        halt($data);
        return $this->where($data)->field('id,title,smalltitle,content,read_count,update_time,image')->select();
    }

}