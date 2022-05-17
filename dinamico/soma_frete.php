<?php
$total=0;
$id = $_POST['id'];
$valor = $_POST['valor'];

session_start();

if(!isset($_SESSION['frete'])){
    $_SESSION['frete'] = array();
}

include("../includes/db.php");

$cons = 'f';
foreach ($_SESSION['frete'] as $value) {
    
    if( $id == $value['id']){
        $cons = 'v';
    }
}

if($cons == 'f'){
    $_SESSION['frete'][] = array('id'=>$id,'valor'=>$valor);
}

echo "<h4>Comissões sobre Frete</h4>";
echo "<table class='table table-striped'>";
echo "<tr class='text-center'><th>ID</th><th>Transportadora</th><th>Valor</th><th></th></tr>";

$soma=0;
foreach ($_SESSION['frete'] as $value) {

    $id_ordem = $value['id'];

    $sql = "SELECT A.apelido 
            FROM transportadoras A, ordem_carregamento B
            WHERE A.id_transp = B.id_transp
            AND B.id_ordem = $id_ordem
            ";
    $result = $conn->query($sql);
    $row=$result->fetch_assoc();

    $soma += $value['valor'];
    echo "<tr class='text-center'>
                <td>".$value['id']."</td>
                <td>".$row['apelido']."</td>
                <td>R$ ".number_format($value['valor'],'2',',','.')."</td>
                <td><button class='btn btn-danger' onclick='DelFrete(".$value['id'].")'>Remover</button></td>
            </tr>";
}
echo "<tr class='text-center'><th></th><th></th><th>R$ ".number_format($soma,'2',',','.')."</th><th></th></tr>";

echo "</table>";

echo "<button class='btn btn-success'>Lançar em Contas a Receber</button>"

?>