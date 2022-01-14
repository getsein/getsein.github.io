<?php
/**
 * @web https://github.com/PHPMailer/PHPMailer
 */

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require 'PHPMailer/src/OAuth.php';

class MyPHPMailer
{
    /**
	 * @var PHPMailer $mail Contains an instance of PHPMailer class
	 */
    private $mail = null;

    /**
	 * Class constructor
	 */
    function __construct()
	{
		$this->mail = new PHPMailer(true);
        $this->mail->CharSet = 'utf-8';
        $this->mail->SMTPDebug = SMTP::DEBUG_OFF;                // Enable verbose debug output
		$this->mail->isSMTP();                                      // Set mailer to use SMTP
		//Configurar email de la organizacion para usarlo como servidor de email
		$this->mail->Host = 'smtp.gmail.com';  					    // Specify main and backup SMTP servers
		$this->mail->SMTPAuth = true;                 	            // Enable SMTP authentication
		$this->mail->Username = 'seinlabs@gmail.com';   // SMTP username
		$this->mail->Password = 'seinLabs2022';                       // SMTP password
		$this->mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;      // Enable TLS encryption, `ssl` also accepted
		$this->mail->Port = 465;                                    // TCP port to connect to (TLS - 578 / SSL - 465)
    }

    public function getMail()
    {
        return $this->mail;
    }
    
	/**
	 * Notas
	 * SMTP::DEBUG_OFF (0): Disable debugging (you can also leave this out completely, 0 is the default).
	 * SMTP::DEBUG_CLIENT (1): Output messages sent by the client.
	 * SMTP::DEBUG_SERVER (2): as 1, plus responses received from the server (this is the most useful setting).
	 * SMTP::DEBUG_CONNECTION (3): as 2, plus more information about the initial connection - this level can help diagnose STARTTLS failures.
	 * SMTP::DEBUG_LOWLEVEL (4): as 3, plus even lower-level information, very verbose, don't use for debugging SMTP, only low-level problems.
	 */

}