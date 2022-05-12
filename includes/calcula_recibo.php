<?php
include('includes/db.php');

$emp       = 1;

$id = $_GET['idLancam'];
    $query = "SELECT A.*, B.id_contrato, B.id_inquilino, B.id_imovel, B.atraso_multa, B.atraso_juros, B.imob_valor, B.imob_percent, B.imob_perc_juros, C.id_cliente, C.nome, C.email1, C.email2, D.rua, D.numero, D.complemento, E.bairro, F.cidade 
                FROM lancamentos A, locacoes B, clientes C, imoveis D, bairros E, cidades F 
                WHERE id_lancam=$id
                AND A.id_contrato = B.id_contrato
                AND B.id_inquilino = C.id_cliente
                AND D.id_imovel = B.id_imovel
                AND D.id_bairro = E.id_bairro
                AND D.id_cidade = F.id_cidade
                ";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    mysqli_free_result($result);
    $hoje = strtotime(date('Y/m/d'));
    $vencimento = strtotime($row['vencimento']);
    if($row['situacao']<>1){
        $dif = 0;;
    }else{
        $dif = ((intval($vencimento) - intval($hoje))/86400)*-1;;
    }

    //*************************************************************************    
    // Preenche variáveis com dados da empresa
    //*************************************************************************    
    $consulta_emp = "SELECT * FROM empresa WHERE id_empresa = '$emp'";
    $result_emp = $conn->query($consulta_emp);
    $rs_emp = $result_emp->fetch_assoc();

    $emp_nome 		= $rs_emp['nome'];
    $emp_cnpj		= $rs_emp['cnpj'];
	$emp_endereco	= $rs_emp['endereco'];
	$emp_estado		= $rs_emp['estado'];
	$emp_cidade		= $rs_emp['cidade'];
	$emp_bairro		= $rs_emp['bairro'];
	$emp_telefone	= $rs_emp['telefone'];
	$emp_site		= $rs_emp['site'];
	$emp_obs		= $rs_emp['obs_boleto'];


    //*************************************************************************    
    // Verifica se tem valores extras para o lançamento e incrementa $subtotal
    //*************************************************************************    
    $consulta = "SELECT * FROM extras WHERE id_lancam = '$id' AND ativo='s'";
    $result2 = $conn->query($consulta);
    $extras = 0;
    while ($linha = $result2->fetch_assoc()){
        if ($linha['tipo']==2) {
            $extras = $extras - $linha['valor'];
        }else{
            $extras = $extras + $linha['valor'];
        }

    }

    $id_inquilino = $row['id_cliente'];

    $imobiliaria1 = "$emp_nome - $emp_endereco - $emp_bairro - $emp_cidade | $emp_estado - Fone: $emp_telefone \r\n";
    $imobiliaria2 = "CNPJ $emp_cnpj - $emp_site" ;

    $inquilino 		= $row['nome'];
    $locacao 		= $row['rua'].", ".$row['numero']." ".$row['complemento'];
    $cidade 		= $row['cidade'];
    $bairro 		= $row['bairro'];
    $local			= $bairro." - ".$cidade;
    $referencia 	= "Referência: ".$row['referencia']." | Vencimento:".date('d/m/Y',strtotime($row['vencimento']));
    $inq_email1 	= $row['email1'];
    $inq_email2		= $row['email2'];

    $inicio			= date("d/m/Y",strtotime($row['ini_periodo']));
    $fim			= date("d/m/Y",strtotime($row['fim_periodo']));    

$mensagens=$emp_obs;    


    //*************************************************************************    
    // Verifica proprietários
    //************************************************************************* 
    $id_imovel = $row['id_imovel'];

    $consulta3 = "SELECT A.*, B.nome, B.id_cliente 
    				FROM imoveis_prop A, clientes B 
    				WHERE A.id_imovel = '$id_imovel' 
    				AND A.id_prop = B.id_cliente
    				AND A.ativo='s'
    				ORDER BY B.nome";
    $result3 = $conn->query($consulta3);

    $i=0;

		require 'fpdf/fpdf.php';
		define('FPDF_FONTPATH', 'fpdf/font/');


		$pdf = new FPDF("P", "mm", "A4");
		$pdf->SetMargins(20, 10, 20);
		$pdf->SetFont('arial', '', 12);
		$pdf->SetTitle("Recibo de pagamento de aluguel");
		$pdf->SetSubject("Recibo de pagamento de aluguel");

		$textoCabecalho = "DESENVOLVIDO POR \n";
		$textoCabecalho .= "Lantec Sistemas ";
		$textoCabecalho .= "Recibo de pagamento de aluguel \n";
		$textoCabecalho .= "Lançamento n° {$id}";    
    
    while ($rs = $result3->fetch_assoc()){

    	$id_proprietario = $rs['id_cliente'];

	    //*************************************************************************    
	    // Cria o identificador único para o recibo: id_imovel.id_inquilino.id_proprietario.id_lancam
	    //*************************************************************************      	

	    $num_recibo = $id.".".$id_inquilino."-".$row['referencia'];

	    $ref = explode("/", $row['referencia']);

	    $nome_recibo = "Recibo ".$ref[0]."-".$ref[1]." - ".utf8_decode($inquilino).".pdf";

	    //*************************************************************************    
	    // Carrega as variaveis de valor e cria a variavel subtotal
	    //************************************************************************* 
	    $valor_aluguel      = $row['valor_aluguel'];
	    $valor_iptu         = $row['valor_iptu'];
	    $valor_seguro       = $row['valor_seguro'];
	    $valor_condominio   = $row['valor_condominio'];
	    $valor_ir           = $row['valor_ir'];

	    $valor_boleto       = $row['taxa_boleto'];
	    $valor_correio      = $row['taxa_correio'];

	    $subtotal = $valor_aluguel + $valor_iptu + $valor_seguro + $valor_condominio + $valor_ir + $valor_boleto + $valor_correio;    	

	    //*************************************************************************    
	    // Verifica se se esta atrasado e incrementa $subtotal
	    //*************************************************************************
	    if ($dif > 0) {
	        $multa = ($subtotal * $row['atraso_multa'])/100;
	        $multa = number_format($multa,'2');
	        $juros = number_format(((($subtotal * $row['atraso_juros'])/100)/30)*$dif,'2');
	        $total = $subtotal + $multa + $juros;
	    }else{
	        $multa = $row['pgto_multa'];
	        $juros = $row['pgto_juros'];
	    }    	

    	$proprietario   = $rs['nome'];
    	$percent 		= $rs['percent'];
      
	    $aluguel 		= ($valor_aluguel*$percent)/100;
	    $iptu 			= ($valor_iptu*$percent)/100;
	    $seguro 		= ($valor_seguro*$percent)/100;
	    $condominio 	= ($valor_condominio*$percent)/100;
	    $irrf 			= ($valor_ir*$percent)/100;
	    $subtotal 		= ($subtotal*$percent)/100;

	    $eventuais 		= ($extras*$percent)/100;
	    $multa 			= ($multa*$percent)/100;
	    $juros 			= ($juros*$percent)/100;
	    $total 			= $subtotal + $eventuais + $multa + $juros;

		require_once("includes/clsTexto.php");

		$extenso		= clsTexto::valorPorExtenso($total, true, false);

	    $historico		= "Recebemos de $inquilino o valor de ".number_format($total,'2',',','.')." (".$extenso.") referente pagamento de aluguel no período de ".$inicio." a ".$fim.", pelo qual passamos o presente recibo.";

	    $pag_data = $row['pgto_data'];

	    if($pag_data>0){
	    	$data = date("d/m/Y",strtotime($pag_data));
	    }else{
	    	$data = "___ / ___ / _______";
	    }

		$pdf->SetY("-1");
		$pdf->MultiCell(60, 25, "", 1, "C");
		
		$pdf->SetXY(22,15);	
		$pdf->Image("img/logo_sismob2.png");

		$pdf->SetXY(80,12);	
		$pdf->SetFont('arial', 'B', 24);
		$pdf->Cell(0, 10, "RECIBO DE ALUGUEL", 0, 0, 'C');

		$pdf->SetXY(80,19);	
		$pdf->SetFont('arial', 'B', 12);
		$pdf->Cell(0, 10, utf8_decode($referencia), 0, 0, 'C');	

		$pdf->SetXY(80,25);	
		$pdf->SetFont('arial', 'B', 14);
		$pdf->Cell(0, 10, utf8_decode("Número: ".$num_recibo), 0, 0, 'C');			

		$pdf->SetXY(80,10);
		$pdf->MultiCell(110, 25, "", 1, "C");

		$pdf->SetXY(20,36);	
		$pdf->SetFont('arial', 'I', 8);
		$pdf->MultiCell(0, 4, utf8_decode($imobiliaria1), 0, 'C');
		$pdf->MultiCell(0, 4, utf8_decode($imobiliaria2), 0, 'C');
		
		//Dados proprietário e inquilino
		$pdf->SetXY(20,45);
		$pdf->MultiCell(86, 25, "", 1, "L");

		$pdf->SetFont('arial', '', 9);
		$pdf->SetXY(20,45);	
		$pdf->MultiCell(23, 5, utf8_decode("Proprietário:"), 0, 'R');	
		$pdf->MultiCell(23, 5, utf8_decode("Inquilino:"), 0, 'R');	
		$pdf->MultiCell(23, 5, utf8_decode("Locação:"), 0, 'R');	
		$pdf->MultiCell(23, 5, utf8_decode("Bairro/Cidade:"), 0, 'R');

		$pdf->SetFont('arial', 'B', 9);
		$pdf->SetXY(42,45);	
		$pdf->MultiCell(63, 5, utf8_decode($proprietario), 0, 'L');
		$pdf->SetXY(42,50);	
		$pdf->MultiCell(63, 5, utf8_decode($inquilino), 0, 'L');
		$pdf->SetXY(42,55);	
		$pdf->MultiCell(63, 5, utf8_decode($locacao), 0, 'L');
		$pdf->SetXY(42,60);	
		$pdf->MultiCell(63, 5, utf8_decode($local), 0, 'L');

		
		//Encargos
		$pdf->SetXY(108,45);
		$pdf->MultiCell(40, 25, "", 1, "L");

		$pdf->SetFont('arial', '', 9);
		$pdf->SetXY(108,45);	
		$pdf->MultiCell(20, 5, utf8_decode("Aluguel:"), 0, 'R');
		$pdf->SetXY(108,50);		
		$pdf->MultiCell(20, 5, utf8_decode("IPTU:"), 0, 'R');	
		$pdf->SetXY(108,55);
		$pdf->MultiCell(20, 5, utf8_decode("Seguro:"), 0, 'R');	
		$pdf->SetXY(108,60);
		$pdf->MultiCell(20, 5, utf8_decode("Condomínio:"), 0, 'R');
		$pdf->SetXY(108,65);
		$pdf->MultiCell(20, 5, utf8_decode("IRRF(-):"), 0, 'R');		
		
		$pdf->SetFont('arial', 'B', 9);	
		$pdf->SetXY(125,45);	
		$pdf->MultiCell(20, 5, number_format($aluguel,'2',',','.'), 0, 'R');
		$pdf->SetXY(125,50);	
		$pdf->MultiCell(20, 5, number_format($iptu,'2',',','.'), 0, 'R');
		$pdf->SetXY(125,55);	
		$pdf->MultiCell(20, 5, number_format($seguro,'2',',','.'), 0, 'R');
		$pdf->SetXY(125,60);	
		$pdf->MultiCell(20, 5, number_format($condominio,'2',',','.'), 0, 'R');
		$pdf->SetXY(125,65);	
		$pdf->MultiCell(20, 5, number_format($irrf,'2',',','.'), 0, 'R');



		//Valores enventuais, multa, juros e total
		$pdf->SetXY(150,45);
		$pdf->MultiCell(40, 25, "", 1, "L");

		$pdf->SetFont('arial', 'B', 9);	
		$pdf->SetXY(150,45);
		$pdf->MultiCell(20, 5, utf8_decode("Subtotal:"), 0, 'R');
		$pdf->SetFont('arial', '', 9);	
		$pdf->SetXY(150,50);		
		$pdf->MultiCell(20, 5, utf8_decode("Acres/Desc:"), 0, 'R');	
		$pdf->SetXY(150,55);
		$pdf->MultiCell(20, 5, utf8_decode("Multa:"), 0, 'R');	
		$pdf->SetXY(150,60);
		$pdf->MultiCell(20, 5, utf8_decode("Juros:"), 0, 'R');
		$pdf->SetXY(150,65);
		$pdf->SetFont('arial', 'B', 9);		
		$pdf->MultiCell(20, 5, utf8_decode("TOTAL:"), 0, 'R');

		$pdf->SetFont('arial', 'B', 9);
		$pdf->SetXY(170,45);
		$pdf->MultiCell(19, 5, number_format($subtotal,'2',',','.'), 0, 'R');
		$pdf->SetXY(170,50);
		$pdf->MultiCell(19, 5, number_format($eventuais,'2',',','.'), 0, 'R');
		$pdf->SetXY(170,55);
		$pdf->MultiCell(19, 5, number_format($multa,'2',',','.'), 0, 'R');
		$pdf->SetXY(170,60);
		$pdf->MultiCell(19, 5, number_format($juros,'2',',','.'), 0, 'R');
		$pdf->SetXY(170,65);
		$pdf->SetFont('arial', 'B', 10);		
		$pdf->MultiCell(19, 5, number_format($total,'2',',','.'), 0, 'R');

		//Historico
		$pdf->SetFont('arial', '', 9);	
		$pdf->SetXY(20,72);
		$pdf->MultiCell(170, 5, utf8_decode($historico), 0, 'J');	

		//Mensagens
		$pdf->SetXY(20,92);	
		$pdf->MultiCell(100, 35, "", 1, 'J');	
		$pdf->SetFont('arial', '', 8);	
		$pdf->SetXY(20,92);
		$pdf->MultiCell(100, 4, utf8_decode($mensagens), 0, 'J');	

		//Data e assinatura
		$pdf->SetXY(120,92);	
		$pdf->MultiCell(70, 35, "", 1, 'J');	
		$pdf->SetFont('arial', '', 11);	
		$pdf->SetXY(120,95);
		$pdf->MultiCell(70, 4, utf8_decode("$cidade, $data"), 0, 'C');	

		$pdf->SetXY(120,113);
		$pdf->MultiCell(70, 4, "_______________________________", 0, 'C');	
		$pdf->SetFont('arial', 'B', 9);	
		$pdf->SetXY(120,118);
		$pdf->MultiCell(70, 4, utf8_decode("p.p. $proprietario"), 0, 'C');

    	$i = $i + 130;

	
	}
?>