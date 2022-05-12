          <div class="nav-side-menu">
              <div class="brand">Usuário: <?=$nome_user?></div>
              <i class="fa fa-bars fa-2x toggle-btn" data-toggle="collapse" data-target="#menu-content"></i>
            
                  <div class="menu-list">
            
                      <ul id="menu-content" class="menu-content collapse out">
                          <li>
                            <a href="painel.php">
                            <i class="fas fa-tachometer-alt"></i> PAINEL DE CONTROLE
                            </a>
                          </li>

 
                          <?php

                          $mysqli = $conn;
                            
                          $sql = "SELECT categorias.id_categoria AS id_categoria, categorias.categoria AS nome_categoria,   categorias.link AS link_categoria, categorias.target AS target_categoria, categorias.class AS class_categoria, categorias.arrow AS arrow_categoria FROM categorias ORDER BY ordem";
                                
                          $query = $mysqli->query( $sql )or die( $mysqli->error );
                          while( $dados = $query->fetch_object() ){
                             
                              echo 
                              "<li data-toggle='collapse' data-target='#".$dados->target_categoria."' class='collapsed'><a href='".$dados->link_categoria."'><i class='".$dados->class_categoria."'></i>".$dados->nome_categoria."<i class='".$dados->arrow_categoria."'></i></a>
                              </li>";

                              $sql2 = "SELECT A.id_pagina, A.pagina, A.link 
                              FROM paginas A, usuario_acesso B
                              WHERE A.id_categoria = {$dados->id_categoria}
                              AND A.id_pagina = B.modulo
                              AND B.id_usuario = $id_user
                              ";
                              $query2 = $mysqli->query($sql2) or die($mysqli->error);
                              echo "<ul class='sub-menu collapse' id='".$dados->target_categoria."'>";
                              
                              while ($row = $query2->fetch_assoc()){
                                
                                $pag = $_SERVER['PHP_SELF'];

                                if($pag=="/tecnobem/eldorado/".$row['link']){$ativo=" class='active'";}else{$ativo="";}

                                echo "<li><a href='".$row['link']."'".$ativo.">".$row['pagina']."</a></li>";
                              }




                              echo "</ul>";
                            }
                          ?>
                      </ul>
               </div>
          </div>