<?php
namespace app\common\model;
use think\Model;

class Teacher extends Model
{
    static public function login($username, $password){
        $map = array('username'=>$username);
        $Teacher = self::get($map);

        if(is_null($Teacher)){
            return false;
        }
        if ($Teacher->checkPassword($password)){
            session('teacherId', $Teacher->getData('id'));
            return true;
        }
    }

    public function checkPassword($password){
        if ($this->getData('password') === $this::encryptPassword($password)){
            return true;
        } else{
            return false;
        }
    }

    static public function encryptPassword($password){
        return sha1(md5($password) . 'mengyunzhi');
    }

    static public function logOut(){
        session('teacherId', null);
        return true;
    }

    static public function isLogin(){
        $teacherId = session('teacherId');
        if (is_null($teacherId)){
            return false;
        }
        return true;
    }
}
