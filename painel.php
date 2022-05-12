<?php
include ("includes/ini.php");
?>



<!-- Cadastros -->

<div class="row divisor_titulo" style="">
    <label class="col-sm-12"><h3>Acesso Rápido</h3></label>
</div>

<div class="row">
	<div class="col-sm-3">

	</div> 
	<div class="col-sm-3">

	</div> 

	<div class="col-sm-3">

	</div> 
 
	<div class="col-sm-3">

	</div> 
</div>

<div class="card mb-3 container-fluid">
    <div class="card-header">
        <i class="fa fa-table"></i>
        Contratos vencendo nos próximos 90 dias
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
                    </tr>
                </thead>
                <tbody>

                    <?php

                    if($adm != 's'){
                        $secret = " AND A.id_secretaria = $id_sec ";
                    }else{
                        $secret = "";
                    }


                    $sql = "SELECT A.id_contrato, A.numero, A.objeto, A.data_ini, A.data_fim, A.fiscal, A.prorrog, A.data_prorrog, B.secretaria, C.fornec
                            FROM contratos A, secretarias B, fornecedores C
                            WHERE A.ativo = 's'
                            AND A.id_secretaria = B.id_secretaria
                            $secret
                            AND A.id_fornec = C.id_fornec
                            AND CURDATE() BETWEEN DATE_SUB(data_fim, INTERVAL 3 MONTH) AND data_fim
                            ORDER BY A.data_fim
                          ";

                          //echo $sql;

                    $result = $conn->query($sql);
                    while ($row = $result->fetch_assoc()) {
                        ?>
                        <tr class="text-center">
                            <td><?=$row['id_contrato']?></td>
                            <td><?=$row['secretaria']?></td>
                            <td><?=$row['fornec']?></td>
                            <td><?=$row['objeto']?></td>
                            <td><?=date("d/m/Y",strtotime($row['data_ini']))?></td>
                            <td style="color:red; font-weight: bold;"><?=date("d/m/Y",strtotime($row['data_fim']))?></td>
                            <td><?=$row['fiscal']?></td>
                            <td><?php if($row['prorrog'] == 's'){echo "SIM";}else{echo "NÃO";}?></td>
                            <td><?=date("d/m/Y",strtotime($row['data_prorrog']))?></td>
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
