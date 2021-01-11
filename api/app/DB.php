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

    public function setUserAvater($avatar, $id) {
        $fileName = $avatar['name'];
        $fileTemp = $avatar['tmp_name'];
        $fileSize = $avatar['size'];
        $fileType = $avatar['type'];

        $path = "upload/".$fileName;

        if (empty($fileName)) {
            return ['error'];
        } else if ($fileType == "image/jpg" || $fileType == "image/jpeg" || $fileType == "image/png" || $fileType == "image/gif") {
            if (!file_exists($path)) {
                if ($fileSize < 5000000) {
                    // move_uploaded_file($fileTemp, "upload/" . $fileName);
                } else {
                    return ['error'];
                }
            } else {
                return ['error'];
            }
        } else {
            return ['error'];
        }
        
        $stmt = $this->db->prepare('INSERT INTO `avatars`(`userId`, `name`, `image`) VALUES (:userId , :fname, :fimage)');
        $stmt->bindParam(':userId', $id);
        $stmt->bindParam(':fname', explode("." ,$fileName)[0]);
        $stmt->bindParam(':fimage', $fileName);

        if ($stmt->execute()) {
            return true;
        } else {
            return ['error'];;
        }
    }

    public function getUserAvatar($id) {
        $stmt = $this->db->prepare("SELECT * FROM `avatars` WHERE userId = '$id'");
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}