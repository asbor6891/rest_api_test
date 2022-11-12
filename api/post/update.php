<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/User.php';

// Создание объекта БД и подключение
$database = new Database();
$db = $database->getConnection();

// Создание объекта пользователя
$user = new User($db);

// Получение необработанных опубликованных данных
$data = json_decode(file_get_contents("php://input"));

// Установка ID для обновления
$user->id = $data->id;
$user->name = $data->name;
$user->email = $data->email;

// Обновление пользователя
if ($user->update()) {
    echo json_encode(array('message' => 'User Updated'));
} else {
    echo json_encode(array('message' => 'User Not Updated'));
}