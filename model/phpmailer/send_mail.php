<?php
require 'PHPMailerAutoload.php';


class SendEmail{
 
    private $Addemail;
    public $mail;

    public function setData( $Addemail){
        $this->Addemail = $Addemail;

    }

    public function __construct(){
        $this->mail = new PHPMailer;
        $this->mail->isSMTP();                                           
        $this->mail->Host       = 'smtp.gmail.com';                    
        $this->mail->SMTPAuth   = true;                                
        $this->mail->Username   = 'toolcreationhelp@gmail.com';                     
        $this->mail->Password   = 'TC2020TC';                              
        $this->mail->SMTPSecure = 'tls';         
        $this->mail->Port       = 587;
        $this->CharSet='UTF8';
    }

    public function sendEmail($newPass){
        $this->mail->setFrom('toolcreationhelp@gmail.com','ToolCreation Support' );
        $this->mail->addAddress( $this->Addemail);              
        $this->mail->isHTML(true);                                 
        $this->mail->Subject = 'Recuperacion de Cuenta';
        $this->mail->Body    = 'Esta es su nuevo Password : <strong>'. $newPass .'</strong> <br> 
                                <strong>Nota</strong>: Inicie sesion de nuevo y cambie el password en la configuracion de cuenta';
        return $this->mail->Send();
    }
}
?>
