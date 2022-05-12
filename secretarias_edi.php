<?php
include ("includes/ini.php");

$id = $_GET['id'];

$sql = "SELECT * FROM secretarias WHERE id_secretaria = $id";

$result = $conn->query($sql);

$row = $result->fetch_assoc();

?>

<div class="row divisor_titulo" style="">
    <label class="col-sm-12"><h3>Edição do Cadastro de Secretarias</h3></label>
</div>

<?php
if (isset($_GET['m'])) {
    $m = $_GET['m'];
    if ($m == '1') {
        echo "<div class='alert alert-success' role='alert'>Registro alterado com sucesso!</div>";
    }else if ($m == '2') {
        echo "<div class='alert alert-danger' role='alert'>Registro não gravou!</div>";
    }
}

?>

<form action="secretarias_gal.php" method="post">

    <input type="hidden" name="id" value="<?=$id?>">

    <div class="form-group row">
        <label for="secretaria" class="col-sm-2 col-form-label text-right"><b>Secretaria</b></label>
        <div class="col-sm-8">
           <input type="text" name="secretaria" class="form-control" value="<?=$row['secretaria']?>" required="required">
        </div>
    </div>

    <div class="form-group row">
        <label for="sigla" class="col-sm-2 col-form-label text-right"><b>Sigla</b></label>
        <div class="col-sm-8">
            <input type="text" name="sigla" class="form-control" value="<?=$row['sigla']?>" required="required">
        </div>
    </div>

    <div class="form-group row">
        <label for="fone" class="col-sm-2 col-form-label text-right"><b>Telefone Principal</b></label>
        <div class="col-sm-8">
           <input type="text" name="fone" class="form-control" value="<?=$row['fone']?>" required="required">
        </div>
    </div>

    <div class="form-group row">
        <label for="email" class="col-sm-2 col-form-label text-right"><b>E-mail</b></label>
        <div class="col-sm-8">
           <input type="text" name="email" class="form-control" value="<?=$row['email']?>" required="required">
        </div>
    </div>

    <div class="form-group row">
        <label for="endereco" class="col-sm-2 col-form-label text-right"><b>Endereço</b></label>
        <div class="col-sm-8">
           <input type="text" name="endereco" class="form-control" value="<?=$row['endereco']?>" required="required">
        </div>
    </div>        

    <div class="form-group row">
        <label for="gestor" class="col-sm-2 col-form-label text-right"><b>Gestor</b></label>
        <div class="col-sm-8">
           <input type="text" name="gestor" class="form-control" value="<?=$row['gestor']?>" required="required">
        </div>
    </div>        

    <div class="form-group row">
        <input type="submit" class="btn btn-success" value="Gravar">
    </div>
</form>




<?php
include ("includes/fim.php");
?>