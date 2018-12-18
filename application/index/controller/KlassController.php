<?php
/**
 * Created by PhpStorm.
 * User: jr
 * Date: 18-12-18
 * Time: 上午8:52
 */

namespace app\index\controller;
use app\common\model\Klass;
use app\common\model\Teacher;
use think\facade\Request;


class KlassController extends IndexController
{
    public function index(){
        $klasses = Klass::paginate(2);
        $this->assign('klasses', $klasses);
        return $this->fetch();
    }

    public function add(){
        $teachers = Teacher::all();
        $this->assign('teachers', $teachers);
        return $this->fetch();
    }

    public function save(){
        $Request = Request::instance();

        $Klass = new Klass();
        $Klass->name = $Request->post('name');
        $Klass->teacher_id = $Request->post('teacher_id');

        $result = $this->validate($Klass, 'app\common\validate\Klass');
        if ($result !== true) {
            $this->error('数据验证失败: ' . $result);
        } else {
            $Klass->save();
            $this->success('操作成功', url('index'));
        }
    }

    public function edit(){
        $id = Request::param('id/d');
        $Klass = Klass::get($id);
        if (is_null($Klass)){
            $this->error('没找到id为 '. $id . '的记录');
        }

        $teachers = Teacher::all();
        $this->assign('teachers', $teachers);
        $this->assign('Klass', $Klass);
        return $this->fetch();
    }

    public function update(){
        $id = Request::post('id/d');
        $Klass = Klass::get($id);
        if (is_null($Klass)){
            $this->error('未找到id为 ' . $id . '的记录');
        }

        $Klass->name = Request::post('name');
        $Klass->teacher_id = Request::post('teacher_id');
        $result = $this->validate($Klass, 'app\common\validate\Klass');
        if ($result !== true) {
            $this->error('数据验证失败: ' . $result);
        } else {
            $Klass->save();
            $this->success('更新成功', url('index'));
        }
    }

    public function delete(){
        $id = Request::param('id/d');
        $Klass = Klass::get($id);
        if (is_null($Klass)){
            $this->error('未找到id为 ' . $id . '的数据');
        }
        $Klass->delete();
        $this->success('删除成功', url('index'));
    }
}