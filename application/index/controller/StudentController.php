<?php
/**
 * Created by PhpStorm.
 * User: jr
 * Date: 18-12-18
 * Time: 下午3:06
 */

namespace app\index\controller;
use app\common\model\Klass;
use app\common\model\Student;
use think\facade\Request;


class StudentController extends IndexController
{
    public function index(){
        $students = Student::paginate();
        $this->assign('students', $students);
        return $this->fetch();
    }

    public function edit(){
        $id = Request::param('id/d');
        $Student = Student::get($id);
        if (is_null($Student)){
            $this->error('没有id为 ' . $id . '的学生');
        }
        $this->assign('Student', $Student);
        return $this->fetch();
    }

    public function update(){
        $id = Request::post('id/d');
        $Student = Student::get($id);
        if (is_null($Student)){
            $this->error('没有存在id为 '. $id . '的学生');
        }

        $result = $this->validate(Request::post(), 'app\common\validate\Student');
        if ($result !== true){
            $this->error('数据验证失败:' . $result);
        }
        $Student->update(Request::post());
        $this->success('更新成功', url('index'));
    }

    public function delete(){
        $id = Request::param('id/d');
        $Student = Student::get($id);
        if (is_null($Student)){
            $this->error('没有存在id为 '. $id . '的学生');
        }
        $Student->delete();
        $this->success('删除成功', url('index'));
    }

    public function add(){
        $klasses = Klass::all();
        $this->assign('klasses', $klasses);
        return $this->fetch();
    }

    public function insert(){
        $postData = Request::post();
        $Student = new Student();
        $Student->name = $postData['name'];
        $Student->num = $postData['num'];
        $Student->email = $postData['email'];
        $Student->sex = $postData['sex'];
        $Student->klass_id = $postData['klass_id'];

        $result = $this->validate($Student, 'app\common\validate\Student');
        if ($result !== true){
            $this->error('数据验证错误');
        }
        $Student->save();
        var_dump($Student);
        $this->success('增加成功', url('index'));
    }
}