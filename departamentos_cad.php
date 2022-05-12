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

<form action="departamentos_gra.php" method="post">

    <div class="form-group row">
        <label for="secretaria" class="col-sm-2 col-form-label text-right"><b>Secretaria</b></label>
        <div class="col-sm-8">
           <select class="form-control" name="id_secretaria" required="required">
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
        <div class="col-sm-8">
           <input type="text" name="departamento" class="form-control" required="required">
        </div>
    </div>

    <div class="form-group row">
        <input type="submit" class="btn btn-success" value="Gravar">
    </div>
</form>



<div class="card mb-3 container-fluid">
    <div class="card-header">
        <i class="fa fa-table"></i>
        Cadastro de Departamentos
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table id="example" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Departamento</th>
                        <th>Secretaria</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Código</th>
                        <th>Departamento</th>
                        <th>Secretaria</th>
                        <th>Ações</th>
                    </tr>
                </tfoot>
                <tbody>

                    <?php

                    $sql = "SELECT A.id_departamento, A.departamento, B.secretaria
                            FROM departamentos A, secretarias B
                            WHERE A.ativo = 's'
                            AND A.id_secretaria = B.id_secretaria
                            ORDER BY A.departamento
                          ";

                    $result = $conn->query($sql);
                    while ($row = $result->fetch_assoc()) {

                        ?>
                        <tr>
                            <td class="text-center"><?=$row['id_departamento']?></td>
                            <td class="text-center"><?=$row['departamento']?></td>
                            <td class="text-center"><?=$row['secretaria']?></td>
                            <td style="width: 200px">
                                <a class="btn btn-primary" href="departamentos_edi.php?id=<?=$row['id_departamento']?>">Editar</a>

                                <a class="btn btn-danger" href="javascript:if(confirm('Tem certeza que deseja excluir este registro?')){location.href='departamentos_del.php?id=<?=$row['id_departamento']?>'}">Excluir</a>    
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