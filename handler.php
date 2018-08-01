<?php
mb_internal_encoding("UTF-8");
include('db.php');
 
print_r($_REQUEST);
print_r($_FILES);



$email = $_POST['email'];
$message = $_POST['message'];
$file = $_FILES['screen']['name'];

$query = "INSERT INTO bugreport (email, message, file) VALUES (:email, :message, :file)";

$query_prep = $connection->prepare($query);
$data =['email'=>$email, 'message'=>$message, 'file'=>$file];
$result = $query_prep->execute($data);


if(isset($_FILES['screen'])){
    $errors = array();
    $file_name = $_FILES['screen']['name'];
    $file_size = $_FILES['screen']['size'];
    $file_tmp = $_FILES['screen']['tmp_name'];
    $file_type = $_FILES['screen']['type'];
    $expension = array("jpeg", "jpg", "png");

    if($file_size> 10097152){
        $errors[]= 'Не больше 10 мб';
    }

    if(empty($errors) == true){
        move_uploaded_file($file_tmp, "D:\OSPanel\domains/form/forming/".$file_name);
        echo "Success";
    }else {
        print $errors;
    }
} 
$botToken = "614074616:AAESbimuMDSsJoPvxq8Q4H_K0zZ8HDCxCjo";
$chatId = "-419698912";
$website="https://api.telegram.org/bot".$botToken;
$params=[
'chat_id' => $chatId,
'parse_mode' => 'html',
'text' => implode(PHP_EOL, array(
    "<b>E-mail:</b> ". $email,
    "Сообщение:  " .  $message,
    "Скриншот: "  . 'http://D:\OSPanel\domains/form/forming/'.$file,
  ) )

];


$ch = curl_init($website . '/sendMessage');
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$result = curl_exec($ch);
curl_close($ch);
print_r($result );

  

die();
?>