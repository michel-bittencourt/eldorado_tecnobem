<?php
include ("includes/ini.php");
?>

<div class="row divisor_titulo" style="">
    <label class="col-sm-12"><h3>Cadastro de Usuários</h3></label>
</div>

<form action="usuarios_gra.php" method="post">
    
    <div class="form-group row">
        <label for="nome" class="col-sm-2 col-form-label">Nome</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome do usuario" required="">
        </div>
    </div>

    <div class="form-group row">
        <label for="usuario" class="col-sm-2 col-form-label">Usuário</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="usuario" name="usuario" placeholder="Usuário para login">
        </div>
    </div>

    <div class="form-group row">
        <label for="senha" class="col-sm-2 col-form-label">Senha</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="senha" name="senha" placeholder="Senha">
        </div>
    </div>

    <div class="form-group row">
        <label for="secretaria" class="col-sm-2 col-form-label">Secretaria</label>
        <div class="col-sm-10">
           <select class="form-control" name="id_secretaria" required="required">
               <option value=""></option>
               <?php
               $sql_secret = "SELECT * FROM secretarias WHERE ativo = 's' ORDER BY secretaria";
               $result_secret = $conn->query($sql_secret);
               while($row_secret = $result_secret->fetch_assoc()){
               ?>   
               <option value="<?=$row_secret['id_secretaria']?>"><?=$row_secret['secretaria']?></option>
               <?php } ?>
            </select>
        </div>
    </div>

    <div class="form-group row">
        <label for="matricula" class="col-sm-2 col-form-label">Matrícula</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="matricula" name="matricula" placeholder="Matrícula">
        </div>
    </div>


    <div class="form-group row">
        <label for="depto" class="col-sm-2 col-form-label">Departamento</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="depto" name="depto" placeholder="Departamento">
        </div>
    </div>

    <div class="form-group row">
        <label for="cargo" class="col-sm-2 col-form-label">Cargo</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="cargo" name="cargo" placeholder="Cargo">
        </div>
    </div>

    <div class="form-group row">
        <label for="fone" class="col-sm-2 col-form-label">Telefone/Ramal</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="fone" name="fone" placeholder="Telefone">
        </div>
    </div>

    <div class="form-group row">
        <label for="mail" class="col-sm-2 col-form-label">E-mail</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="mail" name="mail" placeholder="E-mail">
        </div>
    </div>

    <div class="form-group row">
        <label for="senha" class="col-sm-2 col-form-label">Vínculo</label>
        <div class="col-sm-10">
            <select name="vinculo" class="form-control">
                <option value=""></option>
                <option value="estatutario"></option>
                <option value="CC"></option>
                <option value="estagiario"></option>
                <option value="terceirizado"></option>
            </select>
        </div>
    </div>



    <div class="form-group row">
        <label for="acesso" class="col-sm-2 col-form-label">Acesso</label>
        <div class="col-sm-10">
            <select multiple="multiple" size="25" class="form-control" id="acesso" name="acesso[]">
                <?php
                $sql = "SELECT id_pagina,pagina 
                        FROM paginas 
                        ORDER BY pagina";
                $query = $conn->query($sql);
                
                while ($dados = $query->fetch_array()) {
                    ?>
                    <option value="<?=$dados['id_pagina']?>"><?=$dados['pagina']?></option>
                <?php } ?>

            </select>
        </div>
    </div> 


    <div class="btn-group btn-group-justified" role="group" aria-label="...">
        <div class="btn-group" role="group">
            <button type="submit" class="btn btn-primary" >
                <span class="fa fa-save"></span> 
                Gravar
            </button>
        </div>
        <div class="btn-group" role="group">
            <button type="reset" class="btn btn-secondary">
                <span class="fa fa-eraser"></span> 
                Limpar
            </button>
        </div>
    </div>

</form>
<?php
//$result = $conn->query("SELECT id_cliente, nome, fone1, fone2 FROM clientes WHERE ativo='s' AND categ5 != 's' ORDER BY nome");

$result = $conn->query("SELECT id, nome FROM usuarios WHERE ativo='s' ORDER BY nome");

?>
<div class="row divisor_titulo" style="">
    <label class="col-sm-12"><h3>Usuários: <?=mysqli_num_rows($result)?></h3></label>
</div>

<table id="example" class="table table-striped table-bordered" style="width:100%">
    <thead>
        <tr>
            <th>#</th>
            <th>Nome</th>
            <th colspan="2" class="text-center">Editar</th>
        </tr>
    </thead>
    <tbody>

<?php

while ($row = $result->fetch_assoc()){
    echo "
    <tr>
        <th scope='row'>".$row['id']."</th>
        <td>".$row['nome']."</td>
        <td>
            <form action='usuarios_edi.php' method='get'>
                <input type='hidden' name='idUsuario' value='".$row['id']."'>
                <button class='btn btn-primary' type='submit' style='margin:0'>Editar</button>
            </form>
        </td>
        <td>
            <form action='clientes_exc.php' method='post'>
                <input type='hidden' name='idUsuario' value='".$row['id']."'>
                <button class='btn btn-danger' type='submit' style='margin:0'>Excluir</button>
            </form>
        </td>
    </tr>";
}

$result->close();
$conn->close();
?>

  </tbody>
</table>

<?php
include ("includes/fim.php");
?>