<?php

class DB {
    function __construct() {
        $host = "proger25";
        $user = "root";
        $pass = "root";
        $name = "notesdb";
        try {
            $this->db = new PDO('mysql:host='.$host.';dbname='.$name, $user, $pass);
        } catch (PDOException $e) {
            print "Ошибка!: " . $e->getMessage();
            die();
        }
    }

    function __destruct() {
        $this->db = null;
    }


    public function updateToken($id, $token) {
        $stmt = $this->db->prepare("UPDATE users SET token = '$token' WHERE id = '$id'");
        $stmt->execute();
        return true;
    }

    public function registrationUser($login, $password, $token, $nickname) {
        $stmt =  $this->db->prepare("INSERT INTO `users` (`login`, `password`, `token`, `nickname`) 
            VALUES ('$login', '$password', '$token', '$nickname')");
        $stmt->execute();
        $stmt->fetch();
        return true;
    }

    public function getUserByLogin($login) {
        $stmt = $this->db->prepare("SELECT * FROM `users` WHERE login = '$login'");
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getUserByToken($token) {
        $stmt = $this->db->prepare("SELECT `id`, `login`, `nickname`, `token` FROM `users` WHERE token='$token'");
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getAllId() {
        $stmt = $this->db->prepare("SELECT `id` FROM `users`");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}