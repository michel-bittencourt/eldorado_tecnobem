<?php
include ("includes/ini.php");

$titulo_pagina = "Cadastro de Usuários";

if (isset($_GET['m'])) {
    $m = $_GET['m'];
    if ($m == '1') {
        echo "<div class='alert alert-success' role='alert'>Registro gravado com sucesso!</div>";
    }else if ($m == '2') {
        echo "<div class='alert alert-danger' role='alert'>Registro não gravou!</div>";
    }else if ($m == '3') {
        echo "<div class='alert alert-warning' role='alert'>Registro excluido com sucesso!</div>";
    }
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
            <h3 class="card-title">Formulário de Cadastro de Usuários</h3>
        </div>
        <form action="usuarios_gra.php" method="post">
            <div class="card-body">
                <div class="form-group">
                    <label for="nome_user">Nome</label>
                    <input type="text" class="form-control" id="nome_user" name="nome_user" placeholder="Digite o nome do Usuário">
                </div>

                <div class="form-group">
                    <label for="login_user">Login</label>
                    <input type="text" class="form-control" id="login_user" name="login_user" placeholder="Digite o Login">
                </div>                
                
                <div class="form-group">
                    <label for="senha_user">Senha</label>
                    <input type="password" class="form-control" id="senha_user" name="senha_user" placeholder="Digite uma senha inicial para o usuário">
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Gravar</button>
            </div>
        </form>
    </div>


    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Tabela de Usuários Cadastrados</h3>
        </div>
        
        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr class="text-center">
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Login</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>

                    <?php  
                    $sql_user = "SELECT * FROM usuarios WHERE ativo = 's' ORDER BY usuario";
                    $result_user = $conn->query($sql_user);
                    while ($row_user=$result_user->fetch_assoc()) { ?>
                    
                    <tr class="text-center">
                        <td><?=$row_user['id_usuario']?></td>
                        <td><?=$row_user['usuario']?></td>
                        <td><?=$row_user['login']?></td>
                        <td width="200px">
                            <div class="form-group row ">
                                <div class="col-sm-6">
                                    <a href="usuarios_edi.php?id=<?=$row_user['id_usuario']?>" class="btn btn-secondary btn-sm" ><i class="fas fa-pen" style="font-size: 0.8em;"></i></a>
                                </div>
                                <div class="col-sm-6">
                                    <a  href="javascript:if(confirm('Tem certeza que deseja excluir este registro?')){location.href='usuarios_del.php?id=<?=$row_user['id_usuario']?>'}" class="btn btn-secondary btn-sm" ><i class="fas fa-trash" style="font-size: 0.8em;"></i></a>
                                </div>
                            </div>



                        </td>
                    </tr>

                    <?php
                    }
                    ?>

                </tbody>
                <tfoot>
                    <tr class="text-center">
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Login</th>
                        <th>Ações</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

<?php
include ("includes/fim.php");
?>