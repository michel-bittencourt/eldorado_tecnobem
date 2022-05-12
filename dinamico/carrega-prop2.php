<?php
include('../includes/db.php');

$id_imovel 	= $_POST['id_imovel'];
$id_prop 	= $_POST['id_prop'];
$percent 	= $_POST['percent'];
$resp	 	= $_POST['resp'];
$data_alt   = date("Y/m/d");

$query_prop2 = "SELECT A.id_imoveis_prop, A.id_prop, A.percent, A.resp, B.id_cliente, B.nome
                                        FROM imoveis_prop A, clientes B 
                                        WHERE A.id_imovel = $id_imovel
                                        AND A.id_prop = B.id_cliente
			";

if ($result_prop2 = mysqli_query($conn, $query_prop2)) {
	$total = 0;
    while ($row = mysqli_fetch_assoc($result_prop2)) {
        $total = $total + $row['percent'];
    }

    $total2 = $total + $percent;

    if ($total2 <= 100) {
	    $grava = "INSERT INTO imoveis_prop (id_imovel, id_prop, percent, resp, data_alt) VALUES ('$id_imovel','$id_prop','$percent', '$resp', '$data_alt')";

		mysqli_query($conn, $grava);

        if ($resp == 's') {
            $sql_prop_resp = "UPDATE imoveis SET id_prop_resp = $id_prop WHERE id_imovel = $id_imovel";
            $query = $conn->query($sql_prop_resp);
        }		

		echo "	<table class='table table-striped'>
				    <thead>
				        <tr>
				            <th>#</th>
				            <th>Nome</th>
				            <th>Percentual de participação</th>
				            <th>Responsável</th>
				            <th>Editar</th>
				        </tr>
				    </thead>
				    <tbody>";

		$result_prop2 = mysqli_query($conn, $query_prop2);
	    while ($row_prop2 = mysqli_fetch_assoc($result_prop2)) {
	        echo "		<tr>
	        				<td>{$row_prop2['id_imoveis_prop']}</td>
	        				<td>{$row_prop2['nome']}</td>
	        				<td>{$row_prop2['percent']}</td>
	        				<td>{$row_prop2['resp']}</td>
	        				<td>
	            				<button type='button' class='btn btn-danger' id='btn_prop' onclick='remProp2({$id_imovel},{$row_prop2['id_imoveis_prop']})'>
                					<span class='glyphicon glyphicon-plus'></span> 
                 					Remover
            					</button>
					        </td>
					    </tr>";

	    }

	    echo "</tbody></table>";

	    $sobra = 100 - $total2;
	    
	    echo "<div class='alert alert-info alert-dismissible' role='alert'><b>Percentual disponível: ".$sobra."%</b></div>";
    }else{

		echo "	<table class='table table-striped'>
				    <thead>
				        <tr>
				            <th>#</th>
				            <th>Nome</th>
				            <th>Percentual de participação</th>
				            <th>Responsável</th>
				            <th>Editar</th>
				        </tr>
				    </thead>
				    <tbody>";

    	$result_prop2 = mysqli_query($conn, $query_prop2);
	    while ($row_prop2 = mysqli_fetch_assoc($result_prop2)) {
	        echo "		<tr>
	        				<td>{$row_prop2['id_imoveis_prop']}</td>
	        				<td>{$row_prop2['nome']}</td>
	        				<td>{$row_prop2['percent']}</td>
	        				<td>{$row_prop2['resp']}</td>
	            				<button type='button' class='btn btn-danger' id='btn_prop' onclick='remProp2({$row_prop2['id_imoveis_prop']})'>
                					<span class='glyphicon glyphicon-plus'></span> 
                 					Remover
            					</button>
					        </td>
					    </tr>";
	    }

	    echo "</tbody></table>";

    	echo "<div class='alert alert-danger alert-dismissible' role='alert'><b>O valor atribuido ultrapassa 100%</b></div>";
    }

    mysqli_free_result($result_prop2);

}else{
	echo htmlentities('Vazio...');
}


?>