<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    //
    protected $table="category";//指定表的名称
    protected $primaryKey = 'cate_id';//指定表的主键、否则会默认为id
    public $timestamps = false;//忽略插入框架自动添加的create_at、update_at两个时间戳
    public $guarded = [];//这个表示不可以被赋值的字段，空则是所有都可以被赋值
    public function tree()
    {
        $category = $this->all();
        return $this->getTree($category,'cate_name','cate_id','cate_pid');
    }

    /**
     * 根据pid取出子类
     * @param $data
//     * @param $field_name
//     * @param string $field_id
//     * @param string $field_pid
//     * @param int $pid
//     * @return mixed
//     * author liuzp111
//     */
    public function getTree($data,$field_name,$field_id='id',$field_pid='pid',$pid=0)
    {
        $arr = array();
        foreach($data as $key => $val){
            if($val->$field_pid == $pid){
                $data[$key]['_'.$field_name] = $data[$key][$field_name];
                $arr[] = $data[$key];
                foreach($data as $k =>$v){
                    if($v->$field_pid == $val->$field_id){
                        $data[$k]['_'.$field_name] = '┣━ '.$data[$k][$field_name];
                        $arr[] = $data[$k];
                    }
                }
            }

        }
//        echo '<pre/>';print_r($arr);die;
        return $arr;
    }
//    public function getTree($data,$field_name,$field_id='id',$field_pid='pid',$pid=0)
//    {
//        $arr = array();
//        foreach ($data as $k=>$v){
//            if($v->$field_pid==$pid){
//                $data[$k]["_".$field_name] = $data[$k][$field_name];
//                $arr[] = $data[$k];
//                foreach ($data as $m=>$n){
//                    if($n->$field_pid == $v->$field_id){
//                        $data[$m]["_".$field_name] = '├─ '.$data[$m][$field_name];
//                        $arr[] = $data[$m];
//                    }
//                }
//            }
//        }
//        return $arr;
//    }

}
