<?php
require('../model/phpmailer/send_mail.php');
require('../model/mvc/model_mvc_login.php');

$email = new SendEmail();
$user = new MVCLogin();

$email->setData($_POST['email']);
$psswd = substr( sha1(microtime()), 1, 8);

if( $email->sendEmail($psswd)){
    $user->setEmail($_POST['email']);
    $user->setPassword($psswd);
    echo $user->restorePass();
}else {
    echo 'Hubo un error al enviar el correo ';
}

