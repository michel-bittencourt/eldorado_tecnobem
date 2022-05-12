<?php
include ("includes/ini.php");

$id             = $_POST['idUsuario'];
$nome           = $_POST['nome'];
$usuario        = $_POST['usuario'];
$senha          = $_POST['senha'];
$id_secretaria  = $_POST['id_secretaria'];
$matricula      = $_POST['matricula'];
$depto          = $_POST['depto'];
$cargo          = $_POST['cargo'];
$fone           = $_POST['fone'];
$email          = $_POST['email'];
$vinculo        = $_POST['vinculo'];

$modulos        = $_POST['acesso'];


$id_emp         = 1;
$id_usuario     = $id_user;
$data_cad       = date("Y/m/d");

$sql = "UPDATE usuarios SET 
            nome            = '$nome',
            email           = '$usuario',
            senha           = '$senha',
            id_secretaria   = '$id_secretaria',
            matricula       = '$matricula',
            depto           = '$depto',
            cargo           = '$cargo',
            fone            = '$fone',
            mail            = '$mail',
            vinculo         = '$vinculo',
            id_usuario      = '$id_usuario'
        WHERE 
            id = '$id'";



$sql_limpa = "DELETE FROM usuario_acesso WHERE id_usuario = '$id'";
$query_limpa = $conn->query($sql_limpa);

?>

<div class="row divisor_titulo" style="">
    <label class="col-sm-12"><h3>Cadastro de Usuários</h3></label>
</div>
<?php

if($query = $conn->query($sql)){ ?>
    
    <div class="alert alert-success" role="alert">Cadastro alterado com sucesso!</div>

    <?php

    foreach ($modulos as $acesso) {
        $sql2= "INSERT INTO usuario_acesso(id_usuario, modulo) VALUES ('$id','$acesso')";
        $query = $conn->query($sql2);
    }
    ?>

    <div class="btn-group btn-group-justified" role="group">
        <div class="btn-group" role="group">
            <form action="usuarios_edi.php" method="get">
                <input type="hidden" name="idUsuario" value="<?=$id?>">
                <button type="submit" class="btn btn-primary">
                    <span class="glyphicon glyphicon-pencil"></span> 
                    Editar Usuário
                </button>
            </form>
        </div>
        <div class="btn-group" role="group">
            <form action="usuarios_cad.php">
                <button type="submit" class="btn btn-primary">
                    <span class="glyphicon glyphicon-plus"></span> 
                     Incluir novo Usuário
                </button>
            </form>
        </div>
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
    echo newlog("1",$id_user,"ALTERAÇÃO DE CADASTRO DO USUÁRIO","Alteração do usuário: ".$nome);
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