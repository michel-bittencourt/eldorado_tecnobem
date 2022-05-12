<?php
include ("includes/ini.php");

$tipo           = $_POST['tipo'];
$nome           = $_POST['nome'];
$nacion         = $_POST['nacion'];
$civil          = $_POST['civil'];
$sexo           = $_POST['sexo'];
$profissao      = $_POST['profissao'];
$nascim         = $_POST['nascim'];
$cpf_cnpj       = $_POST['cpf_cnpj'];
$rg             = $_POST['rg'];
$filiacao       = $_POST['filiacao'];
$fone1          = $_POST['fone1'];
$fone2          = $_POST['fone2'];
$email1         = $_POST['email1'];
$email2         = $_POST['email2'];
$endereco       = $_POST['endereco'];
$estado         = $_POST['estado'];
$cidade         = $_POST['cidade'];
$bairro         = $_POST['bairro'];
$cep            = $_POST['cep'];
$cep_sufixo     = $_POST['cep_sufixo'];

$id_emp         = 1;
$id_usuario     = $id_user;
$data_cad       = date("Y/m/d");


$sql = "INSERT INTO clientes (
                nome,
                nacion,
                civil,
                sexo,
                profissao,
                nascim,
                cpf_cnpj,
                rg,
                filiacao,
                fone1,
                fone2,
                email1,
                email2,
                endereco,
                id_estado,
                id_cidade,
                id_bairro,
                cep,
                cep_sufixo,
                id_emp,
                id_usuario,
                data_cad           
            ) VALUES (
                '$nome',
                '$nacion',
                '$civil',
                '$sexo',
                '$profissao',
                '$nascim',
                '$cpf_cnpj',
                '$rg',
                '$filiacao',
                '$fone1',
                '$fone2',
                '$email1',
                '$email2',
                '$endereco',
                '$estado',
                '$cidade',
                '$bairro',
                '$cep',
                '$cep_sufixo',
                '$id_emp',
                '$id_usuario',
                '$data_cad'
            )";




?>

<div class="row divisor_titulo" style="">
    <label class="col-sm-12"><h3>Cadastro de Clientes</h3></label>
</div>
<?php
if($query = $conn->query($sql)){ ?>
    
    <div class="alert alert-success" role="alert">Cadastro realizado com sucesso!</div>

    <?php
    $id = mysqli_insert_id($conn);
    ?>

    <div class="btn-group btn-group-justified" role="group">
        <div class="btn-group" role="group">
            <form action="clientes_edi.php" method="get">
                <input type="hidden" name="idCliente" value="<?=$id?>">
                <button type="submit" class="btn btn-primary">
                    <span class="glyphicon glyphicon-pencil"></span> 
                    Editar Cliente
                </button>
            </form>
        </div>
        <div class="btn-group" role="group">
            <form action="clientes_cad.php">
                <button type="submit" class="btn btn-primary">
                    <span class="glyphicon glyphicon-plus"></span> 
                     Incluir novo Cliente
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