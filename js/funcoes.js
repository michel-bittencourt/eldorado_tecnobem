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

$(document).ready(function() {
    $('#example').DataTable();
    $('#example2').DataTable();
} );


//Excluir
function excluir(){
	if(confirm('Você tem certeza que deseja excluir?')) {
		$("#frm").attr("action","clientes_exc.php");		
        $("#frm").submit();
	}
}

//Voltar para página inicial
$("#btn_home").click(function(){
    location.href = "painel.php";
});

//Voltar para página contratos
$("#btn_contratos").click(function(){
    location.href = "contratos_cad.php";
});

$("#cpf_cnpj").blur(function () {
    var cpf_cnpj = $(this).val();
    $.post("dinamico/consulta_cpf.php",{cpf_cnpj:cpf_cnpj},function(data){
        var idCliente = data;
        if (idCliente > 0) {
            location.href = "clientes_edi.php?idCliente="+idCliente;
        }
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

//Incluir proprietário na lista temporária
function addProp(){
    var id_prop = $("select[name=props]").val();
    var percent = $("input[name=percent]").val();
    var checado = $("#resp").is(':checked')
    if(checado == true){
        resp = 's';
    }else{
        resp = 'n';
    }

    if (id_prop!="" && percent!="") {
        if(percent>100){
            alert('Você não pode inserir um percentual maior que 100% para um proprietário!');
        }else{
            $.post("dinamico/carrega-prop.php",{id_prop:id_prop, percent:percent, resp:resp},function(data){$("#proprietarios").html(data);});
        }
            
    }else{
        alert("Por favor, preencha os dois campos!");
    }

    $("#btn_gravar").show();
    $("#btn_mensagem").hide();
    
}

//Remover proprietário na lista temporária
function remProp(id_temp_prop){
    var id_temp_prop = id_temp_prop;
    $.post("dinamico/remove-prop.php",{id_temp_prop:id_temp_prop},function(data){$("#proprietarios").html(data);});
}

//Incluir proprietário na lista definitiva
function addProp2(id_imovel){
    var id_imovel = id_imovel;
    var id_prop = $("select[name=props]").val();
    var percent = $("input[name=percent]").val();
    var checado = $("#resp").is(':checked')
    if(checado == true){
        resp = 's';
    }else{
        resp = 'n';
    }

    if (id_prop!="" && percent!="") {
        if(percent>100){
            alert("Você não pode um percentual maior que 100% para um proprietário!");
        }else{
            $.post("dinamico/carrega-prop2.php",{id_imovel:id_imovel, id_prop:id_prop, percent:percent, resp:resp},function(data){$("#proprietarios").html(data);});
        }
            
    }else{
        alert("Por favor, preencha os dois campos!");
    } 
}

//Remover proprietário na lista definitiva
function remProp2(id_imovel,id_imoveis_prop){
    var id_imovel = id_imovel;
    var id_imoveis_prop = id_imoveis_prop;
    $.post("dinamico/remove-prop2.php",{id_imovel:id_imovel,id_imoveis_prop:id_imoveis_prop},function(data){$("#proprietarios").html(data);});
}

//Gravar novo banco
function gravaBanco(){
    var nome_banco = $("input[name=nome_banco]").val();
    var num_banco = $("input[name=num_banco]").val();
    $.post("dinamico/incluir_banco.php",{nome_banco:nome_banco,num_banco:num_banco},function(data){$("select[name=banco]").html(data);});
    $('#registro01').modal('hide');
}


function btnEdiCliente(id){
    var id = id;
    //$.post("clientes_edi.php",{idCliente:id});
    $.post( "clientes_edi.php",function(data){alert(id)} );
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


//Pgto de lançamento de aluguel
function gravaPgto(){
    var conta = $("select[name=modal_conta_corrente]").val();
    var forma = $("select[name=modal_forma_pgto]").val();
    if (conta != '' && forma != '') {
        $("input[name=modal_confirm]").val('s');
        $("#form_pgto" ).submit();
        $('#pagamento').modal('hide');
    }else{
        alert('Por favor, selecione a forma de pagamento e o caixa a ser creditado');
    }
}

//Gravar novo FORNECEDOR
function gravaFornec(){
    var nome_fornec = $("input[name=nome_fornec]").val();
    $.post("dinamico/incluir_fornec.php",{nome_fornec:nome_fornec},function(data){$("select[name=fornec]").html(data);});
    $('#registro03').modal('hide');
}

//Gravar novo CLIENTE
function gravaFornec2(){
    var nome_fornec = $("input[name=nome_fornec]").val();
    $.post("dinamico/incluir_fornec2.php",{nome_fornec:nome_fornec},function(data){$("select[name=fornec]").html(data);});
    $('#registro03').modal('hide');
}

//Gravar nova CONTA
function gravaConta(){
    var nome_conta = $("input[name=nome_conta]").val();
    $.post("dinamico/incluir_conta.php",{nome_conta:nome_conta},function(data){$("select[name=conta_corrente]").html(data);});
    $('#registro04').modal('hide');
}

//Gravar nova CONTA
function gravaConta2(){
    var nome_conta = $("input[name=nome_conta]").val();
    $.post("dinamico/incluir_conta2.php",{nome_conta:nome_conta},function(data){$("select[name=conta_corrente]").html(data);});
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
function imprimirRecibo(id){
    var id = id;
    window.open("cobranca_recibo.php?idLancam=" + id);
}

//Baixa de pagamento de contas a receber
function imprimirReciboProp(id){
    var id = id;
    window.open("cobranca_recibo_prop.php?idLancam=" + id);
}

//Baixa de pagamento de contas a receber
function whatsappRecibo(id,fone){
    var id = id;
    var phone = fone;
    var link = "http://www.imobiliariaguima.com.br/novo/cobranca_recibo.php?idLancam="+id;

    window.open("https://api.whatsapp.com/send?phone="+phone+"&text=Aluguel desse mês: " + link);
}

//Baixa de pagamento de contas a receber
function imprimirBoleto(id,dif){
    var id = id;
    var dif = dif;
    window.open("cobranca_boleto.php?idLancam=" + id + "&dif=" + dif);
}


function whatsappBoleto(id,fone){
    var id = id;
    var phone = fone;
    var link = "http://www.imobiliariaguima.com.br/novo/cobranca_boleto.php?idLancam="+id;

    window.open("https://api.whatsapp.com/send?phone="+phone+"&text=Boleto para pagamento de aluguel: " + link);
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