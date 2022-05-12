<?php
include ("includes/ini_print.php");

if(isset($_POST['id_secretaria']) && $_POST['id_secretaria'] != ""){
    $var_secretaria = " AND A.id_secretaria = ".$_POST['id_secretaria'];
}else{
    $var_secretaria = "";
}

if(isset($_POST['id_fornec']) && $_POST['id_fornec'] != ""){
    $var_fornec = " AND A.id_fornec = ".$_POST['id_fornec'];
}else{
    $var_fornec = "";
}

if(isset($_POST['numero']) && $_POST['numero'] != ""){
    $var_numero = " AND A.numero = '".$_POST['numero']."' ";
}else{
    $var_numero = "";
}


if(isset($_POST['data_ini']) && $_POST['data_ini'] != ""){
    $hoje = date("Y-m-d");
    $data_ini     = $_POST['data_ini'];
    if(isset($_POST['data_fim']) && $_POST['data_fim'] != ""){
        $data_fim = $_POST['data_fim'];
    }else{
        $data_fim = $hoje;
    }   
    $var_data = " AND A.data_ini BETWEEN '".$data_ini."' AND '".$data_fim."'";
}else{
    $var_data = "";
}

if(isset($_POST['fiscal']) && $_POST['fiscal'] != ""){
    $var_fiscal = " AND A.fiscal LIKE '%".$_POST['fiscal']."%'";
}else{
    $var_fiscal = "";
}

if(isset($_POST['objeto']) && $_POST['objeto'] != ""){
    $var_objeto = " AND A.objeto LIKE '%".$_POST['objeto']."%'";
}else{
    $var_objeto = "";
}

if(isset($_POST['prorrog']) && $_POST['prorrog'] != ""){
    $var_prorrog = " AND A.prorrog = '".$_POST['prorrog']."' ";
}else{
    $var_prorrog = "";
}

if(isset($_POST['data_prorrog']) && $_POST['data_prorrog'] != ""){
    $var_data_prorrog = " AND A.data_prorrog = '".$_POST['data_prorrog']."' ";
}else{
    $var_data_prorrog = "";
}
?>


<div class="card mb-3 container-fluid">
    <div class="card-header">
        <h3>Cadastro de Contratos</h3>
        
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Secretaria</th>
                        <th>Fornecedor</th>
                        <th>Número</th>
                        <th>Início</th>
                        <th>Término</th>
                        <th>Fiscal</th>
                        <th>Objeto</th>
                        <th>Prorrog</th>
                        <th>Máximo</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Código</th>
                        <th>Secretaria</th>
                        <th>Fornecedor</th>
                        <th>Número</th>
                        <th>Início</th>
                        <th>Término</th>
                        <th>Fiscal</th>
                        <th>Objeto</th>
                        <th>Prorrog</th>
                        <th>Máximo</th>
                    </tr>
                </tfoot>
                <tbody>

                    <?php

                    $sql = "SELECT A.id_contrato, A.numero, A.data_ini, A.data_fim, A.prorrog, A.data_prorrog, A.objeto, A.fiscal, B.secretaria, C.fornec
                            FROM contratos A, secretarias B, fornecedores C
                            WHERE A.ativo = 's'
                            AND A.id_secretaria = B.id_secretaria
                            AND A.id_fornec = C.id_fornec                        
                            $var_secretaria
                            $var_fornec
                            $var_numero
                            $var_data
                            $var_fiscal
                            $var_objeto
                            $var_prorrog
                            $var_data_prorrog
                        ORDER BY A.id_contrato
                    ";

                    //echo $sql;

                    $result = $conn->query($sql);
                    while ($row = $result->fetch_assoc()) {

                        ?>
                        <tr>
                            <td class="text-center"><?=$row['id_contrato']?></td>
                            <td class="text-center"><?=$row['secretaria']?></td>
                            <td class="text-center"><?=strtoupper($row['fornec'])?></td>
                            <td class="text-center"><?=$row['numero']?></td>
                            <td class="text-center"><?=date("d/m/Y",strtotime($row['data_ini']))?></td>
                            <td class="text-center"><?=date("d/m/Y",strtotime($row['data_fim']))?></td>
                            <td class="text-center"><?=$row['fiscal']?></td>
                            <td class="text-center"><?=$row['objeto']?></td>
                            <td class="text-center"><?=$row['prorrog']?></td>
                            <td class="text-center"><?=date("d/m/Y",strtotime($row['data_prorrog']))?></td>
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