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

    public function setUserAvater($params) {
        if ($params['avatar'] && $params['id']) {
            return $this->user->setUserAvater($params['avatar'], $params['id']);
        }
        return ['error'];
    }

    public function getUserAvatar($params) {
        if ($params['id']) {
            return $this->user->getUserAvatar($params['id']);
        }
    }

    public function addNotes($params) {
        if ($params['id'] && $params['title'] && $params['message']) {
            return $this->user->addNotes($params['id'], $params['title'], $params['message']);
        }
    }

    public function getAllNotes($params) {
        if ($params['id']) {
            return $this->user->getAllNotes($params['id']);
        }
    }

    public function deleteNote($params) {
        if ($params['note_id']) {
            return $this->user->deleteNote($params['note_id']);
        }
    }

}


