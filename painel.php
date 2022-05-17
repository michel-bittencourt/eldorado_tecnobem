<?php 
include("includes/ini.php");

$titulo_pagina = "Página Inicial";

?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6"><h1><?=$titulo_pagina?></h1></div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="painel.php">Home</a></li>
                    <li class="breadcrumb-item active"><?=$titulo_pagina?></li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">


    <div class="card">

        <div class="card-header">
            <h3 class="card-title">Meus Projetos</h3>
        </div>
        
        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr class="text-center">
                        <th>ID</th>
                        <th>Titulo</th>
                        <th>Objeto</th>
                        <th>Secretaria</th>
                        <th>Tipo</th>
                        <th>Status</th>
                        <th>Solicitante</th>
                        <th>Responsável</th>
                        <th>Observações</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>

                    <?php  
                    $sql = "SELECT A.id_projeto, A.titulo, A.objeto, A.solicitante, A.obs, B.secretaria, C.tipo, D.status, D.fase, E.nome 
                            FROM projetos A, secretarias B, tipos C, status D, usuarios E
                            WHERE A.ativo = 's' 
                            AND A.id_secretaria = B.id_secretaria
                            AND A.id_tipo = C.id_tipo 
                            AND A.id_status = D.id_status 
                            AND A.id_resp = E.id
                            AND A.id_resp = $id_user
                            ORDER BY A.data_cad";
                    $result = $conn->query($sql);
                    while ($row=$result->fetch_assoc()) { 

                        if($row['fase'] == 3){
                            $cor = " style='background-color:#B0E0E6'";
                        }else if($row['fase'] == 2){
                            $cor = " style='background-color:#F5DEB3'";
                        }else{
                            $cor = "";
                        }


                        ?>
                    
                    <tr <?=$cor?> >
                        <td class="text-center"><?=$row['id_projeto']?></td>
                        <td><?=$row['titulo']?></td>
                        <td><?=$row['objeto']?></td>
                        <td class="text-center"><?=$row['secretaria']?></td>
                        <td class="text-center"><?=$row['tipo']?></td>
                        <td class="text-center"><?=$row['status']?></td>
                        <td><?=$row['solicitante']?></td>
                        <td class="text-center"><?=$row['nome']?></td>
                        <td class="text-center"><?=$row['obs']?></td>
                        <td class="text-center">
                            <div class="form-group row ">
                                <div class="col-sm-6">
                                    <a href="projetos_edi.php?id=<?=$row['id_projeto']?>" class="btn btn-secondary btn-sm" ><i class="fas fa-pen" style="font-size: 0.8em;"></i></a>
                                </div>
                                <div class="col-sm-6">
                                    <a  href="javascript:if(confirm('Tem certeza que deseja excluir este registro?')){location.href='projetos_del.php?id=<?=$row['id_projeto']?>'}" class="btn btn-secondary btn-sm" ><i class="fas fa-trash" style="font-size: 0.8em;"></i></a>
                                </div>

                            </div>
                        </td>
                    </tr>

                    <?php
                    }
                    ?>

                </tbody>
            </table>

        </div>
    </div>    

</section>

<?php 
include("includes/fim.php");
?>
