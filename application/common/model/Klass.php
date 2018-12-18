<?php
/**
 * Created by PhpStorm.
 * User: jr
 * Date: 18-12-18
 * Time: 上午8:53
 */

namespace app\common\model;
use think\Model;


class Klass extends Model
{
    private $Teacher;

    public function getTeacher(){
        if (is_null($this->Teacher)) {
            $teacherId = $this->getData('teacher_id');
            $this->Teacher = Teacher::get($teacherId);
        }
        return $this->Teacher;
    }

}