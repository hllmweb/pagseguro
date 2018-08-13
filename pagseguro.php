<?php
ini_set("Display_errors", "On");
error_reporting(E_ALL);

define("EMAIL_PAGSEGURO", "xpkdbo@gmail.com");
define("TOKEN_PAGSEGURO", "2AE32C1E2D4A437783ABA6D3CBECFE0D");
define("TOKEN_SANDBOX", "20A3F5FD7FB8481CA15B7FDAE5F7A21F");
 
//acessando api do pagseguro, para sair do modo sandbox, remova a palavra das urls
$url = "https://ws.sandbox.pagseguro.uol.com.br/v2/sessions?email=".EMAIL_PAGSEGURO."&token=".TOKEN_SANDBOX."";
$curl = curl_init($url);
curl_setopt($curl,CURLOPT_HTTPHEADER,array("Content-Type: application/x-www-form-urlencoded; charset=ISO-8859-1"));
curl_setopt($curl,CURLOPT_POST,true);
curl_setopt($curl,CURLOPT_SSL_VERIFYPEER,true);
curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
$retorno = curl_exec($curl);
curl_close($curl);

$xml = simplexml_load_string($retorno);

// echo $xml->id;
echo json_encode($xml);

?>