<?php
defined('BASEPATH') or exit('Access Denied');

/**
 * Recaptcha class
 */
class Recaptcha
{
    /**
	 * Class constructor
	 */
    function __construct()
    {
        
    }

    /**
     * Function: it makes a call to Google reCaptcha and verify the token that was gotten in the client side. E.g. Login / Sign Up
     * @link https://developers.google.com/recaptcha/docs/v3
     * @param string $recaptcha_response
     * @return bool if the recaptcha is verified or not
     */
    public function verifyRecaptcha($recaptcha_response)
    {
        define('USER_IP', $_SERVER['REMOTE_ADDR']);
        define('RECAPTCHA_SECRET_KEY', '6LdUv9AdAAAAAGyD9VSsvWm234zo-8SzMIfJ_S33');
        define('URL_RECAPTCHA_VERIFY_BE', 'https://www.google.com/recaptcha/api/siteverify');
        define('MINIMUM_VALIDATION_SCORE', 0.5);
        
         if($_SERVER['HTTP_HOST']=!"localhost") {
        $post_data = http_build_query(
            array(
                'secret' => RECAPTCHA_SECRET_KEY,
                'response' => $recaptcha_response,
                'remoteip' => USER_IP ? USER_IP : ''
            )
        );
        $opts = array('http' =>
            array(
                'method'  => 'POST',
                'header'  => 'Content-type: application/x-www-form-urlencoded',
                'content' => $post_data
            )
        );
        $context  = stream_context_create($opts);
        $response = file_get_contents(URL_RECAPTCHA_VERIFY_BE, false, $context);
        $result = json_decode($response);
        if (!$result->success) {
            // throw new Exception('Gah! CAPTCHA verification failed. Please email me directly at: jstark at jonathanstark dot com', 1);
            return false;
        }
        // Take action based on the score returned:
        if ($result->score >= MINIMUM_VALIDATION_SCORE) {
            // Verified
            return true;
        } else {
            // Not verified
            return false;
        }
         } else {
            return true;
         }
    }

}