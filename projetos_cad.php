<?php
include ("includes/ini.php");

$titulo_pagina = "Cadastro de Projetos";

if (isset($_GET['m'])) {
    $m = $_GET['m'];
    mensRetorno($m);
}

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


    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Formulário de Cadastro de Projetos</h3>
        </div>
        <form action="projetos_gra.php" method="post">
            <div class="card-body">
                
                <div class="form-group row">
                    <div class="col-sm-12">
                        <label for="titulo">Título</label>
                        <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Título do Projeto" maxlength="255">
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col=sm-12">
                        <label for="objeto">Objeto</label>
                        <textarea class="form-control" name="objeto" required="required"></textarea>
                    </div>
                </div>
                
                <div class="form-group row">
                    <div class="col-sm-4">
                        <label for="secretaria">Secretaria</label>
                        <select class="form-select" id="id_secretaria" name="id_secretaria" required="required">
                            <option></option>
                            <?php  
                            $sql_secretaria = "SELECT * FROM secretarias WHERE ativo='s' ORDER BY secretaria";
                            $result_secretaria = $conn->query($sql_secretaria);
                            while ($row_secretaria=$result_secretaria->fetch_assoc()) {?>
                                <option value="<?=$row_secretaria['id_secretaria']?>"><?=$row_secretaria['secretaria']?></option>
                            <?php
                            }
                            ?>                            
                        </select>
                    </div>
                    <div class="col-sm-2">
                        <label for="id_tipo">Tipo</label>
                        <select class="form-select" id="id_tipo" name="id_tipo" required="required">
                            <option></option>
                            <?php  
                            $sql_tipo = "SELECT * FROM tipos WHERE ativo='s' ORDER BY tipo";
                            $result_tipo = $conn->query($sql_tipo);
                            while ($row_tipo=$result_tipo->fetch_assoc()) {?>
                                <option value="<?=$row_tipo['id_tipo']?>"><?=$row_tipo['tipo']?></option>
                            <?php
                            }
                            ?>                            
                        </select>
                    </div>                    
                    <div class="col-sm-2">
                        <label for="secretaria">Status</label>
                        <select class="form-select" id="id_status" name="id_status" required="required">
                            <option></option>
                            <?php  
                            $sql_status = "SELECT * FROM status WHERE ativo='s' ORDER BY status";
                            $result_status = $conn->query($sql_status);
                            while ($row_status=$result_status->fetch_assoc()) {?>
                                <option value="<?=$row_status['id_status']?>"><?=$row_status['status']?></option>
                            <?php
                            }
                            ?>                             
                        </select>
                    </div>
                    <div class="col-sm-2">
                        <label for="fone">Solicitante</label>
                        <input type="text" class="form-control" id="solicitante" name="solicitante" placeholder="Nome do Solicitante" maxlength="60">
                    </div>
                    <div class="col-sm-2">
                        <label for="secretaria">Responsável</label>
                        <select class="form-select" id="id_resp" name="id_resp" required="required">
                            <option></option>
                            <?php  
                            $sql_resp = "SELECT * FROM usuarios WHERE ativo='s' ORDER BY nome";
                            $result_resp = $conn->query($sql_resp);
                            while ($row_resp=$result_resp->fetch_assoc()) {?>
                                <option value="<?=$row_resp['id']?>"><?=$row_resp['nome']?></option>
                            <?php
                            }
                            ?>                             
                        </select>
                    </div>                                        
                </div>

                <div class="form-group row">
                    <div class="col=sm-12">
                        <label for="objeto">Observações</label>
                        <textarea class="form-control" name="obs"></textarea>
                    </div>
                </div>                

            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Gravar</button>
            </div>
        </form>
    </div>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Tabela de Projetos Cadastradas</h3>
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

<?php
include ("includes/fim.php");
?>