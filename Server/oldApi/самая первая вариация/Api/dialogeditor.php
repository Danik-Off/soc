<?php

// требуется для декодирования JWT 

// получаем значение веб-токена JSON 

// получаем JWT /*
/*$ids = $_GET["ids"];
$deb =new DialogEditor();

$keymsgs = $deb->new_Dialogfilemsgs($ids,$mainid);
echo $keymsgs;*/

// если JWT не пуст 
class DialogEditor{
    public $idss ;
    public function SetNew_Dialogs($id,$msgskey,$namedialog="standart"){
        $filed = "Data/Userinfo/".$id.".txt";
        
        if(!file_exists($filed)){
            $rez =json_encode(array(
                "type"=>"dialog",
                "name" =>$namedialog,
                "key"=>$msgskey
                
            ), JSON_UNESCAPED_UNICODE);
            $fp = fopen($filed, "w+");
       // новый файл
            fwrite($fp,"$rez\n");
             
        
            fclose($fp);
            return "newcreated";
        }
        else{
            
      
            $rez =json_encode(array(
                "type"=>"dialog",
                "name" =>$namedialog,
                "key"=>$msgskey
                
            ), JSON_UNESCAPED_UNICODE);
            // записываем в файл текст
            file_put_contents($filed,"$rez\n", FILE_APPEND );
            return "writed";
        }
    
    }
    //~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    function new_Dialogfilemsgs($ids,$mainid,$name="standart"){//создает новый файл диалога 
        $msgskey=md5(time());
    $filed = "Data/msgs/".$msgskey.".txt";
    if(file_exists($filed)){
        while(!file_exists($filed)){
            $msgskey=md5(time());
            $filed = "./Da";
        }
    }
  if(is_array($ids)){
 $idss =   array_merge ($ids,array($mainid));}else{
    $idss =   array($ids,$mainid);

 } 
 foreach($idss as $id1){
    
 $dd =new DialogEditor;
 $dd->SetNew_Dialogs($id1,$msgskey,$name);
 } 
        $rez =json_encode(array(
            "type"=>"infodialog",
            "name" =>"$name",
            "creator"=>"$mainid",
            "admins"=>"$mainid",
            "ids" => $idss,
            "img"=>""
        ), JSON_UNESCAPED_UNICODE);
        // открываем файл, если файл не существует,
        //делается попытка создать его
        
       
        while(!file_exists($filed)){
        $fp = fopen($filed, "w+");
         
        // записываем в файл текст
        fwrite($fp,"$rez\n");
         
        // закрываем
        fclose($fp);
        }
     
    return $msgskey;
}
//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
function new_Msg($id,$key,$msg,$type="msg"){
    $filed = "Data/msgs/".$key.".txt";
  $dt=  date("Y-m-d H:i:s");
    $rez =json_encode(array(
        "type"=>$type,
        "text" =>"$msg",
        "madeby"=>"$id",
        "date"=>"$dt"
    ), JSON_UNESCAPED_UNICODE);
    // записываем в файл текст
    file_put_contents($filed,"$rez\n", FILE_APPEND );
return "ok";
}
//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
function get_Msg($id,$key,$count){
    $lines = file("Data/msgs/".$key.".txt");
    array_shift($lines);
    $rez =json_encode(array(
        "msgs"=>$lines
        
    ), JSON_UNESCAPED_UNICODE);
  $rez = str_replace('\n','',$rez);
  $rez = str_replace('\\','',$rez);
  $rez = str_replace('["','[',$rez);
  $rez = str_replace('"]',']',$rez);
  $rez = str_replace('}","','},',$rez);
    return $rez;
}
//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
function get_DialogInfo($key){
    $lines = file("Data/msgs/".$key.".txt");   
    return $lines[0];
}
//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
function RenameDialog($msgskey,$id,$new_name)
{
    $filename = "Data/msgs/".$msgskey.".txt"; // имя файла

    $file = file($filename);
    $data = json_decode($file[0]);
    $oldname= $data->{'name'};
        $data->{'name'}=$new_name ;
    

    $file[0] = json_encode( $data, JSON_UNESCAPED_UNICODE).PHP_EOL;
    
    file_put_contents($filename, join('', $file));
    $dd = new DialogEditor;
    $text = "название изменено с $oldname на $new_name";
    $dd->new_Msg($id,$msgskey,$text,$type="system");
    return "ok";
}
//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~`
function Set_DialogInfo($id,$msgskey,$namedialog,$admins,$idsa){// изменить информацию о диалоге

    

$filename = "Data/msgs/".$msgskey.".txt"; // имя файла

$file = file($filename);
$data = json_decode($file[0]);
if($namedialog!=null){
$data->{'name'}= $namedialog;
}
if($idsa =null){

}
if($admins==null){
    $data->{'admins'}= $namedialog;
}
$replace =json_encode(array(
    "type"=>"infodialog",
    "name" =>$data->{'name'},
    "creator"=>$data->{'admins'},
    "admins"=>"",
    "ids" => $idsa,
    "img"=>""
), JSON_UNESCAPED_UNICODE);
$file[0] = $replace.PHP_EOL;

file_put_contents($filename, join('', $file));
}
//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

function Get_Dialogs($id){
    $jsondialogs  = file( "Data/Userinfo/".$id.".txt");
  
    for($i = 0; $i < count($jsondialogs); ++$i) {
$data= json_decode($jsondialogs[$i]);
$msgskey = $data->{"key"};

$filed = "Data/msgs/".$msgskey.".txt";
        if(!file_exists($filed)){
            unset($myArr[$i]);
        }
    }
        $rez =json_encode(array(
            "msgs"=>$jsondialogs
            
        ), JSON_UNESCAPED_UNICODE);
      $rez = str_replace('\n','',$rez);
      $rez = str_replace('\\','',$rez);
      $rez = str_replace('["','[',$rez);
      $rez = str_replace('"]',']',$rez);
      $rez = str_replace('}","','},',$rez);
        return $rez;
    

}




  
     


/*function new_Msg(){
    $filed = "save.txt";
    $rez = "Записано в файлик";
    file_put_contents($filed, $rez);
}
function get_Msg(){
    $handle = @fopen("/tmp/inputfile.txt", "r");
    if ($handle) {
        while (($buffer = fgets($handle, 4096)) !== false) {
            echo $buffer;
        }
        if (!feof($handle)) {
            echo "Ошибка: fgets() неожиданно потерпел неудачу\n";
        }
        fclose($handle);
    }
}
function get_infodialog(){
   
}
function set_infoDialog(){
    $line=1; // номер строки, которую нужно изменить
    $replace="xxx1"; // на что нужно изменить
    $filename = 'my_file.txt'; // имя файла
     
    $file = file($filename);
    $file[$line-1] = $replace.PHP_EOL;
    file_put_contents($filename, join('', $file));
}$cheks =new CheckToken();
$id =1;
 echo $cheks->check($id);
 
*/

 }
?>