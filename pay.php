<!DOCTYPE html>
<html dir="ltr" lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="css/estilo.css?versao=<?= time(); ?>">
  <title>Info Pay</title>
</head>
<body>
<form id="formComprar" name="formComprar" method="post" action="pedido.php">
  
<div id="dados_comprador">
  <p>Dados do Comprador</p>
  <label for="nome_comprador">
    <strong>Nome do comprador:</strong>
    <input type="text" name="nome_comprador" id="nome_comprador">
  </label>
  <label for="cpf_comprador">
    <strong>CPF do comprador:</strong>
    <input type="text" name="cpf_comprador" id="cpf_comprador">
  </label>

  <label for="ddd">
    <strong>DDD:</strong>
    <input type="text" name="ddd_comprador" id="ddd_comprador">
  </label>
  <label for="telefone_comprador">
    <strong>Telefone do comprador:</strong>
    <input type="text" name="telefone_comprador" id="telefone_comprador">
  </label>
 </div>
  
  
  <div id="dados_entrega">
  <p>Dados de Entrega</p>
  <label for="cep">
    <strong>CEP:</strong>
    <input type="text" name="cep" id="cep">
  </label>
  <label for="endereco">
    <strong>Endereco:</strong>
    <input type="text" name="endereco" id="endereco">
  </label>
  <label for="numero">
    <strong>Número:</strong>
    <input type="text" name="numero" id="numero">
  </label>
  <label for="complemento">
    <strong>Complemento:</strong>
    <input type="text" name="complemento" id="complemento">
  </label>
  <label for="bairro">
    <strong>Bairro:</strong>
    <input type="text" name="bairro" id="bairro">
  </label>
  <label for="cidade">
    <strong>Cidade:</strong>
    <input type="text" name="cidade" id="cidade">
  <label>
  <label for="uf">
    <strong>UF:</strong>
    <input type="text" name="uf" id="uf">  
  </label>
</div>   


<div id="dados_cartao">
  <p>Dados do Cartão</p>
  <label for="numero_cartao">
    <strong>Número do Cartão:</strong>
    <input type="text" name="numero_cartao" id="numero_cartao">
    <input type="text" name="token_card" id="token_card">
    <input type="text" name="hash_card" id="hash_card">
    <div class="bandeira_cartao"></div>
    <input type="text" name="bandeira_cartao" id="bandeira_cartao">
  </label>  
  <label for="nome_cartao">
     <strong>Nome Impresso no Cartão:</strong> 
     <input type="text" name="nome_cartao" id="nome_cartao">
  </label>
  <label for="mes_validade_cartao">
    <strong>Mês de Validade:</strong>  
    <input type="text" name="mes_validade_cartao" id="mes_validade_cartao" maxlength="2">
  </label>  
  <label for="ano_validade_cartao">
    <strong>Ano de Validade:</strong>  
    <input type="text" name="ano_validade_cartao" id="ano_validade_cartao" maxlength="4">
  </label
  <label for="cvv">
    <strong>CVV:</strong>
    <input type="text" name="cvv" id="cvv" maxlength="3">
  </label>
  <label for="qtd_parcelas">
    <strong>Qtd. de Parcelas</strong>
    <select name="qtd_parcelas" id="qtd_parcelas">
      <option value="">Selecione</option>
    </select>
    <input type="text" id="valor_parcela" name="valor_parcela">
  </label>
  <label for="cpf_cartao">
    <strong>CPF do Dono do Cartão:</strong>
    <input type="text" name="cpf_cartao" id="cpf_cartao">
  </label> 
</div>

<button type="submit" id="btn_comprar" name="btn_comprar">Comprar</button>  

</form>
    
    
<div class="bloco">
 <hr>  
 <h2>Consultas</h2>
  <form id="formConsulta" name="formConsulta" method="POST" action="consulta.php">
    <input type="text" name="referencia" id="referencia">
    <button type="submit">Consultar</button>  
  </form>
  <hr>
</div>      
    
<div class="cartao_credito"><div class="titulo">Cartão de Crédito</div></div>    
<div class="boleto"><div class="titulo">Boleto</div></div>    
<div class="debito"><div class="titulo">Débito Online</div></div>    
    

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script type="text/javascript" src="https://stc.sandbox.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.directpayment.js"></script>
  <script src="https://hugomesquita.com.br/pagseguro/lib/app.js?versao=<?= time(); ?>"></script>    
</body>
</html>