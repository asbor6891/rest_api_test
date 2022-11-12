<?php

class Database
{
    // Параметры БД
    private $host = 'localhost';
    private $db_name = 'rest_api_users';
    private $username = 'root';
    private $password = '';
    private $connect;

    // Подключение к БД
    public function getConnection()
    {
        $this->connect = null;

        try {
            $this->connect = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->db_name, $this->username, $this->password);
            $this->connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $exception) {
            echo 'Connection error: ' . $exception->getMessage();
        }

        return $this->connect;
    }
}