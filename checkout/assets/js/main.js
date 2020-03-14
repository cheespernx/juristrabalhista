let btnAddDep = document.getElementById('btnAddDep');
let btnRemDep = document.getElementById('btnRemDep');
let divAddDep = document.getElementById('addDep');
let navlinkDep = document.getElementById('dadosDep');
var qtdVidas = 0;

//var amount = "600.00";

var amount = $('#amount').val();
var paymentLink = '#';
var paymentMethod = '#';

btnAddDep.addEventListener('click', function() {
    if (btnAddDep.innerHTML == "Adicionar Dependentes") {
        btnAddDep.innerHTML = "Remover dependentes";
        btnAddDep.className = "btn btn-danger btn-block";
    } else {
        btnAddDep.innerHTML = "Adicionar Dependentes";
        btnAddDep.className = "btn btn-primary btn-block";
        document.getElementById('nome-dep1').value = "";
        document.getElementById('nasc-dep1').value = "";
        document.getElementById('mae-dep1').value = "";
        document.getElementById('sexo-dep1').value = "";
        document.getElementById('cpf-dep1').value = "";

        document.getElementById('nome-dep2').value = "";
        document.getElementById('nasc-dep2').value = "";
        document.getElementById('mae-dep2').value = "";
        document.getElementById('sexo-dep2').value = "";
        document.getElementById('cpf-dep2').value = "";

        qtdVidas = 1;
        atualizaAmount();

        valorTotal = qtdVidas * valorPlano;
        document.getElementById('totalPlano').innerHTML = "R$" + valorTotal.toFixed(2).replace(".", ",");
        document.getElementById('sidebar-qtd-vidas').innerHTML = qtdVidas;
        document.getElementById('qtd-vidas').value = qtdVidas;
        document.getElementById('itemQuantity1').value = qtdVidas;
    }
    navlinkDep.innerHTML = `<img src="https://img.icons8.com/metro/20/000000/2-circle.png"> - Dados dos Dependentes`;
});

// SISTEMA PAGSEGURO
let btnComprar = document.getElementById('btnComprar');

let endereco = jQuery('.endereco').attr('data-endereco');

function pagamento() {
    $.ajax({
        url: endereco + "pagamento.php",
        type: 'POST',
        dataType: 'json',
        success: function(retorno) {
            PagSeguroDirectPayment.setSessionId(retorno.id);
        },
        complete: function(retorno) {
            listarMeiosPag();
        }
    });
}

document.addEventListener("DOMContentLoaded", function(event) {
    pagamento();
});

function atualizaAmount() {
    amount = $('#valorTotalPlano').val();
}

function listarMeiosPag() {
    atualizaAmount();
    PagSeguroDirectPayment.getPaymentMethods({
        amount: amount,
        success: function(retorno) {
            $('.meio-pag').append("<div>Cartão de Crédito</div>");
            $.each(retorno.paymentMethods.CREDIT_CARD.options, function(i, obj) {
                //$('.meio-pag').append("<span class='img-band'><img src='https://stc.pagseguro.uol.com.br" + obj.images.SMALL.path + "'></span>");
            });

            $('.meio-pag').append("<div>Boleto</div>");
            $('.meio-pag').append("<span class='img-band'><img src='https://stc.pagseguro.uol.com.br" + retorno.paymentMethods.BOLETO.options.BOLETO.images.SMALL.path + "'></span>");

            $('.meio-pag').append("<div>Débito Online</div>");
            $.each(retorno.paymentMethods.ONLINE_DEBIT.options, function(i, obj) {
                //$('.meio-pag').append("<span class='img-band'><img src='https://stc.pagseguro.uol.com.br" + obj.images.SMALL.path + "'></span>");

                $('#bankName').show().append("<option value='" + obj.name + "'>" + obj.displayName + "</option>");
            });
        },
        error: function(retorno) {
            // Callback para chamadas que falharam.
        },
        complete: function(retorno) {

        }
    });
}

// Recupera a bandeira do cartão digitado pelo Usuário

$('#numCartao').on('keyup', function() {
    var numCartao = $(this).val();
    var qtnNumero = numCartao.length;
    atualizaAmount();

    if (qtnNumero == 6) {
        PagSeguroDirectPayment.getBrand({
            cardBin: numCartao,
            success: function(retorno) {
                $('#msg').empty();
                let imgBand = retorno.brand.name;
                $('.bandeira-cartao').html("<img src='https://stc.pagseguro.uol.com.br/public/img/payment-methods-flags/68x30/" + imgBand + ".png'>");

                $('#bandeira-cartao-2').html("<img src='https://stc.pagseguro.uol.com.br/public/img/payment-methods-flags/42x20/" + imgBand + ".png'>");

                $('.bandeiraCartao').text("Cartão de Crédito: " + imgBand);
                $('#bandCartao').val(imgBand);
                recupParcelas(imgBand);
                $('#msg').hide();
            },
            error: function(retorno) {
                $('.bandeira-cartao').empty();
                $('.bandeiraCartao').text("Aguardando...");
                $('#msg').show().html('Cartão Inválido!');
                $('#qtdParcelas').html('<option value="">Selecione</option>');
                $('#bandeira-cartao-2').html('');
            },
            complete: function(retorno) {
                //tratamento comum para todas chamadas
            }
        });
    }
});

//Recupera a quantidade de parcelas e o valor das parcelas

function recupParcelas(bandeira) {
    var noIntInstalQuantity = $('#noIntInstallQuantity').val();
    $('#qtdParcelas').html('<option value="">Selecione</option>');
    PagSeguroDirectPayment.getInstallments({

        //Valor do produto
        amount: amount,

        //Quantidade de parcelas sem juro        
        maxInstallmentNoInterest: noIntInstalQuantity,

        //Tipo da bandeira
        brand: bandeira,
        success: function(retorno) {
            $.each(retorno.installments, function(ia, obja) {
                $.each(obja, function(ib, objb) {

                    //Converter o preço para o formato real com JavaScript
                    var valorParcela = objb.installmentAmount.toFixed(2).replace(".", ",");

                    //Acrecentar duas casas decimais apos o ponto
                    var valorParcelaDouble = objb.installmentAmount.toFixed(2);
                    //Apresentar quantidade de parcelas e o valor das parcelas para o usuário no campo SELECT
                    $('#qtdParcelas').append("<option value='" + objb.quantity + "' data-parcelas='" + valorParcelaDouble + "'>" + objb.quantity + " parcelas de R$ " + valorParcela + "</option>");
                });
            });
        },
        error: function(retorno) {
            // callback para chamadas que falharam.
        },
        complete: function(retorno) {
            // Callback para todas chamadas.
        }
    });
}

//Enviar o valor da parcela para o Formulário
$('#qtdParcelas').change(function() {
    $('#valorParcela').val($('#qtdParcelas').find(':selected').attr('data-parcelas'));
});

//Recuperar o hash do cartão
$('#formPagamento').on("submit", function(event) {
    event.preventDefault();
    $.LoadingOverlay("show");

    paymentMethod = document.querySelector('input[name="paymentMethod"]:checked').value;
    if (paymentMethod == 'creditCard') {
        PagSeguroDirectPayment.createCardToken({
            cardNumber: $('#numCartao').val(), // Número do cartão de crédito
            brand: $('#bandeiraCartao').val(), // Bandeira do cartão
            cvv: $('#cvvCartao').val(), // CVV do cartão
            expirationMonth: $('#mesValidade').val(), // Mês da expiração do cartão
            expirationYear: $('#anoValidade').val(), // Ano da expiração do cartão, é necessário os 4 dígitos.
            success: function(retorno) {
                $('#tokenCartao').val(retorno.card.token);
                recupHashCartao();
            },
            error: function(retorno) {
                // Callback para chamadas que falharam.
            },
            complete: function(retorno) {
                // Callback para todas chamadas.

            }
        });
    } else if (paymentMethod == 'boleto') {
        recupHashCartao();
    } else if (paymentMethod == 'eft') {
        recupHashCartao();
    }

    function recupHashCartao() {
        PagSeguroDirectPayment.onSenderHashReady(function(retorno) {
            if (retorno.status == 'error') {
                return false;
            } else {
                $("#hashCartao").val(retorno.senderHash);
                var dados = $("#formPagamento").serialize();

                var endereco = jQuery('.endereco').attr("data-endereco");
                $.ajax({
                    method: "POST",
                    url: endereco + "assets/control/proc_pag.php",
                    data: dados,
                    dataType: 'json',
                    success: function(retorna) {

                        var codeTransaction = retorna.dados.code;
                        $('#codeTransaction').val(codeTransaction);
                        paymentLink = retorna.dados.paymentLink;
                        cadastrarPedido();
                    },
                    error: function(retorna) {
                    },
                    complete: function(retorna) {

                    }
                });
            }
        });
    }
});

function cadastrarPedido() {
    var nome = $('#nome-resp-financeiro').val();
    var email = $('#senderEmail').val();
    var ddd = $('#senderAreaCode').val();
    var telefone_cel = $('#senderPhone').val();
    var data_nasc = $('#nasc-resp-financeiro').val();
    var cpf = $('#cpf-resp-financeiro').val();
    var sexo = $('#sexo-resp-financeiro').val();
    var nome_da_mae = $('#mae-resp-financeiro').val();
    var nome_titular = $('#nome-titular').val();
    var data_nasc_titular = $('#nasc-titular').val();
    var cpf_titular = $('#cpf-titular').val();
    var sexo_titular = $('#sexo-titular').val();
    var nome_da_mae_titular = $('#mae-titular').val();
    var cep = $('#shippingAddressPostalCode').val();
    var uf = $('#shippingAddressState').val();
    var cidade = $('#shippingAddressCity').val();
    var rua = $('#shippingAddressStreet').val();
    var bairro = $('#shippingAddressDistrict').val();
    var numero = $('#shippingAddressNumber').val();
    var complemento = $('#shippingAddressComplement').val();
    var plano = $('#itemDescription1').val();
    var produto = $('#produto').val();
    var qtd_vidas = $('#itemQuantity1').val();
    var valor = $('#valorTotalPlano').val();
    var statusDep = $('#dep').val();
    var codeTransaction = $('#codeTransaction').val();
    var vUrl = endereco + "assets/control/cad.php";
    $.post(vUrl, {
        nome: nome,
        email: email,
        ddd: ddd,
        telefone_cel: telefone_cel,
        data_nasc: data_nasc,
        cpf: cpf,
        sexo: sexo,
        nome_da_mae: nome_da_mae,
        nome_titular: nome_titular,
        data_nasc_titular: data_nasc_titular,
        cpf_titular: cpf_titular,
        sexo_titular: sexo_titular,
        nome_da_mae_titular: nome_da_mae_titular,
        cep: cep,
        uf: uf,
        cidade: cidade,
        rua: rua,
        bairro: bairro,
        numero: numero,
        complemento: complemento,
        plano: plano,
        produto: produto,
        qtd_vidas: qtd_vidas,
        valor: valor,
        statusDep: statusDep,
        codigo: codeTransaction
    }, function(response) {
        if (statusDep == '1' || statusDep == '2') {
            incluirDep(statusDep);
        } else {
            if (paymentMethod == 'boleto') {
                window.location.href = 'finalizar-boleto.php?paymentLink=' + paymentLink;
            } else if (paymentMethod == 'eft') {
                window.location.href = 'finalizar-debito.php?paymentLink=' + paymentLink;
            } else if (paymentMethod == 'creditCard') {
                window.location.href = 'finalizar-cartao.php';
            };
        };
    });

    function incluirDep(qtdDep) {
        var urlAddDep = endereco + "assets/control/caddep.php?dep=" + qtdDep;
        if (qtdDep == '1') {
            var nomeDep1 = $('#nome-dep1').val();
            var nascDep1 = $('#nasc-dep1').val();
            var maeDep1 = $('#mae-dep1').val();
            var sexoDep1 = $('#sexo-dep1').val();
            var cpfDep1 = $('#cpf-dep1').val();
            $.post(urlAddDep, {
                statusDep: statusDep,
                nomeDep1: nomeDep1,
                nascDep1: nascDep1,
                maeDep1: maeDep1,
                sexoDep1: sexoDep1,
                cpfDep1: cpfDep1,
            }, function(response) {
                if (paymentMethod == 'boleto') {
                    window.location.href = 'finalizar-boleto.php?paymentLink=' + paymentLink;
                } else if (paymentMethod == 'eft') {
                    window.location.href = 'finalizar-debito.php?paymentLink=' + paymentLink;
                } else if (paymentMethod == 'creditCard') {
                    window.location.href = 'finalizar-cartao.php';
                };
            });
        } else if (qtdDep == '2') {
            var nomeDep1 = $('#nome-dep1').val();
            var nascDep1 = $('#nasc-dep1').val();
            var maeDep1 = $('#mae-dep1').val();
            var sexoDep1 = $('#sexo-dep1').val();
            var cpfDep1 = $('#cpf-dep1').val();

            var nomeDep2 = $('#nome-dep2').val();
            var nascDep2 = $('#nasc-dep2').val();
            var maeDep2 = $('#mae-dep2').val();
            var sexoDep2 = $('#sexo-dep2').val();
            var cpfDep2 = $('#cpf-dep2').val();
            $.post(urlAddDep, {
                statusDep: statusDep,
                nomeDep1: nomeDep1,
                nascDep1: nascDep1,
                maeDep1: maeDep1,
                sexoDep1: sexoDep1,
                cpfDep1: cpfDep1,
                nomeDep2: nomeDep2,
                nascDep2: nascDep2,
                maeDep2: maeDep2,
                sexoDep2: sexoDep2,
                cpfDep2: cpfDep2,
                codigo: codeTransaction
            }, function(response) {
                if (paymentMethod == 'boleto') {
                    window.location.href = 'finalizar-boleto.php?paymentLink=' + paymentLink;
                } else if (paymentMethod == 'eft') {
                    window.location.href = 'finalizar-debito.php?paymentLink=' + paymentLink;
                } else if (paymentMethod == 'creditCard') {
                    window.location.href = 'finalizar-cartao.php';
                };
            });
        }

    }
}