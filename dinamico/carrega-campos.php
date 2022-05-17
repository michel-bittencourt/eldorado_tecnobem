<?php
include('../includes/db.php');
$tipo = $_POST['tipo'];

if($tipo == 1){ ?>

                    <div class="col-sm-6">
                        <label for="id_fornec">Fornecedor</label>
                        <select class="form-control" name="id_fornec" required="required">
                            <option value=""></option>
                            <?php  
                            $sql_fornec = "SELECT * FROM fornecedores WHERE ativo='s' ORDER BY fornec";
                            $result_fornec = $conn->query($sql_fornec);
                            while ($row_fornec=$result_fornec->fetch_assoc()) {?>
                                <option value="<?=$row_fornec['id_fornec']?>"><?=$row_fornec['fornec']?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>     

                    <div class="col-sm-6">
                        <label for="id_conta_pagar">Conta</label>
                        <select class="form-control" name="id_conta_pagar" required="required">
                            <option value=""></option>
                            <?php  
                            $sql_pagar = "SELECT * FROM contas_pagar WHERE ativo='s' ORDER BY conta_pagar";
                            $result_pagar = $conn->query($sql_pagar);
                            while ($row_pagar=$result_pagar->fetch_assoc()) {?>
                                <option value="<?=$row_pagar['id_conta_pagar']?>"><?=$row_pagar['conta_pagar']?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div> 

<?php
}else if($tipo == 2){ ?>

                    <div class="col-sm-6">
                        <label for="id_cliente">Clientes</label>
                        <select class="form-control" name="id_cliente" required="required">
                            <option value=""></option>
                            <?php  
                            $sql_cliente = "SELECT * FROM clientes WHERE ativo='s' ORDER BY cliente";
                            $result_cliente = $conn->query($sql_cliente);
                            while ($row_cliente=$result_cliente->fetch_assoc()) {?>
                                <option value="<?=$row_cliente['id_cliente']?>"><?=$row_cliente['cliente']?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>  

                    <div class="col-sm-6">
                        <label for="id_conta_receber">Conta</label>
                        <select class="form-control" name="id_conta_receber" required="required">
                            <option value=""></option>
                            <?php  
                            $sql_receber = "SELECT * FROM contas_receber WHERE ativo='s' ORDER BY conta_receber";
                            $result_receber = $conn->query($sql_receber);
                            while ($row_receber=$result_receber->fetch_assoc()) {?>
                                <option value="<?=$row_receber['id_conta_receber']?>"><?=$row_receber['conta_receber']?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div> 

<?php
}else{
    echo "";
}



/* close connection */
mysqli_close($conn);
?>