<?php
$_GET['id'];
$editdial = new DialogEditor();
echo $editdial->new_Dialog(1)
class DialogEdiotor{

function new_Dialog($id){//функция для создания нового файла сообщений необходимо передать id тез кому доступно 
   try{ 
    $filed;
    while(!file_exists($filed)){
        $filed = "../../Data/msgs/"+"1."+"txt";//generate_token()
    }
   if( is_array($id,$namedialog)){
    $rez =json_encode(array(
        "type"=>"infodialog",
        "name" => $namedialog,
        "ids" => $id,
        "img"=>null
    ), JSON_UNESCAPED_UNICODE);
    file_put_contents($filed, $rez);
}else{
    $rez =json_encode(array(
        "type"=>"infodialog",
        "name" => $namedialog,
        "ids" => $id,
        "img"=>null
    ), JSON_UNESCAPED_UNICODE);
    file_put_contents($filed, $rez);
}} catch (Exception $e){
    echo json_encode(array(
        "message"=>"ошибка",
        "error" => $e->getMessage()
       
    ), JSON_UNESCAPED_UNICODE);
}
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
}
*/}
?>