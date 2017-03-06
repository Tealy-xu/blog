<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    protected $table='category';
    protected $primaryKey = 'cate_id';
    public $timestamps = false;

    public function tree()
    {
        $category = $this->orderBy('cate_order','asc')->get();
        $data = $this->getTree($category, 'cate_name', 'cate_id', 'cate_pid');
        return $data;
    }

    public function getTree($data, $field_name,  $field_id='id', $field_pid='pid', $pid=0)
    {
        $arr = array();
        foreach($data as $key=>$value){
            if($value->$field_pid==$pid){
                $data[$key]['_'.$field_name] = $data[$key][$field_name];
                $arr[] = $data[$key];
            }
            foreach($data as $k=>$v){
                if($v->$field_pid==$value->$field_id){
                    $data[$k]['_cate_name'] = '--'.$data[$k]['cate_name'];
                    $arr[] = $data[$k];
                }
            }
        }

        return $arr;
    }

}
