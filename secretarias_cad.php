<?php
include ("includes/ini.php");
?>

<div class="row divisor_titulo" style="">
    <label class="col-sm-12"><h3>Cadastro de Secretarias</h3></label>
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

<form action="secretarias_gra.php" method="post">

    <div class="form-group row">
        <label for="secretaria" class="col-sm-2 col-form-label text-right"><b>Secretaria</b></label>
        <div class="col-sm-8">
           <input type="text" name="secretaria" class="form-control" required="required">
        </div>
    </div>

    <div class="form-group row">
        <label for="fone" class="col-sm-2 col-form-label text-right"><b>Telefone Principal</b></label>
        <div class="col-sm-8">
           <input type="text" name="fone" class="form-control" required="required">
        </div>
    </div>

    <div class="form-group row">
        <label for="email" class="col-sm-2 col-form-label text-right"><b>E-mail</b></label>
        <div class="col-sm-8">
           <input type="text" name="email" class="form-control" required="required">
        </div>
    </div>    

    <div class="form-group row">
        <label for="endereco" class="col-sm-2 col-form-label text-right"><b>Endereço</b></label>
        <div class="col-sm-8">
           <input type="text" name="endereco" class="form-control" required="required">
        </div>
    </div>        

    <div class="form-group row">
        <label for="gestor" class="col-sm-2 col-form-label text-right"><b>Gestor</b></label>
        <div class="col-sm-8">
           <input type="text" name="gestor" class="form-control" required="required">
        </div>
    </div>    

    <div class="form-group row">
        <label for="sigla" class="col-sm-2 col-form-label text-right"><b>Sigla</b></label>
        <div class="col-sm-8">
            <input type="text" name="sigla" class="form-control" required="required">
        </div>
    </div>

    <div class="form-group row">
        <input type="submit" class="btn btn-success" value="Gravar">
    </div>
</form>



<div class="card mb-3 container-fluid">
    <div class="card-header">
        <i class="fas fa-table"></i>
        Cadastro de Secretarias
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table id="example" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Secretaria</th>
                        <th>Sigla</th>
                        <th>Telefone</th>
                        <th>E-mail</th>
                        <th>Endereço</th>
                        <th>Gestor</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Código</th>
                        <th>Secretaria</th>
                        <th>Sigla</th>
                        <th>Telefone</th>
                        <th>E-mail</th>
                        <th>Endereço</th>
                        <th>Gestor</th>
                        <th>Ações</th>
                    </tr>
                </tfoot>
                <tbody>

                    <?php

                    $sql = "SELECT *
                            FROM secretarias
                            WHERE ativo = 's'
                            ORDER BY secretaria
                          ";

                    $result = $conn->query($sql);
                    while ($row = $result->fetch_assoc()) {

                        ?>
                        <tr>
                            <td class="text-center"><?=$row['id_secretaria']?></td>
                            <td class="text-center"><?=$row['secretaria']?></td>
                            <td class="text-center"><?=$row['sigla']?></td>
                            <td class="text-center"><?=$row['fone']?></td>
                            <td class="text-center"><?=$row['email']?></td>
                            <td class="text-center"><?=$row['endereco']?></td>
                            <td class="text-center"><?=$row['gestor']?></td>
                            <td style="width: 200px">
                                <a class="btn btn-primary" href="secretarias_edi.php?id=<?=$row['id_secretaria']?>">Editar</a>

                                <a class="btn btn-danger" href="javascript:if(confirm('Tem certeza que deseja excluir este registro?')){location.href='secretarias_del.php?id=<?=$row['id_secretaria']?>'}">Excluir</a>    
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