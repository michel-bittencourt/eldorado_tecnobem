<?php
include('../includes/db.php');
$estado = $_POST['id_estado'];

$query = "SELECT * FROM cidades WHERE id_estado = '$estado' ORDER BY cidade";

if ($result = mysqli_query($conn, $query)) {

    /* fetch associative array */
    echo '<option value="">Selecione a Cidade...</option>';
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<option value="'.$row['id_cidade'].'">'.$row['cidade'].'</option>';
    }

    /* free result set */
    mysqli_free_result($result);
}else{
	echo  '<option value="0">'.htmlentities('Aguardando Estado...').'</option>';
}

/* close connection */
mysqli_close($conn);
?>