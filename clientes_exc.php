<?php
include ("includes/ini.php");
?>

<div class="row divisor_titulo" style="">
    <label class="col-sm-12"><h3>Excluir cadastro de Cliente</h3></label>
</div>

<?php
if (isset($_POST['idCliente'])) {
	$id=$_POST['idCliente'];
    $query = "SELECT id_cliente, nome FROM clientes WHERE id_cliente=$id";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

    mysqli_free_result($result);

    if (isset($_POST['confirm']) ) {

    	$sql = "UPDATE clientes SET ativo='n' WHERE id_cliente =  $id ";

		if($query = $conn->query($sql)){ ?>
    
    		<div class="alert alert-success" role="alert">Registro excluído com sucesso!</div>

    		<a class="btn btn-primary" href="clientes_cad.php" role="button">Retornar ao cadastro de clientes</a>
    		<a class="btn btn-primary" href="painel.php" role="button">Volar à pagina inicial</a>
    	<?php
    	}else{
    		?>
		    <div class="alert alert-danger" role="alert">
		        Opa, ocorreu um erro de gravação no banco de dados!
		    </div>

		    <p>Por favor, tente novamente. Se o erro persistir, entre em contato com suporte clicando no ícone do menu. </p>

		    <a class="btn btn-primary" href="clientes_cad.php" role="button">Tentar Novamente</a>
		    <a class="btn btn-primary" href="painel.php" role="button">Volar à pagina inicial</a>

		    <?php
    	}

    }else{
	   	$pergunta = "Está certo que deseja excluir o registro do cliente ".$row['nome']."?";
	   	?>
		<div class='alert alert-warning'>
			<strong>Atenção: </strong> <?=$pergunta?>?
			<br><br>
			<div>
				<form action="clientes_exc.php" method="post">
					<input type="hidden" name="idCliente" value=<?=$id?>>
					<input type="hidden" name="confirm" value="yes">
					<button class='btn btn-danger' type='submit' >Excluir</button>
				</form>
				<form action="clientes_cad.php">
					<button class='btn btn-primary' type='submit' >Cancelar</button>
				</form>
			</div>			
		</div>
	<?php
    }


}else{?>
		    <div class="alert alert-danger" role="alert">
		        Opa, não conseguimos identificar o número do registro!
		    </div>

		    <p>Por favor, tente novamente. Se o erro persistir, entre em contato com suporte clicando no ícone do menu. </p>

		    <a class="btn btn-primary" href="clientes_cad.php" role="button">Tentar Novamente</a>
		    <a class="btn btn-primary" href="painel.php" role="button">Volar à pagina inicial</a>
<?php
}
?>


<?php
include ("includes/fim.php");
?>