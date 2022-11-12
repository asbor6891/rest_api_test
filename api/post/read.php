<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/User.php';

// Создание объекта БД и подключение
$database = new Database();
$db = $database->getConnection();

// Создание объекта пользователя
$user = new User($db);

// Запрос пользователя
$result = $user->read();
// Получение количества строк
$num = $result->rowCount();

// Проверка существования пользователей
if ($num > 0) {
    $users_arr = array();
    $users_arr['data'] = array();

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $users_item = array(
            'id' => $id,
            'name' => $name,
            'email' => $email
        );

        array_push($users_arr['data'], $users_item);
    }

    // Переход к JSON и вывод
    echo json_encode($users_arr);
} else {
    echo json_encode(array('message' => 'No Users Found'));
}