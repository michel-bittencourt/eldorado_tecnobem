<?php
include ("includes/ini.php");

$id         = $_GET['id'];
$tabela     = $_GET['tabela'];
$id_projeto = $_GET['id_projeto'];

$sql = "SELECT * FROM $tabela WHERE id = $id";

$result = $conn->query($sql);

$row = $result->fetch_assoc();

?>

<div class="row divisor_titulo" style="">
    <label class="col-sm-12"><h3>Edição do projeto</h3></label>
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

<form action="proj_gal.php" method="post">

    <input type="hidden" name="id" value="<?=$id?>">
    <input type="hidden" name="tabela" value="<?=$tabela?>">
    <input type="hidden" name="id_projeto" value="<?=$id_projeto?>">

    <div class="form-group row">
        <label for="descri" class="col-sm-2 col-form-label text-right"><b>Descrição</b></label>
        <div class="col-sm-8">
           <textarea name="descri" rows="5" class="form-control" required="required"><?=$row['descri']?></textarea>
        </div>
    </div>

    <div class="form-group row">
        <input type="submit" class="btn btn-success" value="Gravar">
    </div>
</form>




<?php
include ("includes/fim.php");
?>