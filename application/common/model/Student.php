<?php
/**
 * Created by PhpStorm.
 * User: jr
 * Date: 18-12-18
 * Time: 下午3:03
 */

namespace app\common\model;
use think\Model;


class Student extends Model
{
//    protected $dateFormat = 'Y年m月d日';
//    protected $type = [
//        'create_time' => 'datetime',
//    ];
    public function getSexAttr($value){
        $status = array('0'=>'男', '1'=>'女');
        $sex = $status[$value];
        if (is_null($sex)){
            return $status[0];
        }
        return $sex;
    }

    public function getCreateTimeAttr($value){
        return date('Y-m-d', $value);
    }

    public function Klass(){
        return $this->belongsTo('Klass');
    }
}