<?php
include('../includes/db.php');

$id_temp_prop = $_POST['id_temp_prop'];

$query_del = "DELETE FROM temp_prop
			WHERE id_temp_prop = $id_temp_prop
			";
mysqli_query($conn, $query_del);

$query = "SELECT A.id_temp_prop, A.id_prop, A.percent, B.id_cliente, B.nome 
			FROM temp_prop A, clientes B
			WHERE A.id_prop = B.id_cliente
			";

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


mysqli_free_result($result);

mysqli_close($conn);
?>