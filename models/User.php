<?php

class User
{
    private $connect;
    private $table = 'users';

    public $id;
    public $name;
    public $email;

    public function __construct($db)
    {
        $this->connect = $db;
    }

    // Получение всех пользователей
    public function read()
    {
        // Создание запроса
        $query = "SELECT * FROM users";
        
        // Подготовка запроса
        $statement = $this->connect->prepare($query);

        // Выполнение запроса
        $statement->execute();

        return $statement;
    }

    // Получение одного пользователя
    public function read_single()
    {
        // Создание запроса
        $query = "SELECT * FROM users WHERE id = ? LIMIT 0,1";

        // Подготовка запроса
        $statement = $this->connect->prepare($query);

        // Привязка ID
        $statement->bindParam(1, $this->id);

        // Выполнение запроса
        $statement->execute();

        $row = $statement->fetch(PDO::FETCH_ASSOC);

        // Установка свойств
        $this->id = $row['id'];
        $this->name = $row['name'];
        $this->email = $row['email'];
    }

    // Создание пользователя
    public function create() 
    {
        // Создание запроса
        $query = "INSERT INTO users (name, email) VALUES (:name, :email)";

        // Подготовка запроса
        $statement = $this->connect->prepare($query);

        // Очистка данных
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->email = htmlspecialchars(strip_tags($this->email));

        // Обновление данных
        $statement->bindParam(':name', $this->name);
        $statement->bindParam(':email', $this->email);

        // Выполнение запроса
        if ($statement->execute()) {
            return true;
        }

    printf("Error: %s.\n", $statement->error);

    return false;
    }

    // Обновление пользователя
    public function update() 
    {
        // Создание запроса
        $query = "UPDATE users SET name=:name, email=:email WHERE id=:id";

        // Подготовка запроса
        $statement = $this->connect->prepare($query);

        // Очистка данных
        $this->id = htmlspecialchars(strip_tags($this->id));
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->email = htmlspecialchars(strip_tags($this->email));

        // Обновление данных
        $statement->bindParam(':id', $this->id);
        $statement->bindParam(':name', $this->name);
        $statement->bindParam(':email', $this->email);

        // Выполнение запроса
        if ($statement->execute()) {
            return true;
        }

        printf("Error: %s.\n", $statement->error);

        return false;
    }

    // Удаление пользователя
    public function delete() 
    {
        // Создание запроса
        $query = "DELETE FROM users WHERE id=:id";

        // Подготовка запроса
        $statement = $this->connect->prepare($query);

        // Очистка данных
        $this->id = htmlspecialchars(strip_tags($this->id));

        // Обновление данных
        $statement->bindParam(':id', $this->id);

        // Выполнение запроса
        if ($statement->execute()) {
            return true;
        }

        printf("Error: %s.\n", $statement->error);

        return false;
    }
}