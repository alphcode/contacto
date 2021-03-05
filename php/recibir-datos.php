<?php

    require_once '../vendor/autoload.php';
    require_once 'correo.php';

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;


    $nombre = $_POST["nombre"] ?? '';
    $apellido = $_POST["apellido"] ?? '';
    $correo = $_POST["correo"] ?? '';
    $mensaje = $_POST["mensaje"] ?? '';
 
    $respuesta = [];
    $bandera = true;

    if($nombre == ''){
        $respuesta += ['nombre' => 'Ingres un nombre'];
        $bandera= false;
    }

    if($apellido == ''){
        $respuesta += ['apellido' => 'Ingrese un apelllido']; 
        $bandera= false;
    }

    if($correo == '' ){
        $respuesta += ['correo' => 'Ingrese un correo'];

        $bandera= false;
    }

    if($mensaje == '' ){
        $respuesta += ['mensaje' => 'Ingrese un mensaje'];
        $bandera= false;
    }

    if($bandera){

        
		$mail = new PHPMailer(true);
		try {
			//Server settings
		  //       $mail->SMTPDebug = 2;                                       // Enable verbose debug output
			$mail->isSMTP();                                            // Set mailer to use SMTP
			$mail->Host       = 'smtp.server.mx';  // Specify main and backup SMTP servers
			$mail->SMTPAuth   = true;                                   // Enable SMTP authentication
			$mail->Username   = 'contacto@mail.com';                     // SMTP username
			$mail->Password   = '123456789';                               // SMTP password
			$mail->SMTPSecure = 'tls';                                  // Enable TLS encryption, `ssl` also accepted
			$mail->Port       = 958;                                    // TCP port to connect to
			//Recipients
			$mail->setFrom('salida@mail.com', 'Alphcode - Contacto');
			$mail->addAddress('correo@gmail.com', 'Alphcode');
			// Content
			$mail->Subject = 'Nuevo contacto';
			$mail->isHTML(true);                                  // Set email format to HTML
			$mail->Body    = correo($nombre,$apellido,$correo,$mensaje);
			$mail->CharSet = 'UTF-8';
			$mail->send();
			$respuesta = ['respuesta' => true];
		} catch (Exception $e) {
			$respuesta = ['respuesta' => false];
		}


    }


    echo json_encode($respuesta);