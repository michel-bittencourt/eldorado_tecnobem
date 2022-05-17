<?php
include ("includes/ini.php");

$titulo_pagina = "Cadastro de Secretarias";

$id = $_GET['id'];

$sql = "SELECT * FROM projetos WHERE id_projeto = $id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

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
                    <li class="breadcrumb-item"><a href="projetos_cad.php">Cadastro de Projetos</a></li>
                    <li class="breadcrumb-item active">Editar Projeto</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">


    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Alteração de Cadastro de Projetos</h3>
        </div>
        <form action="projetos_gal.php" method="post">
            <input type="hidden" name="id" value="<?=$id?>">
            <div class="card-body">

                <div class="form-group row">
                    <div class="col-sm-12">
                        <label for="titulo">Título</label>
                        <input type="text" class="form-control" id="titulo" name="titulo" value="<?=$row['titulo']?>" placeholder="Título do Projeto" maxlength="255">
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col=sm-12">
                        <label for="objeto">Objeto</label>
                        <textarea class="form-control" name="objeto"><?=$row['objeto']?></textarea>
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
                            while ($row_secretaria=$result_secretaria->fetch_assoc()) {
                                if($row['id_secretaria'] == $row_secretaria['id_secretaria']){$sel="selected";}else{$sel="";}
                                ?>
                                <option value="<?=$row_secretaria['id_secretaria']?>" <?=$sel?> ><?=$row_secretaria['secretaria']?></option>
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
                            while ($row_tipo=$result_tipo->fetch_assoc()) {
                                if($row['id_tipo'] == $row_tipo['id_tipo']){$sel="selected";}else{$sel="";}
                                ?>
                                <option value="<?=$row_tipo['id_tipo']?>" <?=$sel?>><?=$row_tipo['tipo']?></option>
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
                            while ($row_status=$result_status->fetch_assoc()) {
                                if($row['id_status'] == $row_status['id_status']){$sel="selected";}else{$sel="";}
                                ?>
                                <option value="<?=$row_status['id_status']?>" <?=$sel?>><?=$row_status['status']?></option>
                            <?php
                            }
                            ?>                             
                        </select>
                    </div>
                    <div class="col-sm-2">
                        <label for="fone">Solicitante</label>
                        <input type="text" class="form-control" id="solicitante" name="solicitante" value="<?=$row['solicitante']?>" placeholder="Nome do Solicitante" maxlength="60">
                    </div>
                    <div class="col-sm-2">
                        <label for="secretaria">Responsável</label>
                        <select class="form-select" id="id_resp" name="id_resp" required="required">
                            <option></option>
                            <?php  
                            $sql_resp = "SELECT * FROM usuarios WHERE ativo='s' ORDER BY nome";
                            $result_resp = $conn->query($sql_resp);
                            while ($row_resp=$result_resp->fetch_assoc()) {
                                if($row['id_resp'] == $row_resp['id']){$sel="selected";}else{$sel="";}
                                ?>
                                <option value="<?=$row_resp['id']?>" <?=$sel?>><?=$row_resp['nome']?></option>
                            <?php
                            }
                            ?>                             
                        </select>
                    </div>                                        
                </div>

                <div class="form-group row">
                    <div class="col=sm-12">
                        <label for="objeto">Observações</label>
                        <textarea class="form-control" name="obs"><?=$row['obs']?></textarea>
                    </div>
                </div>  


            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Gravar</button>
                <a href="projetos_cad.php" class="btn btn-secondary">Voltar</a>
            </div>
        </form>
    </div>


<?php
include ("includes/fim.php");
?>