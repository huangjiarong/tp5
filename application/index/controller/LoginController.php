<?php
/**
 * Created by PhpStorm.
 * User: jr
 * Date: 18-12-14
 * Time: 下午3:43
 */

namespace app\index\controller;
use think\Controller;
use think\facade\Request;
use app\common\model\Teacher;


class LoginController extends Controller
{
    public function index(){
        return $this->fetch();
    }

    public function login(){
        $postData = Request::post();

        if (Teacher::login($postData['username'], $postData['password'])){
            $this->success('login success', url('Teacher/index'));
        } else{
            $this->error('username or password wrong', url('index'));
        }
    }

    public function test(){
        echo Teacher::encryptPassword('123');
    }

    public function logOut(){
        if (Teacher::logOut()) {
            $this->success('logout success', url('index'));
        } else {
            $this->error('logout error', url('index'));
        }
    }
}