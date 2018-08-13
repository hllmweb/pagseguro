<?php
ini_set("Display_errors", "On");
error_reporting(E_ALL);

define("EMAIL_PAGSEGURO", "xpkdbo@gmail.com");
define("TOKEN_PAGSEGURO", "2AE32C1E2D4A437783ABA6D3CBECFE0D");
define("TOKEN_SANDBOX", "20A3F5FD7FB8481CA15B7FDAE5F7A21F");

$token_card = $_POST["token_card"];
$hash_card = $_POST["hash_card"];
$qtd_parcelas = filter_input(INPUT_POST,'qtd_parcelas',FILTER_SANITIZE_SPECIAL_CHARS);
$valor_parcela = filter_input(INPUT_POST,'valor_parcela',FILTER_SANITIZE_SPECIAL_CHARS);
$cpf_cartao = filter_input(INPUT_POST,'cpf_cartao',FILTER_SANITIZE_SPECIAL_CHARS);

$nome_comprador = filter_input(INPUT_POST,'nome_comprador',FILTER_SANITIZE_SPECIAL_CHARS);
$cpf_comprador = filter_input(INPUT_POST,'cpf_comprador',FILTER_SANITIZE_SPECIAL_CHARS);
$ddd_comprador = filter_input(INPUT_POST,'ddd_comprador',FILTER_SANITIZE_SPECIAL_CHARS);
$telefone_comprador = filter_input(INPUT_POST,'telefone_comprador',FILTER_SANITIZE_SPECIAL_CHARS);

$nome_cartao = filter_input(INPUT_POST,'nome_cartao',FILTER_SANITIZE_SPECIAL_CHARS);


$endereco = filter_input(INPUT_POST,'endereco',FILTER_SANITIZE_SPECIAL_CHARS);
$numero = filter_input(INPUT_POST,'numero',FILTER_SANITIZE_SPECIAL_CHARS);
$complemento = filter_input(INPUT_POST,'complemento',FILTER_SANITIZE_SPECIAL_CHARS);
$bairro = filter_input(INPUT_POST,'bairro',FILTER_SANITIZE_SPECIAL_CHARS);
$cidade = filter_input(INPUT_POST,'cidade',FILTER_SANITIZE_SPECIAL_CHARS);
$uf = filter_input(INPUT_POST,'uf',FILTER_SANITIZE_SPECIAL_CHARS);
$cep = filter_input(INPUT_POST,'cep',FILTER_SANITIZE_SPECIAL_CHARS);

$data["email"] = EMAIL_PAGSEGURO;
$data["token"] = TOKEN_SANDBOX;

$data["paymentMode"] = "default";
$data["paymentMethod"] = "creditCard";
$data["receiverEmail"] = EMAIL_PAGSEGURO;
$data["currency"] = "BRL";

$data["itemId1"] = "1";
$data["itemDescription1"] = "Website desenvolvido por Hugo Mesquita";
$data["itemAmount1"] = "500.00";
$data["itemQuantity1"] = "1";

$data["notificationURL"] = "https://hugomesquita.com.br/pagseguro/notificacao.php";

//dados da pessoa que esta fazendo o pedido de compra
$data["reference"] = "834783478347";
$data["senderName"] = $nome_comprador;
$data["senderCPF"] = $cpf_comprador;
$data["senderAreaCode"] = $ddd_comprador;
$data["senderPhone"] = $telefone_comprador;
$data["senderEmail"] = "c18580940988061975671@sandbox.pagseguro.com.br";
$data["senderHash"] = $hash_card;


$data["shippingAddressStreet"] = $endereco;
$data["shippingAddressNumber"] = $numero;
$data["shippingAddressComplement"] = $complemento;
$data["shippingAddressDistrict"] = $bairro;
$data["shippingAddressPostalCode"] = $cep;
$data["shippingAddressCity"] = $cidade;
$data["shippingAddressState"] = $uf;
$data["shippingAddressCountry"] = "BRA";

$data["shippingType"] = "1";
$data["shippingCost"] = "0.00";

$data["creditCardToken"] = $token_card;
$data["installmentQuantity"] = $qtd_parcelas;
$data["installmentValue"] = $valor_parcela;
$data["noInterestInstallmentQuantity"] = 2;


//dados da pessoa que estar pagando com o cartao
$data["creditCardHolderName"] = $nome_cartao;
$data["creditCardHolderCPF"] = $cpf_cartao;
$data["creditCardHolderBirthDate"] = "27/10/1987";
$data["creditCardHolderAreaCode"] = $ddd_comprador;
$data["creditCardHolderPhone"] = $telefone_comprador;

$data["billingAddressStreet"] = $endereco;
$data["billingAddressNumber"] = $numero;
$data["billingAddressComplement"] = $complemento;
$data["billingAddressDistrict"] = $bairro;
$data["billingAddressPostalCode"] = $cep;
$data["billingAddressCity"] = $cidade;
$data["billingAddressState"] = $uf;
$data["billingAddressCountry"] = "BRA";



$build_query = http_build_query($data);
$url = "https://ws.sandbox.pagseguro.uol.com.br/v2/transactions";
$curl = curl_init($url);
curl_setopt($curl,CURLOPT_HTTPHEADER,array("Content-Type: application/x-www-form-urlencoded; charset=ISO-8859-1"));
curl_setopt($curl,CURLOPT_POST,true);
curl_setopt($curl,CURLOPT_SSL_VERIFYPEER,true);
curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
curl_setopt($curl,CURLOPT_POSTFIELDS,$build_query);
$retorno = curl_exec($curl);
curl_close($curl);
echo $retorno;

$xml = simplexml_load_string($retorno);
// print_r($xml);
echo "<pre>";
print_r($xml);
echo "</pre>";
//echo json_encode($xml);

/*$con  = new PDO("mysql:host=localhost;dbname=hugomesquita_testeps", "hugomesquita_testeps", "asdf123");
$crud =  $con->prepare("INSERT INTO pedido (reference, status) VALUES ");*/
?>