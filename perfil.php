<?php
include ("includes/ini.php");

$query = "SELECT * FROM usuarios WHERE id=$id_user";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);

mysqli_free_result($result);

?>

<div class="row divisor_titulo" style="">
    <label class="col-sm-12"><h3>Editar Perfil</h3></label>
</div>

<form action="perfil_gra.php" method="post" id="form_perfil">

    <input type="hidden" name="idUsuario" value="<?=$id_user?>">
    
    <div class="form-group row">
        <label for="nome" class="col-sm-2 col-form-label">Nome</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" value="<?=$row['nome']?>" id="nome" name="nome" placeholder="Nome do cliente" required="">
        </div>
    </div>

    <div class="form-group row">
        <label for="usuario" class="col-sm-2 col-form-label">Usuário</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" value="<?=$row['email']?>" id="usuario" name="usuario" placeholder="Nome do cliente" required="">
        </div>
    </div>

    <div class="form-group row">
        <label for="password" class="col-sm-2 col-form-label">Nova Senha</label>
        <div class="col-sm-10">
            <input type="password" class="form-control" id="senha" name="senha" placeholder="Nova Senha">
        </div>
    </div>

    <div class="form-group row">
        <label for="repete_senha" class="col-sm-2 col-form-label">Repete a Senha</label>
        <div class="col-sm-10">
            <input type="password" class="form-control" id="repete_senha" name="repete_senha" placeholder="Repete a Senha">
        </div>
    </div>

    <div class="form-group row">
        <div class="col-sm-12" >       
            <button type="button" class="btn btn-primary" onclick="confere_senha()">Gravar</button>
            <button type="reset" class="btn btn-success">Limpar</button>
        </div>
    </div>
</form>

<?php
include ("includes/fim.php");
?>