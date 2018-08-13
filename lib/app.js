var root = "https://"+document.location.hostname+"/";
var amount = 500.00;
//iniciando a secao de pagamento
function iniciarSessao(){
  $.ajax({
    url: root+"pagseguro/pagseguro.php",
    dataType: "json",
    success: function(data){
        console.log(data.id);
        PagSeguroDirectPayment.setSessionId(data.id);
    },
    complete: function(){
      listaMeiosPagamento();
    }
    
  });
}

//lista as bandeiras de pagamentos disponíveis no pagseguro
function listaMeiosPagamento(){
  PagSeguroDirectPayment.getPaymentMethods({
    amount: 500.00,
    success: function(data) {
      //meios de pagamento disponíveis
      //console.log(data);
      $.each(data.paymentMethods.CREDIT_CARD.options,function(i, obj){
        $(".cartao_credito").append("<div><img src=https://stc.pagseguro.uol.com.br/"+obj.images.SMALL.path+">"+obj.name+"</div>");
      }); 
      
      $(".boleto").append("<div><img src=https://stc.pagseguro.uol.com.br/"+data.paymentMethods.BOLETO.options.BOLETO.images.SMALL.path+">"+data.paymentMethods.BOLETO.name+"</div>");
     
      $.each(data.paymentMethods.ONLINE_DEBIT.options,function(i, obj){
        $(".debito").append("<div><img src=https://stc.pagseguro.uol.com.br/"+obj.images.SMALL.path+">"+obj.name+"</div>");
      }); 
      
    }
    /*,complete: function(data) {
      getTokenCard();
    }*/
  });  
  
}


  
//ao digitar número do cartão carrega a bandeira do cartao
$("#numero_cartao").on("keyup",function(){
  var numero_cartao = $(this).val();
  var qtd_caracteres = numero_cartao.length;
  console.log(qtd_caracteres);
  if(qtd_caracteres == 6){
    PagSeguroDirectPayment.getBrand({
        cardBin: numero_cartao, //envia o numero do cartao para o pagseguro
          success: function(response_brand) {
            //bandeira encontrada
            //console.log(response_brand.brand.name);
            var bandeira_img = response_brand.brand.name;
            $("#bandeira_cartao").val(bandeira_img);
            $(".bandeira_cartao").html("<img src='https://stc.pagseguro.uol.com.br/public/img/payment-methods-flags/42x20/"+bandeira_img+".png'>");
            getParcelas(bandeira_img);
          },
          error: function(response_brand){
              alert("Cartão não reconhecido!");
              $(".bandeira_cartao").empty();
          }
    }); 
  }

  
});

//exibe a quantidade e valores das parcelas
function getParcelas(bandeira){
  PagSeguroDirectPayment.getInstallments({	
    amount: 500.00,
    brand: bandeira,
    maxInstallmentNoInterest: 2,
    success: function(response) {
       //opções de parcelamento disponível
      //console.log(response);
      $.each(response.installments,function(i, obj){
        $.each(obj,function(i2, obj2){
          var valor_ponto   = obj2.installmentAmount;
          var valor_format  = "R$ "+valor_ponto.toFixed(2).replace(".",","); 
          var valor_parcela  = valor_ponto.toFixed(2); 
          //console.log(obj2.quantity);
          //aplicar um efeito para quando preencher o número do cartão, automaticamente aparecer as parcelas
          $("#qtd_parcelas").append("<option value='"+obj2.quantity+"' label='"+valor_parcela+"'>"+obj2.quantity+" parcelas de "+valor_format+"</option>");
        });          
      });
    }
  });  
}


//pegar o valor da parcela
$("#qtd_parcelas").on("change",function(){
  var valor_selecionado = document.getElementById("qtd_parcelas");
  $("#valor_parcela").val(valor_selecionado.options[valor_selecionado.selectedIndex].label);
});

//chamar a funcao de token
$("#cvv").on("blur",function(){
  getTokenCard();
});

//obter o token do cartao de credito
function getTokenCard(){
  PagSeguroDirectPayment.createCardToken({
    cardNumber: $("#numero_cartao").val(),
    brand: $("#bandeira_cartao").val(),
    cvv: $("#cvv").val(),
    expirationMonth: $("#mes_validade_cartao").val(),
    expirationYear: $("#ano_validade_cartao").val(),
    success: function(response){
      //console.log(response);
      $("#token_card").val(response.card.token);
    }
  });  
}


//identificando e enviando dados do comprador
$("#formComprar").on("submit", function(){
  //e.preventDefault();
  PagSeguroDirectPayment.onSenderHashReady(function(response){
        //console.log(response);
      $("#hash_card").val(response.senderHash);
  });
  
});

iniciarSessao();