<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Prefeitura de Eldorado do Sul || Painel de Controle</title>

        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
        <link rel="stylesheet" href="./plugins/fontawesome-free/css/all.min.css">
        <link rel="stylesheet" href="./plugins/icheck-bootstrap/icheck-bootstrap.min.css">
        <link rel="stylesheet" href="./dist/css/adminlte.min.css">
    </head>
    <body class="hold-transition login-page">
        
        <div class="login-box">
            
            <div class="login-logo">
                <img src="./dist/img/logo_peq.png">
                <h1>Prefeitura de Eldorado do Sul</h1>
            </div>
            
            <div class="card">
                <div class="card-body login-card-body">
                    <p class="login-box-msg">Informe seus dados de acesso</p>

                    <form action="autentica.php" method="post">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" name="user" placeholder="Usuário">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-user"></span>
                                </div>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <input type="password" class="form-control" name="pass" placeholder="Senha">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-8">

                            </div>
                            <div class="col-4">
                                <button type="submit" class="btn btn-primary btn-block">Enviar</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>

        <script src="./plugins/jquery/jquery.min.js"></script>
        <script src="./plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="./dist/js/adminlte.min.js"></script>
    </body>
</html>
