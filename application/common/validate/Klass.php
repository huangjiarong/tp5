<?php
/**
 * Created by PhpStorm.
 * User: jr
 * Date: 18-12-18
 * Time: 上午9:36
 */

namespace app\common\validate;
use think\Validate;


class Klass extends Validate
{
    protected $rule = [
        'name'  => 'require|length:2,25',
        'teacher_id' => 'require',
    ];

}