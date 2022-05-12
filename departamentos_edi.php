<?php
include ("includes/ini.php");

$id = $_GET['id'];

$sql = "SELECT * FROM departamentos WHERE id_departamento = $id";

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

<form action="departamentos_gal.php" method="post">

    <input type="hidden" name="id" value="<?=$id?>">

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
        <label for="departamento" class="col-sm-2 col-form-label text-right"><b>Departamento</b></label>
        <div class="col-sm-8">
           <input type="text" name="departamento" class="form-control" value="<?=$row['departamento']?>" required="required">
        </div>
    </div>

    <div class="form-group row">
        <input type="submit" class="btn btn-success" value="Gravar">
    </div>
</form>

<div class="row col-sm-12">
    


    <div class="col-sm-6 alert-info text-center">

        <h3 style="margin-top: 18px">INCLUIR TELEFONES</h3>

        <form action="telefones_gra.php" method="post" class="col-sm-12">
            <input type="hidden" name="id" value="<?=$id?>">

            <div class="form-group row">
              <div class="col-sm-4 text-center"><label for="tipo"><b>Tipo</b></label></div>
              <div class="col-sm-4 text-center"><label for="numero"><b>Número</b></label></div>
              <div class="col-sm-4 text-center"><label for="usuario"><b>Usuário</b></label></div>
            </div>
            <div class="form-group row">
                <div class="col-sm-4">
                    <select class="form-control" name="tipo" required="required" style="margin-top: 8px;">
                        <option value=""></option>    
                        <option value="fixo">Fixo</option>    
                        <option value="ramal">Ramal</option>    
                        <option value="celular">Celular</option>    
                    </select>   
                </div>
                <div class="col-sm-4">
                    <input type="text" name="numero" class="form-control">
                </div>
                <div class="col-sm-4">
                    <input type="text" name="usuario" class="form-control">
                </div>
            </div>
            <div class="form-group row" style="margin:10px;">
                <div class="col-sm-4"></div> 
                <div class="col-sm-4"><input type="submit" class="btn btn-success form-control" value="Incluir Telefone"></div> 
                <div class="col-sm-4"></div> 
            </div>
        </form>

        <!-- DataTables Example -->
        <div class="card mb-3 container-fluid">
            <div class="card-header">
                <i class="fa fa-table"></i>
                Telefones do Departamento 
            </div>
            <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr class="text-center">
                            <th>Tipo</th>
                            <th>Número</th>
                            <th>Usuário</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php

                        $sql = "SELECT *
                                FROM telefones
                                WHERE ativo = 's'
                                AND id_departamento = $id
                              ";

                        $result = $conn->query($sql);
                        while ($row = $result->fetch_assoc()) {

                            ?>
                            <tr>
                                <td class="text-center"><?=strtoupper($row['tipo'])?></td>
                                <td class="text-center"><?=$row['numero']?></td>
                                <td class="text-center"><?=$row['usuario']?></td>
                                <td style="width: 200px">
                                    <a class="btn btn-warning" href="telefones_edi.php?id=<?=$row['id_telefone']?>">Editar</a> 

                                    <a class="btn btn-danger" href="javascript:if(confirm('Tem certeza que deseja excluir este registro?')){location.href='telefones_del.php?id=<?=$row['id_telefone']?>&id_departamento=<?=$id?>'}">Excluir</a>    
                                </td>
                            </tr>

                        <?php } ?>

                    </tbody>
                </table>
                </div>
            </div>
            <div class="card-footer small text-muted">Atualizado hoje às <?=date('H:m')?></div>
        </div>        


    </div>  

    <div class="col-sm-6 alert-success text-center">

        <h3 style="margin-top: 18px">INCLUIR EQUIPAMENTOS</h3>

        <form action="equipamentos_gra.php" method="post" class="col-sm-12">
            <input type="hidden" name="id" value="<?=$id?>">

            <div class="form-group row">
              <div class="col-sm-2 text-center"><label for="qtd"><b>Qtd</b></label></div>
              <div class="col-sm-4 text-center"><label for="id_equipamento"><b>Equipamento</b></label></div>
              <div class="col-sm-3 text-center"><label for="internet"><b>Internet</b></label></div>
              <div class="col-sm-3 text-center"><label for="proprio"><b>Próprio</b></label></div>
            </div>
            <div class="form-group row">
                <div class="col-sm-2">
                    <input type="text" name="qtd" class="form-control" required="required">
                </div>                
                <div class="col-sm-4">
                    <select class="form-control" name="id_equipamento" required="required" style="margin-top: 8px;">
                        <option value=""></option>   
                        <?php 
                        $sql_equip = "SELECT * FROM equipamentos WHERE ativo = 's' ORDER BY equipamento";
                        $result_equip = $conn->query($sql_equip);
                        while ($row_equip=$result_equip->fetch_assoc()) { ?>
                            <option value="<?=$row_equip['id_equipamento']?>"><?=$row_equip['equipamento']?></option>
                        <?php
                        }
                        ?> 
                            
                        <option value="ramal">Ramal</option>    
                        <option value="celular">Celular</option>    
                    </select>   
                </div>
                <div class="col-sm-3">
                    <select class="form-control" name="internet" required="required" style="margin-top: 8px;">
                        <option value=""></option>    
                        <option value="s">Sim</option>    
                        <option value="n">Não</option>    
                    </select> 
                </div>
                <div class="col-sm-3">
                    <select class="form-control" name="proprio" required="required" style="margin-top: 8px;">
                        <option value=""></option>    
                        <option value="s">Sim</option>    
                        <option value="n">Não</option>    
                    </select> 
                </div>
            </div>
            <div class="form-group row" style="margin:10px;">
                <div class="col-sm-3"></div> 
                <div class="col-sm-6"><input type="submit" class="btn btn-success form-control" value="Incluir Equipamento"></div> 
                <div class="col-sm-3"></div> 
            </div>
        </form>

        <!-- DataTables Example -->
        <div class="card mb-3 container-fluid">
            <div class="card-header">
                <i class="fa fa-table"></i>
                Equipamentos do Departamento 
            </div>
            <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr class="text-center">
                            <th>Qtd</th>
                            <th>Equipamento</th>
                            <th>Internet</th>
                            <th>Próprio</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php

                        $sql = "SELECT A.qtd, A.internet, A.proprio, B.equipamento
                                FROM depto_equip A, equipamentos B
                                WHERE A.ativo = 's'
                                AND A.id_equipamento = B.id_equipamento
                                AND id_departamento = $id
                              ";

                        $result = $conn->query($sql);
                        while ($row = $result->fetch_assoc()) {

                            ?>
                            <tr>
                                <td class="text-center"><?=$row['qtd']?></td>
                                <td class="text-center"><?=strtoupper($row['equipamento'])?></td>
                                <td class="text-center"><?=$row['internet']?></td>
                                <td class="text-center"><?=$row['proprio']?></td>
                                <td >
                                    <a class="btn btn-warning btn-block" href="equipamentos_edi.php?id=<?=$row['id_']?>">Editar</a> 

                                    <a class="btn btn-danger btn-block" href="javascript:if(confirm('Tem certeza que deseja excluir este registro?')){location.href='telefones_del.php?id=<?=$row['id_telefone']?>&id_departamento=<?=$id?>'}">Excluir</a>    
                                </td>
                            </tr>

                        <?php } ?>

                    </tbody>
                </table>
                </div>
            </div>
            <div class="card-footer small text-muted">Atualizado hoje às <?=date('H:m')?></div>
        </div>  

    </div>

</div>

<?php
include ("includes/fim.php");
?>