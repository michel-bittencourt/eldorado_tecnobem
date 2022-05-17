<?php
include ("includes/ini.php");

$titulo_pagina = "Cadastro de Secretarias";

$id = $_GET['id'];

$sql = "SELECT * FROM secretarias WHERE id_secretaria = $id";
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
                    <li class="breadcrumb-item"><a href="secretarias_cad.php">Cadastro de Secretarias</a></li>
                    <li class="breadcrumb-item active">Editar Secretaria</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">


    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Alteração de Cadastro de Secretarias</h3>
        </div>
        <form action="secretarias_gal.php" method="post">
            <input type="hidden" name="id" value="<?=$id?>">
            <div class="card-body">

                <div class="form-group row">
                    <div class="col-sm-8" style="margin-top:6px">
                        <label for="secretaria">Secretaria</label>
                        <input type="text" class="form-control" id="secretaria" name="secretaria" value="<?=$row['secretaria']?>" placeholder="Digite o nome da Secretaria" maxlength="100" required="required">
                    </div>
                    <div class="col-sm-4" style="margin-top:6px">
                        <label for="sigla">Sigla</label>
                        <input type="text" class="form-control" id="sigla" name="sigla" value="<?=$row['sigla']?>" placeholder="Digite a Sigla" maxlength="10" required="required">
                    </div>                    
                </div>


                <div class="form-group row">
                    <div class="col-sm-2">
                        <label for="fone">Fone</label>
                        <input type="text" class="form-control" id="fone" name="fone" value="<?=$row['fone']?>" placeholder="Digite o telefone" maxlength="15">
                    </div>

                    <div class="col-sm-4">
                        <label for="endereco">Endereço</label>
                        <input type="text" class="form-control" id="endereco" name="endereco" value="<?=$row['endereco']?>" placeholder="Digite o Endereço" maxlength="200">
                    </div>                

                    <div class="col-sm-3">
                        <label for="gestor">Gestor</label>
                        <input type="text" class="form-control" id="gestor" name="gestor" value="<?=$row['gestor']?>" placeholder="Digite o Gestor" maxlength="60">
                    </div>

                    <div class="col-sm-3">
                        <label for="email">E-mail</label>
                        <input type="email" class="form-control" id="email" name="email" value="<?=$row['email']?>" placeholder="Digite o email" maxlength="200">
                    </div>
                </div>
                
            </div>


            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Gravar</button>
                <a href="secretarias_cad.php" class="btn btn-secondary">Voltar</a>
            </div>
        </form>
    </div>


<?php
include ("includes/fim.php");
?>