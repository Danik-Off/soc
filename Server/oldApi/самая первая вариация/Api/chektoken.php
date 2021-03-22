<?php
// заголовки 


 
// требуется для декодирования JWT 

include 'config/appinfo.php';
include_once 'libs/php-jwt-master/src/BeforeValidException.php';
include_once 'libs/php-jwt-master/src/ExpiredException.php';
include_once 'libs/php-jwt-master/src/SignatureInvalidException.php';
include_once 'libs/php-jwt-master/src/JWT.php';
use \Firebase\JWT\JWT;
 
// получаем значение веб-токена JSON 

// получаем JWT 


// если JWT не пуст 
class CheckToken{
    
    function check($jwt,$key){
if($jwt) {
 
    // если декодирование выполнено успешно, показать данные пользователя 
    try {
        // декодирование jwt 
        $decoded = JWT::decode($jwt, $key, array('HS256'));
 
        // код ответа 
        //http_response_code(200);
 
        // показать детали 
        return json_encode(array(
            
            "status"=>"true",
            "message" => "Доступ разрешен.",
            "data" => $decoded->data
        ), JSON_UNESCAPED_UNICODE);
 
    }
 
    // если декодирование не удалось, это означает, что JWT является недействительным 
    catch (Exception $e){
    
        // код ответа 
      // http_response_code(401);
    
        // сообщить пользователю отказано в доступе и показать сообщение об ошибке 
        return json_encode(array(
            "status"=>"false",
            "message" => "Доступ закрыт.",
            "error" => $e->getMessage()
        ), JSON_UNESCAPED_UNICODE);
    }
}
 
// показать сообщение об ошибке, если jwt пуст 
else{
 
    // код ответа 
    //http_response_code(401);
 
    // сообщить пользователю что доступ запрещен 
    return json_encode(array(
        "status"=>"false",
        "message" => "Доступ запрещён.",
       
    ), JSON_UNESCAPED_UNICODE);
}}}
?>