<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- As 3 meta tags acima *devem* vir em primeiro lugar dentro do `head`; qualquer outro conteúdo deve vir *após* essas tags -->
    <title>Comunica</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/estilo.css" rel="stylesheet">
    <!-- HTML5 shim e Respond.js para suporte no IE8 de elementos HTML5 e media queries -->
    <!-- ALERTA: Respond.js não funciona se você visualizar uma página file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <div class="container">
      <div class="row content">
        <div class="col-sm-12 sidenav">


          <?php require_once("dinamico/alert.php"); ?>

          <form action="autenticar.php" method="post" >
            <div class="imgcontainer">
              <img src="img/comunica.png" style="width:100px">
            </div>

            <div class="container">
              <label><b>Usuário</b></label>
              <input type="text" placeholder="Entre com Usuário" name="inputEmail" required>

              <label><b>Senha</b></label>
              <input type="password" placeholder="Entre com a Senha" name="inputPass" required>

              <button type="submit" class="btn btn-primary">Login</button>
              <label>
                <input type="checkbox" checked="checked">Gravar senha
              </label>
            </div>

            <div class="container" style="background-color:#f1f1f1">
              <button type="button" class="cancelbtn">Cancelar</button>
              <span class="psw">Esqueceu a <a href="#">senha</a>?</span>
            </div>
          </form>
        </div>
      </div>

    </div>


    <!-- jQuery (obrigatório para plugins JavaScript do Bootstrap) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Inclui todos os plugins compilados (abaixo), ou inclua arquivos separadados se necessário -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>