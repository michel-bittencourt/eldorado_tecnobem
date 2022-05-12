<?php
include ("includes/ini.php");
?>

<div class="row divisor_titulo" style="">
    <label class="col-sm-12"><h3>Relatório de Projetos</h3></label>
</div>

<form action="rel_projetos_prn.php" method="post" target="_blank">

    <div class="form-group row">
        <label for="projeto" class="col-sm-2 col-form-label text-right"><b>Nome do Projeto</b></label>
        <div class="col-sm-8">
           <input type="text" name="projeto" class="form-control">
        </div>
    </div>

    <div class="form-group row">
        <label for="secretaria" class="col-sm-2 col-form-label text-right"><b>Secretaria</b></label>
        <div class="col-sm-8">
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

    <div class="form-group row">
        <label for="inicio" class="col-sm-2 col-form-label text-right"><b>Início</b></label>
        <div class="col-sm-8">
           <input type="date" name="inicio" class="form-control">
        </div>
    </div>    

    <div class="form-group row">
        <label for="fim" class="col-sm-2 col-form-label text-right"><b>Fim</b></label>
        <div class="col-sm-8">
           <input type="date" name="fim" class="form-control">
        </div>
    </div>   

    <div class="form-group row">
        <label for="gestor" class="col-sm-2 col-form-label text-right"><b>Gestor</b></label>
        <div class="col-sm-8">
            <input type="text" name="gestor" class="form-control">
        </div>
    </div>

    <div class="form-group row">
        <label for="responsavel" class="col-sm-2 col-form-label text-right"><b>Responsável</b></label>
        <div class="col-sm-8">
            <input type="text" name="responsavel" class="form-control">
        </div>
    </div>         

    <div class="form-group row">
        <label for="descricao" class="col-sm-2 col-form-label text-right"><b>Descrição</b></label>
        <div class="col-sm-8">
            <input type="text" name="descricao" class="form-control">
        </div>
    </div>  

    <div class="form-group row">
        <label for="objetivos" class="col-sm-2 col-form-label text-right"><b>Objetivos Específicos</b></label>
        <div class="col-sm-8">
            <input type="text" name="objetivos" class="form-control">
        </div>
    </div>  

    <div class="form-group row">
        <label for="cenario" class="col-sm-2 col-form-label text-right"><b>Cenário Atual</b></label>
        <div class="col-sm-8">
            <input type="text" name="cenario" class="form-control"></textarea>
        </div>
    </div>  

    <div class="form-group row">
        <label for="justificativa" class="col-sm-2 col-form-label text-right"><b>Justificativa</b></label>
        <div class="col-sm-8">
            <input type="text" name="justificativa" class="form-control">
        </div>
    </div>  

    <div class="form-group row">
        <label for="estrategia" class="col-sm-2 col-form-label text-right"><b>Estratégia</b></label>
        <div class="col-sm-8">
            <input type="text" name="estrategia" class="form-control">
        </div>
    </div>  

    <div class="form-group row">
        <label for="qtd_pessoas" class="col-sm-2 col-form-label text-right"><b>Pessoas Beneficiadas</b></label>
        <div class="col-sm-8">
           <input type="number" name="qtd_pessoas" class="form-control">
        </div>
    </div>  

    <div class="form-group row">
        <label for="id_status" class="col-sm-2 col-form-label text-right"><b>Situação</b></label>
        <div class="col-sm-8">
           <select class="form-control" name="id_status">
               <?php
               $sql_status = "SELECT * FROM status WHERE ativo = 's' ORDER BY id_status";
               $result_status = $conn->query($sql_status);
               while($row_status = $result_status->fetch_assoc()){
               ?>   
               <option value="<?=$row_status['id_status']?>"><?=$row_status['status']?></option>
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
            <input type="text" name="iteracoes" class="form-control">
        </div>
    </div>      

    <div class="form-group row">
        <label for="envolvidos" class="col-sm-2 col-form-label text-right">
            <b>Pessoas Envolvidas</b><br>
            Informar nome, secretaria, tarefa e data prevista para finalizar
        </label>
        <div class="col-sm-8">
            <input type="text" name="envolvidos" class="form-control">
        </div>
    </div>      

    <div class="form-group row">
        <label for="orcamento" class="col-sm-2 col-form-label text-right">
            <b>Orçamento</b><br>
            Informar descrição, periodicidade (mensal ou anual), destino e valor previsto
        </label>
        <div class="col-sm-8">
            <input type="text" name="orcamento" class="form-control">
        </div>
    </div>      

    <div class="form-group row">
        <label for="obs" class="col-sm-2 col-form-label text-right"><b>Observações</b></label>
        <div class="col-sm-8">
            <input type="text" name="obs" class="form-control">
        </div>
    </div>  

    <div class="form-group row">
        <input type="submit" class="btn btn-success" value="Gerar Relatório">
    </div>
</form>

<?php
include ("includes/fim.php");
?>