<?php
class newsEditor
{
public function makeNewPost($id,$groupId,$text,$attach,$type="post")
{
    $filed = "Data/Group/".$groupId.".txt";
    $dt=  date("Y-m-d H:i:s");
      $rez =json_encode(array(
          "type"=>$type,
          "text" =>"$text",
          "madeby"=>"$id",
          "attach"=>"$attach",
          "date"=>"$dt",
          
      ), JSON_UNESCAPED_UNICODE);
      // записываем в файл текст
      file_put_contents($filed,"$rez\n", FILE_APPEND );
  return "ok";
}
//////////////////////////////////////////
function get_GroupInfo($idGroup){
    
    $lines = file("Data/msgs/".$idGroup.".txt");   
  json_decode($lines);
    return $lines[0];
}
//////////////////////////////////////////
public function makeNewGroup()
{

}
//////////////////////////////////////////
function new_Groupfile($ids,$mainid,$name="standart"){//создает новый файл группы
   $id = rand(1,9999999);
$filed = "Data/msgs/".$id.".txt";
if(file_exists($filed)){
    while(!file_exists($filed)){
        $msgskey=md5(time());
        $filed = "Data/Groups/".$msgskey.".txt";
    }
}
$rez =json_encode(array(
    "type"=>"infodialog",
    "name" =>"$name",
    "owner"=>"$mainid",
    "admins"=>"$mainid",
    "moderators"=>"$mainid",
    "ids" => $id,
    "img"=>""
), JSON_UNESCAPED_UNICODE);
// открываем файл, если файл не существует,
//делается попытка создать его
while(!file_exists($filed)){
$fp = fopen($filed, "w+");
}
}
//////////////////////////////////////////
}
?>