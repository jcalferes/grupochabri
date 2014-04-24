<?php

class Utilerias {

    function genera_password($longitud, $tipo) {

        if ($tipo == "alfanumerico") {
            $exp_reg = "[^A-Z0-9]";

//        return substr(eregi_replace($exp_reg, "", md5(rand())) .
//                eregi_replace($exp_reg, "", md5(rand())) .
//                eregi_replace($exp_reg, "", md5(rand())), 0, $longitud);
            return substr(eregi_replace($exp_reg, "", md5(rand())), 0, $longitud);
        }
    }

    function genera_md5($clave,$destinos) {
        $codificado = md5($clave);
        return $codificado;
    }

    function enviarCorreoElectronico($correo, $destinos) {
  include_once ("class.phpmailer.php");
    include_once ("class.smtp.php");

    $mail = new PHPMailer(); //Objeto de PHPMailer
    $mail->IsSMTP(); //Protocolo SMTP
    $mail->SMTPAuth = true; //Autentificacion de SMTP
//    $mail->SMTPSecure = "tls"; //SSL socket layer
//  $mail->Host = "smtp.mail.yahoo.com"; //Servidor de SMTP 
//    $mail->Port = 25; //Puerto seguro del servidor SMTP 
    $mail->SMTPSecure = "ssl";
    $mail->Host = "smtp.gmail.com";
    $mail->Port = 465;

    $mail->From = "de"; //Remitente (En mi variable)
    foreach ($destinos as $value) {
         $mail->AddAddress($value);//Destinatario
    }
    
    $mail->Username = "shanaxchornos@gmail.com"; /* Tienes que poner una direccion de correo real y de del servidor SMTP seleccionado */
    $mail->Password = "catscagats"; //Aqui va la contraseña valida de tu correo
    $mail->Subject = "asunto"; //El asunto de correo
    $mail->Body = "mensaje"; //El mensaje de correo
//    $mail->WordWrap = 50; //# de columnas
    $mail->CharSet = 'UTF-8';
    $mail->WordWrap = 50;
    $mail->MsgHTML("mensaje"); //Se indica que el cuerpo del correo tendra formato HTML
    $mail->AddAttachment("../administracion/reportes/probando.pdf", "nombre.pdf"); //Accedemos al archivo que se subio al servidor y lo adjuntamos

    if ($mail->Send()) {//Enviamos el correo por PHPMailer
        $respuesta = "El mensaje a sido enviado desde tu cuenta de Gmail :)";
    } else {
        $respuesta = "El mensaje no a sido enviado :(";
        $respuesta .= "Error: " . $mail->ErrorInfo;
    }
}
}

?>