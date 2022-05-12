<?php
include('../includes/db.php');

$id_prop = $_POST['id_prop'];
$percent = $_POST['percent'];
$resp	 = $_POST['resp'];

$query = "SELECT A.id_temp_prop, A.id_prop, A.percent, A.resp, B.id_cliente, B.nome 
			FROM temp_prop A, clientes B
			WHERE A.id_prop = B.id_cliente
			";

if ($result = mysqli_query($conn, $query)) {
	$total = 0;
    while ($row = mysqli_fetch_assoc($result)) {
        $total = $total + $row['percent'];
    }

    $total2 = $total + $percent;

    if ($total2 <= 100) {
	    $grava = "INSERT INTO temp_prop (id_prop, percent, resp) VALUES ('$id_prop','$percent','$resp')";
		mysqli_query($conn, $grava);

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

		$result = mysqli_query($conn, $query);
	    while ($row = mysqli_fetch_assoc($result)) {
	        echo "		<tr>
	        				<td>{$row['id_temp_prop']}</td>
	        				<td>{$row['nome']}</td>
	        				<td>{$row['percent']}</td>
	        				<td>{$row['resp']}</td>
	        				<td>
	            				<button type='button' class='btn btn-danger' id='btn_prop' onclick='remProp({$row['id_temp_prop']})'>
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
				            <th>Editar</th>
				        </tr>
				    </thead>
				    <tbody>";

    	$result = mysqli_query($conn, $query);
	    while ($row = mysqli_fetch_assoc($result)) {
	        echo "		<tr>
	        				<td>{$row['id_temp_prop']}</td>
	        				<td>{$row['nome']}</td>
	        				<td>{$row['percent']}</td>
	        				<td>
	            				<button type='button' class='btn btn-danger' id='btn_prop' onclick='remProp({$row['id_temp_prop']})'>
                					<span class='glyphicon glyphicon-plus'></span> 
                 					Remover
            					</button>
					        </td>
					    </tr>";
	    }

	    echo "</tbody></table>";

    	echo "<div class='alert alert-danger alert-dismissible' role='alert'><b>O valor atribuido ultrapassa 100%</b></div>";
    }

    mysqli_free_result($result);

}else{
	echo htmlentities('Vazio...');
}

mysqli_close($conn);
?>