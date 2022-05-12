<?php
include('includes/db.php');
$id_secretaria = $_POST['id_secretaria'];

$query = "SELECT * FROM departamentos WHERE id_secretaria = '$id_secretaria' ORDER BY departamento";

if ($result = mysqli_query($conn, $query)) {

    /* fetch associative array */
    echo "<select name='id_departamento' class='form-control'>";
    echo '<option value="">Selecione o Departamento...</option>';
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<option value="'.$row['id_departamento'].'">'.$row['departamento'].'</option>';
    }
    echo "</select>";

    /* free result set */
    mysqli_free_result($result);
}else{
	echo  '<option value="0">'.htmlentities('Aguardando Secretaria...').'</option>';
}

/* close connection */
mysqli_close($conn);
?>