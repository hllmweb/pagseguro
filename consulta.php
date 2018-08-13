<?php
ini_set("Display_errors", "On");
error_reporting(E_ALL);

define("EMAIL_PAGSEGURO", "xpkdbo@gmail.com");
define("TOKEN_PAGSEGURO", "2AE32C1E2D4A437783ABA6D3CBECFE0D");
define("TOKEN_SANDBOX", "20A3F5FD7FB8481CA15B7FDAE5F7A21F");

$referencia = filter_input(INPUT_POST,'referencia',FILTER_SANITIZE_SPECIAL_CHARS);

$url = "https://ws.sandbox.pagseguro.uol.com.br/v2/transactions?email=".EMAIL_PAGSEGURO."&token=".TOKEN_SANDBOX."&reference={$referencia}";

$curl = curl_init($url);
curl_setopt($curl,CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; .NET CLR 1.1.4322)');
curl_setopt($curl, CURLOPT_HEADER, false);
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
echo json_encode($xml);
echo "<br><br>".$xml->transactions->transaction[0]->code;
/*foreach($xml->transactions as $dados_transactions){
    var_dump($dados_transactions);
}*/

?>