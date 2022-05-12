<?php 
//include('db.php');
include_once('funcoes.php');

    //$id=$_GET['idLancam'];

    $query = "SELECT A.*, B.id_contrato, B.id_inquilino, B.id_imovel, B.atraso_multa, B.atraso_juros, B.imob_valor, B.imob_percent, B.imob_perc_juros, C.id_cliente, C.nome, C.tipo, C.cpf_cnpj, C.email1, D.rua, D.numero, D.complemento, D.id_bairro, D.id_cidade, D.cep, D.cep_sufixo, E.id_bairro, E.bairro, F.id_cidade, F.cidade, G.sigla
                FROM lancamentos A, locacoes B, clientes C, imoveis D, bairros E, cidades F, estados G
                WHERE id_lancam=$id
                AND A.id_contrato = B.id_contrato
                AND B.id_inquilino = C.id_cliente
                AND B.id_imovel = D.id_imovel
                AND D.id_bairro = E.id_bairro
                AND D.id_cidade = F.id_cidade
                AND D.id_estado = G.id_estado
            ";

    //echo $query;

    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

    mysqli_free_result($result);

    $data_vencim = $row['vencimento'];

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

    if ($imob_valor>0) {
        $taxa_adm   = $imob_valor;
    }else if($imob_percent > 0){
        $taxa_adm   = ($valor_aluguel * $imob_percent)/100;
    }else{
        $taxa_adm   = 0;
    }


    //*************************************************************************    
    // Verifica se proprietário = PF e inquilino = PJ, para deduzir IRRF
    //************************************************************************* 
    $id_imovel          = $row['id_imovel'];
    $tipo_inquilino     = $row['tipo'];

    $sql = "SELECT A.nome, A.tipo 
            FROM clientes A, imoveis_prop B
            WHERE A.id_cliente = B.id_prop 
            AND B.id_imovel = $id_imovel
            AND B.resp = 's'
            ";

    $result2    = mysqli_query($conn, $sql);

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


    //*************************************************************************    
    // Carrega as variaveis para despesas de envio: $desp_envio
    //************************************************************************* 
    $valor_boleto       = $row['taxa_boleto'];
    $valor_correio      = $row['taxa_correio'];

    $desp_envio         = $valor_boleto + $valor_correio;

    //*************************************************************************    
    // Verifica se tem valores extras e cria variável $extras
    //*************************************************************************    
    $sql = "SELECT * FROM extras WHERE id_lancam = '$id' AND ativo='s'";
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
        $multa = (($valor_aluguel + $encargos + $desp_envio) * $row['atraso_multa'])/100;
        $multa = number_format($multa,'2','.','');
        $juros = number_format((((($valor_aluguel + $encargos + $desp_envio) * $row['atraso_juros'])/100)/30)*$dif,'2','.','');
    }else{
        $multa = $row['pgto_multa'];
        $juros = $row['pgto_juros'];
    }


    //*************************************************************************    
    // Cria a variável total somando todos os valores
    //*************************************************************************
    $total = $valor_aluguel + $encargos - $valor_irrf + $desp_envio + $extras + $multa + $juros;


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
                        'num_contrato'      => $row['id_contrato'],
                        'num_lancam'        => $row['id_lancam'],
                        'referencia'        => $row['referencia'],
                        'imob_valor'        => $imob_valor,
                        'imob_percent'      => $imob_percent,
                        'imob_perc_juros'   => $imob_perc_juros,
                        'inquilino'         => $row['nome'],
                        'rua'               => $row['rua'],
                        'numero'            => $row['numero'],
                        'complemento'       => $row['complemento'],
                        'bairro'            => $row['bairro'],
                        'cidade'            => $row['cidade'],
                        'estado'            => $row['sigla'],
                        'cep'               => $row['cep'],
                        'cep_sufixo'        => $row['cep_sufixo'],
                        'estado'            => $row['sigla'],
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
                        'inq_email'         => $row['email1']
                        );

//echo "<pre>".print_r($dados_aluguel,'true')."<pre>";

?>