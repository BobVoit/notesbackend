<?php

require_once('DB.php');
require_once('User.php');


class Application {
    function __construct() {
        $this->user = new User();
    }


    public function login($params) {
        if ($params['login'] && $params['password']) {
            return $this->user->login($params['login'], $params['password']);
        }
        return ['error'];
    }

    public function logout($params) {
        if ($params['token']) {
            return $this->user->logout($params['token']);
        }
        return ['error'];
    }

    public function getUserByToken($params) {
        if ($params['token']) {
            return $this->user->getUserByToken($params['token']);
        }
        return ['error'];
    }

    public function registration($params) {
        $login = $params['login'];
        $password = $params['password'];
        $nickname = $params['nickname'];

        if(strlen($login) < 3 || strlen($login) > 30 ){
            return ['error']; 
        }
        elseif(strlen($password) < 5) {
            return ['error']; 
        }
        elseif(strlen($nickname) < 3){
            return ['error']; 
        }

        return $this->user->registration($login, $password, $nickname);
    }

    public function getAllId() {
        return $this->user->getAllId();
    }

}


