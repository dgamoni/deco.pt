<?php
error_reporting(E_ALL);


add_filter( 'https_ssl_verify', '__return_false' );

$args = '{"nomeCompleto":"test","nif":"324234","associado":"true","numeroAssociado":"","emailContacto":"am@digitalclap.com","telefone":"","telemovel":"","morada":"","codigoPostal":"","localidade":"","concelhoResidencia":"Aguiar da Beira","descricao":"","anexos":["wpcf7-files\/test_CF7_hook-11-4.docx"]}';
$hook_url = 'http://gacdeco.northeurope.cloudapp.azure.com:81/api/Contacts';
$result = wp_remote_post( $hook_url, $args );

var_dump('wp_remote_post');
echo "<pre>", var_dump($result), "</pre>";


$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://gacdeco.northeurope.cloudapp.azure.com:81/api/Contacts',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'{"nomeCompleto":"test","nif":"324234","associado":"true","numeroAssociado":"","emailContacto":"am@digitalclap.com","telefone":"","telemovel":"","morada":"","codigoPostal":"","localidade":"","concelhoResidencia":"Aguiar da Beira","descricao":"","anexos":["wpcf7-files\\/test_CF7_hook-11-4.docx"]}',
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/json; charset=UTF-8'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
//var_dump($response);

var_dump('curl');
echo "<pre>", var_dump($response), "</pre>";

$mailResult = false;
$mailResult = wp_mail( 'dgamoni@gmail.com', 'test if mail works', 'hurray' );
var_dump($mailResult);