<?php
$total=0;
$id = $_POST['id'];
$valor = $_POST['valor'];

session_start();

if(!isset($_SESSION['comiss1'])){
    $_SESSION['comiss1'] = array();
}

include("../includes/db.php");

$cons = 'f';
foreach ($_SESSION['comiss1'] as $value) {
    
    if( $id == $value['id']){
        $cons = 'v';
    }
}

if($cons == 'f'){
    $_SESSION['comiss1'][] = array('id'=>$id,'valor'=>$valor);
}

echo "<h4>Comissões sobre Comprador</h4>";
echo "<table class='table table-striped'>";
echo "<tr class='text-center'><th>ID</th><th>Comprador</th><th>Valor</th><th></th></tr>";

$soma=0;
foreach ($_SESSION['comiss1'] as $value) {

    $id_ordem = $value['id'];

    $sql = "SELECT C.comprador 
            FROM ordem_carregamento A, contratos B, compradores C
            WHERE A.id_ordem = $id_ordem
            AND B.id_comprador = C.id_comprador
            AND A.id_contrato = B.id_contrato            
            ";

    $result = $conn->query($sql);
    $row=$result->fetch_assoc();

    $soma += $value['valor'];
    echo "<tr class='text-center'>
                <td>".$value['id']."</td>
                <td>".$row['comprador']."</td>
                <td>R$ ".number_format($value['valor'],'2',',','.')."</td>
                <td><button class='btn btn-danger' onclick='DelComiss1(".$value['id'].")'>Remover</button></td>
            </tr>";
}
echo "<tr class='text-center'><th></th><th></th><th>R$ ".number_format($soma,'2',',','.')."</th><th></th></tr>";

echo "</table>";

echo "<button class='btn btn-success'>Lançar em Contas a Receber</button>";

?>