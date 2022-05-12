<?php
include ("includes/ini_print.php");

$id_secretaria = $_POST['id_secretaria'];
if(isset($_POST['id_departamento']) && $_POST['id_departamento'] != ""){
    $var_depto = " AND id_departamento = ".$_POST['id_departamento'];
}else{
    $var_depto = "";
}
$id_depto = $_POST['id_departamento'];

$sql = "SELECT *
    FROM secretarias
    WHERE ativo = 's'
    AND id_secretaria = $id_secretaria
    ORDER BY secretaria
";
$result = $conn->query($sql);
while ($row = $result->fetch_assoc()) {

?>

    <div class="row divisor_titulo" style="">
        <h3><?=$row['secretaria']?></h3>
    </div>

    <?php

    $id_secretaria = $row['id_secretaria'];

    $sql2 = "SELECT *
        FROM departamentos
        WHERE ativo = 's'
        AND id_secretaria = $id_secretaria
        $var_depto        
        ORDER BY departamento
    ";

    $result2 = $conn->query($sql2);
    while ($row2 = $result2->fetch_assoc()) {

    ?>    

    <div style="margin-left:50px"><h4><u><?=$row2['departamento']?></u></h4></div>

        <?php
        $id_departamento = $row2['id_departamento'];
        ?>

        <div class="row col-sm-12" style="padding-left: 80px;">

            <div class="col-sm-6">
                <h5>Telefones</h5>
                <ul>
                    <?php
                    $sql3 = "SELECT *
                            FROM telefones
                            WHERE ativo = 's'
                            AND id_departamento = $id_departamento
                            ORDER BY numero
                        ";        
                    $result3 = $conn->query($sql3);                    
                    while ($row3 = $result3->fetch_assoc()) { ?>

                        <li><?=strtoupper($row3['tipo'])?> | <?=$row3['numero']?> | <?=$row3['usuario']?></li>

                    <?php
                    } ?>
                </ul>
            </div>
            <div class="col-sm-6">
                <h5>Equipamentos</h5>
                <ul>
                    <?php
                    $sql4 = "SELECT A.qtd, A.internet, A.proprio, B.equipamento
                            FROM depto_equip A, equipamentos B
                            WHERE A.ativo = 's'
                            AND A.id_equipamento = B.id_equipamento
                            AND id_departamento = $id_departamento
                            ORDER BY B.equipamento
                        "; 

                    $result4 = $conn->query($sql4);                    
                    while ($row4 = $result4->fetch_assoc()) { ?>

                        <li><?=strtoupper($row4['equipamento'])?> | <?=$row4['qtd']?> </li>

                    <?php
                    } ?>
                </ul>                
            </div>
        </div>
    <?php
    }
    ?>

<?php
}
include ("includes/fim.php");
?>