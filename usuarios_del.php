<?php
include('includes/db.php');

$id = $_GET['id'];

$sql = "UPDATE usuarios SET 
                ativo    = 'n'
        WHERE id_usuario = $id ";

$conn->query($sql);

if(mysqli_affected_rows($conn) != 0){
    header("Location: usuarios_cad.php?m=3&id=".$id);
}else{
    header("Location: usuarios_cad.php?m=2id=".$id);
}

?>