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
$mail->addAddress('gf.muzkat@gmail.com');     // Кому будет уходить письмо 
$mail->Subject = 'Заявка на консультацию по Маркетингу!';

$name = $_POST['name'];
$phone = $_POST['tel'];
$email = $_POST['email'];
$connect = "по телефону";
if($_POST['question'] == "messenger"){
    $connect = "в мессенджере";
};


// Тело письам
$body = '<h1>Заявка на консультацию</h1>';

if(trim(!empty($name))){
    $body.='<p><strong>ФИО:</strong> '.$name.'</p>';
}
if(trim(!empty($phone))){
    $body.='<p><strong>Номер телефона:</strong> '.$phone.'</p>';
}
if(trim(!empty($email))){
    $body.='<p><strong>Email:</strong> '.$email.'</p>';
}
if(trim(!empty($connect))){
    $body.='<p><strong>Как с вами связаться:</strong> '.$connect.'</p>';
}



$mail->Body = $body; //Отправка

if (!$mail->send()) {
    echo 'Ошибка: '.$mail->ErrorInfo;
} else {
    echo '!OK!';
}

?>
