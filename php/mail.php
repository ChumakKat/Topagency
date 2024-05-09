<?php

header('Content-type: text/html');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
//use PHPMailer\PHPMailer\SMTP;

require "PHPMailer/src/PHPMailer.php";
require "PHPMailer/src/Exception.php";
//require "PHPMailer/src/SMTP.php";

$mail = new PHPMailer(true);
$mail->CharSet = 'utf-8';
$mail->setLanguage('ru', 'PHPMailer/language/');
$mail->isHTML(true);  

//$mail-> isSMTP();

$mail->setFrom('muzkat@mail.com', 'Заявка с сайта'); // от кого будет уходить письмо?
$mail->addAddress('topagency.ads@gmail.com');     // Кому будет уходить письмо 
$mail->Subject = 'Новая заявка для Topagency';

$name = $_POST['name'];
$email = $_POST['email'];
$company = $_POST['company'];
$phone = $_POST['tel'];
$message = $_POST['message'];


// Тело письам
$body = '<h1>Заявка для Topagency</h1>';

if(trim(!empty($name))){
    $body.='<p><strong>ФИО:</strong> '.$name.'</p>';
}
if(trim(!empty($email))){
    $body.='<p><strong>Email:</strong> '.$email.'</p>';
}
if(trim(!empty($company))){
    $body.='<p><strong>Название компании:</strong> '.$company.'</p>';
}
if(trim(!empty($phone))){
    $body.='<p><strong>Номер телефона:</strong> '.$phone.'</p>';
}
if(trim(!empty($message))){
    $body.='<p><strong>Задача:</strong> '.$message.'</p>';
}

$mail->Body = $body; //Отправка

if (!$mail->send()) {
    echo 'Ошибка: '.$mail->ErrorInfo;
} else {
    echo '!OK!';
}

?>