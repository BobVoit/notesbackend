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

    public function setUserAvater($images, $token) {
        // $img = $images['name'];
        // $stmt = $this->db->prepare("UPDATE `users` SET `avatar` = $img WHERE `token` = $token");
        // $stmt->execute();
        // return $images;

        // $fileName = $images['name'];
        // $fileTmpName = $images['tmp_name'];
        // $fileSize = $images['size'];
        // $fileError = $images['error'];
        // $fileType = $images['type'];

        // $fileExt = explode('.', $fileName);
        // $fileActualExt = strtolower(end($fileExt));

        // $allowed = array('jpg', 'jpeg', 'png', 'pdf');

        // if (in_array($fileActualExt, $allowed)) {
        //     if ($fileError === 0) {
        //         if ($fileSize < 1000000) {
        //             $fileNameNew = uniqid('', true) . "." . $fileActualExt;
        //             $fileDestination = 'uploads/' . $fileNameNew;
        //             move_uploaded_file($fileTmpName, $fileDestination);
        //             header("Location: index.php");
        //         } else {
        //             echo "Your file is too big";
        //         }
        //     } else {
        //         echo "There was an error uploading your file";
        //     }
        // } else {
        //     echo "You cannot upload files of this type";
        // }

        $file = addslashes(file_get_contents($images['tmp_name']));
        $stmt = $this->db->prepare("UPDATE `users` SET `avatar` = $file WHERE `token` = $token");
        $stmt->execute();
        return true;
    }
}