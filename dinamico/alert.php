<?php
if ( isset($_GET['erro']) ):
  $er  = $_GET['erro'];
  switch ($er){
    case 1:
      echo '<div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong>Atenção!</strong> Usuário ou senha inválido! Por favor, digite novamente.</div>';
      break;
  case 2:
      echo '<div class="alert alert-warning alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong>Atenção!</strong> Sessão expirada! Por favor, faça login novamente.</div>';
      break;      
  case 3:
      echo '<div class="alert alert-warning alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong>Atenção!</strong> Você não tem acesso a esse módulo. Consulte administrador do sistema.</div>';
      break;      
  }
endif;
?>