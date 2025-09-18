<?php
//contacts script:

//prevent opening directly, only allow POST:
if($_SERVER['REQUEST_METHOD'] == 'GET'){
    exit();
}

//error_reporting(-1);
//ini_set('display_errors', 'On');

function getmainurl2(){
    if(isset($_SERVER['HTTPS'])){
        $protocol = ($_SERVER['HTTPS'] && $_SERVER['HTTPS'] != "off") ? "https" : "http";
    }
    else{
        $protocol = 'http';
    }
    //return $protocol . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
	return $protocol . "://" . $_SERVER['HTTP_HOST'];
}

$arrContextOptions=array(
  "ssl"=>array(
		"verify_peer"=>false,
		"verify_peer_name"=>false,
	),
);

//define the LP location
//$lp_location = base_url() . "custom-pages/alteracoesclimaticas/";
//NOTE: for now I'm hadrcoding the custom page!
$lp_location = getmainurl2() . "/" . "custom-pages/alteracoesclimaticas/";

include("db_connect.php");

//limit the querystrings types:
$fieldsArray = array("id_municipality","consent_text","name","email","municipality","contacts_text","consent");
$fieldsValues = array();
//build the dynamic variables:
for($i=0;$i<count($fieldsArray);$i++){
	//generate the variables (dynamic):
	//some items need to be obtained in their raw form, because of the HTML tags:
	$theValue = strip_tags(trim($_REQUEST[$fieldsArray[$i]]));
	${$fieldsArray[$i]} = $theValue;
	array_push($fieldsValues, $theValue);
}

$contacts_return = "";
$contacts_saved_in_db = false;

// 1---------- save in the db:
if($consent === "1"){
	$consent = "Sim";
}
$link = OpenCon();
//$sql = "INSERT INTO ac_contacts (id_municipality,consent_text,name,email,municipality,contacts_text,privacy_consent,contacts_date) VALUES ('" . $municipality_id . "', '" . $municipality_title . "', '" . $rating . "', NOW())";

$contacts_date = date("Y-m-d H:i:s");
$sql = 'INSERT INTO `ac_contacts` (' . implode(", ", $fieldsArray) . ', contacts_date) VALUES (' . sprintf("'%s'", implode("','", $fieldsValues )) . ', "' . $contacts_date . '");';
//force UTF8 chars:
mysqli_query($link, "set names 'utf8'");			 
if(mysqli_query($link, $sql)){
	$contacts_saved_in_db = true;
} else{
	echo "ERROR: Could not execute $sql. " . mysqli_error($link);
}

CloseCon($link);

//var_dump($contacts_saved_in_db);

// 2---------- send email
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
if($contacts_saved_in_db){
	require 'phpmailer/Exception.php';
	require 'phpmailer/PHPMailer.php';
	require 'phpmailer/SMTP.php';

	$mail = new PHPMailer();

	//bypass the SMTP connect error
	$mail->SMTPOptions = array(
	'ssl' => array(
	'verify_peer' => false,
	'verify_peer_name' => false,
	'allow_self_signed' => true
	)
	);

	$mail->IsSMTP();
	$mail->SMTPKeepAlive = true; // prevent the SMTP session from being closed after each message 
	//$mail->Mailer = "smtp";

	$mail->SMTPDebug  = 0;
	$mail->SMTPAuth   = TRUE;

	//Settings
	$mail->SMTPSecure = "tls";
	$mail->Port       = 587; //ssl: 465 | tls: 587
	$mail->Host       = "smtp.ptempresas.pt"; //if you get errors connecting, use the prefix ssl://
	$mail->Username   = "noreply@deco.pt";
	$mail->Password   = 'BFDaveP$FV(D19'; //use single quotes because of the dollar sign!
	$mail->SetFrom("noreply@deco.pt", "DECO");
	$mail->AddReplyTo("noreply@deco.pt", "DECO"); //reply to
	
	//if it is a dev environment or not:
	$email_dev = 0;

	if($email_dev){
		//destination
		//$mail->AddAddress("enzo@exadorma.com", "Enzo");
		//$mail->AddCC("cc-recipient-email@domain", "cc-recipient-name");
		//multiple recipients:
		$recipients = array(
			"enzo@exadorma.com" => "Enzo",
			//"info@exadorma.com" => "Info",
		);
	} else {
		//destination
		//$mail->AddAddress("enzo@exadorma.com", "Enzo");
		//$mail->AddCC("cc-recipient-email@domain", "cc-recipient-name");
		//multiple recipients:
		$recipients = array(
			"aferreira@deco.pt" => "Ana Ferreira",
			"scorreia@deco.pt" => "Susana Correia",
		);
	}

	// Content
	$mail->CharSet = 'UTF-8';
	$mail->IsHTML(true);
	$mail->Subject = "Campanha Alterações Climáticas: avaliação feita no site";
	$content = "Foi preenchido no site da DECO, o formulário de avaliação das alterações climáticas do Município <strong>" . $municipality . "</strong>, com os seguintes dados:<br><br>".
	"<strong>Nome</strong>:<br>" . $name . "<br><br>" .
	"<strong>Email</strong>:<br>" . $email . "<br><br>" .
	"<strong>Consentimento</strong> (aceitação da política de privacidade):<br>" . $consent . "<br><br>" .
	"<strong>Município</strong>:<br>" . $municipality . "<br><br>" .
	"<strong>Conteúdo</strong>:<br>" . nl2br($contacts_text) . "<br><br>" .
	"<strong>Data e hora</strong>:<br>" . $contacts_date;
	
	//"(<strong>id interno do Município</strong>):<br>" . $id_municipality . "<br><br>" .

	$mail->MsgHTML($content);
	
	//simple email to one recipient only:
	/*
	if(!$mail->Send()) {
		//echo "Mailer Error: " . $mail->ErrorInfo;
		$contacts_return = "error";
		//var_dump($mail);
	} else {
		//email sent successfully
		
		//all done, return
	  	$contacts_return = "success";
	}
	*/
	
	//record if the email was sent to all the recipients:
	$email_sent_all_recipients = array();
	
	// Send a message to each recipient.
	// Headers that are unique for each message should be set within the foreach loop
	foreach ($recipients as $r_email => $r_name) {

		// Generate headers that are unique for each message
		$mail->ClearAllRecipients();
		$mail->AddAddress($r_email, $r_name);

		// Generate the message
		$mail->MsgHTML($content);
		//$mail->AltBody = $text_body;

		// Send the message 
		if($mail->Send()) {
			//echo "Message sent!\n";
			array_push($email_sent_all_recipients, $r_email);
		} else {
			echo "Mailer Error: " . $mail->ErrorInfo . "\n";
			$contacts_return = "error";
			break;
		}
	}

	//if sent to all the recipients:
	if(count($email_sent_all_recipients) === count($recipients)){
		
		//send the thank you email
		//3 ------- thank you email:
		// clear addresses
    	$mail->ClearAllRecipients();
		 //Set who the message is to be sent to
		$mail->AddAddress($email, $name);
		$mail->Subject = 'Alterações Climáticas | Obrigada pelo seu contributo!';
		$content_thanks = "Thank you message";
		//get the thank you email from the HTML that we prepared earlier:
		ob_start();
		echo file_get_contents($lp_location . 'includes/thanks-email/email.html', false, stream_context_create($arrContextOptions));
		$content_thanks = ob_get_clean();
		//$mail->msgHTML(file_get_contents('thanks-email/email.html'), __DIR__);
		$mail->MsgHTML($content_thanks);
		// send email
		$mail->Send();
		
		//all done, return
	  	$contacts_return = "success";
	} else {
		$contacts_return = "error";
	}
	
	// Close the SMTP session
	$mail->SmtpClose();

	//return it:
	echo $contacts_return;
}


//check if you have open_ssl enabled.
//echo !extension_loaded('openssl')?"Not Available":"Available"

?>