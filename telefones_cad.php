<?php
include ("includes/ini.php");
?>

<div class="row divisor_titulo" style="">
    <label class="col-sm-12"><h3>Cadastro de Telefones</h3></label>
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

<form action="telefones_gra.php" method="post">

    <div class="form-group row">
        <label for="id_departamento" class="col-sm-2 col-form-label text-right"><b>Departamento</b></label>
        <div class="col-sm-8">
           <select class="form-control" name="id_departamento" required="required">
               <option value=""></option>
               <?php
               $sql_depto = "SELECT A.id_departamento, A.departamento, B.sigla FROM departamentos A, secretarias B WHERE A.ativo = 's' AND A.id_secretaria = B.id_secretaria ORDER BY B.sigla, A.departamento";
               $result_depto = $conn->query($sql_depto);
               while($row_depto = $result_depto->fetch_assoc()){
               ?>   
               <option value="<?=$row_depto['id_departamento']?>"><?=$row_depto['sigla']?> - <?=$row_depto['departamento']?></option>
               <?php } ?>
            </select>
        </div>
    </div>

    <div class="form-group row">
        <label for="tipo" class="col-sm-2 col-form-label text-right"><b>Tipo</b></label>
        <div class="col-sm-8">
            <select class="form-control" name="tipo" required="required">
                <option value=""></option>    
                <option value="fixo">Fixo</option>    
                <option value="ramal">Ramal</option>    
                <option value="celular">Celular</option>    
            </select>            
        </div>
    </div>

    <div class="form-group row">
        <label for="numero" class="col-sm-2 col-form-label text-right"><b>Número</b></label>
        <div class="col-sm-8">
           <input type="text" name="numero" class="form-control" required="required">
        </div>
    </div>

    <div class="form-group row">
        <label for="usuario" class="col-sm-2 col-form-label text-right"><b>Usuário</b></label>
        <div class="col-sm-8">
            <input type="text" name="usuario" class="form-control" required="required">
        </div>
    </div>

    <div class="form-group row">
        <input type="submit" class="btn btn-success" value="Gravar">
    </div>
</form>



<div class="card mb-3 container-fluid">
    <div class="card-header">
        <i class="fas fa-table"></i>
        Cadastro de Telefones
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table id="example" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Departamento</th>
                        <th>Tipo</th>
                        <th>Número</th>
                        <th>Usuário</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Código</th>
                        <th>Departamento</th>
                        <th>Tipo</th>
                        <th>Número</th>
                        <th>Usuário</th>
                        <th>Ações</th>
                    </tr>
                </tfoot>
                <tbody>

                    <?php

                    $sql = "SELECT A.id_telefone, A.tipo, A.numero, A.usuario, B.departamento, C.sigla
                            FROM telefones A, departamentos B, secretarias C
                            WHERE A.ativo = 's'
                            AND A.id_departamento = B.id_departamento
                            AND B.id_secretaria = C.id_secretaria
                            ORDER BY A.usuario
                          ";

                    $result = $conn->query($sql);
                    while ($row = $result->fetch_assoc()) {

                        ?>
                        <tr>
                            <td class="text-center"><?=$row['id_telefone']?></td>
                            <td class="text-center"><?=$row['sigla']?> - <?=$row['departamento']?></td>
                            <td class="text-center"><?=$row['tipo']?></td>
                            <td class="text-center"><?=$row['numero']?></td>
                            <td class="text-center"><?=$row['usuario']?></td>
                            <td style="width: 170px">
                                <a class="btn btn-primary" href='telefones_edi.php?id=<?=$row['id_telefone']?>'>Editar</a>

                                <a class="btn btn-danger" href="javascript:if(confirm('Tem certeza que deseja excluir este registro?')){location.href='telefones_del.php?id=<?=$row['id_telefone']?>'}">Excluir</a>    
                            </td>
                        </tr>

                    <?php } ?>

                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer small text-muted">Atualizado hoje às <?=date('H:m')?></div>
</div>



<?php
include ("includes/fim.php");
?>