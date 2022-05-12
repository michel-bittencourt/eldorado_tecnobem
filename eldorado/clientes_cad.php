<?php
include ("includes/ini.php");
?>

<div class="row divisor_titulo" style="">
    <label class="col-sm-12"><h3>Cadastro de Clientes</h3></label>
</div>

<form action="clientes_gra.php" method="post">
    
    <div class="form-group row">
        <label for="cpf_cnpj" class="col-sm-2 col-form-label">CPF/CNPJ</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="cpf_cnpj" name="cpf_cnpj" placeholder="CPF ou CNPJ (obrigatório, somente números)" onkeyup="somenteNumeros(this);" required >
        </div>
    </div>

    <fieldset class="form-group">
        <div class="row">
            <label class="col-form-label col-sm-2 pt-0">Tipo</label>
            <div class="col-sm-10">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="tipo" id="tipo1" value="1" checked>
                    <label class="form-check-label" for="tipo1">Pessoa Física</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="tipo" id="tipo2" value="2">
                    <label class="form-check-label" for="tipo2">Pessoa Jurídica</label>
                </div>
            </div>
        </div>
    </fieldset>

    <div class="form-group row">
        <label for="nome" class="col-sm-2 col-form-label">Nome</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome do cliente" required="">
        </div>
    </div>

    <div class="form-group row">
        <label for="nacion" class="col-sm-2 col-form-label">Nacionalidade</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="nacion" name="nacion" placeholder="Nacionalidade">
        </div>
    </div>

    <div class="form-group row">
        <label for="civil" class="col-sm-2 col-form-label">Estado Civil</label>
        <div class="col-sm-10">
            <select class="form-control" id="civil" name="civil">
                <option value="">Selecione...</option>
                <option value="1">Solteiro(a)</option>
                <option value="2">Casado(a)</option>
                <option value="3">Separado(a)</option>
                <option value="4">Divorciado(a)</option>
                <option value="5">Viúvo(a)</option>
            </select>
        </div>
    </div>

    <fieldset class="form-group">
        <div class="row">
            <label class="col-form-label col-sm-2 pt-0">Sexo</label>
            <div class="col-sm-10">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="sexo" id="sexo1" value="m" checked>
                    <label class="form-check-label" for="tipo1">Masculino</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="sexo" id="sexo2" value="f">
                    <label class="form-check-label" for="tipo2">Feminino</label>
                </div>
            </div>
        </div>
    </fieldset>

    <div class="form-group row">
        <label for="profissao" class="col-sm-2 col-form-label">Profissão</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="profissao" name="profissao" placeholder="Profissão">
        </div>
    </div>

    <div class="form-group row">
        <label for="nascim" class="col-sm-2 col-form-label">Data de nascimento</label>
        <div class="col-sm-10">
            <input type="date" class="form-control" id="nascim" name="nascim" placeholder="Data de nascimento">
        </div>
    </div>

    <div class="form-group row">
        <label for="rg" class="col-sm-2 col-form-label">RG</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="rg" name="rg" placeholder="Carteira de identidade">
        </div>
    </div>

    <div class="form-group row">
        <label for="filiacao" class="col-sm-2 col-form-label">Filiação</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="filiacao" name="filiacao" placeholder="Nome do pai e da mãe">
        </div>
    </div>

    <div class="form-group row">
        <label for="fone1" class="col-sm-2 col-form-label">Fone 1</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="fone1" name="fone1" placeholder="Telefone principal">
        </div>
    </div>

    <div class="form-group row">
        <label for="fone2" class="col-sm-2 col-form-label">Fone 2</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="fone2" name="fone2" placeholder="Telefone secundário">
        </div>
    </div>


    <div class="form-group row">
        <label for="email1" class="col-sm-2 col-form-label">Email 1</label>
        <div class="col-sm-10">
            <input type="email" class="form-control" id="email1" name="email1" placeholder="Email principal">
        </div>
    </div>

    <div class="form-group row">
        <label for="email2" class="col-sm-2 col-form-label">Email 2</label>
        <div class="col-sm-10">
            <input type="email" class="form-control" id="email2" name="email2" placeholder="Email secundário">
        </div>
    </div>

    <div class="form-group row divisor" style="">
        <label class="col-sm-12 col-form-label">Endereço</label>
    </div>  

    <div class="form-group row">
        <label for="endereco" class="col-sm-2 col-form-label">Endereço</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="endereco" name="endereco" placeholder="Logradouro e número">
        </div>
    </div>

    <div class="form-group row">
        <label for="estado" class="col-sm-2 col-form-label">Estado</label>
        <div class="col-sm-10">
            <select class="form-control" id="estado" name="estado">
                <option value="">Selecione...</option>
                <?php
                $sql = "SELECT id_estado, estado FROM estados WHERE ativo='s' ORDER BY estado";
                $query = $conn->query($sql);
                while ($dados = $query->fetch_array()) {
                ?>
                <option value="<?=$dados['id_estado']?>"><?=$dados['estado']?></option>
                <?php } ?>
            </select>
        </div>
    </div> 

    <div class="form-group row">
        <label for="cidade" class="col-sm-2 col-form-label">Cidade</label>
        <div class="col-sm-10">
            <select class="form-control" id="cidade" name="cidade">
                <option value="">Selecione...</option>
            </select>
        </div>
    </div> 

    <div class="form-group row">
        <label for="bairro" class="col-sm-2 col-form-label">Bairro</label>
        <div class="col-sm-10">
            <select class="form-control" id="bairro" name="bairro">
                <option value="">Selecione...</option>
            </select>
            <!-- ******************************* MODAL PARA INCLUIR BAIRRO *********************************** -->
            <br>
            <a data-toggle="modal" href="#registro02" class="btn btn-primary">Incluir novo  Bairro</a>
            <div class="modal fade" id="registro02">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button aria-hidden="true" class="close" data-dismiss="modal" type="button">×</button>
                            <h1 class="modal-title">Incluir novo Bairro</h4>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="nome_bairro" class="control-label">Nome do Bairro</label>
                                <input type="text" class="form-control" name="nome_bairro" id="nome_bairro" placeholder="Nome do Bairro">
                            </div>
                            <div class="modal-footer">
                                <a type="button" class="btn btn-primary" id="btn_prop" onclick="gravaBairro()">
                                    <span class="glyphicon glyphicon-plus"></span> 
                                    Incluir Bairro
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>   


        </div>
    </div> 

    <div class="form-group row">
        <label for="cep" class="col-sm-2 col-form-label">CEP</label>
        <div class="col-sm-5">
            <input type="text" class="form-control" id="cep" name="cep" maxlength="5" placeholder="CEP">
        </div>
        <div class="col-sm-5">
            <input type="text" class="form-control" id="cep_sufixo" name="cep_sufixo" maxlength="3" placeholder="Sufixo">
        </div>
    </div>

    <div class="btn-group btn-group-justified" role="group" aria-label="...">
        <div class="btn-group" role="group">
            <button type="submit" class="btn btn-primary" >
                Gravar
            </button>
        </div>
        <div class="btn-group" role="group">
            <button type="reset" class="btn btn-secondary">
                Limpar
            </button>
        </div>
    </div>

</form>
<?php
//$result = $conn->query("SELECT id_cliente, nome, fone1, fone2 FROM clientes WHERE ativo='s' AND categ5 != 's' ORDER BY nome");

$result = $conn->query("SELECT id_cliente, nome, fone1, fone2 FROM clientes WHERE ativo='s' AND categ5 != 's' ORDER BY nome");

?>
<div class="row divisor_titulo" style="">
    <label class="col-sm-12"><h3>Proprietários Cadastrados: <?=mysqli_num_rows($result)?></h3></label>
</div>

<table class="table table-striped">
    <thead>
        <tr>
            <th>#</th>
            <th>Nome</th>
            <th>Fone 1</th>
            <th>Fone 2</th>
            <th colspan="2" class="text-center">Editar</th>
        </tr>
    </thead>
    <tbody>

<?php

while ($row = $result->fetch_assoc()){
    echo "
    <tr>
        <th scope='row'>".$row['id_cliente']."</th>
        <td>".$row['nome']."</td>
        <td>".$row['fone1']."</td>
        <td>".$row['fone2']."</td>
        <td>
            <form action='clientes_edi.php' method='get'>
                <input type='hidden' name='idCliente' value='".$row['id_cliente']."'>
                <button class='btn btn-primary' type='submit' style='margin:0'>Editar</button>
            </form>
        </td>
        <td>
            <form action='clientes_exc.php' method='post'>
                <input type='hidden' name='idCliente' value='".$row['id_cliente']."'>
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