<?php
include ("includes/ini.php");

$id = $_GET['id'];

$sql = "SELECT * FROM projetos WHERE id_projeto = $id";

$result = $conn->query($sql);

$row = $result->fetch_assoc();

?>

<div class="row divisor_titulo" style="">
    <label class="col-sm-12"><h3>Edição do Cadastro de Projetos</h3></label>
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

<form action="projetos_gal.php" method="post">

    <input type="hidden" name="id" value="<?=$id?>">

    <div class="form-group row">
        <label for="projeto" class="col-sm-2 col-form-label text-right"><b>Nome do Projeto</b></label>
        <div class="col-sm-8">
           <input type="text" name="projeto" class="form-control" value="<?=$row['projeto']?>" required="required">
        </div>
    </div>

    <div class="form-group row">
        <label for="tipo" class="col-sm-2 col-form-label text-right"><b>Tipo</b></label>
        <div class="col-sm-8">
           <select class="form-control" name="tipo" required="required">
               <option value=""></option>
               <option value="interno" <?php if($row['tipo'] == 'interno'){echo "selected";} ?> >Interno</option>
               <option value="externo" <?php if($row['tipo'] == 'externo'){echo "selected";} ?> >Requer contratação</option>
            </select>
        </div>
    </div>    

    <div class="form-group row">
        <label for="secretaria" class="col-sm-2 col-form-label text-right"><b>Secretaria</b></label>
        <div class="col-sm-8">
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
    </div>

    <div class="form-group row">
        <label for="gestor" class="col-sm-2 col-form-label text-right"><b>Gestor</b></label>
        <div class="col-sm-8">
            <input type="text" name="gestor" class="form-control" value="<?=$row['gestor']?>" required="required">
        </div>
    </div>

    <div class="form-group row">
        <label for="id_status" class="col-sm-2 col-form-label text-right"><b>Status</b></label>
        <div class="col-sm-8">
           <select class="form-control" name="id_status" required="required">
               <?php
               $sql_status = "SELECT * FROM status WHERE ativo = 's' ORDER BY id_status";
               $result_status = $conn->query($sql_status);
               while($row_status = $result_status->fetch_assoc()){
                if($row['id_status']==$row_status['id_status']){$sel="selected";}else{$sel="";}
               ?>   
               <option value="<?=$row_status['id_status']?>" <?=$sel?> ><?=$row_status['status']?></option>
               <?php } ?>
            </select>
        </div>
    </div>

    <div class="form-group row">
        <input type="submit" class="btn btn-success" value="Gravar">
    </div>
</form>

<?php

$sql2 = "SELECT * FROM termo1 WHERE ativo = 's' ORDER BY id_termo1";
$result2 = $conn->query($sql2);
while($row2=$result2->fetch_assoc()){ 
    $tabela = $row2['tabela'];
    ?>
    
    <h3 style="margin-top:30px"><?=$row2['titulo']?></h3>
    <form action="proj_gra.php" method="POST">
        <input type="hidden" name="tabela" value="<?=$tabela?>">
        <input type="hidden" name="id_projeto" value="<?=$id?>">
        <div class="form-group row">
            <div class="col-sm-8">
               <input type="text" name="descri" class="form-control" required="required">
            </div>
            <div class="col-sm-2">
                <input type="submit" value="Incluir" class="btn btn-primary m-2">
            </div>
        </div>            
    </form>

    <table class="table">
        <?php 
        $sql3 = "SELECT * FROM $tabela WHERE ativo = 's' AND id_projeto = $id";

        $result3 = $conn->query($sql3);
        while($row3=$result3->fetch_assoc()){ 
            ?>
            <tr>
                <td><?=$row3['descri']?></td>
                <td style="width:180px">
                    <a class="btn btn-primary" href='proj_edi.php?id=<?=$row3['id']?>&tabela=<?=$tabela?>&id_projeto=<?=$id?>'>Editar</a>

                    <a class="btn btn-danger" href="javascript:if(confirm('Tem certeza que deseja excluir este registro?')){location.href='proj_del.php?id=<?=$row3['id']?>&tabela=<?=$tabela?>&id_projeto=<?=$id?>'}">Excluir</a>                      
                </td>
            </tr>
            <?php 
            } 
        ?>
    </table>

<?php 
}
?>



<?php
include ("includes/fim.php");
?>