<?php
include('includes/db.php');

$id         = $_POST['id'];
$fornec     = $_POST['fornec'];
$contato    = $_POST['contato'];
$fone       = $_POST['fone'];
$email      = $_POST['email'];
$obs        = $_POST['obs'];

$sql = "UPDATE fornecedores SET 
                fornec      = '$fornec',
                contato     = '$contato',
                fone        = '$fone',
                email       = '$email',
                obs         = '$obs'
        WHERE id_fornec = $id ";


    $resultado = mysqli_query($conn, $sql);

    if(mysqli_affected_rows($conn) != 0){
        header("Location: fornecedores_edi.php?m=1&id=".$id);
    }else{
        header("Location: fornecedores_edi.php?m=2&id=".$id);
    }

?>