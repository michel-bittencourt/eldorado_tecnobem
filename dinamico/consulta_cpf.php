<?php
include('../includes/db.php');
$cpf_cnpj = $_POST['cpf_cnpj'];

$query = "SELECT id_cliente FROM clientes WHERE cpf_cnpj = '$cpf_cnpj' AND categ5 != 's'";
$result = mysqli_query($conn, $query);

$row_cnt = mysqli_num_rows($result);

if ($row_cnt > 0) {
	$row = mysqli_fetch_assoc($result);
	$id_cliente = $row['id_cliente'];
	echo $id_cliente;
}else{
	echo '0';
}



mysqli_close($conn);
?>