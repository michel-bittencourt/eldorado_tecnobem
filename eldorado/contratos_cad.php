<?php
include ("includes/ini.php");
?>

<div class="row divisor_titulo" style="">
    <label class="col-sm-12"><h3>Cadastro de Contratos</h3></label>
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

<form action="contratos_gra.php" method="post">

    <div class="form-group row">
        <label for="id_secretaria" class="col-sm-1 col-form-label text-right"><b>Secretaria</b></label>
        <div class="col-sm-5">
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

        <label for="id_fornec" class="col-sm-1 col-form-label text-right"><b>Fornecedor</b></label>
        <div class="col-sm-5">
           <select class="form-control" name="id_fornec" required="required">
               <option value=""></option>
               <?php
               $sql_fornec = "SELECT * FROM fornecedores WHERE ativo = 's' ORDER BY fornec";
               $result_fornec = $conn->query($sql_fornec);
               while($row_fornec = $result_fornec->fetch_assoc()){
               ?>   
               <option value="<?=$row_fornec['id_fornec']?>"><?=$row_fornec['fornec']?></option>
               <?php } ?>
            </select>
        </div>
    </div>

    <div class="form-group row">

        <label for="numero" class="col-sm-1 col-form-label text-right"><b>Número</b></label>
        <div class="col-sm-2">
           <input type="text" name="numero" class="form-control" required="required">
        </div>

        <label for="data_ini" class="col-sm-1 col-form-label text-right"><b>Início</b></label>
        <div class="col-sm-2">
           <input type="date" name="data_ini" class="form-control" required="required">
        </div>

        <label for="data_fim" class="col-sm-1 col-form-label text-right"><b>Término</b></label>
        <div class="col-sm-2">
           <input type="date" name="data_fim" class="form-control" required="required">
        </div>
        
        <label for="fiscal" class="col-sm-1 col-form-label text-right"><b>Fiscal</b></label>
        <div class="col-sm-2">
           <input type="text" name="fiscal" class="form-control" required="required">
        </div>

    </div>

    <div class="form-group row">
        <label for="objeto" class="col-sm-1 col-form-label text-right"><b>Objeto</b></label>
        <div class="col-sm-5">
           <textarea name="objeto" class="form-control"></textarea>
        </div>

        <label for="prorrog" class="col-sm-2 col-form-label text-right"><b>Permite prorrogação</b></label>
        <div class="col-sm-1">
           <input type="radio" name="prorrog" value="s" checked="checked"> Sim </br>
           <input type="radio" name="prorrog" value="n"> Não
        </div>

        <label for="data_prorrog" class="col-sm-1 col-form-label text-right"><b>Prazo máximo</b></label>
        <div class="col-sm-2">
           <input type="date" name="data_prorrog" class="form-control">
        </div>        

    </div>

    <div class="form-group row">
        <input type="submit" class="btn btn-success" value="Gravar">
    </div>
</form>



<div class="card mb-3 container-fluid">
    <div class="card-header">
        <i class="fa fa-table"></i>
        Cadastro de Contratos
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table id="example" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Secretaria</th>
                        <th>Fornecedor</th>
                        <th>Objeto</th>
                        <th>Início</th>
                        <th>Término</th>
                        <th>Fiscal</th>
                        <th>Permite Prorrogação</th>
                        <th>Até quando</th>                        
                        <th>Ações</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Código</th>
                        <th>Secretaria</th>
                        <th>Fornecedor</th>
                        <th>Objeto</th>
                        <th>Início</th>
                        <th>Término</th>
                        <th>Fiscal</th>
                        <th>Permite Prorrogação</th>
                        <th>Até quando</th>
                        <th>Ações</th>
                    </tr>
                </tfoot>
                <tbody>

                    <?php

                    $sql = "SELECT A.id_contrato, A.numero, A.objeto, A.data_ini, A.data_fim, A.fiscal, A.prorrog, A.data_prorrog, B.secretaria, C.fornec
                            FROM contratos A, secretarias B, fornecedores C
                            WHERE A.ativo = 's'
                            AND A.id_secretaria = B.id_secretaria
                            AND A.id_fornec = C.id_fornec
                            ORDER BY A.data_ini
                          ";

                    $result = $conn->query($sql);
                    while ($row = $result->fetch_assoc()) {

                        ?>
                        <tr class="text-center">
                            <td><?=$row['id_contrato']?></td>
                            <td><?=$row['secretaria']?></td>
                            <td><?=$row['fornec']?></td>
                            <td><?=$row['objeto']?></td>
                            <td><?=date("d/m/Y",strtotime($row['data_ini']))?></td>
                            <td><?=date("d/m/Y",strtotime($row['data_fim']))?></td>
                            <td><?=$row['fiscal']?></td>
                            <td><?php if($row['prorrog'] == 's'){echo "SIM";}else{echo "NÃO";}?></td>
                            <td><?=date("d/m/Y",strtotime($row['data_prorrog']))?></td>
                            <td style="width: 200px">
                                <a class="btn btn-primary" href="contratos_edi.php?id=<?=$row['id_contrato']?>">Editar</a>

                                <a class="btn btn-danger" href="javascript:if(confirm('Tem certeza que deseja excluir este registro?')){location.href='contratos_del.php?id=<?=$row['id_contrato']?>'}">Excluir</a>    
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