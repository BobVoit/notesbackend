<?php

require_once('DB/DB.php');
require_once('User/User.php');


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
        return ['error'];
    }

    public function addNote($params) {
        if ($params['id'] && $params['title'] && $params['message']) {
            return $this->user->addNote($params['id'], $params['title'], $params['message']);
        }
        return ['error'];
    }

    public function getAllNotes($params) {
        if ($params['id']) {
            return $this->user->getAllNotes($params['id']);
        }
        return ['error'];
    }

    public function deleteNote($params) {
        if ($params['note_id']) {
            return $this->user->deleteNote($params['note_id']);
        }
        return ['error'];
    }

    public function updateNickname($params) {
        if ($params['id'] && $params['new_nickname']) {
            return $this->user->updateNickname($params['id'], $params['new_nickname']);
        }
        return ['error'];
    }

}


