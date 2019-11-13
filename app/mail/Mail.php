<?php


use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

require_once ("PHPMailer/PHPMailer.php");
require_once ("PHPMailer/POP3.php");
require_once ("PHPMailer/SMTP.php");
require_once ("PHPMailer/Exception.php");


class Mail {

    private $username;
    private $password;
    private $host;
    private $port;
    private $protocolo;
    private $name;

    function __construct(){
        $this->username = 'correo@gmail.cl';
        $this->password = 'passWord123';
        $this->host = 'smtp.gmail.com';
        $this->protocolo = 'ssl';
        $this->port = '465';
        $this->name= 'nombre empresa';

    }

	public static function enviar($correoDestino,$asunto,$mensaje){
        //Envio de correo recepcion
        $mail = new PHPMailer(true);
        try {

			$mail->isSMTP(); // Set mailer to use SMTP xd
            $mail->Host = $this->host; // Specify main and backup SMTP 
            $mail->SMTPAuth = true; // Enable SMTP authentication
            $mail->Username = $this->username; // SMTP username
            $mail->Password =  $this->password;  // SMTP password
			$mail->SMTPSecure = $this->protocolo;
			$mail->CharSet = 'utf-8';
            $mail->IsHTML(true); // Enable TLS encryption, `ssl` also accepted
            $mail->Port = $this->port; // TCP port to connect to
            $mail->setFrom($this->correo, $this->name);
			$mail->Subject = $asunto;
			$mail->Body = $mensaje;     
			$mail->addAddress($correoDestino);           


			if ($mail->Send()) {
				return 1;
			} else {
				return -1;
			}			
    } catch (Exception $e) {	
      
        //echo $e;  
        return 0;
				
    }
  }

  public static function texto($m = array('nombre','correo','asunto','mensaje')){
    $t =  $m[0] . " " . $m[1] . " " . $m[2] . " " . $m[3];
    return $t;
  }


}