<?php
include ("includes/ini.php");

$id = $_GET['id'];

$sql = "SELECT * FROM telefones WHERE id_telefone = $id";

$result = $conn->query($sql);

$row = $result->fetch_assoc();

?>

<div class="row divisor_titulo" style="">
    <label class="col-sm-12"><h3>Edição do Cadastro de Telefones</h3></label>
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

<form action="telefones_gal.php" method="post">

    <input type="hidden" name="id" value="<?=$id?>">
    <input type="hidden" name="id_departamento" value="<?=$row['id_departamento']?>">

    <div class="form-group row">
        <label for="tipo" class="col-sm-2 col-form-label text-right"><b>Tipo</b></label>
        <div class="col-sm-8">
            <select class="form-control" name="tipo" required="required">
                <option value="fixo" <?php if($row['tipo'] == 'fixo'){echo 'selected';}?> >Fixo</option>    
                <option value="ramal" <?php if($row['tipo'] == 'ramal'){echo 'selected';}?> >Ramal</option>    
                <option value="celular" <?php if($row['tipo'] == 'celular'){echo 'selected';}?> >Celular</option>    
            </select>            
        </div>
    </div>

    <div class="form-group row">
        <label for="numero" class="col-sm-2 col-form-label text-right"><b>Número</b></label>
        <div class="col-sm-8">
           <input type="text" name="numero" class="form-control" value="<?=$row['numero']?>" required="required">
        </div>
    </div>

    <div class="form-group row">
        <label for="usuario" class="col-sm-2 col-form-label text-right"><b>Usuário</b></label>
        <div class="col-sm-8">
            <input type="text" name="usuario" class="form-control" value="<?=$row['usuario']?>" required="required">
        </div>
    </div>

    <div class="form-group row">
        <input type="submit" class="btn btn-success" value="Gravar">
    </div>
</form>




<?php
include ("includes/fim.php");
?>