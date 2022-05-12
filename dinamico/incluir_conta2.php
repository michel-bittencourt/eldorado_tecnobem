<?php
include('../includes/db.php');

$nome = $_POST['nome_conta'];

$sql = "INSERT INTO cad_contas(nome_conta,tipo,id_usuario,id_emp) VALUES('$nome','2','1','1')";
mysqli_query($conn, $sql);

$query = "SELECT * FROM cad_contas WHERE ativo = 's' AND tipo='2' ORDER BY nome_conta";

if ($result = mysqli_query($conn, $query)) {

    /* fetch associative array */
    echo '<option value="">Selecione a Conta...</option>';
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<option value="'.$row['id_conta'].'">'.$row['nome_conta'].'</option>';
    }

    /* free result set */
    mysqli_free_result($result);
}

/* close connection */
mysqli_close($conn);
?>