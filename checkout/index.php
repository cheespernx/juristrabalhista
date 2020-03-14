<?php 
    session_start();
    include_once('assets/control/pagseguro.php');
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

    <script>
    function limpa_formulário_cep() {
      //Limpa valores do formulário de cep.
      document.getElementById('shippingAddressStreet').value = ("");
      document.getElementById('shippingAddressDistrict').value = ("");
      document.getElementById('shippingAddressCity').value = ("");
      document.getElementById('shippingAddressState').value = ("");
    }

    function meu_callback(conteudo) {
      if (!("erro" in conteudo)) {
        //Atualiza os campos com os valores.
        document.getElementById('shippingAddressStreet').value = (conteudo.logradouro);
        document.getElementById('shippingAddressDistrict').value = (conteudo.bairro);
        document.getElementById('shippingAddressCity').value = (conteudo.localidade);
        document.getElementById('shippingAddressState').value = (conteudo.uf);
        
        // Pagseguro
        document.getElementById('billingAddressStreet').value = (conteudo.logradouro);
        document.getElementById('billingAddressDistrict').value = (conteudo.bairro);
        document.getElementById('billingAddressCity').value = (conteudo.localidade);
        document.getElementById('billingAddressState').value = (conteudo.uf);
        getBillingStreetAddress(conteudo.logradouro);
        getBillingDistrictAddress(conteudo.bairro);
        getBillingCityAddress(conteudo.localidade);
        getBillingStateAddress(conteudo.uf);

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
          document.getElementById('shippingAddressStreet').value = "...";
          document.getElementById('shippingAddressDistrict').value = "...";
          document.getElementById('shippingAddressCity').value = "...";
          document.getElementById('shippingAddressState').value = "...";
          getBillingPostalCodeAddress(cep);

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
    var operadora = "<?php echo $operadora ?>";
    var valorPlano = "<?php echo $valor ?>";
    var valorPromocional = "<?php echo $valorPromocional ?>";
    var codigoPlano = "<?php echo $codigoPlano ?>";
    var categoria = "<?php echo $categoria ?>";
    var inclusaoDependentes = "<?php echo $inclusaoDependentes ?>";
    var tipoPlano = "<?php echo $tipo ?>";
    var modalidadePlano = "<?php echo $modalidade ?>";    
    
  </script>
    
    <title>Checkout Top Prime</title>
</head>

<body>
<div id="target"></div>
  <nav class="navbar navbar-expand-lg navbar-light bg-light mb-5">
    <div class="container">
      <a class="navbar-brand" href="https://topprimesegurosesaude.com.br"><img src="assets/img/logo-padrão@1x-09.png" width="150px" alt="Top Prime Seguros"></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSite"><span class="navbar-toggler-icon"></span></button>
      <div class="collapse navbar-collapse" id="navbarSite">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a href="#" class="nav-link ml-5"><img src="https://img.icons8.com/metro/20/000000/1-circle.png"> - Dados dos Beneficiarios <i class="fas fa-check"></i></a>
          </li>
          <li class="nav-item">
            <a href="#" id="dadosDep" class="nav-link ml-5" disabled><img src="https://img.icons8.com/metro/20/000000/2-circle.png"> - Dados dos Dependentes</a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link ml-5" aria-disabled="true"><img src="https://img.icons8.com/metro/20/000000/3-circle.png"> - Resumo</a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link ml-5"><img src="https://img.icons8.com/metro/20/000000/4-circle.png"> - Checkout</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="container">
    <div class="row">
      <!-- DIV PRINCIPAL - FORMULÁRIOS -->
      <div class="col-md-7 mb-5">
        <form action="" class="mb-5" id="formPagamento" name="formPagamento" method="POST">
            <div class="tab mb-5">
              <div class="row">

                <!-- ERRO -->
                <div class="alert alert-danger col-md-12" role="alert" id="erroCPFTitular" style="display: none">
                  CPF Inválido, verifique e tente novamente!
                </div>
                <!-- ERRO -->

                <!-- TITULAR -->
                <div class="form-group col-md-6">
                  <label for="cpf">CPF do Titular</label><a tabindex="0" id="help-titular" class="badge badge-info ml-1" data-trigger="focus" data-placement="top" data-toggle="popover" data-content="Será a o principal beneficiário do plano." onclick="$('#help-titular').popover('show')" style="color: #fff;">?</a>
                  <input type="text" name="cpf-titular" id="cpf-titular" class="form-control" onblur="buscaCPFTitular(this.value);" data-mask="000.000.000-00" data-minlength="14" inputmode="numeric" data-error="Por favor, informe um CPF válido!" data-mask-selectonfocus="true"/>
                  <small id="nomeTitular" class="form-text text-muted">Aguardando...</small>
                  <div class="help-block with-errors"></div>
                </div>
                <!-- TITULAR -->

                <!-- RESPONSÁVEL FINANCEIRO -->
                <div class="form-group col-md-6">
                  <label for="cpf-resp">CPF do Responsável financeiro</label><a tabindex="0" id="help-resp" class="badge badge-info ml-1" data-trigger="focus" data-placement="top" data-toggle="popover" data-content="Será a Pessoa responsável pelos pagamentos do plano." onclick="$('#help-resp').popover('show')" style="color: #fff;">?</a>
                  <input type="text" name="cpf-resp-financeiro" id="cpf-resp-financeiro" class="form-control" onblur="buscaCPFResp(this.value);" data-mask="000.000.000-00" data-minlength="14" inputmode="numeric" data-error="Por favor, informe um CPF válido!" data-mask-selectonfocus="true"/>
                  <small id="nomeResponsavel" class="form-text text-muted">Aguardando...</small>
                  <div class="help-block with-errors"></div>
                </div>
                <!-- RESPONSÁVEL FINANCEIRO -->

              </div>
            </div>

            <!-- ADIÇÃO DE DEPENDENTES -->

            <div class="tab mb-5" id="askDep">
              <div class="text-center mb-3">
                <h3 class="bd-title">Deseja adicionar Dependentes?</h3>
              </div>
              <div class="row">
                <div class="form-group col-md-12">
                  <a class="btn btn-primary btn-block" style="color: #fff;" id="btnAddDep" data-toggle="collapse" href="#addDep" role="button" aria-expanded="false" aria-controls="addDep">Adicionar Dependentes</a>
                </div>
              </div>
            </div>

            <div class="collapse tab mb-5" id="addDep">
              <h3 class="bd-title">Adicione até dois dependentes*</h3>
              <div class="row">
                <div class="alert alert-danger col-md-12" role="alert" id="erroCPFDep" style="display: none">
                  CPF Inválido, verifique e tente novamente!
                </div>
                <div class="form-group col-md-6">
                  <label for="cpf-dep1">CPF do Dependente 1</label>
                  <input type="text" name="cpf-dep1" id="cpf-dep1" class="form-control" onblur="buscaCPFDep1(this.value);" data-mask="000.000.000-00" data-minlength="14" inputmode="numeric" data-error="Por favor, informe um CPF válido!" data-mask-selectonfocus="true"/>
                  <small id="nomeDep1" class="form-text text-muted">Aguardando...</small>
                  <div class="help-block with-errors"></div>
                </div>
                <div class="form-group col-md-6">
                  <label for="cpf-dep2">CPF do Dependente 2</label>
                  <input type="text" name="cpf-dep2" id="cpf-dep2" class="form-control" onblur="buscaCPFDep2(this.value);" data-mask="000.000.000-00" data-minlength="14" inputmode="numeric" data-error="Por favor, informe um CPF válido!" data-mask-selectonfocus="true"/>
                  <small id="nomeDep2" class="form-text text-muted">Aguardando...</small>
                  <div class="help-block with-errors"></div>
                </div>
              </div>
              <small class="form-text text-muted">* Você poderá adicionar mais dependentes posteriormente através da central de atendimentos</small>
            </div>

            <!-- ADIÇÃO DE DEPENDENTES -->

            <!-- CAMPOS INVISIVEIS PARA CAPTURA DOS DADOS **START** -->
            <input type="text" name="nome-titular" id="nome-titular" hidden />
            <input type="text" name="nasc-titular" id="nasc-titular" hidden />
            <input type="text" name="mae-titular" id="mae-titular" hidden />
            <input type="text" name="sexo-titular" id="sexo-titular" hidden />
            <!--===*===*===*===*===*===*===*===*===*===*===*===*===*===*===-->
            <input type="text" name="nome-resp-financeiro" id="nome-resp-financeiro" hidden />
            <input type="text" name="nasc-resp-financeiro" id="nasc-resp-financeiro" hidden />
            <input type="text" name="mae-resp-financeiro" id="mae-resp-financeiro" hidden />
            <input type="text" name="sexo-resp-financeiro" id="sexo-resp-financeiro" hidden />
            <!--===*===*===*===*===*===*===*===*===*===*===*===*===*===*===-->
            <input type="text" name="page-id" id="page-id" value="stage2" hidden />
            <!--===*===*===*===*===*===*===*===*===*===*===*===*===*===*===-->
            <input type="text" name="produto" id="produto" value="Plano Odontológico" hidden />
            <!--===*===*===*===*===*===*===*===*===*===*===*===*===*===*===-->
            <input type="text" name="plano" id="plano" value="test" hidden />
            <!--===*===*===*===*===*===*===*===*===*===*===*===*===*===*===-->
            <input type="text" name="qtd-vidas" id="qtd-vidas" value="0" hidden />
            <!--===*===*===*===*===*===*===*===*===*===*===*===*===*===*===-->
            <input type="text" name="dep" id="dep" value="0" hidden />
            <!--===*===*===*===*===*===*===*===*===*===*===*===*===*===*===-->
            <input type="text" name="nome-dep1" id="nome-dep1" hidden />
            <input type="text" name="nasc-dep1" id="nasc-dep1" hidden />
            <input type="text" name="mae-dep1" id="mae-dep1" hidden />
            <input type="text" name="sexo-dep1" id="sexo-dep1" hidden />
            <!--===*===*===*===*===*===*===*===*===*===*===*===*===*===*===-->
            <input type="text" name="nome-dep2" id="nome-dep2" hidden />
            <input type="text" name="nasc-dep2" id="nasc-dep2" hidden />
            <input type="text" name="mae-dep2" id="mae-dep2" hidden />
            <input type="text" name="sexo-dep2" id="sexo-dep2" hidden />
            <!-- CAMPOS INVISIVEIS PARA CAPTURA DOS DADOS **END** -->

            <!-- TERMOS E CONDIÇÕES -->
            <div class="tab mb-5">
              <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="customCheck1">
                <label class="custom-control-label" for="customCheck1">* Li e aceito as <a href="#" class="link" data-toggle="modal" data-target="#modalExemplo">Condições de Contratação</a> (incluindo a política de cancelamento e reembolso) Termos e Condições da topprimesegurosesaude.com.br.</label>
              </div>
            </div>
            <!-- TERMOS E CONDIÇÕES -->

            <!-- CONTATO -->
            <h3>Contato</h3>
            <div class="tab mb-5">
              <div class="row">
                <div class="form-group col-md-4">
                  <label for="senderAreaCode">DDD</label>
                  <input class="form-control" type="text" inputmode="numeric" name="senderAreaCode" id="senderAreaCode" maxlength="2" data-mask="##" onblur="getCardHolderAreaCode(this.value);"/>
                  <small class="form-text text-muted">2 digitos</small>
                </div>
                <div class="form-group col-md-8">
                  <label for="senderPhone">Telefone</label>
                  <input class="form-control" type="text" inputmode="numeric" name="senderPhone" id="senderPhone" maxlength="8" data-mask="#########" onblur="getCardHolderPhone(this.value);"/>
                  <small class="form-text text-muted">Ex.: 9 1234-5678</small>
                </div>
              </div>
              <div class="form-group">
                <label for="senderEmail">E-mail</label>
                <input class="form-control" type="email" name="senderEmail" id="senderEmail"/>
                <small class="form-text text-muted">seu@email.com</small>
              </div>
            </div>
            <!-- CONTATO -->

            <!-- ENDEREÇO -->
            <h3>Endereço</h3>
            <div class="tab mb-5">
              <div class="form-group">
                <label for="shippingAddressPostalCode">CEP</label>
                <input class="form-control" type="text" name="shippingAddressPostalCode" id="shippingAddressPostalCode" data-mask="00.000-000" inputmode="numeric" data-mask-selectonfocus="true" onblur="pesquisacep(this.value);" required/>
                  <small class="form-text text-muted">Apenas Números</small>
              </div>
              <div id="cepCollapse" class="collapse">
                <div class="row">
                  <div class="form-group col-md-8">
                    <label for="shippingAddressStreet">Rua</label>
                    <input class="form-control" type="text" name="shippingAddressStreet" id="shippingAddressStreet" onchange="getBillingStreetAddress(this.value);"/>
                  </div>

                  <div class="form-group col-md-4">
                    <label for="shippingAddressNumber">Número</label>
                    <input class="form-control" type="text" name="shippingAddressNumber" id="shippingAddressNumber" onchange="getBillingNumberAddress(this.value);" autofocus required/>
                  </div>
                </div>
                <div class="row">
                  <div class="form-group col-md-6">
                    <label for="shippingAddressComplement">Complemento</label>
                      <input class="form-control" type="text" name="shippingAddressComplement" id="shippingAddressComplement" value="Sem Complemento" onchange="getBillingComplementAddress(this.value);"/>
                  </div>
                  <div class="form-group col-md-6">
                    <label for="shippingAddressDistrict">Bairro</label>
                    <input class="form-control" type="text" name="shippingAddressDistrict" id="shippingAddressDistrict" onchange="getBillingDistrictAddress(this.value);"/>
                  </div>
                </div>
                <div class="row">
                  <div class="form-group col-md-4">
                    <label for="shippingAddressCity">Cidade</label>
                    <input class="form-control" type="text" name="shippingAddressCity" id="shippingAddressCity" onchange="getBillingCityAddress(this.value);"/>
                  </div>
                  <div class="form-group col-md-4">
                    <label for="shippingAddressState">Estado</label>
                    <input class="form-control" type="text" name="shippingAddressState" id="shippingAddressState" onchange="getBillingStateAddress(this.value);"/>
                  </div>
                  <div class="form-group col-md-4">
                    <label for="shippingAddressCountry">País</label>
                    <input class="form-control" type="text" name="shippingAddressCountry" id="shippingAddressCountry" value="BRA" readonly/>
                  </div>
                </div>
              </div>
            </div>
            <!-- ENDEREÇO -->

            <!-- MÉTODOS DE PAGAMENTO -->
            <h3>Pagamento</h3>
            <div class="tab mb-5">
              <label for="numCartao">Meios de Pagamento Disponíveis</label>
              <!--<div class="meio-pag mb-5"></div>-->
              <div class="form-group">
                <div class="custom-control custom-radio custom-control-inline">
                  <input type="radio" id="paymentMethodcc" value="creditCard" name="paymentMethod" class="custom-control-input">
                  <label class="custom-control-label" for="paymentMethodcc">Cartão de Crédito</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                  <input type="radio" id="paymentMethodbo" value="boleto" name="paymentMethod" class="custom-control-input">
                  <label class="custom-control-label" for="paymentMethodbo">Boleto</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                  <input type="radio" id="paymentMethoddb" value="eft" name="paymentMethod" class="custom-control-input">
                  <label class="custom-control-label" for="paymentMethoddb">Débito Online</label>
                </div>
              </div>
            </div>
            <!-- MÉTODOS DE PAGAMENTO -->

            <!-- CARTÃO DE CRÉDITO -->
            <div class="tab mb-5 cartao-credito" id="cc">
              <div class="row">
                <div class="form-group col-md-12">

                  <label for="numCartao">Número do Cartão</label>
                  <div class="input-group">
                    <input type="text" name="numCartao" id="numCartao" class="form-control" data-error="Cartão Inválidp" />
                    <div class="input-group-append">
                      <span id="bandeira-cartao-2" class="input-group-text creditCard"></span>
                    </div>
                  </div>
                  <small id="bandeiraCartao" class="form-text text-muted bandeiraCartao">Aguardando...</small>
                  <div class="alert alert-danger hidden" id="msg" role="alert">
                      Cartão Inválido!
                  </div>

                </div>
              </div>

              <div class="row">
                <div class="col-md-6 form-group">
                  <label for="cvvCartao">CVV do Cartão</label>
                  <input class="form-control" type="text" name="cvvCartao" id="cvvCartao" maxlength="3"/>
                </div>
                <div class="col-md-3 form-group">
                  <label for="mesValidade">Mês de validade</label>
                  <input class="form-control" type="text" name="mesValidade" id="mesValidade" maxlength="2"/>
                  <small id="bandeiraCartao" class="form-text text-muted bandeiraCartao">2 digitos, Ex.: 09</small>
                </div>
                <div class="col-md-3 form-group">
                  <label for="anoValidade">Ano de validade</label>
                  <input class="form-control" type="text" name="anoValidade" id="anoValidade" maxlength="4"/>
                  <small id="bandeiraCartao" class="form-text text-muted bandeiraCartao">4 digitos, Ex.: 2022</small>
                </div>
              </div>                 
              <div class="row">
                <div class="form-group col-md-12 mb-5">
                  <label for="qtdParcelas">Parcelamento</label>
                    <select name="qtdParcelas" class="form-control" id="qtdParcelas">
                      <option value="">Selecione</option>
                    </select>
                </div>
              </div>
              <div class="row">
                <div class="alert alert-danger col-md-12" role="alert" id="erroCPFDonoCartao" style="display: none">
                  CPF Inválido, verifique e tente novamente!
                </div>
                <div class="form-group col-md-6">
                  <label for="creditCardHolderCPF1">CPF do Dono do Cartão</label>
                  <input type="text" class="form-control" onblur="buscaCPFDonoCartao(this.value);" name="creditCardHolderCPF1" id="creditCardHolderCPF1"
                  data-mask="000.000.000-00" data-minlength="14" inputmode="numeric" data-error="Por favor, informe um CPF válido!" data-mask-selectonfocus="true">
                </div>
                <div class="form-group col-md-6">
                  <label for="creditCardHolderName">Nome do Dono do Cartão</label>
                  <input type="text" class="form-control" name="creditCardHolderName" id="creditCardHolderName" value="Aguardando..." readonly>
                </div>
              </div>
                
              <div hidden>
                <!-- CAMPOS ESCONDIDOS PAGSEGURO -->
                <input type="text" name="valorParcela" class="form-control" id="valorParcela"/>
                <input type="text" name="tokenCartao" class="form-control" id="tokenCartao"/>
                <input type="text" name="hashCartao" class="form-control" id="hashCartao"/>
                
                <input type="text" name="currency" class="form-control" id="currency" value="<?php echo MOEDA_PAGAMENTO; ?>"/>
                <!--<input type="text" name="extraAmount" class="form-control" id="extraAmount" value="0.00"/>-->
                <input type="text" name="noIntInstallQuantity" class="form-control" id="noIntInstalQuantity" value="2"/>
                <input type="text" name="itemId1" class="form-control" id="itemId1" value=""/>
                <input type="text" name="itemDescription1" class="form-control" id="itemDescription1" value=""/>
                <input type="text" name="itemAmount1" id="itemAmount1" class="form-control" value="600.00"/>
                <input type="text" name="amount" id="amount" class="form-control" value="600.00"/>
                <input type="text" name="itemQuantity1" id="itemQuantity1" class="form-control" value=""/>
                <input type="text" name="notificationURL" id="notificationURL" class="form-control" value="<?php echo URL_NOTIFICACAO; ?>"/>
                <input type="text" name="reference" id="reference" class="form-control" value=""/>
                <input type="text" name="senderName" id="senderName" class="form-control" hidden/>
                <input type="text" name="senderCPF" id="senderCPF" hidden/>

                <input type="text" name="creditCardHolderCPF" id="creditCardHolderCPF">
                <input type="text" name="creditCardHolderBirthDate" id="creditCardHolderBirthDate">
                <input type="text" name="creditCardHolderAreaCode" id="creditCardHolderAreaCode">
                <input type="text" name="creditCardHolderPhone" id="creditCardHolderPhone">

                <input type="text" name="billingAddressStreet" id="billingAddressStreet">
                <input type="text" name="billingAddressNumber" id="billingAddressNumber">
                <input type="text" name="billingAddressComplement" id="billingAddressComplement" value="Sem Complemento">
                <input type="text" name="billingAddressDistrict" id="billingAddressDistrict">
                <input type="text" name="billingAddressPostalCode" id="billingAddressPostalCode">
                <input type="text" name="billingAddressCity" id="billingAddressCity">
                <input type="text" name="billingAddressState" id="billingAddressState">
                <input type="text" name="billingAddressCountry" id="billingAddressCountry" value="BRA">
                <input type="hidden" name="valorTotalPlano" id="valorTotalPlano">
                <input type="hidden" name="codeTransaction" id="codeTransaction">
              </div>

              
            </div>
            <!-- CARTÃO DE CRÉDITO -->

            <!-- DÉBITO ONLINE -->
            <div class="tab mb-5 debito-online " id="db">
              <div class="form-group col-md-12 ">
                <label for="bankName">Banco</label>
                  <select name="bankName" class="form-control" id="bankName">
                    <option value="">Selecione</option>
                  </select>
              </div>
            </div>
            <!-- DÉBITO ONLINE -->

            <div class="tab mb-5">
              <div class="form-group">
                <button class="btn btn-success btn-block" id="btnComprar" >Comprar</button>
                <span class="endereco" data-endereco="<?php URL; ?>"></span>
              </div>
            </div>
          </form>
      </div>

      <!-- DIV LATERAL PARA INFO DO PEDIDO -->
      <div class="col-md-4">
        <div class="list-group">
          <a href="#" class="list-group-item list-group-item-action list-group-item-light tab">Preço por Pessoa: <b><span id="precoPessoa">Aguardando...</span></b></a>
          <a href="#" class="list-group-item list-group-item-action">Quantidade de Pessoas: <b id="sidebar-qtd-vidas">Aguardando...</b></a>
          <a href="#" class="list-group-item list-group-item-action">Corretora: <b>Top Prime Seguros & Saúde</b></a>
          <a href="#" class="list-group-item list-group-item-action">Responsável Financeiro: <b id="sidebar-nome-resp">Aguardando...</b></a>
          <a href="#" class="list-group-item list-group-item-action">Plano: <b><span id="planoSelecionado">Aguardando...</span></b></a>
          <a href="#" class="list-group-item list-group-item-action">Modalidade: <b><span id="modalidadeSelecionada">Aguardando...</span></b></a>
          <a href="#" class="list-group-item list-group-item-action">Forma de Pagamento: <div class="bandeira-cartao"><span id="formaPagamento"></span></div></a>
          <a href="#" class="list-group-item list-group-item-action list-group-item-light tab">Total: <b><span id="totalPlano">Aguardando...</span></b></a>
        </div>
      </div>
      <!-- DIV LATERAL PARA INFO DO PEDIDO -->

    </div>
  </div>
  
  <div class="form-group col-md-12">

          <!-- Modal -->
          <div class="modal fade" id="modalExemplo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h3 class="modal-title" id="exampleModalLabel">Termos e Condições</h3>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <h4><b>DECLARAÇÃO DO CONTRATANTE</b></h4><br />

                  <h5>Declaro para os devidos fins que:</h5>

                  <p>1. Sou responsável por todas as informações prestadas para a contratação do Plano Odontológico Individual/Familiar e atesto que são verdadeiras e completas;</p><br />

                  <p>2. Realizei a transferência eletrônica, “download”, de todos os documentos abaixo relacionados (Condições Gerais do Plano, Guia de Leitura Contratual, Manual de Orientação para Contratação de Planos de Saúde e Informações sobre os Tipos de Contratação RN 432), os quais foram suficientes para orientar-me acerca das coberturas, garantias, benefícios, exclusões, limites e cancelamento do plano odontológico que estou contratando;</p><br />

                  <p>3. Tenho conhecimento que as coberturas oferecidas pelo plano odontológico estão de acordo com o Rol de Procedimentos e Eventos em Saúde na segmentação Odontológica, instituído pela Agência Nacional de Saúde Suplementar – ANS e que estão sujeitas às atualizações, inclusões ou exclusões de procedimentos, sempre que houver a atualização do referido Rol pela ANS;</p><br />

                  <p>4. Tenho conhecimento que as movimentações da Rede Credenciada estarão disponíveis no site da Operadora Contratada ou na Central de Serviços da Operadora, conforme telefone indicado no verso do cartão de identificação do plano.</p><br />
                  <ul>
                    <li><a href="https://topprimesegurosesaude.com.br/arquivos/bradesco/condicoes-gerais.pdf" target="_blank">Condições Gerais do Plano</a><br /></li>
                  </ul>

                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-primary" data-dismiss="modal">Concordo</button>
                </div>
              </div>
            </div>
          </div>
        </div>
  </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="assets/js/bootstrap/bootstrap.js"></script>
    <script src="assets/js/main.js"></script>

    <script>
    
      if(inclusaoDependentes == 'Não'){
      $('#askDep').hide();
    }
      setInfoPedido();
      function setInfoPedido(){
          amount = parseFloat(valorPlano).toFixed(2);
          document.getElementById('itemDescription1').value = nomePlano;
          document.getElementById('itemId1').value = idPlano;
          document.getElementById('precoPessoa').innerHTML = "R$"+valorPlano.replace(".", ",");
          document.getElementById('planoSelecionado').innerHTML = nomePlano;
          document.getElementById('modalidadeSelecionada').innerHTML = modalidadePlano;
          document.getElementById('itemAmount1').value = amount;
          document.getElementById('amount').value = amount;
          document.getElementById('reference').value = codigoPlano;
          
        }
        function buscaCPFResp(cpf) {
          cpf = cpf.replace(/\.|\-/g, '');
          if(cpf.length == 11){
            $.get("https://api.cpfcnpj.com.br/fe4a573423a68ddee38b9d0534288131/2/" + cpf, function(resultado) {
                document.getElementById('nomeResponsavel').innerHTML = resultado.nome;
                document.getElementById('sidebar-nome-resp').innerHTML = resultado.nome;
                document.getElementById('nome-resp-financeiro').value = resultado.nome;
                document.getElementById('creditCardHolderBirthDate').value = resultado.nascimento;
                document.getElementById('senderName').value = resultado.nome;
                document.getElementById('senderCPF').value = cpf;
                document.getElementById('nasc-resp-financeiro').value = resultado.nascimento;
                document.getElementById('mae-resp-financeiro').value = resultado.mae;
                if (resultado.genero == 'M') {
                    document.getElementById('sexo-resp-financeiro').value = 'Masculino';
                } else {
                    document.getElementById('sexo-resp-financeiro').value = 'Feminino';
                }
                document.getElementById('erroCPFTitular').style.display = 'none';
            }).fail(function() {
                document.getElementById('erroCPFTitular').style.display = 'block';
            });
          } else {
            document.getElementById('nomeResponsavel').innerHTML = 'Insira um CPF Válido e completo!'
          }
        }

        function buscaCPFTitular(cpf) {
          cpf = cpf.replace(/\.|\-/g, '');
          if(cpf.length == 11){
            $.get("https://api.cpfcnpj.com.br/fe4a573423a68ddee38b9d0534288131/2/" + cpf, function(resultado) {
              document.getElementById('nomeTitular').innerHTML = resultado.nome;
              document.getElementById('nome-titular').value = resultado.nome;
              document.getElementById('nasc-titular').value = resultado.nascimento;
              document.getElementById('mae-titular').value = resultado.mae;
              if (resultado.genero == 'M') {
                  document.getElementById('sexo-titular').value = 'Masculino';
              } else {
                  document.getElementById('sexo-titular').value = 'Feminino';
              }
              document.getElementById('erroCPFTitular').style.display = 'none';
              qtdVidas++;
              document.getElementById('itemQuantity1').value = qtdVidas;
              valorTotal = qtdVidas * valorPlano;
              document.getElementById('totalPlano').innerHTML = "R$" +valorTotal.toFixed(2).replace(".", ",");
              document.getElementById('valorTotalPlano').value = valorTotal.toFixed(2);
              document.getElementById('sidebar-qtd-vidas').innerHTML = qtdVidas;
              document.getElementById('qtd-vidas').value = qtdVidas;
            }).fail(function() {
                document.getElementById('erroCPFTitular').style.display = 'block';
            });
          } else {
            document.getElementById('nomeTitular').innerHTML = 'Insira um CPF Válido e completo!'
          }
        }

        function buscaCPFDep1(cpf) {
          document.getElementById('dep').value = '1';
          cpf = cpf.replace(/\.|\-/g, '');
          if(cpf.length == 11){
            $.get("https://api.cpfcnpj.com.br/fe4a573423a68ddee38b9d0534288131/2/" + cpf, function(resultado) {
              document.getElementById('nomeDep1').innerHTML = resultado.nome;
              document.getElementById('nome-dep1').value = resultado.nome;
              document.getElementById('nasc-dep1').value = resultado.nascimento;
              document.getElementById('mae-dep1').value = resultado.mae;
              document.getElementById('dep').value = '1';
              if (resultado.genero == 'M') {
                  document.getElementById('sexo-dep1').value = 'Masculino';
              } else {
                  document.getElementById('sexo-dep1').value = 'Feminino';
              }
              document.getElementById('erroCPFDep').style.display = 'none';
              qtdVidas++;
              document.getElementById('qtd-vidas').value = qtdVidas;
              valorTotal = qtdVidas * valorPlano;
              document.getElementById('totalPlano').innerHTML = "R$" +valorTotal.toFixed(2).replace(".", ",");
              document.getElementById('valorTotalPlano').value = valorTotal.toFixed(2);
              document.getElementById('itemQuantity1').value = qtdVidas;
              document.getElementById('sidebar-qtd-vidas').innerHTML = qtdVidas;
              atualizaAmount();
            }).fail(function() {
                document.getElementById('erroCPFDep').style.display = 'block';
            });
          } else {
            document.getElementById('nomeDep1').innerHTML = 'Insira um CPF Válido e completo!'
          }
        }

        function buscaCPFDep2(cpf) {
          document.getElementById('dep').value = '2';
          cpf = cpf.replace(/\.|\-/g, '');
          if(cpf.length == 11){
            $.get("https://api.cpfcnpj.com.br/fe4a573423a68ddee38b9d0534288131/2/" + cpf, function(resultado) {
              document.getElementById('nomeDep2').innerHTML = resultado.nome;
              document.getElementById('nome-dep2').value = resultado.nome;
              document.getElementById('nasc-dep2').value = resultado.nascimento;
              document.getElementById('mae-dep2').value = resultado.mae;
              document.getElementById('dep').value = '2';
              if (resultado.genero == 'M') {
                  document.getElementById('sexo-dep2').value = 'Masculino';
              } else {
                  document.getElementById('sexo-dep2').value = 'Feminino';
              }
              document.getElementById('erroCPFDep').style.display = 'none';
              qtdVidas++;
              document.getElementById('qtd-vidas').value = qtdVidas;
              valorTotal = qtdVidas * valorPlano;
              document.getElementById('totalPlano').innerHTML = "R$" +valorTotal.toFixed(2).replace(".", ",");
              document.getElementById('valorTotalPlano').value = valorTotal.toFixed(2);
              document.getElementById('itemQuantity1').value = qtdVidas;
              document.getElementById('sidebar-qtd-vidas').innerHTML = qtdVidas;
              atualizaAmount();
            }).fail(function() {
                document.getElementById('erroCPFDep').style.display = 'block';
            });
          } else {
            document.getElementById('nomeDep2').innerHTML = 'Insira um CPF Válido e completo!'
          }
        }
        function buscaCPFDonoCartao(cpf) {
            cpf = cpf.replace(/\.|\-/g, '');
          if(cpf.length == 11){
            $.get("https://api.cpfcnpj.com.br/fe4a573423a68ddee38b9d0534288131/2/" + cpf, function(resultado) {
              document.getElementById('creditCardHolderName').value = resultado.nome;
              document.getElementById('creditCardHolderBirthDate').value = resultado.nascimento
              document.getElementById('creditCardHolderCPF').value = cpf;

              document.getElementById('erroCPFDonoCartao').style.display = 'none';
              
            }).fail(function() {
                document.getElementById('erroCPFDonoCartao').style.display = 'block';
            });
          } else {
            document.getElementById('creditCardHolderName').value = 'Insira um CPF Válido e completo!'
          }
        }
    </script>

    <script src="<?php echo SCRIPT_PAGSEGURO; ?>"></script>
    <script src="assets/plugins/mask-field/jquery.mask.min.js"></script>
    <script src="assets/js/validator.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.6/dist/loadingoverlay.min.js"></script>
    <script>

      function getBillingStreetAddress(stre){
        document.getElementById('billingAddressStreet').value = stre;
      }

      function getBillingNumberAddress(num){
        document.getElementById('billingAddressNumber').value = num;
      }

      function getBillingComplementAddress(comp){
        document.getElementById('billingAddressComplement').value = comp;
      }

      function getBillingDistrictAddress(dist){
        document.getElementById('billingAddressDistrict').value = dist;
      }

      function getBillingCityAddress(city){
        document.getElementById('billingAddressCity').value = city;
      }

      function getBillingStateAddress(state){
        document.getElementById('billingAddressState').value = state;
      }

      function getBillingPostalCodeAddress(cep){
        document.getElementById('billingAddressPostalCode').value = cep;
      }

      function getCardHolderPhone(tel){
        document.getElementById('creditCardHolderPhone').value = tel;
      }

      function getCardHolderAreaCode(code){
        document.getElementById('creditCardHolderAreaCode').value = code;
      }

      function liberarEndereco(){
        $('#cepCollapse').collapse('show');
      }

      function mostrarDivCartao(){
        $('#cc').collapse('show');
      }
      $("#paymentMethoddb").click(function () {
        $("#cc").hide();
        $("#db").show();
        $("#formaPagamento").html('Débito Online');
      });
      $("#paymentMethodbo").click(function () {
        $("#cc").hide();
        $("#db").hide();
        $("#formaPagamento").html('Boleto Bancário');
      });
      $("#paymentMethodcc").click(function () {
        $("#cc").show();
        $("#db").hide();
      });

    </script>
</body>

</html>