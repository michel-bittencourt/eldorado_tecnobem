<?php
include ("includes/ini.php");

$id_perfil      = $_POST['idUsuario'];
$nome           = $_POST['nome'];
$usuario        = $_POST['usuario'];
$senha          = $_POST['senha'];

$sql = "UPDATE usuarios SET 
            nome        = '$nome',
            email       = '$usuario',
            senha       = '$senha'
        WHERE 
            id = '$id_perfil'";

?>

<div class="row divisor_titulo" style="">
    <label class="col-sm-12"><h3>Cadastro de Usuários</h3></label>
</div>
<?php

if($query = $conn->query($sql)){ ?>
    
    <div class="alert alert-success" role="alert">Cadastro alterado com sucesso!</div>

    <div class="btn-group btn-group-justified" role="group">
        <div class="btn-group" role="group">
            <form action="painel.php">
                <button type="submit" class="btn btn-primary">
                    <span class="glyphicon glyphicon-home"></span> 
                    Voltar à pagina inicial
                </button>
            </form>
        </div>
    </div>

    <?php
    echo newlog("1",$id_user,"ALTERAÇÃO DE PERFIL","Alteração do usuário: ".$nome);
    ?>
<?php
}else{ ?>

    <div class="alert alert-danger" role="alert">
        Opa, ocorreu um erro de gravação no banco de dados!
    </div>

    <p>Por favor, tente novamente. Se o erro persistir, entre em contato com suporte clicando no ícone do menu. </p>

    <a class="btn btn-primary" href="clientes_cad.php" role="button">Tentar Novamente</a>
    <a class="btn btn-primary" href="painel.php" role="button">Volar à pagina inicial</a>

<?php
}

include ("includes/fim.php");
?>