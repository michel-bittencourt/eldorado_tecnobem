<?php
include ("includes/ini.php");
?>

<div class="row divisor_titulo" style="">
    <label class="col-sm-12"><h3>Cadastro de Departamentos</h3></label>
</div>

<?php
if (isset($_GET['m'])) {
    $m = $_GET['m'];
    if ($m == '1') {
        echo "<div class='alert alert-success' role='alert'>Registro gravado com sucesso!</div>";
    }else if ($m == '2') {
        echo "<div class='alert alert-danger' role='alert'>Registro não gravou!</div>";
    }else if ($m == '3') {
        echo "<div class='alert alert-danger' role='alert'>Registro excluído com sucesso!</div>";
    }
}

?>

<form action="relatorio_prn.php" method="post" target="_blank">

    <div class="form-group row">
        <label for="secretaria" class="col-sm-2 col-form-label text-right"><b>Secretaria</b></label>
        <div class="col-sm-8">
           <select class="form-control" name="id_secretaria" id="id_secretaria" required="required">
               <option value=""></option>
               <?php
               $sql_secret = "SELECT * FROM secretarias WHERE ativo = 's' ORDER BY secretaria";
               $result_secret = $conn->query($sql_secret);
               while($row_secret = $result_secret->fetch_assoc()){
               ?>   
               <option value="<?=$row_secret['id_secretaria']?>"><?=$row_secret['secretaria']?></option>
               <?php } ?>
            </select>
        </div>
    </div>

    <div class="form-group row">
        <label for="departamento" class="col-sm-2 col-form-label text-right"><b>Departamento</b></label>
        <div class="col-sm-8" id="depto">
           
        </div>
    </div>

    <div class="form-group row">
        <input type="submit" class="btn btn-success" value="Gravar">
    </div>
</form>



<?php
include ("includes/fim.php");
?>