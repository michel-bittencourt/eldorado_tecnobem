<?php
setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Sao_Paulo');

function GetIdUser() {
	session_start();
    $id_user    = $_SESSION['id_user'];
    return $id_user;
}

function gravaLog($modulo,$acao,$registro){
	include "db.php";
	$id_user = GetIdUser();
	$data = date("Y/m/d");
	$hora = date("H:i:s");
	$sql_log = "INSERT INTO log(id_user, modulo, acao, registro, data, hora) 
				VALUES('$id_user','$modulo','$acao', '$registro', '$data', '$hora')";
	$query = $conn->query($sql_log);
}

function cdo(){
    include "db.php";
    $sql_cdo = "SELECT cdo FROM parametros WHERE id_param = 1";
    $result_cdo = $conn->query($sql_cdo);
    $row_cdo = $result_cdo->fetch_assoc();
    return $row_cdo['cdo'];
}

function pesoEmb($x){
    include "db.php";
    $sql_emb = "SELECT kg FROM embalagens WHERE id_embalagem = $x";
    $result_emb = $conn->query($sql_emb);
    $row_emb = $result_emb->fetch_assoc();
    return $row_emb['kg'];
}

function tipoVend($x){
    include "db.php";
    $sql_vend = "SELECT id_tipo FROM vendedores WHERE id_vendedor = $x";
    $result_vend = $conn->query($sql_vend);
    $row_vend = $result_vend->fetch_assoc();
    return $row_vend['id_tipo'];
}

function mensRetorno($m){

	$mens = $m;

    switch ($m) {
        case '1':
        $mens= "<div class='alert alert-success m-3' role='alert'>
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                    <h3>Parabéns!</h3>
                    <p>Registro gravado com sucesso.</p>
                </div>";
                break;
        case '2':
        $mens= "<div class='alert alert-danger m-3' role='alert'>
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                    <h3>Atenção!</h3>
                    <p>Registro não gravou.</p>
                </div>";                        
                break;
        case '3':
        $mens= "<div class='alert alert-warning m-3' role='alert'>
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                    <h3>Concluído!</h3>
                    <p>Registro excluido com sucesso.</p>
                </div>";    
                break;
        case '4':
        $mens= "<div class='alert alert-danger m-3' role='alert'>
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                    <h3>Não gravou!</h3>
                    <p>Registro já existe no banco de dados.</p>
                </div>";
                break;
        case '5':
        $mens= "<div class='alert alert-danger m-3' role='alert'>
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                    <h3>Não gravou!</h3>
                    <p>Saldo insuficiente para realizar pagamento.</p>
                </div>";
                break;                
        default:
        $mens = "";
                break;
    }

    echo $mens;
}

function qtdTransporte($id){
    include "db.php";
    $sql = "SELECT SUM(A.peso_maximo) AS soma, C.kg 
            FROM tipos_caminhao A, ordem_carregamento B, embalagens C, contratos D 
            WHERE B.id_contrato = $id 
            AND B.ativo = 's'
            AND B.situacao = 'AGENDADO' 
            AND A.id_tipo_caminhao = B.id_tipo_caminhao
            AND B.id_contrato = D.id_contrato
            AND D.id_embalagem = C.id_embalagem";
    $result = $conn->query($sql);
    $row=$result->fetch_assoc();
    $unidade = $row['kg'];
    return $row['soma']/$unidade;
}

function qtdEntregue($id){
    include "db.php";
    $sql = "SELECT SUM(A.peso_nf) AS soma, C.kg
            FROM ordem_carregamento A, contratos B, embalagens C 
            WHERE A.id_contrato = $id 
            AND A.ativo = 's'
            AND A.situacao = 'CARREGADO'
            AND A.id_contrato = B.id_contrato
            AND B.id_embalagem = C.id_embalagem";
    $result = $conn->query($sql);
    $row=$result->fetch_assoc();

    return $row['soma']/$row['kg'];
}

function nomeVendedor($id){
    include "db.php";
    $sql = "SELECT vendedor FROM vendedores WHERE id_vendedor = $id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    return $row['vendedor'];
}

function nomeComprador($id){
    include "db.php";
    $sql = "SELECT comprador FROM compradores WHERE id_comprador = $id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    return $row['comprador'];
}

function nomeTransp($id){
    include "db.php";
    $sql = "SELECT transp FROM transportadoras WHERE id_transp = $id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    return $row['transp'];
}

function nomeFornec($id){
    include "db.php";
    $sql = "SELECT fornec FROM fornecedores WHERE id_fornec = $id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    return $row['fornec'];
}

function nomeCliente($id){
    include "db.php";
    $sql = "SELECT cliente FROM clientes WHERE id_cliente = $id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    return $row['cliente'];
}

function nomeContaPagar($id){
    include "db.php";
    $sql = "SELECT conta_pagar FROM contas_pagar WHERE id_conta_pagar = $id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    return $row['conta_pagar'];
}

function nomeContaReceber($id){
    include "db.php";
    $sql = "SELECT conta_receber FROM contas_receber WHERE id_conta_receber = $id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    return $row['conta_receber'];
}

function nomeContaCorrente($id){
    include "db.php";
    $sql = "SELECT conta FROM contas WHERE id_conta = $id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    return $row['conta'];    
}

function ConsultaTransp($id){
    include "db.php";
    $sql = "SELECT id_transp FROM ordem_carregamento WHERE id_ordem = $id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    return $row['id_transp'];
}

function ConsultaComprador($id){
    include "db.php";
    $sql = "SELECT A.id_contrato, B.id_comprador
            FROM ordem_carregamento A, contratos B
            WHERE A.id_ordem = $id 
            AND A.id_contrato = B.id_contrato";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    return $row['id_comprador'];
}

function ConsultaVendedor($id){
    include "db.php";
    $sql = "SELECT A.id_contrato, B.id_vendedor
            FROM ordem_carregamento A, contratos B
            WHERE A.id_ordem = $id 
            AND A.id_contrato = B.id_contrato";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    return $row['id_vendedor'];
}

function SaldoConta($id_caixa){
    include "db.php";
    $sql_cx = "SELECT SUM(A.valor_pgto) as total, B.limite 
                FROM financeiro A, contas B 
                WHERE A.id_caixa = $id_caixa 
                AND A.situacao = 1 
                AND A.ativo = 's'
                AND B.id_conta = $id_caixa
            ";

    $result_cx = $conn->query($sql_cx);
    $row_cx=$result_cx->fetch_assoc();

    $saldo = floatval($row_cx['total']+$row_cx['limite']);

    return $saldo;    
}

function VencPis($data){
    $dia_venc = '25';
    $mes_venc = date('m', strtotime($data.' + 1 month'));
    $ano_venc = date('Y', strtotime($data.' + 1 month'));
    $venc = $ano_venc."-".$mes_venc."-".$dia_venc;
        
    $dia_semana = date("w",strtotime($venc));

    if($dia_semana == 6){
        $venc = date("Y-m-d",strtotime($venc.'- 1 day'));
    }else if($dia_semana == 0){
        $venc = date("Y-m-d",strtotime($venc.'- 2 day'));
    }
    return $venc;
}

function VencIss($data){
    $dia_venc = '15';
    $mes_venc = date('m', strtotime($data.' + 1 month'));
    $ano_venc = date('Y', strtotime($data.' + 1 month'));
    $venc = $ano_venc."-".$mes_venc."-".$dia_venc;
        
    $dia_semana = date("w",strtotime($venc));

    if($dia_semana == 6){
        $venc = date("Y-m-d",strtotime($venc.'- 1 day'));
    }else if($dia_semana == 0){
        $venc = date("Y-m-d",strtotime($venc.'- 2 day'));
    }
    return $venc;
}

function VencCsll($data){

    $mes_data = date('m', strtotime($data));

    switch ($mes_data) {
        case '01':
            $nova_data = strtotime($data.' + 3 month');
            break;
        case '02':
            $nova_data = strtotime($data.' + 2 month');
            break;
        case '03':
            $nova_data = strtotime($data.' + 1 month');
            break;
        case '04':
            $nova_data = strtotime($data.' + 3 month');
            break;
        case '05':
            $nova_data = strtotime($data.' + 2 month');
            break;
        case '06':
            $nova_data = strtotime($data.' + 1 month');
            break;
        case '07':
            $nova_data = strtotime($data.' + 3 month');
            break;
        case '08':
            $nova_data = strtotime($data.' + 2 month');
            break;
        case '09':
            $nova_data = strtotime($data.' + 1 month');
            break;
        case '10':
            $nova_data = strtotime($data.' + 3 month');
            break;
        case '11':
            $nova_data = strtotime($data.' + 2 month');
            break;
        case '12':
            $nova_data = strtotime($data.' + 1 month');
            break;                                    
    }

    $dia_venc = date('t', $nova_data);
    $mes_venc = date('m', $nova_data);
    $ano_venc = date('Y', $nova_data);
    $venc = $ano_venc."-".$mes_venc."-".$dia_venc;    

    $dia_semana = date("w",strtotime($venc));

    if($dia_semana == 6){
        $venc = date("Y-m-d",strtotime($venc.'- 1 day'));
    }else if($dia_semana == 0){
        $venc = date("Y-m-d",strtotime($venc.'- 2 day'));
    }    

    return $venc;
}