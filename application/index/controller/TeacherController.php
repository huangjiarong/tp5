<?php
namespace app\index\controller;
use app\common\model\Teacher;
use think\App;
use think\Controller;
use think\facade\Request;

class TeacherController extends IndexController
{
    public function index()
    {
        $pageSize = 5;
        $name = Request::get('name');
        $Teacher = new Teacher;
        if (!empty($name)){
            $Teachers = $Teacher->where('name', 'like', '%'.$name.'%');
        }else {
            $Teachers = $Teacher;
        }

        $teachers = $Teachers->paginate($pageSize, false, [
            'query'=>[
                'name'=>$name,
            ]
        ]);
        $this->assign('teachers', $teachers);

        $html = $this->fetch();

        return $html;
    }

    public function insert()
    {
        $message = '';
        try {
            $postData = Request::post();

            $Teacher = new Teacher();

            $Teacher->name = $postData['name'];
            $Teacher->username = $postData['username'];
            $Teacher->sex = $postData['sex'];
            $Teacher->email = $postData['email'];

            $result = $this->validate(
                $Teacher, 'app\common\validate\Teacher'
            );
            if ($result !== true) {
                throw new \Exception('数据验证不成功', 1);
            } else {
                $Teacher->save();
                $this->success('用户' . $Teacher->username . '新增成功', url('index'));
            }
        }catch(\think\Exception\HttpResponseException $e) {
            throw $e;
        } catch (\Exception $e){
            return 'insert出错' . $e->getMessage();
        }
        $this->error($message);
        return;
    }

    public function add()
    {
        try {
            $htmls = $this->fetch();
            return $htmls;
        }catch(\Exception $e){
            return 'Error' . $e->getMessage();
        }

    }

    public function delete()
    {
        try {
            $Request = Request::instance();
            $id = Request::param('id/d');
            if (is_null($id) || 0 === $id) {
                throw new \Exception('未获取到id', 1);
            }

            $Teacher = Teacher::get($id);
            if (is_null($Teacher)) {
                throw new \Exception('不存在id为' . $id . '的教师', 1);
            }
            if (!$Teacher->delete()) {
                return '删除失败' . $Teacher->getError();
            }
        }catch(\think\Exception\HttpResponseException $e){
            throw $e;
        } catch(\Exception $e){
            return 'delete error' . $e->getMessage();
        }
        $this->success('success delete', $Request->header('referer'));
    }

    public function edit(){
        try {
            $id = Request::param('id/d');
            if (is_null($id) || $id ===0){
                throw new \Exception('未获取到Id', 1);
            }
            $Teacher = Teacher::get($id);
            if(!$Teacher){
                $this->error('未找到id为' . $id . '的教师');
            }
            if (is_null($Teacher)) {
                return '找不到id为' . $id . '的数据';
            }
            $this->assign('Teacher', $Teacher);
            $html = $this->fetch();
            return $html;
        }catch(\think\Exception\HttpResponseException $e){
            throw $e;
        }catch (\Exception $e){
            return $e->getMessage();
        }
    }

    public function update(){
        try {
            $id = Request::post('id/d');
            $state = $this->validate(Request::post(), 'app\common\validate\Teacher');
            if (!$state) {
                return '数据验证失败';
            }

            $Teacher = Teacher::get($id);
            if (is_null($Teacher)) {
                throw new \Exception('所更新的记录不存在', 1);
            }
            $Teacher->update(Request::post());
        }catch(\think\Exception\HttpResponseException $e){
            throw $e;
        }catch (\Exception $e){
            return $e->getMessage();
        }
        $this->success('success update', url('index'));
    }
}
