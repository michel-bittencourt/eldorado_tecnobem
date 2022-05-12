<?php
function genRandomString() 
{
    $length = 5;
    $characters = "0123456789ABCDEFGHIJKLMNOPQRSTUVWZYZ";

    $real_string_length = strlen($characters) ;     
    $string="id";

    for ($p = 0; $p < $length; $p++) 
    {
        $string .= $characters[mt_rand(0, $real_string_length-1)];
    }

    return strtolower($string);
}


//Gravar arquivo de log. Recebe como parâmetros o id da empresa, id do usuário, página e processo
function newlog($emp,$id_user,$pag,$proc){
	include "db.php";
	$data = date("Y/m/d");
	$hora = date("H:i:s");
	$sql_log = "INSERT INTO logfile(id_emp,id_user,pag,data,hora,processo) 
				VALUES('$emp','$id_user','$pag','$data','$hora','$proc')";
	$query = $conn->query($sql_log);
}

function Valor($valor) {
    $verificaPonto = ".";
    if(strpos("[".$valor."]", "$verificaPonto")):
        $valor = str_replace('.','', $valor);
        $valor = str_replace(',','.', $valor);
    else:
        $valor = str_replace(',','.', $valor);   
    endif;

    return $valor;
}

function calculaIrrf($aluguel_encargos) {

    $n1 = 1903.99;
    $a1 = 7.5;
    $d1 = 142.80;
    
    $n2 = 2826.66;
    $a2 = 15;
    $d2 = 354.80;
    
    $n3 = 3751.06;
    $a3 = 22.5;
    $d3 = 636.13;
    
    $n4 = 4664.68;
    $a4 = 27.5;
    $d4 = 869.36;
    
    if($aluguel_encargos > $n4) {
        $valor      = (($aluguel_encargos * $a4)/100) - $d4;
    }else if($aluguel_encargos > $n3){
        $valor      = (($aluguel_encargos * $a3)/100) - $d3;
    }else if($aluguel_encargos > $n2){
        $valor      = (($aluguel_encargos * $a2)/100) - $d2;
    }else if($aluguel_encargos > $n1){
        $valor      = (($aluguel_encargos * $a1)/100) - $d1;
    }else{
        $valor      = 0;
    }
    
    if($valor < 10){
        $valor = 0;
    }

    $valor = 0;

    return $valor;
}

function calculaAluguel($id){

    include('db.php');

    $query = "SELECT A.*, B.id_contrato, B.id_inquilino, B.id_imovel, B.atraso_multa, B.atraso_juros, B.imob_valor, B.imob_percent, B.imob_perc_juros, C.id_cliente, C.nome, C.tipo, C.cpf_cnpj, C.email1, C.email2, C.fone1, D.rua, D.numero, D.complemento, D.id_bairro, D.id_cidade, D.cep, D.cep_sufixo, E.id_bairro, E.bairro, F.id_cidade, F.cidade, G.sigla
                FROM lancamentos A, locacoes B, clientes C, imoveis D, bairros E, cidades F, estados G
                WHERE id_lancam=$id
                AND A.id_contrato = B.id_contrato
                AND B.id_inquilino = C.id_cliente
                AND B.id_imovel = D.id_imovel
                AND D.id_bairro = E.id_bairro
                AND D.id_cidade = F.id_cidade
                AND D.id_estado = G.id_estado
            ";

    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

    mysqli_free_result($result);

    $data_vencim = $row['vencimento'];

    //*************************************************************************    
    // Carrega os dados do cliente para gerar remessa
    //************************************************************************* 
    $id_inq = $row['id_inquilino'];

    
    $sql_cliente = "SELECT A.endereco, A.cep, A.cep_sufixo, B.bairro, C.cidade 
                    FROM clientes A, bairros B, cidades C 
                    WHERE id_cliente = '$id_inq'
                    AND A.id_bairro = B.id_bairro
                    AND A.id_cidade = C.id_cidade
                    ";


    $result_cliente     = mysqli_query($conn, $sql_cliente);

    $row_cliente        = mysqli_fetch_array($result_cliente, MYSQLI_ASSOC);

    $cli_endereco       = $row_cliente['endereco'];
    $cli_bairro         = $row_cliente['bairro'];
    $cli_cidade         = $row_cliente['cidade'];
    $cli_cep            = $row_cliente['cep'];
    $cli_cep_sufixo     = $row_cliente['cep_sufixo'];


    //*************************************************************************    
    // Carrega a variavel $valor_aluguel
    //************************************************************************* 
    $valor_aluguel      = $row['valor_aluguel'];

    //*************************************************************************    
    // Carrega a variavel $encargos
    //************************************************************************* 
    $valor_iptu         = $row['valor_iptu'];
    $valor_seguro       = $row['valor_seguro'];
    $valor_condominio   = $row['valor_condominio'];
    $encargos           = $valor_iptu + $valor_seguro + $valor_condominio;

    //*************************************************************************    
    // Cria a variável $aluguel_encargos
    //************************************************************************* 
    $aluguel_encargos   = $valor_aluguel + $encargos;

    //*************************************************************************    
    // Calcula taxa de administração da imobiliária
    //*************************************************************************
    $imob_valor         = $row['imob_valor'];
    $imob_percent       = $row['imob_percent'];
    $imob_perc_juros    = $row['imob_perc_juros'];

    if($row['valor_imob']>0){
        $taxa_adm = $row['valor_imob']; 
    }else{
        if ($imob_valor>0) {
            $taxa_adm   = $imob_valor;
        }else if($imob_percent > 0){
            $taxa_adm   = ($valor_aluguel * $imob_percent)/100;
        }else{
            $taxa_adm   = 0;
        }           
    }




    //*************************************************************************    
    // Verifica se proprietário = PF e inquilino = PJ, para deduzir IRRF
    //************************************************************************* 
    $id_imovel          = $row['id_imovel'];
    $tipo_inquilino     = $row['tipo'];

    $sql2= "SELECT A.nome, A.tipo 
            FROM clientes A, imoveis_prop B
            WHERE A.id_cliente = B.id_prop 
            AND B.id_imovel = $id_imovel
            AND B.resp = 's'
            ";

    $result2    = mysqli_query($conn, $sql2);

    $row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC);

    $prop_resp  = $row2['nome'];
    $tipo_prop  = $row2['tipo'];

    mysqli_free_result($result2);

    $base_irrf  = $valor_aluguel - $encargos - $taxa_adm;   

    if(($tipo_inquilino == 2) && ($tipo_prop == 1)){
        $valor_irrf = calculaIrrf($base_irrf);
    }else{
        $valor_irrf = 0;
    }

    $valor_irrf = $row['valor_ir'];


    //*************************************************************************    
    // Carrega as variaveis para despesas de envio: $desp_envio
    //************************************************************************* 
    $valor_boleto       = $row['taxa_boleto'];
    $valor_correio      = $row['taxa_correio'];

    $desp_envio         = $valor_boleto + $valor_correio;

    //*************************************************************************    
    // Verifica se tem valores extras e cria variável $extras
    //*************************************************************************    
    $sql = "SELECT * FROM extras WHERE id_lancam = '$id' AND ativo='s' AND cliente='1'";
    $result3 = $conn->query($sql);

    $extras = 0;
    while ($row3 = $result3->fetch_assoc()){
        if ($row3['tipo']==2) {
            $extras = $extras - $row3['valor'];
        }else{
            $extras = $extras + $row3['valor'];
        }
    }
    mysqli_free_result($result3); 

    $sql_prop = "SELECT * FROM extras WHERE id_lancam = '$id' AND ativo='s' AND cliente='2'";
    $result_prop = $conn->query($sql_prop);

    $extras_prop = 0;
    while ($row_prop = $result_prop->fetch_assoc()){
        if ($row_prop['tipo']==2) {
            $extras_prop = $extras_prop - $row_prop['valor'];
        }else{
            $extras_prop = $extras_prop + $row_prop['valor'];
        }
    }
    mysqli_free_result($result_prop); 


    //*************************************************************************    
    // Verifica se esta atrasado e cria as variáveis $multa e $juros
    //*************************************************************************
    $situacao = $row['situacao'];

    $hoje = strtotime(date('Y/m/d'));
    $vencimento = strtotime($row['vencimento']);

    if($situacao<>1){
        $dif = 0;
    }else{
        $dif = ((intval($vencimento) - intval($hoje))/86400)*-1;
    }

    if ($dif > 0) {
        $multa = (($valor_aluguel + $encargos) * $row['atraso_multa'])/100;
        $multa = number_format($multa,'2','.','');
        $juros = number_format((((($valor_aluguel + $encargos) * $row['atraso_juros'])/100)/30)*$dif,'2','.','');
    }else{
        $multa = $row['pgto_multa'];
        $juros = $row['pgto_juros'];
    }


    //*************************************************************************    
    // Cria a variável total somando todos os valores
    //*************************************************************************
    $total = $valor_aluguel + $encargos - $valor_irrf + $desp_envio + $extras + $multa + $juros;

    $total = number_format($total,'2','.','');


    //*************************************************************************    
    // Faz consulta para obter dados da imobiliária
    //*************************************************************************
    $sql_emp = "SELECT * FROM empresa WHERE id_empresa = 1";
    $result_emp = mysqli_query($conn, $sql_emp);
    $row_emp = mysqli_fetch_array($result_emp, MYSQLI_ASSOC);

    mysqli_free_result($result_emp);


    //*************************************************************************    
    // Calcula percentual sobre juros e multa da imobiliária
    //*************************************************************************

    if ($multa > 0) {
        $multa_imob = ($multa * $imob_perc_juros)/100;
        $multa_inq  = $multa - $multa_imob;
    }else{
        $multa_imob = 0;
        $multa_inq = 0;
    }

    if ($juros > 0) {
        $juros_imob = ($juros * $imob_perc_juros)/100;
        $juros_inq  = $juros - $juros_imob;
    }else{
        $juros_imob = 0;
        $juros_inq = 0;
    }

    //*************************************************************************    
    // Cria um array com todos os valores calculados
    //*************************************************************************

    $dados_aluguel = array(
                        'valor_aluguel'     => $valor_aluguel,
                        'valor_iptu'        => $valor_iptu,
                        'valor_seguro'      => $valor_seguro,
                        'valor_condominio'  => $valor_condominio,
                        'valor_irrf'        => $valor_irrf,
                        'valor_multa'       => $multa,
                        'valor_juros'       => $juros,
                        'valor_boleto'      => $valor_boleto,
                        'valor_correio'     => $valor_correio,
                        'valor_extras'      => $extras,
                        'valor_extras_prop' => $extras_prop,
                        'encargos'          => $encargos,
                        'base_irrf'         => $base_irrf,
                        'vencimento'        => $data_vencim,
                        'data_cad'          => $row['data_cad'],
                        'ini_periodo'       => $row['ini_periodo'],
                        'fim_periodo'       => $row['fim_periodo'],
                        'dias_atraso'       => $dif,
                        'atraso_multa'      => $row['atraso_multa'],
                        'atraso_juros'      => $row['atraso_juros'],
                        'situacao'          => $situacao,
                        'situ_prop'         => $row['situacao_prop'],
                        'num_contrato'      => $row['id_contrato'],
                        'num_lancam'        => $row['id_lancam'],
                        'referencia'        => $row['referencia'],
                        'imob_valor'        => $imob_valor,
                        'imob_percent'      => $imob_percent,
                        'imob_perc_juros'   => $imob_perc_juros,
                        'inquilino'         => $row['nome'],

                        'cli_endereco'      => $cli_endereco,
                        'cli_bairro'        => $cli_bairro,
                        'cli_cidade'        => $cli_cidade,
                        'cli_cep'           => $cli_cep, 
                        'cli_cep_sufixo'    => $cli_cep_sufixo,

                        'rua'               => $row['rua'],
                        'numero'            => $row['numero'],
                        'complemento'       => $row['complemento'],
                        'bairro'            => $row['bairro'],
                        'cidade'            => $row['cidade'],
                        'estado'            => $row['sigla'],
                        'cep'               => $row['cep'],
                        'cep_sufixo'        => $row['cep_sufixo'],
                        'telefone'          => $row['fone1'],
                        'subtotal'          => $valor_aluguel+$encargos+$desp_envio-$valor_irrf,
                        'total'             => $total,
                        'pgto_data'         => $row['pgto_data'],
                        'emp_nome'          => $row_emp['nome'],
                        'emp_endereco'      => $row_emp['endereco'],
                        'emp_bairro'        => $row_emp['bairro'],
                        'emp_cidade'        => $row_emp['cidade'],
                        'emp_estado'        => $row_emp['estado'],
                        'emp_telefone'      => $row_emp['telefone'],
                        'emp_cnpj'          => $row_emp['cnpj'],
                        'emp_email'         => $row_emp['email'],
                        'emp_site'          => $row_emp['site'],
                        'emp_obs_boleto'    => $row_emp['obs_boleto'],       
                        'emp_agencia'       => $row_emp['agencia'],       
                        'emp_conta'         => $row_emp['conta'],       
                        'emp_conta_dv'      => $row_emp['conta_dv'],       
                        'emp_carteira'      => $row_emp['carteira'],       
                        'emp_cedente'       => $row_emp['cedente'],       
                        'taxa_adm'          => $taxa_adm,       
                        'multa_imob'        => $multa_imob,       
                        'multa_inq'         => $multa_inq,       
                        'juros_imob'        => $juros_imob,       
                        'juros_inq'         => $juros_inq,
                        'tipo_inq'          => $tipo_inquilino,
                        'cpf_cnpj'          => $row['cpf_cnpj'],
                        'id_imovel'         => $id_imovel,
                        'prop_resp'         => $prop_resp,
                        'tipo_prop'         => $tipo_prop,
                        'reajustar'         => $row['reajustar'], 
                        'pgto_multa'        => $row['pgto_multa'], 
                        'pgto_juros'        => $row['pgto_juros'],
                        'inq_email'         => $row['email1'],
                        'inq_email2'        => $row['email2'],
                        'gerado'            => $row['gerado']
                        );
return $dados_aluguel;
//echo "<pre>".print_r($dados_aluguel,'true')."<pre>";
}

function digitoVerificador_nossonumero($numero) {
    $resto2 = modulo_11($numero, 9, 1);
     $digito = 11 - $resto2;
     if ($digito == 10 || $digito == 11) {
        $dv = 0;
     } else {
        $dv = $digito;
     }
     return $dv;
}


function digitoVerificador_cedente($numero) {
  $resto2 = modulo_11($numero, 9, 1);
  $digito = 11 - $resto2;
  if ($digito == 10 || $digito == 11) $digito = 0;
  $dv = $digito;
  return $dv;
}

function digitoVerificador_barra($numero) {
    $resto2 = modulo_11($numero, 9, 1);
     if ($resto2 == 0 || $resto2 == 1 || $resto2 == 10) {
        $dv = 1;
     } else {
        $dv = 11 - $resto2;
     }
     return $dv;
}


function formata_numero($numero,$loop,$insert,$tipo = "geral") {
    if ($tipo == "geral") {
        $numero = str_replace(",","",$numero);
        while(strlen($numero)<$loop){
            $numero = $insert . $numero;
        }
    }
    if ($tipo == "valor") {
        /*
        retira as virgulas
        formata o numero
        preenche com zeros
        */
        $numero = str_replace(",","",$numero);
        while(strlen($numero)<$loop){
            $numero = $insert . $numero;
        }
    }
    if ($tipo == "convenio") {
        while(strlen($numero)<$loop){
            $numero = $numero . $insert;
        }
    }
    return $numero;
}


function esquerda($entra,$comp){
    return substr($entra,0,$comp);
}

function direita($entra,$comp){
    return substr($entra,strlen($entra)-$comp,$comp);
}

function fator_vencimento($data) {
  if ($data != "") {
    $data = explode("/",$data);
    $ano = $data[2];
    $mes = $data[1];
    $dia = $data[0];
    return(abs((_dateToDays("1997","10","07")) - (_dateToDays($ano, $mes, $dia))));
  } else {
    return "0000";
  }
}

function _dateToDays($year,$month,$day) {
    $century = substr($year, 0, 2);
    $year = substr($year, 2, 2);
    if ($month > 2) {
        $month -= 3;
    } else {
        $month += 9;
        if ($year) {
            $year--;
        } else {
            $year = 99;
            $century --;
        }
    }
    return ( floor((  146097 * $century)    /  4 ) +
            floor(( 1461 * $year)        /  4 ) +
            floor(( 153 * $month +  2) /  5 ) +
                $day +  1721119);
}

function modulo_10($num) { 
        $numtotal10 = 0;
        $fator = 2;

        // Separacao dos numeros
        for ($i = strlen($num); $i > 0; $i--) {
            // pega cada numero isoladamente
            $numeros[$i] = substr($num,$i-1,1);
            // Efetua multiplicacao do numero pelo (falor 10)
            $temp = $numeros[$i] * $fator; 
            $temp0=0;
            foreach (preg_split('//',$temp,-1,PREG_SPLIT_NO_EMPTY) as $k=>$v){ $temp0+=$v; }
            $parcial10[$i] = $temp0; //$numeros[$i] * $fator;
            // monta sequencia para soma dos digitos no (modulo 10)
            $numtotal10 += $parcial10[$i];
            if ($fator == 2) {
                $fator = 1;
            } else {
                $fator = 2; // intercala fator de multiplicacao (modulo 10)
            }
        }
        
        // várias linhas removidas, vide função original
        // Calculo do modulo 10
        $resto = $numtotal10 % 10;
        $digito = 10 - $resto;
        if ($resto == 0) {
            $digito = 0;
        }
        
        return $digito;
        
}

function modulo_11($num, $base=9, $r=0)  {
    /**
     *   Autor:
     *           Pablo Costa <pablo@users.sourceforge.net>
     *
     *   Função:
     *    Calculo do Modulo 11 para geracao do digito verificador 
     *    de boletos bancarios conforme documentos obtidos 
     *    da Febraban - www.febraban.org.br 
     *
     *   Entrada:
     *     $num: string numérica para a qual se deseja calcularo digito verificador;
     *     $base: valor maximo de multiplicacao [2-$base]
     *     $r: quando especificado um devolve somente o resto
     *
     *   Saída:
     *     Retorna o Digito verificador.
     *
     *   Observações:
     *     - Script desenvolvido sem nenhum reaproveitamento de código pré existente.
     *     - Assume-se que a verificação do formato das variáveis de entrada é feita antes da execução deste script.
     */                                        

    $soma = 0;
    $fator = 2;

    /* Separacao dos numeros */
    for ($i = strlen($num); $i > 0; $i--) {
        // pega cada numero isoladamente //
        $numeros[$i] = substr($num,$i-1,1);
        // Efetua multiplicacao do numero pelo falor
        $parcial[$i] = $numeros[$i] * $fator;
        // Soma dos digitos
        $soma += $parcial[$i];
        if ($fator == $base) {
            // restaura fator de multiplicacao para 2 
            $fator = 1;
        }
        $fator++;
    }

    /* Calculo do modulo 11 */
    if ($r == 0) {
        $soma *= 10;
        $digito = $soma % 11;
        if ($digito == 10) {
            $digito = 0;
        }
        return $digito;
    } elseif ($r == 1){
        $resto = $soma % 11;
        return $resto;
    }
}

function monta_linha_digitavel($codigo) {
        
        // Posição  Conteúdo
        // 1 a 3    Número do banco
        // 4        Código da Moeda - 9 para Real
        // 5        Digito verificador do Código de Barras
        // 6 a 9   Fator de Vencimento
        // 10 a 19 Valor (8 inteiros e 2 decimais)
        // 20 a 44 Campo Livre definido por cada banco (25 caracteres)

        // 1. Campo - composto pelo código do banco, código da moéda, as cinco primeiras posições
        // do campo livre e DV (modulo10) deste campo
        $p1 = substr($codigo, 0, 4);
        $p2 = substr($codigo, 19, 5);
        $p3 = modulo_10("$p1$p2");
        $p4 = "$p1$p2$p3";
        $p5 = substr($p4, 0, 5);
        $p6 = substr($p4, 5);
        $campo1 = "$p5.$p6";

        // 2. Campo - composto pelas posiçoes 6 a 15 do campo livre
        // e livre e DV (modulo10) deste campo
        $p1 = substr($codigo, 24, 10);
        $p2 = modulo_10($p1);
        $p3 = "$p1$p2";
        $p4 = substr($p3, 0, 5);
        $p5 = substr($p3, 5);
        $campo2 = "$p4.$p5";

        // 3. Campo composto pelas posicoes 16 a 25 do campo livre
        // e livre e DV (modulo10) deste campo
        $p1 = substr($codigo, 34, 10);
        $p2 = modulo_10($p1);
        $p3 = "$p1$p2";
        $p4 = substr($p3, 0, 5);
        $p5 = substr($p3, 5);
        $campo3 = "$p4.$p5";

        // 4. Campo - digito verificador do codigo de barras
        $campo4 = substr($codigo, 4, 1);

        // 5. Campo composto pelo fator vencimento e valor nominal do documento, sem
        // indicacao de zeros a esquerda e sem edicao (sem ponto e virgula). Quando se
        // tratar de valor zerado, a representacao deve ser 000 (tres zeros).
        $p1 = substr($codigo, 5, 4);
        $p2 = substr($codigo, 9, 10);
        $campo5 = "$p1$p2";

        return "$campo1 $campo2 $campo3 $campo4 $campo5"; 
}

function geraCodigoBanco($numero) {
    $parte1 = substr($numero, 0, 3);
    $parte2 = modulo_11($parte1);
    return $parte1 . "-" . $parte2;
}

function limpaCPF_CNPJ($valor){
    $valor = trim($valor);
    $valor = str_replace(".", "", $valor);
    $valor = str_replace(",", "", $valor);
    $valor = str_replace("-", "", $valor);
    $valor = str_replace("/", "", $valor);
    $valor = str_replace(" ", "", $valor);
    $valor = str_replace("(", "", $valor);
    $valor = str_replace(")", "", $valor);
    return $valor;
}


function remover_acentos($string, $slug = false) {
  $string = strtolower($string);
  // Código ASCII das vogais
  $ascii['a'] = range(224, 230);
  $ascii['e'] = range(232, 235);
  $ascii['i'] = range(236, 239);
  $ascii['o'] = array_merge(range(242, 246), array(240, 248));
  $ascii['u'] = range(249, 252);
  // Código ASCII dos outros caracteres
  $ascii['b'] = array(223);
  $ascii['c'] = array(231);
  $ascii['d'] = array(208);
  $ascii['n'] = array(241);
  $ascii['y'] = array(253, 255);
  foreach ($ascii as $key=>$item) {
    $acentos = '';
    foreach ($item AS $codigo) $acentos .= chr($codigo);
    $troca[$key] = '/['.$acentos.']/i';
  }
  $string = preg_replace(array_values($troca), array_keys($troca), $string);
  // Slug?
  if ($slug) {
    // Troca tudo que não for letra ou número por um caractere ($slug)
    $string = preg_replace('/[^a-z0-9]/i', $slug, $string);
    // Tira os caracteres ($slug) repetidos
    $string = preg_replace('/' . $slug . '{2,}/i', $slug, $string);
    $string = trim($string, $slug);
  }
  return $string;
}

function post_slug($str) 
{ 
  return strtoupper(preg_replace(array('/[^a-zA-Z0-9 -]/', '/[ -]+/', '/^-|-$/'), 
  array('', '-', ''), remover_acentos($str))); 
} 

# ******************************************************************************************************************************************************************
/*Campos Numéricos (“Picture 9”)
• Alinhamento: sempre à direita, preenchido com zeros à esquerda, sem máscara de edição;
• Não utilizados: preencher com zeros.
*/
# ******************************************************************************************************************************************************************

function picture_9($palavra,$limite){
    $var=str_pad($palavra, $limite, "0", STR_PAD_LEFT);
    return $var;
}

# ******************************************************************************************************************************************************************
/*
Campos Alfanuméricos (“Picture X”)
• Alinhamento: sempre à esquerda, preenchido com brancos à direita;
• Não utilizados: preencher com brancos;
• Caracteres: maiúsculos, sem acentuação, sem ‘ç’, sem caracteres especiais.
*/
# ******************************************************************************************************************************************************************
     
function picture_x($palavra,$limite){
    $var = str_pad($palavra, $limite," ", STR_PAD_RIGHT );
    $var = remover_acentos($var);
    if(strlen($palavra)>=$limite){
        $var = substr($palavra,0,$limite);
    }
    $var = strtoupper($var);// converte em letra maiuscula
    return $var;
}    

# ******************************************************************************************************************************************************************     

function sequencial($i)
{
if($i < 10)
{
return zeros(0,5).$i;
}
else if($i > 10 && $i < 100)
{
return zeros(0,4).$i;
}
else if($i > 100 && $i < 1000)
{
return zeros(0,3).$i;
}
else if($i > 1000 && $i < 10000)
{
return zeros(0,2).$i;
}
else if($i > 10000 && $i < 100000)
{
return zeros(0,1).$i;
}
}

# ******************************************************************************************************************************************************************

function zeros($min,$max)
{
$x = ($max - strlen($min));
for($i = 0; $i < $x; $i++)
{
$zeros .= '0';
}
return $zeros.$min;
}

function complementoRegistro($int,$tipo)
{
if($tipo == "zeros")
{
$space = '';
for($i = 1; $i <= $int; $i++)
{
$space .= '0';
}
}
else if($tipo == "brancos")
{
$space = '';
for($i = 1; $i <= $int; $i++)
{
$space .= ' ';
}
}

return $space;
}

# ******************************************************************************************************************************************************************
# FIM DAS FUNCOES
# ******************************************************************************************************************************************************************

/**
 * ValidaCPFCNPJ valida e formata CPF e CNPJ
 *
 * Exemplo de uso:
 * $cpf_cnpj  = new ValidaCPFCNPJ('71569042000196');
 * $formatado = $cpf_cnpj->formata(); // 71.569.042/0001-96
 * $valida    = $cpf_cnpj->valida(); // True -> Válido
 *
 * @package  valida-cpf-cnpj
 * @author   Luiz Otávio Miranda <contato@todoespacoonline.com/w>
 * @version  v1.4
 * @access   public
 * @see      http://www.todoespacoonline.com/w/
 */
class ValidaCPFCNPJ
{
    /** 
     * Configura o valor (Construtor)
     * 
     * Remove caracteres inválidos do CPF ou CNPJ
     * 
     * @param string $valor - O CPF ou CNPJ
     */
    function __construct ( $valor = null ) {
        // Deixa apenas números no valor
        $this->valor = preg_replace( '/[^0-9]/', '', $valor );
        
        // Garante que o valor é uma string
        $this->valor = (string)$this->valor;
    }

    /**
     * Verifica se é CPF ou CNPJ
     * 
     * Se for CPF tem 11 caracteres, CNPJ tem 14
     * 
     * @access protected
     * @return string CPF, CNPJ ou false
     */
    protected function verifica_cpf_cnpj () {
        // Verifica CPF
        if ( strlen( $this->valor ) === 11 ) {
            return 'CPF';
        } 
        // Verifica CNPJ
        elseif ( strlen( $this->valor ) === 14 ) {
            return 'CNPJ';
        } 
        // Não retorna nada
        else {
            return false;
        }
    }
    
    /**
     * Verifica se todos os números são iguais
     *   * 
     * @access protected
     * @return bool true para todos iguais, false para números que podem ser válidos
     */
    protected function verifica_igualdade() {
        // Todos os caracteres em um array
        $caracteres = str_split($this->valor );
        
        // Considera que todos os números são iguais
        $todos_iguais = true;
        
        // Primeiro caractere
        $last_val = $caracteres[0];
        
        // Verifica todos os caracteres para detectar diferença
        foreach( $caracteres as $val ) {
            
            // Se o último valor for diferente do anterior, já temos
            // um número diferente no CPF ou CNPJ
            if ( $last_val != $val ) {
               $todos_iguais = false; 
            }
            
            // Grava o último número checado
            $last_val = $val;
        }
        
        // Retorna true para todos os números iguais
        // ou falso para todos os números diferentes
        return $todos_iguais;
    }

    /**
     * Multiplica dígitos vezes posições
     *
     * @access protected
     * @param  string    $digitos      Os digitos desejados
     * @param  int       $posicoes     A posição que vai iniciar a regressão
     * @param  int       $soma_digitos A soma das multiplicações entre posições e dígitos
     * @return int                     Os dígitos enviados concatenados com o último dígito
     */
    protected function calc_digitos_posicoes( $digitos, $posicoes = 10, $soma_digitos = 0 ) {
        // Faz a soma dos dígitos com a posição
        // Ex. para 10 posições:
        //   0    2    5    4    6    2    8    8   4
        // x10   x9   x8   x7   x6   x5   x4   x3  x2
        //   0 + 18 + 40 + 28 + 36 + 10 + 32 + 24 + 8 = 196
        for ( $i = 0; $i < strlen( $digitos ); $i++  ) {
            // Preenche a soma com o dígito vezes a posição
            $soma_digitos = $soma_digitos + ( $digitos[$i] * $posicoes );

            // Subtrai 1 da posição
            $posicoes--;

            // Parte específica para CNPJ
            // Ex.: 5-4-3-2-9-8-7-6-5-4-3-2
            if ( $posicoes < 2 ) {
                // Retorno a posição para 9
                $posicoes = 9;
            }
        }

        // Captura o resto da divisão entre $soma_digitos dividido por 11
        // Ex.: 196 % 11 = 9
        $soma_digitos = $soma_digitos % 11;

        // Verifica se $soma_digitos é menor que 2
        if ( $soma_digitos < 2 ) {
            // $soma_digitos agora será zero
            $soma_digitos = 0;
        } else {
            // Se for maior que 2, o resultado é 11 menos $soma_digitos
            // Ex.: 11 - 9 = 2
            // Nosso dígito procurado é 2
            $soma_digitos = 11 - $soma_digitos;
        }

        // Concatena mais um dígito aos primeiro nove dígitos
        // Ex.: 025462884 + 2 = 0254628842
        $cpf = $digitos . $soma_digitos;

        // Retorna
        return $cpf;
    }

    /**
     * Valida CPF
     *
     * @author                Luiz Otávio Miranda <contato@todoespacoonline.com/w>
     * @access protected
     * @param  string    $cpf O CPF com ou sem pontos e traço
     * @return bool           True para CPF correto - False para CPF incorreto
     */
    protected function valida_cpf() {
        // Captura os 9 primeiros dígitos do CPF
        // Ex.: 02546288423 = 025462884
        $digitos = substr($this->valor, 0, 9);

        // Faz o cálculo dos 9 primeiros dígitos do CPF para obter o primeiro dígito
        $novo_cpf = $this->calc_digitos_posicoes( $digitos );

        // Faz o cálculo dos 10 dígitos do CPF para obter o último dígito
        $novo_cpf = $this->calc_digitos_posicoes( $novo_cpf, 11 );
        
        // Verifica se todos os números são iguais
        if ( $this->verifica_igualdade() ) {
            return false;
        }

        // Verifica se o novo CPF gerado é idêntico ao CPF enviado
        if ( $novo_cpf === $this->valor ) {
            // CPF válido
            return true;
        } else {
            // CPF inválido
            return false;
        }
    }

    /**
     * Valida CNPJ
     *
     * @author                  Luiz Otávio Miranda <contato@todoespacoonline.com/w>
     * @access protected
     * @param  string     $cnpj
     * @return bool             true para CNPJ correto
     */
    protected function valida_cnpj () {
        // O valor original
        $cnpj_original = $this->valor;

        // Captura os primeiros 12 números do CNPJ
        $primeiros_numeros_cnpj = substr( $this->valor, 0, 12 );

        // Faz o primeiro cálculo
        $primeiro_calculo = $this->calc_digitos_posicoes( $primeiros_numeros_cnpj, 5 );

        // O segundo cálculo é a mesma coisa do primeiro, porém, começa na posição 6
        $segundo_calculo = $this->calc_digitos_posicoes( $primeiro_calculo, 6 );

        // Concatena o segundo dígito ao CNPJ
        $cnpj = $segundo_calculo;
        
        // Verifica se todos os números são iguais
        if ( $this->verifica_igualdade() ) {
            return false;
        }

        // Verifica se o CNPJ gerado é idêntico ao enviado
        if ( $cnpj === $cnpj_original ) {
            return true;
        }
    }

    /**
     * Valida
     * 
     * Valida o CPF ou CNPJ
     * 
     * @access public
     * @return bool      True para válido, false para inválido
     */
    public function valida () {
        // Valida CPF
        if ( $this->verifica_cpf_cnpj() === 'CPF' ) {
            // Retorna true para cpf válido
            return $this->valida_cpf();
        } 
        // Valida CNPJ
        elseif ( $this->verifica_cpf_cnpj() === 'CNPJ' ) {
            // Retorna true para CNPJ válido
            return $this->valida_cnpj();
        } 
        // Não retorna nada
        else {
            return false;
        }
    }

    /**
     * Formata CPF ou CNPJ
     *
     * @access public
     * @return string  CPF ou CNPJ formatado
     */
    public function formata() {
        // O valor formatado
        $formatado = false;

        // Valida CPF
        if ( $this->verifica_cpf_cnpj() === 'CPF' ) {
            // Verifica se o CPF é válido
            if ( $this->valida_cpf() ) {
                // Formata o CPF ###.###.###-##
                $formatado  = substr( $this->valor, 0, 3 ) . '.';
                $formatado .= substr( $this->valor, 3, 3 ) . '.';
                $formatado .= substr( $this->valor, 6, 3 ) . '-';
                $formatado .= substr( $this->valor, 9, 2 ) . '';
            }
        } 
        // Valida CNPJ
        elseif ( $this->verifica_cpf_cnpj() === 'CNPJ' ) {
            // Verifica se o CPF é válido
            if ( $this->valida_cnpj() ) {
                // Formata o CNPJ ##.###.###/####-##
                $formatado  = substr( $this->valor,  0,  2 ) . '.';
                $formatado .= substr( $this->valor,  2,  3 ) . '.';
                $formatado .= substr( $this->valor,  5,  3 ) . '/';
                $formatado .= substr( $this->valor,  8,  4 ) . '-';
                $formatado .= substr( $this->valor, 12, 14 ) . '';
            }
        } 

        // Retorna o valor 
        return $formatado;
    }
}


?>

