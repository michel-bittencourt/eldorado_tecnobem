<?php
include('includes/db.php');
include ("includes/funcoes.php");

$id = $_GET['id'];

$sql = "UPDATE secretarias SET 
                ativo    = 'n'
        WHERE id_secretaria = $id ";

$conn->query($sql);

if(mysqli_affected_rows($conn) != 0){
    gravaLog("Secretarias","Excluiu",$id);
    header("Location: secretarias_cad.php?m=3");
}else{
    header("Location: secretarias_cad.php?m=2");
}

?>