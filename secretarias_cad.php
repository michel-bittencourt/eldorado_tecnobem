<?php
include ("includes/ini.php");

$titulo_pagina = "Cadastro de Secretarias";

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
            <h3 class="card-title">Formulário de Cadastro de Secretarias</h3>
        </div>
        <form action="secretarias_gra.php" method="post">
            <div class="card-body">
                
                <div class="form-group row">
                    <div class="col-sm-8" style="margin-top:6px">
                        <label for="secretaria">Secretaria</label>
                        <input type="text" class="form-control" id="secretaria" name="secretaria" placeholder="Digite o nome da Secretaria" maxlength="100" required="required">
                    </div>
                    <div class="col-sm-4" style="margin-top:6px">
                        <label for="sigla">Sigla</label>
                        <input type="text" class="form-control" id="sigla" name="sigla" placeholder="Digite a Sigla" maxlength="10" required="required">
                    </div>                    
                </div>


                <div class="form-group row">
                    <div class="col-sm-2">
                        <label for="fone">Fone</label>
                        <input type="text" class="form-control" id="fone" name="fone" placeholder="Digite o telefone" maxlength="15">
                    </div>

                    <div class="col-sm-4">
                        <label for="endereco">Endereço</label>
                        <input type="text" class="form-control" id="endereco" name="endereco" placeholder="Digite o Endereço" maxlength="200">
                    </div>                

                    <div class="col-sm-3">
                        <label for="gestor">Gestor</label>
                        <input type="text" class="form-control" id="gestor" name="gestor" placeholder="Digite o Gestor" maxlength="60">
                    </div>

                    <div class="col-sm-3">
                        <label for="email">E-mail</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Digite o email" maxlength="200">
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
            <h3 class="card-title">Tabela de Secretarias Cadastradas</h3>
        </div>
        
        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr class="text-center">
                        <th>ID</th>
                        <th>Secretaria</th>
                        <th>Sigla</th>
                        <th>Fone</th>
                        <th>Endereço</th>
                        <th>Gestor</th>
                        <th>E-mail</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>

                    <?php  
                    $sql = "SELECT * FROM secretarias WHERE ativo = 's' ORDER BY secretaria";
                    $result = $conn->query($sql);
                    while ($row=$result->fetch_assoc()) { ?>
                    
                    <tr>
                        <td class="text-center"><?=$row['id_secretaria']?></td>
                        <td><?=$row['secretaria']?></td>
                        <td class="text-center"><?=$row['sigla']?></td>
                        <td class="text-center"><?=$row['fone']?></td>
                        <td><?=$row['endereco']?></td>
                        <td class="text-center"><?=$row['gestor']?></td>
                        <td class="text-center"><?=$row['email']?></td>
                        <td class="text-center">
                            <div class="form-group row ">
                                <div class="col-sm-6">
                                    <a href="secretarias_edi.php?id=<?=$row['id_secretaria']?>" class="btn btn-secondary btn-sm" ><i class="fas fa-pen" style="font-size: 0.8em;"></i></a>
                                </div>
                                <div class="col-sm-6">
                                    <a  href="javascript:if(confirm('Tem certeza que deseja excluir este registro?')){location.href='secretarias_del.php?id=<?=$row['id_secretaria']?>'}" class="btn btn-secondary btn-sm" ><i class="fas fa-trash" style="font-size: 0.8em;"></i></a>
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