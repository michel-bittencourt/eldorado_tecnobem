<?php
include('../includes/db.php');

$id_imovel = $_POST['id_imovel'];
$id_imoveis_prop = $_POST['id_imoveis_prop'];

$query_del = "DELETE FROM imoveis_prop
			WHERE id_imoveis_prop = $id_imoveis_prop
			";
mysqli_query($conn, $query_del);

$query = "SELECT A.id_imoveis_prop, A.id_imovel, A.id_prop, A.percent, B.id_cliente, B.nome 
			FROM imoveis_prop A, clientes B
			WHERE A.id_prop = B.id_cliente
			AND id_imovel = $id_imovel
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
    	$soma = 0;
	    while ($row = mysqli_fetch_assoc($result)) {
	        echo "		<tr>
	        				<td>{$row['id_imoveis_prop']}</td>
	        				<td>{$row['nome']}</td>
	        				<td>{$row['percent']}</td>
	        				<td>
	            				<button type='button' class='btn btn-danger' id='btn_prop' onclick='remProp({$row['id_imoveis_prop']})'>
                					<span class='glyphicon glyphicon-plus'></span> 
                 					Remover
            					</button>
					        </td>
					    </tr>";
			$soma = $soma + $row['percent'];
	    }

	    echo "</tbody></table>";

		


		$sobra = 100 - $soma;
   
	    
	    echo "<div class='alert alert-info alert-dismissible' role='alert'><b>Percentual disponível: ".$sobra."%</b></div>";


mysqli_free_result($result);

mysqli_close($conn);
?>