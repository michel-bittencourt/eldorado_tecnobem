<?php
include ("includes/ini.php");
?>

<div class="row divisor_titulo" style="">
    <label class="col-sm-12"><h3>Realtório de Usuários</h3></label>
</div>

<form action="rel_usuarios_prn.php" method="post" target="_blank">
    
    <div class="form-group row">
        <label for="nome" class="col-sm-2 col-form-label">Nome</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome do usuario">
        </div>
    </div>

    <div class="form-group row">
        <label for="usuario" class="col-sm-2 col-form-label">Usuário</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="usuario" name="usuario" placeholder="Usuário para login">
        </div>
    </div>

    <div class="form-group row">
        <label for="secretaria" class="col-sm-2 col-form-label text-right"><b>Secretaria</b></label>
        <div class="col-sm-10">
           <select class="form-control" name="id_secretaria">
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

    <div class="btn-group btn-group-justified" role="group" aria-label="...">
        <div class="btn-group" role="group">
            <button type="submit" class="btn btn-primary" >
                <span class="fa fa-save"></span> 
                Gerar Relatório
            </button>
        </div>
        <div class="btn-group" role="group">
            <button type="reset" class="btn btn-secondary">
                <span class="fa fa-eraser"></span> 
                Limpar
            </button>
        </div>
    </div>

</form>


<?php
include ("includes/fim.php");
?>