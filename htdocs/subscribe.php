<?php
	require_once 'inc/MCAPI.class.php';
	require 'PHPMailer/PHPMailerAutoload.php';
require_once('PHPMailer/class.phpmailer.php');
	 $api = new MCAPI('dbdbd86e3868fca40973810da6dde76c-us12');
	 $merge_vars = array('FNAME'=>$_POST["fname"], 'LNAME'=>$_POST["lname"]);
	 $email=$_POST["email"];

	// // Submit subscriber data to MailChimp
	// // For parameters doc, refer to: http://apidocs.mailchimp.com/api/1.3/listsubscribe.func.php
	 $retval = $api->listSubscribe( 'd403335c23', $_POST["email"], $merge_vars, 'html', false, true );

	// if ($api->errorCode){
	// 	//var_dump($api->errorCode);
	// 	echo "<h4>Please try again.</h4>".$_POST["email"];
	// } else {
	 	//echo "<h4 style=\"text-align: center;\">Inscription newsletter: ".$_POST["email"]."</h4> <br> <h4  style=\"text-align: center;\">Bienvenue parmi nous! ;)</h4>";

require 'mailin/V2.0/Mailin.php'; 

$mailin = new Mailin("https://api.sendinblue.com/v2.0","7EOFHaXfdmpqJRBD");
    $data = array( "email" => $_POST["email"],"listid" => array(5));
    $mailin->create_update_user($data);
 
    // //var_dump($mailin->create_update_user($data));
    // var_dump($mailin->create_update_user($data)); 
    // die;	

define('GUSER', 'vnicolas060@gmail.com'); // GMail username
define('GPWD', 'couvou123?'); // GMail password
//$mailhex=$mail;
$mymessage2='<p>Salut !<br><br>


Tu trouveras en pièce jointe le guide<br><br>

Nous travaillons actuellement sur l\'amélioration du site<br>
le site sera opérationel mi janvier 2017<br><br>

Comme promis, le guide pdf sur "Les Conseils matériels de DJ":<br>
<a href="http://dj-formation.thinkific.com/courses/test">guide pdf sur Les Conseils matériels de DJ</a><br><br>


et la formation "Initiation aux matériel"<br>
<a href="http://dj-formation.thinkific.com/courses/demo">formation Initiation aux matériel</a><br><br>


A bientôt,<br><br>

L\'Equipe
<br><a href="http://www.dj-formation.com" title="">http://www.dj-formation.com</a></p>';


$mymessage="<p;>Bienvenue parmi nous!<br><br> 

Tu viens de t'inscrire à notre newsletter.<br> 
Comme tu le vois Aventour.net est sous sa version bêta, on va bientôt le lancé!<br>
En attendant, nous sommes fière de te compter parmi nous pour cette grande aventure ;)<br><br>

L\'equipe Aventour.net<br>
<a href=\"http://www.aventour.net\">aventour.net</a>
</p>"; 
//$email="vnicolas054@gmail.com";
//$mymessage="<a href=\"http://aventour.io/\">Clique ici pour activer ton compte</a>"; 
//$mymessage=file_get_contents('mail.html'); 
smtpmailer($email, 'contact@dj-formation.com', 'L\'EQUIPE DJ-Formation.com', 'Guide + Formation', $mymessage2);
smtpmailer('vnicolas054@gmail.com', 'contact@dj-formation.com', 'L\'EQUIPE DJ-Formation.com', 'Nouvelle inscription newsletter : '.$email.'<br><br><br><br> '.$mymessage2);




function smtpmailer($to, $from, $from_name, $subject, $body) { 
  global $error;
  $mail = new PHPMailer();  // create a new object
  $mail->CharSet = 'UTF-8';
  $mail->IsSMTP(); // enable SMTP
  $mail->SMTPDebug = 0;  // debugging: 1 = errors and messages, 2 = messages only
  $mail->SMTPAuth = true;  // authentication enabled
  $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
  $mail->Host = 'smtp.gmail.com';
  $mail->Port = 465; 
  $mail->Username = GUSER;  
  $mail->Password = GPWD;           
  $mail->SetFrom($from, $from_name);
  $mail->Subject = $subject;
  $mail->Body = $body;
  $mail->MsgHTML($body);
  $mail->AddAddress($to);
  //$mail->AddAttachment('cadeau/aventour.net decembre 2016 semaine 1.pdf');
  if(!$mail->Send()) {
    $error = 'Mail error: '.$mail->ErrorInfo; 
    return false;
  } else {
    $error = 'Message sent!';
    return true;
  }

}
header('location: http://www.dj-formation.com/confirmation/');
die("<h4 style=\"text-align: center;\">Inscription newsletter: ".$_POST["email"]."</h4> <br> <h4  style=\"text-align: center;\">Bienvenue parmi nous! ;)</h4>");

// }






	





	








 
//}
  //unset($_POST['submit']);
//$_POST['submit']=null;
//header("location: ../myindexdev.php");
//die("<meta http-equiv=\"Content-type\" content=\"text/html; charset=utf-8\" /><h1 style=\"padding-top: 10%;text-align: center;\">Un mail de confirmation a été envoyé sur ta boite mail</h1>");



?>
