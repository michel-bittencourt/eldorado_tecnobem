<?php
include ("includes/ini.php");
?>

<div class="row divisor_titulo" style="">
    <label class="col-sm-12"><h3>Relatório de Contratos</h3></label>
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

<form action="rel_contratos_prn.php" method="post" target="_blank">

    <div class="form-group row">
        <label for="id_secretaria" class="col-sm-1 col-form-label text-right"><b>Secretaria</b></label>
        <div class="col-sm-5">
           <select class="form-control" name="id_secretaria" >
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

        <label for="id_fornec" class="col-sm-1 col-form-label text-right"><b>Fornecedor</b></label>
        <div class="col-sm-5">
           <select class="form-control" name="id_fornec" >
               <option value=""></option>
               <?php
               $sql_fornec = "SELECT * FROM fornecedores WHERE ativo = 's' ORDER BY fornec";
               $result_fornec = $conn->query($sql_fornec);
               while($row_fornec = $result_fornec->fetch_assoc()){
               ?>   
               <option value="<?=$row_fornec['id_fornec']?>"><?=$row_fornec['fornec']?></option>
               <?php } ?>
            </select>
        </div>
    </div>

    <div class="form-group row">

        <label for="numero" class="col-sm-1 col-form-label text-right"><b>Número</b></label>
        <div class="col-sm-2">
           <input type="text" name="numero" class="form-control">
        </div>

        <label for="data_ini" class="col-sm-1 col-form-label text-right"><b>Início</b></label>
        <div class="col-sm-2">
           <input type="date" name="data_ini" class="form-control">
        </div>

        <label for="data_fim" class="col-sm-1 col-form-label text-right"><b>Término</b></label>
        <div class="col-sm-2">
           <input type="date" name="data_fim" class="form-control">
        </div>
        
        <label for="fiscal" class="col-sm-1 col-form-label text-right"><b>Fiscal</b></label>
        <div class="col-sm-2">
           <input type="text" name="fiscal" class="form-control">
        </div>

    </div>

    <div class="form-group row">
        <label for="objeto" class="col-sm-1 col-form-label text-right"><b>Objeto</b></label>
        <div class="col-sm-5">
           <textarea name="objeto" class="form-control"></textarea>
        </div>

        <label for="prorrog" class="col-sm-2 col-form-label text-right"><b>Permite prorrogação</b></label>
        <div class="col-sm-1">
           <input type="radio" name="prorrog" value="s" checked="checked"> Sim </br>
           <input type="radio" name="prorrog" value="n"> Não
        </div>

        <label for="data_prorrog" class="col-sm-1 col-form-label text-right"><b>Prazo máximo</b></label>
        <div class="col-sm-2">
           <input type="date" name="data_prorrog" class="form-control">
        </div>        

    </div>

    <div class="form-group row">
        <input type="submit" class="btn btn-success" value="Gravar">
    </div>
</form>


<?php
include ("includes/fim.php");
?>