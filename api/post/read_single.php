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

// Получение ID
$user->id = isset($_GET['id']) ? $_GET['id'] : die();

// Получение пользователя
$user->read_single();

// Создание массива
$user_arr = array(
    'id' => $user->id,
    'name' => $user->name,
    'email' => $user->email,
);

// Создание JSON
print_r(json_encode($user_arr));