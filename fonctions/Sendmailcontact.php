<?php
require_once "Alert.php";
$errors = '';
$myemail = 'franzleroxxor@hotmail.fr'; //<-----Put Your email address here.
header("refresh:1; http://localhost/ProjetBDEWeb4/home.php");
if(empty($_POST['name'])  ||
   empty($_POST['email']) ||
   empty($_POST['message']))
{
    $errors .= "\n Error: all fields are required";
}
$name = $_POST['name'];
$email_address = $_POST['email'];
$message = $_POST['message'];
if (!preg_match(
"/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/i",
$email_address))
{
    $errors .= "\n Error: Invalid email address";
}

if( empty($errors))
{
$to = $myemail;
$email_subject = "Contact form submission: $name";
$email_body = "You have received a new message. ".
" Here are the details:\n Name: $name \n ".
"Email: $email_address\n Message \n $message";
$headers = "From: $myemail\n";
$headers .= "Reply-To: $email_address";
// ini_set('sendmail_from', 'smtp.free.fr'); // non fonctionnel en local --> l'adresse doit être celle du serveur SMTP du fournisseur 
mail($to,$email_subject,$email_body,$headers);
alert("Message succesfully sent");
header("refresh:5; C:/wamp64/www/ProjetBDEWeb/home.php");
}
?>