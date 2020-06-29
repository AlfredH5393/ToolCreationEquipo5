<?php
require('../model/phpmailer/send_mail.php');

$email = new SendEmail();

$email->setData('Almagr5797@gmail.com');

$psswd = substr( sha1(microtime()), 1, 8);

if( $email->sendEmail($psswd)){
    echo "Envio de correo exitoso";
}else {
    echo 'Hubo un erro al enviar el correo ';
}

