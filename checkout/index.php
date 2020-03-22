<?php 
    session_start();
    include_once('assets/control/calculo.php');
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />

    <link href="https://fonts.googleapis.com/css?family=Ubuntu:400,700&display=swap" rel="stylesheet">

    <script src="https://kit.fontawesome.com/37212eb3e5.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="assets/css/bootstrap/bootstrap.css" />
    <link rel="stylesheet" href="assets/css/style.css" />
    <script src="https://assets.pagar.me/checkout/checkout.js"></script>
    <title>JurisTrabalhista</title>

    <script>
    function limpa_formulário_cep() {
      //Limpa valores do formulário de cep.
      document.getElementById('rua').value = ("");
      document.getElementById('bairro').value = ("");
      document.getElementById('cidade').value = ("");
      document.getElementById('estado').value = ("");
    }

    function meu_callback(conteudo) {
      if (!("erro" in conteudo)) {
        //Atualiza os campos com os valores.
        document.getElementById('rua').value = (conteudo.logradouro);
        document.getElementById('bairro').value = (conteudo.bairro);
        document.getElementById('cidade').value = (conteudo.localidade);
        document.getElementById('estado').value = (conteudo.uf);
        
        // Pagseguro
        document.getElementById('rua').value = (conteudo.logradouro);
        document.getElementById('bairro').value = (conteudo.bairro);
        document.getElementById('cidade').value = (conteudo.localidade);
        document.getElementById('estado').value = (conteudo.uf);

      } //end if.
      else {
        //CEP não Encontrado.
        limpa_formulário_cep();
        alert("CEP não encontrado.");
      }
    }

    function pesquisacep(valor) {

      liberarEndereco();
      //Nova variável "cep" somente com dígitos.
      var cep = valor.replace(/\.|\-/g, '');

      

      //Verifica se campo cep possui valor informado.
      if (cep != "") {

        //Expressão regular para validar o CEP.
        var validacep = /^[0-9]{8}$/;

        //Valida o formato do CEP.
        if (validacep.test(cep)) {

          //Preenche os campos com "..." enquanto consulta webservice.
          document.getElementById('rua').value = "...";
          document.getElementById('bairro').value = "...";
          document.getElementById('cidade').value = "...";
          document.getElementById('estado').value = "...";

          //Cria um elemento javascript.
          var script = document.createElement('script');

          //Sincroniza com o callback.
          script.src = 'https://viacep.com.br/ws/' + cep + '/json/?callback=meu_callback';

          //Insere script no documento e carrega o conteúdo.
          document.body.appendChild(script);

        } //end if.
        else {
          //cep é inválido.
          limpa_formulário_cep();
          alert("Formato de CEP inválido.");
        }
      } //end if.
      else {
        //cep sem valor, limpa formulário.
        limpa_formulário_cep();
      }
    };
  </script>
  <script>
    var idPlano = "<?php echo $id ?>";
    var nomePlano = "<?php echo $nome ?>";
    var valorPlano = "<?php echo $valor ?>";
    amount = parseFloat(valorPlano).toFixed(2);
  </script>
</head>

<body>
<div id="target"></div>
  <nav class="navbar navbar-expand-lg navbar-light bg-light mb-5">
    <div class="container">
      <a class="navbar-brand" href="https://juristrabalhista">Juris<b>Trabalhista</b></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSite"><span class="navbar-toggler-icon"></span></button>
      <div class="collapse navbar-collapse" id="navbarSite">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a href="#" class="nav-link ml-5"><img src="https://img.icons8.com/metro/20/000000/1-circle.png"> - Checkout <i class="fas fa-check"></i></a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="container">
    <div class="row">
      <!-- DIV PRINCIPAL - FORMULÁRIOS -->
      <div class="col-md-7 mb-5">
        <div class="tab mb-5">

          <div class="row">
          <!-- NOME -->
            <div class="form-group col-md-12">
              <label for="nome">Nome</label><a tabindex="0" id="help-titular" class="badge badge-info ml-1" data-trigger="focus" data-placement="top" data-toggle="popover" data-content="Seu nome completo" onclick="$('#help-titular').popover('show')" style="color: #fff;">?</a>
              <input type="text" name="nome" id="nome" class="form-control"/>
              <div class="help-block with-errors"></div>
            </div>
            <!-- NOME -->
          </div>

          <div class="row">

            <!-- DATA DE NASCIMENTO -->
            <div class="form-group col-md-6">
              <label for="dataNascimento">Data de Nascimento</label><a tabindex="0" id="help-titular" class="badge badge-info ml-1" data-trigger="focus" data-placement="top" data-toggle="popover" data-content="Sua data de nascimento" onclick="$('#help-titular').popover('show')" style="color: #fff;">?</a>
              <input type="text" name="dataNascimento" id="dataNascimento" class="form-control" data-mask="00/00/0000" inputmode="numeric" data-error="Por favor, informe uma data válida!" data-mask-selectonfocus="true"/>
              <div class="help-block with-errors"></div>
            </div>
            <!-- NOME -->

            <!-- CPF -->
            <div class="form-group col-md-6">
              <label for="cpf-resp">CPF</label><a tabindex="0" id="help-resp" class="badge badge-info ml-1" data-trigger="focus" data-placement="top" data-toggle="popover" data-content="Seu CPF" onclick="$('#help-resp').popover('show')" style="color: #fff;">?</a>
              <input type="text" name="cpf-resp-financeiro" id="cpf-resp-financeiro" class="form-control" data-mask="000.000.000-00" data-minlength="14" inputmode="numeric" data-error="Por favor, informe um CPF válido!" data-mask-selectonfocus="true"/>
              <div class="help-block with-errors"></div>
            </div>
            <!-- CPF -->

          </div>
        </div>

        <!-- TERMOS E CONDIÇÕES -->
        <div class="tab mb-5">
          <div class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" id="customCheck1">
            <label class="custom-control-label" for="customCheck1">* Li e aceito as <a href="#" class="link" data-toggle="modal" data-target="#modalExemplo">Condições de Contratação</a> (incluindo a política de cancelamento e reembolso) Termos e Condições da juristrabalhista.com.</label>
          </div>
        </div>
        <!-- TERMOS E CONDIÇÕES -->

        <!-- CONTATO -->
        <h3>Contato</h3>
        <div class="tab mb-5">
          <div class="row">
            <div class="form-group col-md-6">
              <label for="telefone">Telefone</label>
              <input class="form-control" type="text" inputmode="numeric" name="telefone" id="telefone" maxlength="8" data-mask="00 0 0000-0000"/>
              <small class="form-text text-muted">Ex.: 92 9 1234-5678</small>
            </div>
            <div class="form-group col-md-6">
              <label for="email">E-mail</label>
              <input class="form-control" type="email" name="email" id="email"/>
              <small class="form-text text-muted">seu@email.com</small>
            </div>
          </div>
        </div>
        <!-- CONTATO -->

        <!-- ENDEREÇO -->
        <h3>Endereço</h3>
        <div class="tab mb-5">
          <div class="form-group">
            <label for="cep">CEP</label>
            <input class="form-control" type="text" name="cep" id="cep" data-mask="00.000-000" inputmode="numeric" data-mask-selectonfocus="true" onblur="pesquisacep(this.value);" required/>
              <small class="form-text text-muted">Apenas Números</small>
          </div>
          <div id="cepCollapse" class="collapse">
            <div class="row">
              <div class="form-group col-md-8">
                <label for="rua">Rua</label>
                <input class="form-control" type="text" name="rua" id="rua"/>
              </div>

              <div class="form-group col-md-4">
                <label for="numero">Número</label>
                <input class="form-control" type="text" name="numero" id="numero" autofocus required/>
              </div>
            </div>
            <div class="row">
              <div class="form-group col-md-6">
                <label for="complemento">Complemento</label>
                  <input class="form-control" type="text" name="complemento" id="complemento" value="Sem Complemento"/>
              </div>
              <div class="form-group col-md-6">
                <label for="bairro">Bairro</label>
                <input class="form-control" type="text" name="bairro" id="bairro"/>
              </div>
            </div>
            <div class="row">
              <div class="form-group col-md-4">
                <label for="cidade">Cidade</label>
                <input class="form-control" type="text" name="cidade" id="cidade"/>
              </div>
              <div class="form-group col-md-4">
                <label for="estado">Estado</label>
                <input class="form-control" type="text" name="estado" id="estado" />
              </div>
              <div class="form-group col-md-4">
                <label for="pais">País</label>
                <input class="form-control" type="text" name="pais" id="pais" value="br" readonly/>
              </div>
            </div>
          </div>
        </div>
        <!-- ENDEREÇO -->

        <div class="tab mb-5">
          <div class="form-group">
            <button class="btn btn-success btn-block" id="btnComprar" >Comprar</button>
          </div>
        </div>
        
      </div>

      <!-- DIV LATERAL PARA INFO DO PEDIDO -->
      <div class="col-md-4">
        <div class="list-group">
          <a href="#" class="list-group-item list-group-item-action">Plano: <b><span id="planoSelecionado">Aguardando...</span></b></a>
          <a href="#" class="list-group-item list-group-item-action">Forma de Pagamento: Cartão de Crédito</span></div></a>
          <a href="#" class="list-group-item list-group-item-action list-group-item-light tab">Total: <b><span id="totalPlano">Aguardando...</span></b></a>
        </div>
      </div>
      <!-- DIV LATERAL PARA INFO DO PEDIDO -->

    </div>
  </div>
  
  </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="assets/js/bootstrap/bootstrap.js"></script>
    <script src="assets/js/main.js"></script>
    <script src="https://assets.pagar.me/checkout/checkout.js"></script>


    <script>
      $(document).ready(function() {
      var amount = valorPlano;
        var button = $('#btnComprar');
        var email = document.getElementById('email').value;
        button.click(function() {
          // INICIAR A INSTÂNCIA DO CHECKOUT
          // declarando um callback de sucesso
          var checkout = new PagarMeCheckout.Checkout({"encryption_key":"ek_test_ZdUW1y6OLoejQdWKyoHPIAnlZ4gTLr", success: function(data) {
            console.log(data);
            //Tratar aqui as ações de callback do checkout, como exibição de mensagem ou envio de token para captura da transação
            
            
            var params = {"customerData":"false", "amount":amount, "createToken": "false", "interestRate": 10 };
            checkout.open(params);
          }});

        });
      });
    </script>
    
    <script>
      setInfoPedido();
      function setInfoPedido(){
          amount = valorPlano;
          document.getElementById('planoSelecionado').innerHTML = nomePlano;
          document.getElementById('totalPlano').innerHTML = "R$"+valorPlano.replace(".", ",");
        }
    </script>

    <script src="assets/plugins/mask-field/jquery.mask.min.js"></script>
    <script src="assets/js/validator.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.6/dist/loadingoverlay.min.js"></script>
    <script>

      
      function liberarEndereco(){
        $('#cepCollapse').collapse('show');
      }
    </script>
</body>

</html>