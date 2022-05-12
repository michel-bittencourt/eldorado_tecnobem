<?php
include ("includes/ini.php");

$nome           = $_POST['nome'];
$usuario        = $_POST['usuario'];
$senha          = $_POST['senha'];
$id_secretaria  = $_POST['id_secretaria'];
$matricula      = $_POST['matricula'];
$depto          = $_POST['depto'];
$cargo          = $_POST['cargo'];
$fone           = $_POST['fone'];
$mail           = $_POST['mail'];
$vinculo        = $_POST['vinculo'];

$modulos        = $_POST['acesso'];


$id_emp         = 1;
$id_usuario     = $id_user;
$data_cad       = date("Y/m/d");

$sql = "INSERT INTO usuarios (
                nome,
                email,
                senha,
                id_secretaria,
                matricula,
                depto,
                cargo,
                fone, 
                mail,
                vinculo,               
                id_usuario,
                data_cad        
            ) VALUES (
                '$nome',
                '$usuario',
                '$senha',
                '$id_secretaria',
                '$matricula',
                '$depto',
                '$cargo',
                '$fone', 
                '$mail',
                '$vinculo',                 
                '$id_usuario',
                '$data_cad'
            )";

?>

<div class="row divisor_titulo" style="">
    <label class="col-sm-12"><h3>Cadastro de Usuários</h3></label>
</div>
<?php
if($query = $conn->query($sql)){ ?>
    
    <div class="alert alert-success" role="alert">Cadastro realizado com sucesso!</div>

    <?php
    $id = mysqli_insert_id($conn);

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
    echo newlog("1",$id_user,"CADASTRO DE CLIENTES","Inclusão do cliente: ".$nome);
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