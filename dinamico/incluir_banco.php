<?php
include('../includes/db.php');

$nome = $_POST['nome_banco'];
$num  = $_POST['num_banco'];

$sql = "INSERT INTO bancos(banco,num_banco,id_usuario,id_emp) VALUES('$nome','$num','1','1')";
mysqli_query($conn, $sql);

$query = "SELECT * FROM bancos WHERE ativo = 's' ORDER BY banco";

if ($result = mysqli_query($conn, $query)) {

    /* fetch associative array */
    echo '<option value="">Selecione o Banco...</option>';
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<option value="'.$row['id_banco'].'">'.$row['banco'].'</option>';
    }

    /* free result set */
    mysqli_free_result($result);
}else{
	echo  '<option value="0">'.htmlentities('Aguardando Banco...').'</option>';
}

/* close connection */
mysqli_close($conn);
?>