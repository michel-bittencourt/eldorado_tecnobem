<?php
include('../includes/db.php');
$cidade = $_POST['id_cidade'];

$query = "SELECT * FROM bairros WHERE id_cidade = '$cidade' ORDER BY bairro";

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