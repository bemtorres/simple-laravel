<?php 
session_start();

require_once ("Mail.php");

if(isset($_POST['_token'])){
    
    if($_POST['_token'] == $_SESSION['_token']){
        $correo = htmlspecialchars($_POST['correo']);
        $nombre = htmlspecialchars($_POST['nombre']);
        $asunto = htmlspecialchars($_POST['asunto']);
        $mensaje = htmlspecialchars($_POST['mensaje']);    
       
        $mensajes = array($nombre,$correo,$asunto,$mensaje);

        $m = Mail::texto($mensajes);
        $correo_destino = "correoDestino@gmail.com";
        $asunto = "correo@gmail.com";
   


        $e = Mail::enviar($correo_destino,$asunto,$m);
        if($e==1){
            $_SESSION['info'] = "listo";
        }else{
            $_SESSION['error'] = "";
        }

      

    }else{
        $_SESSION['error'] = "listo";
    }  
}else{
    $_SESSION['error'] = "listo";
}

    header("Location: / ");
?>