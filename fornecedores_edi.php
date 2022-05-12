<?php
include ("includes/ini.php");

$id = $_GET['id'];

$sql = "SELECT * FROM fornecedores WHERE id_fornec = $id";

$result = $conn->query($sql);

$row = $result->fetch_assoc();

?>

<div class="row divisor_titulo" style="">
    <label class="col-sm-12"><h3>Edição do Cadastro de Fornecedores</h3></label>
</div>

<?php
if (isset($_GET['m'])) {
    $m = $_GET['m'];
    if ($m == '1') {
        echo "<div class='alert alert-success' role='alert'>Registro alterado com sucesso!</div>";
    }else if ($m == '2') {
        echo "<div class='alert alert-danger' role='alert'>Registro não gravou!</div>";
    }else if ($m == '3') {
        echo "<div class='alert alert-success' role='alert'>Registro excluído com sucesso!</div>";
    }
}

?>

<form action="fornecedores_gal.php" method="post">

    <input type="hidden" name="id" value="<?=$id?>">

    <div class="form-group row">
        <label for="fornec" class="col-sm-2 col-form-label text-right"><b>Fornecedor</b></label>
        <div class="col-sm-8">
           <input type="text" name="fornec" value="<?=$row['fornec']?>" class="form-control" required="required">
        </div>
    </div>

    <div class="form-group row">
        <label for="contato" class="col-sm-2 col-form-label text-right"><b>Contato</b></label>
        <div class="col-sm-8">
           <input type="text" name="contato" value="<?=$row['contato']?>" class="form-control" required="required">
        </div>
    </div>

    <div class="form-group row">
        <label for="fone" class="col-sm-2 col-form-label text-right"><b>Telefone</b></label>
        <div class="col-sm-8">
           <input type="text" name="fone" value="<?=$row['fone']?>" class="form-control" required="required">
        </div>
    </div>

    <div class="form-group row">
        <label for="email" class="col-sm-2 col-form-label text-right"><b>E-mail</b></label>
        <div class="col-sm-8">
           <input type="text" name="email" value="<?=$row['email']?>" class="form-control">
        </div>
    </div>

    <div class="form-group row">
        <label for="obs" class="col-sm-2 col-form-label text-right"><b>Observações</b></label>
        <div class="col-sm-8">
           <textarea name="obs" class="form-control"><?=$row['obs']?></textarea>
        </div>
    </div>

    <div class="form-group row">
        <input type="submit" class="btn btn-success" value="Gravar">
    </div>
</form>


<?php
include ("includes/fim.php");
?>