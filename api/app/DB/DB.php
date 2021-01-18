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
        return $stmt->execute();
    }

    public function registrationUser($login, $password, $token, $nickname) {
        $stmt =  $this->db->prepare("INSERT INTO `users` (`login`, `password`, `token`, `nickname`) 
            VALUES ('$login', '$password', '$token', '$nickname')");
        $stmt->execute();
        return $stmt->fetch();
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
        // $stmt = $this->db->prepare("INSERT INTO `avatars` (`userId`, `image`) VALUES ('$id', '$avatar')");
        // $stmt->execute();
        // return true;
        $targetDir = "uploads/";
        $fileName = basename($avatar["name"]);
        $targetFilePath = $targetDir . $fileName;
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
        if (!empty($avatar["name"])) {
            $allowTypes = array('jpg','png','jpeg','gif','pdf');
            if (in_array($fileType, $allowTypes)) {
                if (move_uploaded_file($avatar["tmp_name"], $targetFilePath)) {
                    $stmt = $this->db->prepare("INSERT INTO `avatars` (`userId`, `image`) VALUES ('$id', '".$fileName."')");
                    if ($stmt->execute()) {
                        return true;
                    } else {
                        return "File upload failed, please try again.";
                    }
                } else {
                    return "Sorry, there was an error uploading your file.";
                }
            } else {
                return "Sorry, only JPG, JPEG, PNG, GIF, & PDF files are allowed to upload.";
            }
        } else {
            return "Please select a file to upload."; 
        }
    }

    public function getUserAvatar($id) {
        $stmt = $this->db->prepare("SELECT `image` FROM `avatars` WHERE userId = '$id'");
        $stmt->execute();
        $img = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($img) {
            $imageURL = "uploads/" . $img["image"];
            if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')   
                $http = "https://";   
            else  
                $http = "http://";   
            return $http . $_SERVER['HTTP_HOST'] . "/api/" . $imageURL;
        } 
        return false;
    }

    public function addNote($id, $title, $message) {
        $messageDate = date('Y-m-j H:i:s');
        $stmt = $this->db->prepare("INSERT INTO `notes` (`title`, `message`, `messageDate`, `userId`) 
            VALUES ('$title', '$message', '$messageDate', '$id')");
        if ($stmt->execute()) {
            $stmt = $this->db->prepare("SELECT * FROM `notes` WHERE `messageDate`='$messageDate'");
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
        return false;
    }

    public function getAllNotes($id) {
        $stmt = $this->db->prepare("SELECT * FROM `notes` WHERE userId='$id' ORDER BY `messageDate`");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function deleteNote($noteId) {
        $stmt = $this->db->prepare("DELETE FROM `notes` WHERE id='$noteId'");
        return $stmt->execute();
    }

    public function updateNickname($id, $newNickname) {
        $stmt = $this->db->prepare("UPDATE `users` SET `nickname`='$newNickname' WHERE `id`='$id'");
        return $stmt->execute();
    }

    public function getNickname($id) {
        $stmt = $this->db->prepare("SELECT `nickname` FROM `users` WHERE `id`='$id'");
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
}