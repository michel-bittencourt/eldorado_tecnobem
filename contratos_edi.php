<?php
include ("includes/ini.php");

$id = $_GET['id'];

$sql = "SELECT A.id_contrato, A.numero, A.objeto, A.data_ini, A.data_fim, A.fiscal, A.id_secretaria, A.prorrog, A.data_prorrog, A.dias_antec, C.id_fornec, B.secretaria, C.fornec
        FROM contratos A, secretarias B, fornecedores C
        WHERE A.ativo = 's'
        AND A.id_secretaria = B.id_secretaria
        AND A.id_fornec = C.id_fornec
        AND A.id_contrato = $id;
        ";

$result = $conn->query($sql);

$row = $result->fetch_assoc();



?>

<div class="row divisor_titulo" style="">
    <label class="col-sm-12"><h3>Edição do Cadastro de Departamentos</h3></label>
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

<form action="contratos_gal.php" method="post">

    <input type="hidden" name="id" value="<?=$id?>">

    <div class="form-group row">
        <label for="id_secretaria" class="col-sm-1 col-form-label text-right"><b>Secretaria</b></label>
        <div class="col-sm-5">
           <select class="form-control" name="id_secretaria" required="required">
               <option value=""></option>
               <?php
               $sql_secret = "SELECT * FROM secretarias WHERE ativo = 's' ORDER BY secretaria";
               $result_secret = $conn->query($sql_secret);
               while($row_secret = $result_secret->fetch_assoc()){
                if($row['id_secretaria']==$row_secret['id_secretaria']){$sel="selected";}else{$sel="";}
               ?>   
               <option value="<?=$row_secret['id_secretaria']?>" <?=$sel?> ><?=$row_secret['secretaria']?></option>
               <?php } ?>
            </select>
        </div>

        <label for="id_fornec" class="col-sm-1 col-form-label text-right"><b>Fornecedor</b></label>
        <div class="col-sm-5">
           <select class="form-control" name="id_fornec" required="required">
               <option value=""></option>
               <?php
               $sql_fornec = "SELECT * FROM fornecedores WHERE ativo = 's' ORDER BY fornec";
               $result_fornec = $conn->query($sql_fornec);
               while($row_fornec = $result_fornec->fetch_assoc()){
                    if($row['id_fornec']==$row_fornec['id_fornec']){$sel="selected";}else{$sel="";}
               ?>   
               <option value="<?=$row_fornec['id_fornec']?>" <?=$sel?> > <?=$row_fornec['fornec']?></option>
               <?php } ?>
            </select>
        </div>
    </div>

    <div class="form-group row">

        <label for="numero" class="col-sm-1 col-form-label text-right"><b>Número</b></label>
        <div class="col-sm-2">
           <input type="text" name="numero" value="<?=$row['numero']?>" class="form-control" required="required">
        </div>

        <label for="data_ini" class="col-sm-1 col-form-label text-right"><b>Início</b></label>
        <div class="col-sm-2">
           <input type="date" name="data_ini" value="<?=$row['data_ini']?>" class="form-control" required="required">
        </div>

        <label for="data_fim" class="col-sm-1 col-form-label text-right"><b>Término</b></label>
        <div class="col-sm-2">
           <input type="date" name="data_fim"value="<?=$row['data_fim']?>" class="form-control" required="required">
        </div>
        
        <label for="fiscal" class="col-sm-1 col-form-label text-right"><b>Fiscal</b></label>
        <div class="col-sm-2">
           <input type="text" name="fiscal" value="<?=$row['fiscal']?>" class="form-control" required="required">
        </div>

    </div>

    <div class="form-group row">
        <label for="objeto" class="col-sm-1 col-form-label text-right"><b>Objeto</b></label>
        <div class="col-sm-5">
           <textarea name="objeto" class="form-control"><?=$row['objeto']?></textarea>
        </div>

        <label for="prorrog" class="col-sm-2 col-form-label text-right"><b>Permite prorrogação</b></label>
        <div class="col-sm-1">
           <input type="radio" name="prorrog" value="s" <?php if($row['prorrog'] == 's'){echo "checked";}?> > Sim </br>
           <input type="radio" name="prorrog" value="n" <?php if($row['prorrog'] == 'n'){echo "checked";}?> > Não
        </div>

        <label for="data_prorrog" class="col-sm-1 col-form-label text-right"><b>Prazo máximo</b></label>
        <div class="col-sm-2">
           <input type="date" name="data_prorrog" value="<?=$row['data_prorrog']?>" class="form-control">
        </div>    

    </div>

    <div class="form-group row">
        <label for="dias_antec" class="col-sm-3 col-form-label text-right"><b>Quantidade de dias para aviso</b></label>
        <div class="col-sm-1">
           <input type="number" name="dias_antec" value="<?=$row['dias_antec']?>" class="form-control">
        </div>

        <label for="arquivo" class="col-sm-2 col-form-label text-right"><b>Anexos</b></label>
        <div class="col-sm-6">
           <input type="file" name="arquivo[]" multiple="multiple">
        </div>
    </div>   

    <div class="form-group row">
        <?php
        $sql = "SELECT *
                FROM contratos_anexos
                WHERE id_contrato = $id
                ORDER BY titulo_arquivo";

                $result = $conn->query($sql);

                $dir = "anexos/contratos/".$id;

                    while ($row = $result->fetch_assoc()) {?> 
                        <div class="check_documentos">                      
                            <input type="checkbox" name="id_anexo[]" value="<?=$row['id_anexo']?>" checked="checked"> <a href='<?=$dir.'/'.$row['titulo_arquivo']?>' target='_blank'><?=$row['titulo_arquivo']?></a>
                        </div>
                    <?php }?>
                </div> 




    <div class="form-group row">
        <input type="submit" class="btn btn-success" value="Gravar">
    </div>
</form>


<?php
include ("includes/fim.php");
?>