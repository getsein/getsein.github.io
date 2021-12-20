<?php
$destino = "agustinaclaro@hotmail.com"; // Email del Sitio Web
$asunto = "Sein :: Contacto Web"; // Asunto del Email
$nombre = utf8_decode(trim($_POST["nombre"]));
$email = trim($_POST["email"]);
$telefono = trim($_POST["telefono"]);
$consulta = utf8_decode(trim($_POST["consulta"]));
$mensaje = "<html>\n";
$mensaje .= "<body style='font-family:arial; font-size:14px;'>\n";
$mensaje .= "<p style='background-color:#EEEEEE; padding:5px;'><b>" .$asunto ."</b></p>";
$mensaje .= "<p><b>Nombre y Apellido:</b> " .$nombre ."<br>\n";
$mensaje .= "<b>Email:</b> " .$email ."<br>\n";
$mensaje .= "<b>Tel&eacute;fono/Celular:</b> " .$telefono ."<br>\n";
$mensaje .= "<b>Consulta:</b> " .$consulta ."</p>\n";
$mensaje .= "</body>\n";
$mensaje .= "</html>\n";
$headers = "MIME-Version: 1.0\r\n";
$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
$headers .= "From: " .$nombre ." <" .$email .">\r\n";
$headers .= "Reply-To: " .$email ."\r\n";

if (($nombre != "") && ($email != "") && ($consulta != "")) {
	mail($destino, $asunto, $mensaje, $headers);
	/*date_default_timezone_set("America/Buenos_Aires");
	$contenido = $nombre ."; " .$email ."; " .$telefono ."; " .$consulta ."; " .date("Y-m-d") ."; " .date("H:i:s") ."; " .$_SERVER["REMOTE_ADDR"] ."\n";
	$nombre_archivo = "contactos.csv";
	$archivo = fopen($nombre_archivo, "a");
	fwrite($archivo, $contenido);
	fclose($archivo);*/
	header("Location:gracias.html");
} else {
	header("Location:error.html");
}
?>