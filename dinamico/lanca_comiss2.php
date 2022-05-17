<?php
$total=0;
session_start();

if(isset($_SESSION['comiss2'])){

    include("../includes/db.php");
    include("../includes/funcoes.php");

    $historico = "RECEBIMENTO DE COMISSÃO SOBRE CARGA VENDEDOR: ";
    $soma = 0;
    $i=0;
    foreach ($_SESSION['comiss2'] as $value) {
    
        $historico .= $value['id'];
        $historico .= " ";
        $soma += $value['valor'];

        $sql1 = "UPDATE ordem_carregamento SET lancado_comiss2 = 's' WHERE id_ordem = ".$value['id'];

        $conn->query($sql1);

        if($i == 0){$id_ordem = $value['id'];}
        $i+=1;
    }

    $_SESSION['comiss2']=null;

    //$id_transp = ConsultaTransp($id_ordem);
    //$id_comprador = ConsultaComprador($id_ordem);
    $id_vendedor = ConsultaVendedor($id_ordem);

    $data_cad = date("Y-m-d");
    $tipo = 2;

    $qtdDias = 5;

    $vencimento = date('Y-m-d', strtotime("+{$qtdDias} days",strtotime($data_cad)));

    $valor = $soma;
    $descri = $historico;
    $id_ccusto = 1;
    $id_conta = 3;
    $situacao = 0;

    $sql2 = "INSERT INTO financeiro (data_cad, tipo, id_fornec, id_comprador, id_vendedor, id_transp, vencimento, valor, acrescimos, descontos, descri, data_pgto, valor_pgto, id_ccusto, id_conta_receber, situacao) 
            VALUES ('$data_cad', '$tipo', '0', '0', '$id_vendedor', '0', '$vencimento', '$valor', '0', '0', '$descri', '0000-00-00', '0', '$id_ccusto', '$id_conta', '$situacao')";
    
    $conn->query($sql2);


    echo "Lançamento de R$ ".number_format($soma,'2',',','.')." incluído com sucesso, com previsão de baixa para o dia ".date('d/m/Y',strtotime($vencimento));
    echo "<br><br>";

    echo "<input type='button' class='btn btn-success' value='Atualizar Tabela' onClick='window.location.reload()''>";

}else{
    echo "Nenhum dado armazenado para comissão Vendedor";
}

?>