<?php
// validate-recaptcha

//prevent opening directly, only allow POST:
if($_SERVER['REQUEST_METHOD'] == 'GET'){
    exit();
}

//get the query strings:
$recaptcha = strip_tags(trim($_REQUEST['recaptcha']));

//define the status for this action:
$status	= 'fail';

//reCAPTCHA:
if($recaptcha === ""){
	echo $status;
	//echo "empty recaptcha";
	return false;
}

$secret = "6LevCcseAAAAAI3RMLkIEQTQ2iyYihrUvZBJVOfC";
//$verifyCaptcha = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret={$secret}&response={$recaptcha}");
//$captcha_success = json_decode($verifyCaptcha);

$ch = curl_init();

curl_setopt_array($ch, [
	CURLOPT_URL => 'https://www.google.com/recaptcha/api/siteverify',
	CURLOPT_POST => true,
	CURLOPT_POSTFIELDS => [
		'secret' => $secret,
		'response' => $recaptcha,
		'remoteip' => $_SERVER['REMOTE_ADDR']
	],
	CURLOPT_RETURNTRANSFER => true
]);

$output = curl_exec($ch);
curl_close($ch);

$captcha_success = json_decode($output);

if($captcha_success->success == false) {
	echo $status;
	//echo "recaptcha no success";
	return false;
}
else if ($captcha_success->success == true) {
	$status = "success";
}

echo $status;
?>
