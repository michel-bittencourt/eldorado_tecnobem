<?php
include ("includes/db.php");
include ("includes/funcoes.php");

$id             = filter_input(INPUT_POST, 'id'); 
$secretaria     = filter_input(INPUT_POST, 'secretaria'); 
$sigla          = strtoupper(filter_input(INPUT_POST, 'sigla')); 
$fone           = filter_input(INPUT_POST, 'fone'); 
$endereco       = filter_input(INPUT_POST, 'endereco'); 
$gestor         = filter_input(INPUT_POST, 'gestor'); 
$email          = filter_input(INPUT_POST, 'email'); 

$sql = "UPDATE secretarias SET 
                        secretaria='$secretaria',
                        sigla='$sigla',
                        fone='$fone',
                        endereco='$endereco',
                        gestor='$gestor',
                        email='$email'   
            WHERE id_secretaria = $id";

$conn->query($sql);

if(mysqli_affected_rows($conn) != 0){
    gravaLog("Secretarias","Alterou",$id);
    header("Location: secretarias_edi.php?m=1&id=".$id);
}else{
    header("Location: secretarias_edi.php?m=2&id=".$id);
}

?>