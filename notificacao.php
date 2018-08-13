<?php
ini_set("Display_errors", "On");
error_reporting(E_ALL);

define("EMAIL_PAGSEGURO", "xpkdbo@gmail.com");
define("TOKEN_PAGSEGURO", "2AE32C1E2D4A437783ABA6D3CBECFE0D");
define("TOKEN_SANDBOX", "20A3F5FD7FB8481CA15B7FDAE5F7A21F");

$url = "https://ws.sandbox.pagseguro.uol.com.br/v3/transactions/notifications/{$_POST['notificationCode']}?email=".EMAIL_PAGSEGURO."&token=".TOKEN_SANDBOX."";
$curl = curl_init($url);
curl_setopt($curl,CURLOPT_SSL_VERIFYPEER,true);
curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
$retorno = curl_exec($curl);
curl_close($curl);
echo $retorno;

$xml = simplexml_load_string($retorno);
// print_r($xml);
echo "<pre>";
print_r($xml);
echo "</pre>";
echo $xml->status;
//echo json_encode($xml);

$con  = new PDO("mysql:host=localhost;dbname=hugomesquita_testeps", "hugomesquita_user2", "asdf123");
$crud =  $con->prepare("UPDATE pedido SET status=? WHERE reference=?");
$crud->bindValue(1,$xml->status);
$crud->bindValue(2,$xml->reference);
$crud->execute();
?>