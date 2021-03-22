<?php

// требуемые заголовки 

header("Access-Control-Allow-Origin: http://authentication-jwt/");

header("Content-Type: application/json; charset=UTF-8");

header("Access-Control-Allow-Methods: POST");

header("Access-Control-Max-Age: 3600");

header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

 

// подключение к БД 

// файлы, необходимые для подключения к базе данных 

include_once 'config/database.php';

include_once 'objects/user.php';

 

// получаем соединение с базой данных 

$database = new Database();

$db = $database->getConnection();

 

// создание объекта 'User' 

$user = new User($db);

// получаем данные 

$data = json_decode(file_get_contents("php://input"));

 

// устанавливаем значения 

$user->firstname = $_GET["firstname"];

$user->lastname =$_GET["lastname"];

$user->email =$_GET["email"];

$user->password =$_GET["password"];

 // создание пользователя 

if (

    !empty($user->firstname) &&

    !empty($user->email) &&

    !empty($user->password)&&

    $user->create()

) {

    // устанавливаем код ответа 

    http_response_code(200);

 

    // покажем сообщение о том, что пользователь был создан 

     

    echo json_encode(array("message" => "Пользователь был создан."), JSON_UNESCAPED_UNICODE), "\n";

}

 

// сообщение, если не удаётся создать пользователя 

else {

 

    // устанавливаем код ответа 

    http_response_code(400);

 

    // покажем сообщение о том, что создать пользователя не удалось 

    echo json_encode(array("message" => "Невозможно создать пользователя. попробуйте в следующем формате create_user.php?firstname=name&lastname=lastname&password=1234&email=exampl@pochta.ru"), JSON_UNESCAPED_UNICODE);

}
?>