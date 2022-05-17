<?php
include ("includes/ini.php");

$titulo_pagina = "Cadastro de Usuários";

$id = $_GET['id'];

$sql = "SELECT * FROM usuarios WHERE id_usuario = $id";
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
        <form action="usuarios_gal.php" method="post">
            <input type="hidden" name="id" value="<?=$id?>">
            <div class="card-body">
                <div class="form-group">
                    <label for="nome_user">Nome</label>
                    <input type="text" class="form-control" id="nome_user" name="nome_user" value="<?=$row['usuario']?>" placeholder="Digite o nome do Usuário">
                </div>

                <div class="form-group">
                    <label for="login_user">Login</label>
                    <input type="text" class="form-control" id="login_user" name="login_user" value="<?=$row['login']?>" placeholder="Digite o Login">
                </div>                
                
                <div class="form-group">
                    <label for="senha_user">Nova Senha</label>
                    <input type="password" class="form-control" id="senha_user" name="senha_user" placeholder="Digite uma nova senha para o usuário">
                </div>
                
                <div class="form-group">
                    <label for="nome_user">Acesso</label>
                    <select class="form-control" id="acesso" name="acesso[]" multiple="multiple" size="20">
                    <?php
                    $sql = "SELECT id_pagina,pagina 
                            FROM paginas 
                            ORDER BY pagina";
                    $query = $conn->query($sql);
                    
                    while ($dados = $query->fetch_array()) {
                        
                        $modulo = $dados['id_pagina'];
                        
                        $sql2 = "   SELECT * 
                                    FROM usuario_acesso 
                                    WHERE id_usuario = $id 
                                    AND id_pagina = $modulo
                                    ";
                        $result2 = $conn->query($sql2);

                        $lin = $result2->num_rows;

                        if($lin > 0){$marcar = "selected";}else{$marcar="";}

                        ?>
                        <option value="<?=$dados['id_pagina']?>" <?=$marcar?> ><?=$dados['pagina']?></option>
                    <?php } ?>
                    </select>
                </div>                
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Gravar</button>
            </div>
        </form>
    </div>



<?php
include ("includes/fim.php");
?>