$(document).ready(function() {
    
    $('select#estado').on("change", function(){
        $("select[name=cidade]").html('<option value="">Carregando...</option>');
        $("select[name=bairro]").html('<option value="">Aguardando Cidade...</option>');
        var id_estado = $("select[name=estado]").val();    
        $.post("dinamico/carrega-cidades.php",{id_estado:id_estado},function(data){$("select[name=cidade]").html(data);});
    });

    $('select#cidade').on("change", function(){
        var id_cidade = $("select[name=cidade]").val();    
        $.post("dinamico/carrega-bairros.php",{id_cidade:id_cidade},function(data){$("select[name=bairro]").html(data);});
    });

    $('#example').DataTable();
    $('#example2').DataTable();

    $('input#arquivo').on("change", function(){
        $('input#nf').val("111");
        $('input#peso_nf').val("222");
        $('input#data_nf').val("2022-02-16");
        $('input#valor_nf').val("555");
    });

    $('select#tipo').on("change", function(){
        var tipo=$("select[name=tipo]").val();  
        $.post("dinamico/carrega-campos.php",{tipo:tipo},function(data){$("#tipo_lancamento").html(data);});
    });    

    $('input#valor_pgto').blur(function(){
        var valor = $('input#valor').val();
        var valorpg = $('input#valor_pgto').val();
        if(valor != valorpg){
            alert("Valor inserido diferente do valor original");
        }
    })

    $('select#tipo_tomador').on("change", function(){
        var tomador=$("select[name=tipo_tomador]").val();  
        $.post("dinamico/carrega-tomador.php",{tomador:tomador},function(data){$("select[name=id_tomador]").html(data);});
    });     

});

//Editar contrato
function editar_contrato(id_contrato){
    id = id_contrato;
    location.href = "contratos_edi.php?idContrato="+id;
}

//Efetuar lançamentos do contrato
function lancam_contrato(id_contrato){
    var id = id_contrato;
    location.href = "contratos_lan.php?idContrato="+id;
}

//Gravar novo banco
function gravaBanco(){
    var nome_banco = $("input[name=nome_banco]").val();
    var num_banco = $("input[name=num_banco]").val();
    $.post("dinamico/incluir_banco.php",{nome_banco:nome_banco,num_banco:num_banco},function(data){$("select[name=banco]").html(data);});
    $('#registro01').modal('hide');
}

//Gravar novo bairro
function gravaBairro(){
    var nome_bairro = $("input[name=nome_bairro]").val();
    var id_cidade = $("select[name=cidade]").val(); 

    if (id_cidade != '') {
        $.post("dinamico/incluir_bairro.php",{nome_bairro:nome_bairro,id_cidade:id_cidade},function(data){$("select[name=bairro]").html(data);});
    }else{
        alert('Por favor, selecione o Estado e a Cidade para poder gravar o novo bairro.');
    }
    $('#registro02').modal('hide');
}

//Gravar novo FORNECEDOR
function gravaFornec(){
    var nome_fornec = $("input[name=nome_fornec]").val();
    $.post("dinamico/incluir_fornec.php",{nome_fornec:nome_fornec},function(data){$("select[name=fornec]").html(data);});
    $('#registro03').modal('hide');
}

//Gravar nova CONTA
function gravaConta(){
    var nome_conta = $("input[name=nome_conta]").val();
    $.post("dinamico/incluir_conta.php",{nome_conta:nome_conta},function(data){$("select[name=conta_corrente]").html(data);});
    $('#registro04').modal('hide');
}

//Baixa de pagamento de contas a pagar
function gravaPgtoDebito(){
    var conta = $("select[name=modal_conta_corrente]").val();
    if (conta != '') {
        $("input[name=modal_confirm]").val('s');
        $("#form_pgto" ).submit();
        $('#pagamento').modal('hide');
    }else{
        alert('Por favor, selecione o caixa a ser debitado');
    }
}

//Baixa de pagamento de contas a receber
function gravaPgtoCredito(){
    var conta = $("select[name=modal_conta_corrente]").val();
    if (conta != '') {
        $("input[name=modal_confirm]").val('s');
        $("#form_pgto" ).submit();
        $('#pagamento').modal('hide');
    }else{
        alert('Por favor, selecione o caixa a ser creditado');
    }
}

//Baixa de pagamento de contas a receber
function whatsappRecibo(id,fone){
    var id = id;
    var phone = fone;
    var link = "http://www.imobiliariaguima.com.br/novo/cobranca_recibo.php?idLancam="+id;

    window.open("https://api.whatsapp.com/send?phone="+phone+"&text=Aluguel desse mês: " + link);
}

function somenteNumeros(num) {
    var er = /[^0-9.]/;
    er.lastIndex = 0;
    var campo = num;
    if (er.test(campo.value)) {
        campo.value = "";
    }
}

function confere_senha(){
    var senha1 = $("input[name=senha]").val();    
    var senha2 = $("input[name=repete_senha]").val();
    if (senha1 == senha2) {
        $("#form_perfil" ).submit();
    }else{
        alert('As senhas devem ser iguais');
    }    
}

function AddFrete(id,valor){
    var id = id;
    var valor = valor;
    $.post("dinamico/soma_frete.php",{id:id,valor:valor},function(data){$("#mostra_frete").html(data);});
}

function DelFrete(id){
    var id = id;
    $.post("dinamico/del_frete.php",{id:id},function(data){$("#mostra_frete").html(data);});
}


function AddComiss1(id,valor){
    var id = id;
    var valor = valor;
    $.post("dinamico/soma_comiss1.php",{id:id,valor:valor},function(data){$("#mostra_comiss1").html(data);});
}

function DelComiss1(id){
    var id = id;
    $.post("dinamico/del_comiss1.php",{id:id},function(data){$("#mostra_comiss1").html(data);});
}

function AddComiss2(id,valor){
    var id = id;
    var valor = valor;
    $.post("dinamico/soma_comiss2.php",{id:id,valor:valor},function(data){$("#mostra_comiss2").html(data);});
}

function DelComiss2(id){
    var id = id;
    $.post("dinamico/del_comiss2.php",{id:id},function(data){$("#mostra_comiss2").html(data);});
}

function Lanca_Frete(id){
    var id = id;
    $.post("dinamico/lanca_frete.php",function(data){
        $("#mostra_frete").html(data);
    });
}

function Lanca_Comiss1(id){
    var id = id;
    $.post("dinamico/lanca_comiss1.php",function(data){
        $("#mostra_comiss1").html(data);
    });
}

function Lanca_Comiss2(id){
    var id = id;
    $.post("dinamico/lanca_Comiss2.php",function(data){
        $("#mostra_comiss2").html(data);
    });
}

