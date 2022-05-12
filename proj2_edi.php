<?php
include ("includes/ini.php");

$id = $_GET['id'];

$sql = "SELECT * FROM projetos2 WHERE id_projeto = $id";

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
        <label for="inicio" class="col-sm-2 col-form-label text-right"><b>Início</b></label>
        <div class="col-sm-8">
           <input type="date" name="inicio" value="<?=$row['inicio']?>" class="form-control" required="required">
        </div>
    </div>    

    <div class="form-group row">
        <label for="fim" class="col-sm-2 col-form-label text-right"><b>Fim</b></label>
        <div class="col-sm-8">
           <input type="date" name="fim" value="<?=$row['fim']?>" class="form-control" required="required">
        </div>
    </div>   

    <div class="form-group row">
        <label for="gestor" class="col-sm-2 col-form-label text-right"><b>Gestor</b></label>
        <div class="col-sm-8">
            <input type="text" name="gestor" value="<?=$row['gestor']?>" class="form-control" value="<?=$row['gestor']?>" required="required">
        </div>
    </div>

    <div class="form-group row">
        <label for="responsavel" class="col-sm-2 col-form-label text-right"><b>Responsável</b></label>
        <div class="col-sm-8">
            <input type="text" name="responsavel" value="<?=$row['responsavel']?>" class="form-control" required="required">
        </div>
    </div>         

    <div class="form-group row">
        <label for="descricao" class="col-sm-2 col-form-label text-right"><b>Descrição</b></label>
        <div class="col-sm-8">
            <textarea name="descricao" class="form-control"><?=$row['descricao']?></textarea>
        </div>
    </div>  

    <div class="form-group row">
        <label for="descricao" class="col-sm-2 col-form-label text-right"><b>Objetivos Específicos</b></label>
        <div class="col-sm-8">
            <textarea name="objetivos" class="form-control"><?=$row['objetivos']?></textarea>
        </div>
    </div>  

    <div class="form-group row">
        <label for="cenario" class="col-sm-2 col-form-label text-right"><b>Cenário Atual</b></label>
        <div class="col-sm-8">
            <textarea name="cenario" class="form-control"><?=$row['cenario']?></textarea>
        </div>
    </div>  

    <div class="form-group row">
        <label for="justificativa" class="col-sm-2 col-form-label text-right"><b>Justificativa</b></label>
        <div class="col-sm-8">
            <textarea name="justificativa" class="form-control"><?=$row['justificativa']?></textarea>
        </div>
    </div>  

    <div class="form-group row">
        <label for="estrategia" class="col-sm-2 col-form-label text-right"><b>Estratégia</b></label>
        <div class="col-sm-8">
            <textarea name="estrategia" class="form-control"><?=$row['estrategia']?></textarea>
        </div>
    </div>  

    <div class="form-group row">
        <label for="qtd_pessoas" class="col-sm-2 col-form-label text-right"><b>Pessoas Beneficiadas</b></label>
        <div class="col-sm-8">
           <input type="number" name="qtd_pessoas" value="<?=$row['qtd_pessoas']?>" class="form-control">
        </div>
    </div>  

    <div class="form-group row">
        <label for="id_status" class="col-sm-2 col-form-label text-right"><b>Situação</b></label>
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
        <label for="iteracoes" class="col-sm-2 col-form-label text-right">
            <b>Iterações</b><br>
            Informar responsável, descrição da tarefa e data prevista para final
        </label>
        <div class="col-sm-8">
            <textarea name="iteracoes" class="form-control"><?=$row['iteracoes']?></textarea>
        </div>
    </div>      

    <div class="form-group row">
        <label for="envolvidos" class="col-sm-2 col-form-label text-right">
            <b>Pessoas Envolvidas</b><br>
            Informar nome, secretaria, tarefa e data prevista para finalizar
        </label>
        <div class="col-sm-8">
            <textarea name="envolvidos" class="form-control"><?=$row['envolvidos']?></textarea>
        </div>
    </div>      

    <div class="form-group row">
        <label for="orcamento" class="col-sm-2 col-form-label text-right">
            <b>Orçamento</b><br>
            Informar descrição, periodicidade (mensal ou anual), destino e valor previsto
        </label>
        <div class="col-sm-8">
            <textarea name="orcamento" class="form-control"><?=$row['orcamento']?></textarea>
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