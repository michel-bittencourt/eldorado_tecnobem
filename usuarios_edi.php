<?php
include ("includes/ini.php");

if (isset($_GET['idUsuario'])) {
    $id = $_GET['idUsuario'];
    $query = "SELECT * FROM usuarios WHERE id=$id";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

    mysqli_free_result($result);
    ?>

    <div class="row divisor_titulo" style="">
        <label class="col-sm-12"><h3>Cadastro de Usuários</h3></label>
    </div>

    <form action="usuarios_gal.php" method="post">

        <input type="hidden" name="idUsuario" value="<?=$id?>">
        
        <div class="form-group row">
            <label for="nome" class="col-sm-2 col-form-label">Nome</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" value="<?=$row['nome']?>" id="nome" name="nome" placeholder="Nome do usuario" required="">
            </div>
        </div>

        <div class="form-group row">
            <label for="usuario" class="col-sm-2 col-form-label">Usuário</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" value="<?=$row['email']?>" id="usuario" name="usuario" placeholder="Usuário para login">
            </div>
        </div>

        <div class="form-group row">
            <label for="senha" class="col-sm-2 col-form-label">Senha</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" value="<?=$row['senha']?>" id="senha" name="senha" placeholder="Senha">
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
                    if($row['id_secretaria']==$row_secret['id_secretaria']){$sel="selected";}else{$sel="";}
                   ?>   
                   <option value="<?=$row_secret['id_secretaria']?>" <?=$sel?> ><?=$row_secret['secretaria']?></option>
                   <?php } ?>
                </select>
            </div>
        </div>

    <div class="form-group row">
        <label for="matricula" class="col-sm-2 col-form-label">Matrícula</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="matricula" value="<?=$row['matricula']?>" name="matricula" placeholder="Matrícula">
        </div>
    </div>


    <div class="form-group row">
        <label for="depto" class="col-sm-2 col-form-label">Departamento</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="depto" name="depto" value="<?=$row['depto']?>" placeholder="Departamento">
        </div>
    </div>

    <div class="form-group row">
        <label for="cargo" class="col-sm-2 col-form-label">Cargo</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="cargo" name="cargo" value="<?=$row['cargo']?>" placeholder="Cargo">
        </div>
    </div>

    <div class="form-group row">
        <label for="fone" class="col-sm-2 col-form-label">Telefone/Ramal</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="fone" name="fone" value="<?=$row['fone']?>" placeholder="Telefone">
        </div>
    </div>

    <div class="form-group row">
        <label for="email" class="col-sm-2 col-form-label">E-mail</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="mail" name="mail" value="<?=$row['mail']?>" placeholder="E-mail">
        </div>
    </div>

    <div class="form-group row">
        <label for="senha" class="col-sm-2 col-form-label">Vínculo</label>
        <div class="col-sm-10">
            <select name="vinculo" class="form-control">
                <option value=""></option>
                <option value="estatutario" <?php if($row['vinculo'] == "estatutario"){echo "checked";}?> > Estatutário</option>
                <option value="CC" <?php if($row['vinculo'] == "cc"){echo "checked";}?> >CC</option>
                <option value="estagiario" <?php if($row['vinculo'] == "estagiario"){echo "checked";}?> >Estagiário</option>
                <option value="terceirizado" <?php if($row['vinculo'] == "terceirizado"){echo "checked";}?> >Terceirizado</option>
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
                        
                        $modulo = $dados['id_pagina'];
                        
                        $sql2 = "   SELECT * 
                                    FROM usuario_acesso 
                                    WHERE id_usuario = $id 
                                    AND modulo = $modulo
                                    ";
                        $result2 = $conn->query($sql2);
                        if(mysqli_num_rows($result2)>0){$marcar = "selected";}else{$marcar = "";}

                        ?>
                        <option value="<?=$dados['id_pagina']?>" <?=$marcar?> ><?=$dados['pagina']?></option>
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
}
$conn->close();
?>

  </tbody>
</table>

<?php
include ("includes/fim.php");
?>