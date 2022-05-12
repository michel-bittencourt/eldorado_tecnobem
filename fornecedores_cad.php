<?php
include ("includes/ini.php");
?>

<div class="row divisor_titulo" style="">
    <label class="col-sm-12"><h3>Cadastro de Fornecedores</h3></label>
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

<form action="fornecedores_gra.php" method="post">

    <div class="form-group row">
        <label for="fornec" class="col-sm-2 col-form-label text-right"><b>Fornecedor</b></label>
        <div class="col-sm-8">
           <input type="text" name="fornec" class="form-control" required="required">
        </div>
    </div>

    <div class="form-group row">
        <label for="contato" class="col-sm-2 col-form-label text-right"><b>Contato</b></label>
        <div class="col-sm-8">
           <input type="text" name="contato" class="form-control" required="required">
        </div>
    </div>

    <div class="form-group row">
        <label for="fone" class="col-sm-2 col-form-label text-right"><b>Telefone</b></label>
        <div class="col-sm-8">
           <input type="text" name="fone" class="form-control" required="required">
        </div>
    </div>

    <div class="form-group row">
        <label for="email" class="col-sm-2 col-form-label text-right"><b>E-mail</b></label>
        <div class="col-sm-8">
           <input type="text" name="email" class="form-control">
        </div>
    </div>

    <div class="form-group row">
        <label for="obs" class="col-sm-2 col-form-label text-right"><b>Observações</b></label>
        <div class="col-sm-8">
           <textarea name="obs" class="form-control"></textarea>
        </div>
    </div>

    <div class="form-group row">
        <input type="submit" class="btn btn-success" value="Gravar">
    </div>
</form>



<div class="card mb-3 container-fluid">
    <div class="card-header">
        <i class="fa fa-table"></i>
        Cadastro de Fornecedores
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table id="example" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Nome</th>
                        <th>Contato</th>
                        <th>Telefone</th>
                        <th>E-mail</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Código</th>
                        <th>Nome</th>
                        <th>Contato</th>
                        <th>Telefone</th>
                        <th>E-mail</th>
                        <th>Ações</th>
                    </tr>
                </tfoot>
                <tbody>

                    <?php

                    $sql = "SELECT id_fornec, fornec, contato, fone, email
                            FROM fornecedores
                            WHERE ativo = 's'
                            ORDER BY fornec
                          ";

                    $result = $conn->query($sql);
                    while ($row = $result->fetch_assoc()) {

                        ?>
                        <tr>
                            <td class="text-center"><?=$row['id_fornec']?></td>
                            <td class="text-center"><?=$row['fornec']?></td>
                            <td class="text-center"><?=$row['contato']?></td>
                            <td class="text-center"><?=$row['fone']?></td>
                            <td class="text-center"><?=$row['email']?></td>
                            <td style="width: 200px">
                                <a class="btn btn-primary" href="fornecedores_edi.php?id=<?=$row['id_fornec']?>">Editar</a>

                                <a class="btn btn-danger" href="javascript:if(confirm('Tem certeza que deseja excluir este registro?')){location.href='fornecedores_del.php?id=<?=$row['id_fornec']?>'}">Excluir</a>    
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