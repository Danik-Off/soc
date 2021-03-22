<?php

// объект 'user' 

class Finder {

 

    // подключение к БД таблице "users" 

    private $conn;

    private $table_name = "users";

 

    // свойства объекта 

    public $id;

    public $firstname;

    public $lastname;

    public $email;

    public $password;

 private    $Tokens = "{}";

 

    // конструктор класса User 

    public function __construct($dd) {

        $this->conn = $dd;

    }



    // Создание нового пользователя 

  

    // здесь будет метод emailExists() 

   function finduserbyid(){



    // запрос, чтобы проверить, существует ли электронная почта 

    $query = "SELECT email, firstname, lastname, password,Tokens

            FROM " . $this->table_name . "

            WHERE id = ?

            ";

 

    // подготовка запроса 

    $stmt = $this->conn->prepare( $query );

 

    // инъекция 

    $this->id=htmlspecialchars(strip_tags($this->id));

 

    // привязываем значение e-mail 

    $stmt->bindParam(1, $this->id);

 

    // выполняем запрос 

    $stmt->execute();

 

    // получаем количество строк 

    $num = $stmt->rowCount();

 

    // если электронная почта существует, 

    // присвоим значения свойствам объекта для легкого доступа и использования для php сессий 

    if($num>0) {



        // получаем значения 

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

 

        // присвоим значения свойствам объекта 

        $this->id = $row['id'];

        $this->firstname = $row['firstname'];

        $this->lastname = $row['lastname'];

        $this->password = $row['password'];

 

        // вернём 'true', потому что в базе данных существует электронная почта 

        return $this->firstname;

    }

 

    // вернём 'false', если адрес электронной почты не существует в базе данных 

    return "c€zc";

}
}

// здесь будет метод update()



