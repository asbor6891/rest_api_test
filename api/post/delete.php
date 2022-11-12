<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');
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

// Удаление поста
if ($user->delete()) {
    echo json_encode(array('message' => 'User Deleted'));
} else {
    echo json_encode(array('message' => 'User Not Deleted'));
}