<?php


class User {
    function __construct() {
        $this->db = new DB();
        $this->secret = "qpalzm10";
    }

    public function login($login, $password) {
        $user = $this->db->getUserByLogin($login); // ассоциативный массив
        if ($user) {
            if (md5($login . $password . $this->secret) === $user['password']) {
                $rand = rand(0, 100000);
                $token = md5($user['password'] . $rand);
                $this->db->updateToken($user['id'], $token);
                return $token;
            }
            return ['error'];
        }
        return ['error'];
    }

    public function logout($token) {
        $user = $this->db->getUserByToken($token);
        if ($user) {
            $this->db->updateToken($user['id'], null);
            return true;
        }
        return ['error'];
    }

    public function registration($login, $password, $nickname) {
        if ($this->db->getUserByLogin($login)) {
            return ['error'];
        }  
        $password = md5($login . $password . $this->secret);
        return $this->db->registrationUser($login, $password, null, $nickname);
    }


    public function getUserByToken($token) {
        return $this->db->getUserByToken($token);
    }

    public function setUserAvater($avatar, $id) {
        return $this->db->setUserAvater($avatar, $id);
    }

    public function getUserAvatar($id) {
        return $this->db->getUserAvatar($id);
    }

    public function addNote($id, $title, $message) {
        return $this->db->addNote($id, $title, $message);
    }

    public function getAllNotes($id) {
        return $this->db->getAllNotes($id);
    }

    public function deleteNote($noteId) {
        return $this->db->deleteNote($noteId);
    }

    public function updateNickname($id, $newNickname) {
        return $this->db->updateNickname($id, $newNickname);
    }

    public function getNickname($id) {
        return $this->db->getNickname($id);
    }

    public function updateAvatar($id, $newAvatar) {
        return $this->db->updateAvatar($id, $newAvatar);
    }

    public function deleteAvatar($id) {
        return $this->db->deleteAvatar($id);
    }
}