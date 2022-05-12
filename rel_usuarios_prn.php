<?php
include ("includes/ini_print.php");

if(isset($_POST['nome']) && $_POST['nome'] != ""){
    $var_nome = " AND A.nome LIKE '%".$_POST['nome']."%'";
}else{
    $var_nome = "";
}


if(isset($_POST['usuario']) && $_POST['usuario'] != ""){
    $var_usuario = " AND A.email LIKE '%".$_POST['email']."%'";
}else{
    $var_usuario = "";
}


if(isset($_POST['id_secretaria']) && $_POST['id_secretaria'] != ""){
    $var_secretaria = " AND A.id_secretaria = ".$_POST['id_secretaria'];
}else{
    $var_secretaria = "";
}

?>


<div class="card mb-3 container-fluid">
    <div class="card-header">
        <h3>Relatório de Usuários</h3>
        
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Nome</th>
                        <th>Usuário</th>
                        <th>Secretaria</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Código</th>
                        <th>Nome</th>
                        <th>Usuário</th>
                        <th>Secretaria</th>
                    </tr>
                </tfoot>
                <tbody>

                    <?php

                    $sql = "SELECT A.*, B.secretaria
                        FROM usuarios A, secretarias B
                        WHERE A.ativo = 's'
                        AND A.id_secretaria = B.id_secretaria
                        $var_nome
                        $var_usuario
                        $var_secretaria
                        ORDER BY A.nome
                    ";

                    //echo $sql;

                    $result = $conn->query($sql);
                    while ($row = $result->fetch_assoc()) {

                        ?>
                        <tr>
                            <td class="text-center"><?=$row['id']?></td>
                            <td class="text-center"><?=$row['nome']?></td>
                            <td class="text-center"><?=$row['email']?></td>
                            <td class="text-center"><?=$row['secretaria']?></td>
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