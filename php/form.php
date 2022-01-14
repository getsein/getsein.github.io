<?php
define('BASEPATH', true);

require 'MyPHPMailer.php';
require 'Recaptcha.php';

$response = new stdClass();
$response->success = false; // true / false
$response->code = 0; // 200
$response->message = "";

// parametros
$corporacion_email = 'seinlabs@gmail.com';
$corporacion_nombre = 'Sein';
$asunto_del_email = 'Contacto a traves del sitio web Sien';


// 1. obtener datos del form y limpiarlos
// 1.1 verificar tipo de request
if($_SERVER['REQUEST_METHOD'] != "POST") {
    // cancelar
    $response->code = 999;
    $response->message = "wrong request";
    echo json_encode($response);
    exit;
}
// 1.2 obtener valores enviados desde el formulario
$nombre = $_POST['name'];
$email = $_POST['email'];
$mensaje = $_POST['message'];


// 1.3 limpiar los valores enviados
$nombre = cleanString($nombre);
$email = cleanString($email);
$mensaje = cleanString($mensaje);

// 1.4 validar si los valores no estan vacios
if($nombre == '' || $email == '' || $mensaje == '') {
// if($email == '' || $mensaje == '') {
    // error: se han enviado valores vacios
    $response->code = 998;
    $response->message = "Completar todos los datos obligatorios";
    echo json_encode($response);
    exit;
}

if(!isEmailValid($email)) {
    // error: correo electronico invalido
    $response->code = 997;
    $response->message = "Email inválido";
    echo json_encode($response);
    exit;
}

/**
 * Google Recaptcha Implementation
 *
 */
$recaptcha_web_response = $_POST['recaptcha_web_response'];
$recaptcha_web_response = cleanString($recaptcha_web_response);

/*if(!$recaptcha_response) {
    $response->code = 996;
    $response->message = "Recaptcha response inválido";
    echo json_encode($response);
    exit;
}
$verify = new Recaptcha();
if(!$verify->verifyRecaptcha($recaptcha_response)) {
    $response->code = 995;
    $response->message = "Recaptcha verification inválido";
    echo json_encode($response);
    exit;
}*/

$mensaje_final = "Buenos dias, <br>" .
                "Hay un nuevo mensaje de: " . $nombre . "<br>" .
                "Correo electronico: " . $email . "<br>" .
                "Mensaje: " . $mensaje;

// 2. enviar correo
try {
    $phpMailer = new MyPHPMailer();

    $sendEmail = $phpMailer->getMail();

    //Recipients
    // $mail->setFrom('from@example.com', 'Mailer');
    // $mail->addAddress('joe@example.net', 'Joe User');     //Add a recipient
    // $mail->addAddress('ellen@example.com');               //Name is optional
    // $mail->addReplyTo('info@example.com', 'Information');
    // $mail->addCC('cc@example.com');
    // $mail->addBCC('bcc@example.com');
    $sendEmail->setFrom($corporacion_email, $corporacion_nombre);
    //$sendEmail->addAddress($email, $nombre);
    $sendEmail->addAddress($corporacion_email, $corporacion_nombre);

    //Attachments
    // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    //Content
    $sendEmail->isHTML(true);                                  //Set email format to HTML
    $sendEmail->Subject = $asunto_del_email;
    $sendEmail->Body    = $mensaje_final;
    $sendEmail->AltBody = $mensaje_final;

    $sendEmail->send();

    $response->success = true; 
    $response->code = 200;
    $response->message = "El mail fue enviado correctamente";
    echo json_encode($response);
    exit;
} catch (Exception $e) {
    $response->code = 900;
    $response->message = "El mensaje no pudo ser enviado. Mailer Error: {$sendEmail->ErrorInfo}";
    echo json_encode($response);
    exit; 
}


/**
 * Funciones para validaciones
 */

/**
 * Function: it cleans a String variables to avoid Injection
 * @param string $string Contains the string to be cleaned
 * @return string
 *  
 */
function cleanString(string $string) : string
{
    $string = strip_tags($string);
    $string = str_replace("'", "", $string);
    $string = str_replace('"', "", $string);
    $string = trim($string);
    return $string;
}
/**
 * Function: it validates if an email address has a valid format
 * @param string $email Contains an email address
 * @return bool
 * 
 */
function isEmailValid($email)
{
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return true;
    }
    return false;
}