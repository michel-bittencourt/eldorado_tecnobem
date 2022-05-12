<?php 
include("includes/ini.php");

$sql = "SELECT A.vencimento, B.cpf_cnpj, B.nome 
        FROM lancamentos A, clientes B
        WHERE A.id_inquilino = B.id_cliente
        ORDER BY B.nome";

$result_lancam = $conn->query($sql);

while ($row = $result_lancam->fetch_assoc()){

    // Cria um objeto sobre a classe
    $cpf_cnpj = new ValidaCPFCNPJ($row['cpf_cnpj']);

    // Opção de CPF ou CNPJ formatado no padrão
    $formatado = $cpf_cnpj->formata();

    // Verifica se o CPF ou CNPJ é válido
    if ( $formatado ) {
        echo $formatado; // 71.569.042/0001-96
    } else {
        echo $row['nome']." - ".$row['cpf_cnpj'];
    } 

    echo "<br>";
}   

include("includes/fim.php");
?>