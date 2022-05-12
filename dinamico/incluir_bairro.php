<?php
include('../includes/db.php');

$nome = $_POST['nome_bairro'];
$id_cidade  = $_POST['id_cidade'];

$sql = "INSERT INTO bairros(bairro,id_cidade,id_usuario,id_emp) VALUES('$nome','$id_cidade','1','1')";
mysqli_query($conn, $sql);

$query = "SELECT * FROM bairros WHERE ativo = 's' AND id_cidade='$id_cidade' ORDER BY bairro";

if ($result = mysqli_query($conn, $query)) {

    /* fetch associative array */
    echo '<option value="">Selecione o Bairro...</option>';
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<option value="'.$row['id_bairro'].'">'.$row['bairro'].'</option>';
    }

    /* free result set */
    mysqli_free_result($result);
}else{
	echo  '<option value="0">'.htmlentities('Aguardando Cidade...').'</option>';
}

/* close connection */
mysqli_close($conn);
?>