<?php
include('../includes/db.php');

$nome = $_POST['nome_fornec'];

$data_cad       = date("Y/m/d");

$sql = "INSERT INTO clientes(nome,tipo,categ1,id_usuario,id_emp,data_cad) VALUES('$nome','2','s','1','1','$data_cad')";
mysqli_query($conn, $sql);

$query = "SELECT id_cliente, nome FROM clientes WHERE ativo = 's' AND categ5 != 's' ORDER BY nome";

if ($result = mysqli_query($conn, $query)) {

    /* fetch associative array */
    echo '<option value="">Selecione o Fornecedor...</option>';
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<option value="'.$row['id_cliente'].'">'.$row['nome'].'</option>';
    }

    /* free result set */
    mysqli_free_result($result);
}

/* close connection */
mysqli_close($conn);
?>