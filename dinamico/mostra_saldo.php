<?php
include('includes/db.php');

$query = "SELECT id_conta_corrente, nome_conta_corrente
			FROM conta_corrente
			WHERE ativo = 's'
			ORDER BY nome_conta_corrente";
if ($result = mysqli_query($conn, $query)) {
    while ($row = mysqli_fetch_assoc($result)) {
        $id_conta = $row['id_conta_corrente'];
        $sql = "SELECT valor FROM caixa WHERE situacao = '1' AND pag_conta = '$id_conta'";
        if ($result2 = mysqli_query($conn, $sql)) {
			$saldo = 0;
        	while ($row2 = mysqli_fetch_assoc($result2)) {
        		$saldo = $saldo + $row2['valor'];
        	}
        	echo $row['nome_conta_corrente'].": <b>R$ ".number_format($saldo,'2',',','.')."</b><br>";
        	mysqli_free_result($result2);
        }
    }
    mysqli_free_result($result);
}
?>