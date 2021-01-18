<?php
header('Access-Control-Allow-Origin: *');

error_reporting(E_ALL & ~E_NOTICE);

require_once('app/Application.php');


function router($params) {
    $method = $params['method'];
    if ($method) {
        $app = new Application();
        switch ($method) {
            case 'registration': return $app->registration($params);
            case 'login': return $app->login($params);
            case 'logout': return $app->logout($params);
            case 'getuserbytoken': return $app->getUserByToken($params);
            case 'setuseravater': return $app->setUserAvater($params);
            case 'getuseravatar': return $app->getUserAvatar($params);
            case 'addnote': return $app->addNote($params);
            case 'getallnotes': return $app->getAllNotes($params);
            case 'deletenote': return $app->deleteNote($params);
            case 'updatenickname': return $app->updateNickname($params);
        } 
    }
}

function answer($data) {
    if (gettype($data) == 'array') {
        if ($data[0] == 'error') {
            return array('result' => 'error', 'data' => 'error');
        }
        return array('result' => 'ok', 'data' => $data);
    } else if (!$data) {
        return array('result' => 'error');
    } 
    return array('result' => 'ok', 'data' => $data);
}

if ($_FILES && $_POST) {
    echo (json_encode(answer(router(array_merge($_FILES, $_POST)))));
}
elseif ($_GET) {
    echo (json_encode(answer(router($_GET))));
}
elseif ($_POST) {
    echo (json_encode(answer(router($_POST))));
}
