<?php
include('../includes/db.php');
$tomador = $_POST['tomador'];

if($tomador == 1){ ?>

    <option value="">Selecione o cliente...</option>
    <?php  
    $sql_clientes = "SELECT id_cliente, cliente FROM clientes WHERE ativo='s' ORDER BY cliente";
    $result_clientes = $conn->query($sql_clientes);
    while ($row_clientes=$result_clientes->fetch_assoc()) {?>
        <option value="<?=$row_clientes['id_cliente']?>"><?=$row_clientes['cliente']?></option>
    <?php } ?>

<?php
}else if($tomador == 2){ ?>
    <option value="">Selecione o comprador...</option>
    <?php  
    $sql_compradores = "SELECT id_comprador, comprador FROM compradores WHERE ativo='s' ORDER BY comprador";
    $result_compradores = $conn->query($sql_compradores);
    while ($row_compradores=$result_compradores->fetch_assoc()) {?>
        <option value="<?=$row_compradores['id_comprador']?>"><?=$row_compradores['comprador']?></option>
    <?php } ?>

<?php 
}else if($tomador == 3){ ?>
    <option value="">Selecione o vendedor...</option>
    <?php  
    $sql_vendedores = "SELECT id_vendedor, vendedor FROM vendedores WHERE ativo='s' ORDER BY vendedor";
    $result_vendedores = $conn->query($sql_vendedores);
    while ($row_vendedores=$result_vendedores->fetch_assoc()) {?>
        <option value="<?=$row_vendedores['id_vendedor']?>"><?=$row_vendedores['vendedor']?></option>
    <?php } ?>

<?php 
}else if($tomador == 4){ ?>
    <option value="">Selecione a transportadora...</option>
    <?php  
    $sql_transp = "SELECT id_transp, transp FROM transportadoras WHERE ativo='s' ORDER BY transp";
    $result_transp = $conn->query($sql_transp);
    while ($row_transp=$result_transp->fetch_assoc()) {?>
        <option value="<?=$row_transp['id_transp']?>"><?=$row_transp['transp']?></option>
    <?php } ?>

<?php 
}else{ ?>
    <option value="">Escolha o tipo de Tomador</option>   

<?php
}

/* close connection */
mysqli_close($conn);
?>