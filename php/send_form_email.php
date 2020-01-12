<?php
if($_POST && "all required variables are present") {
session_start();
    if($_POST['captcha'] != $_SESSION['digit']) die("D�soler, les nombres entr�s son invalide.");
    session_destroy();
  }
 
if(isset($_POST['email'])) {
 

 
    // EDIT THE 2 LINES BELOW AS REQUIRED
 
    $email_to = $_POST['departement']."@ctlalpax.ca";
 
    $email_subject = $_POST['sujet'];
 
     
 
     
 
    function died($error) {
 
        // your error code can go here
 
        echo "Desoler mais il y a des erreurs dans votre formulaire. ";
 
        echo "Voici vos erreurs.<br /><br />";
 
        echo $error."<br /><br />";
 
        echo "S.V.P retourner en arriere pour les corriger.<br /><br />";
 
        die();
 
    }
 
     
 
    // validation expected data exists
 
    if(!isset($_POST['email']) ||
        !isset($_POST['sujet']) ||
		!isset($_POST['nom']) ||
		!isset($_POST['departement']) ||
		!isset($_POST['tel']) ||
        !isset($_POST['message'])) {
 
        died('Desoler mais il semble avoir un probleme avec votre formulaire.');       
 
    }
 
    $nom = $_POST['nom']; // required
    $email_from = $_POST['email']; // required
	$tel = $_POST['tel'];
	$departement = $_POST['departement']; // required
    $sujet = $_POST['sujet']; // required
    $message = $_POST['message']; // required
 
     
 
    $error_message = "";
 
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
 
  if(!preg_match($email_exp,$email_from)) {
 
    $error_message .= 'Votre addresse courriel est invalide.<br />';
 
  }
    $tel_exp = '/\(?([0-9]{3})\)?([ .-]?)([0-9]{3})\2([0-9]{4})/';
    if(!preg_match($tel_exp,$tel)) {
      	$error_message .= 'Numero de telephone invalide!';
    }
 
    $string_exp = "/^[A-Za-z .'-]+$/";
 
  if(!preg_match($string_exp,$nom)) {
 
    $error_message .= 'Le nom que vous avez entre est invalide.<br />';
 
  }
 
	if(strlen($message) < 2) {
 
    	$error_message .= 'Le message que vous avez entre est invalide.<br />';
 
  }
  
 
  if(strlen($error_message) > 0) {
 
    died($error_message);
 
  }
 
    $email_message = "Detail du formulaire au dessous.<br><br>";
 
     
 
    function clean_string($string) {
 
      $bad = array("content-type","bcc:","to:","cc:","href");
 
      return str_replace($bad,"",$string);
 
    }
 
    $email_message .= "Nom: ".clean_string($nom)."<br>";
 
    $email_message .= "Email: ".clean_string($email_from)."<br>";
	$email_message .= "Telephone: ".clean_string($tel)."<br>";
	
	$email_message .= "Departement: ".clean_string($departement)."<br>";
 
    $email_message .= "Sujet: ".clean_string($sujet)."<br>";
 
    $email_message .= "Message: ".clean_string($message)."<br>";
 
     
 
     
 
// create email headers
 
$headers = 'Content-type: text/html; charset=utf-8'.'From: '.$email_from."\r\n".
 
'Reply-To: '.$email_from."\r\n" . 
 
'X-Mailer: PHP/'. phpversion();
 
@mail($email_to, $email_subject, $email_message, $headers );  
 
header( "refresh:5; url=../index.html" ); //wait for 5 seconds before redirecting
?> 
<!-- include your own success html here --> 
Merci de nous avoir contacte. Nous reponderont aussitot que possible.
<?php 
}
?>