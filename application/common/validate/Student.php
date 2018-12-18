<?php
/**
 * Created by PhpStorm.
 * User: jr
 * Date: 18-12-18
 * Time: 下午4:13
 */

namespace app\common\validate;
use think\Validate;


class Student extends Validate
{
    protected $rule = [
        'name'  => 'require',
        'num' => 'require',
        'sex' => 'require',
    ];
}