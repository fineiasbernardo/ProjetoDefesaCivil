<?php
//inclui a conexao com o banco de dados
include 'database.php'; 

//recebe dados do $_POST
$chamado_id = addslashes($_POST['id_chamado']);
$endereco_principal = addslashes($_POST['endereco_principal']);
$longitude = addslashes($_POST['longitude']);
$latitude = addslashes($_POST['latitude']);
$cep = addslashes($_POST['cep']);
$cidade = addslashes($_POST['cidade']);
$bairro = addslashes($_POST['bairro']);
$logradouro = addslashes($_POST['logradouro']);
$numero = addslashes($_POST['complemento']);
$referencia = addslashes($_POST['referencia']);
//$agente_principal = addslashes($_POST['agente_principal']);
$agente_apoio_1 = addslashes($_POST['agente_apoio_1']);
$agente_apoio_2 = addslashes($_POST['agente_apoio_2']);
$data_ocorrencia = addslashes($_POST['data_ocorrencia']);
$titulo = addslashes($_POST['titulo']);
$descricao = addslashes($_POST['descricao']);
$ocorr_origem = addslashes($_POST['ocorr_origem']);
$nome_pessoa1 = addslashes($_POST['pessoa_atendida_1']);
$nome_pessoa2 = addslashes($_POST['pessoa_atendida_2']);
$cobrade_categoria = $_POST['cobrade_categoria'];
$cobrade_grupo = $_POST['cobrade_grupo'];
$cobrade_subgrupo = $_POST['cobrade_subgrupo'];
$cobrade_tipo = $_POST['cobrade_tipo'];
$cobrade_subtipo = $_POST['cobrade_subtipo'];

$prioridade = addslashes($_POST['prioridade']);

$base64_array = array();

foreach($_FILES["files"]["tmp_name"] as $key=>$tmp_name){
    $temp = $_FILES["files"]["tmp_name"][$key];
        
    if(empty($temp))
        break;
        
    $binary = file_get_contents($temp);
    $base64 = base64_encode($binary);
    array_push($base64_array, $base64);
}

$pg_array = '{'.join(',',$base64_array).'}';

if($pg_array == "{}"){
	$possui_fotos = "false";
}else{
	$possui_fotos = "true";
}

$analisado = 'false';
$congelado = 'false';
$encerrado = 'false';

session_start();
$id_criador = $_SESSION['id_usuario'];
$dataAtual = date('Y-m-d H:i:s');

$data_lancamento = $dataAtual;

if($_SESSION['nivel_acesso'] != 1){
	$prioridade = 'Baixa';
	$analisado = 'false';
	$congelado = 'false';
	$encerrado = 'false';
}

//guarda possiveis erros na inserção do usuário
$erros = '';

if($cobrade_categoria == 0){
	$cobrade = '00000';
}else{
	//verifica se os valores para formar o codigo do cobrade estao de acordo
	if(!preg_match("/^[0-5]$/", $cobrade_categoria))
		$cobrade_categoria = 0;
	if(!preg_match("/^[0-5]$/", $cobrade_grupo))
		$cobrade_grupo = 0;
	if(!preg_match("/^[0-5]$/", $cobrade_subgrupo))
		$cobrade_subgrupo = 0;
	if(!preg_match("/^[0-5]$/", $cobrade_tipo))
		$cobrade_tipo = 0;
	if(!preg_match("/^[0-5]$/", $cobrade_subtipo))
		$cobrade_subtipo = 0;
	$cobrade = $cobrade_categoria.$cobrade_grupo.$cobrade_subgrupo.$cobrade_tipo.$cobrade_subtipo;
	if(strlen($cobrade) > 5 || substr($cobrade, 0, 1) == '0' || substr($cobrade, 1, 2) == '0' || substr($cobrade, 2, 3) == '0')
		$erros = $erros.'&cobrade';
}

//seleciona o endereço no BD, caso ele nao exista entao cria um novo
$logradouro_id = 'null';
if($endereco_principal == "Logradouro"){
	$cep = str_replace("-","",$cep);
	$result = pg_query($connection, "SELECT * FROM endereco_logradouro
									WHERE logradouro = '$logradouro' AND numero = '$numero'");
	if(pg_num_rows($result) == 0){
		$result = pg_query($connection, "INSERT INTO endereco_logradouro(cep,cidade,bairro,logradouro,numero,referencia)
										VALUES ('$cep','$cidade','$bairro','$logradouro','$numero','$referencia')
										RETURNING id_logradouro");
		if(!$result)
			$erros = $erros.'&logradouro';
	}
	$linha = pg_fetch_array($result, 0);
	$logradouro_id = $linha['id_logradouro'];

	$result = pg_query($connection, "INSERT INTO log_endereco(id_logradouro, id_usuario, data_hora)
									VALUES ($logradouro_id, $id_criador, '$dataAtual')");

	$longitude = 'null';
	$latitude = 'null';
}

if($ocorr_retorno == "true"){ //caso seja retorno de ocorrencia, verifica se nao esta vazio e soh aceita numeros
	if(!preg_match("/^[0-9]$/", $ocorr_referencia) || strlen($ocorr_referencia) <= 0)
		$erros = $erros.'&ocorr_referencia';
}else //caso nao for retorno, seta a variavel como null
	$ocorr_referencia = 'null';

//busca o agente informado no banco de dados
//$result = pg_query($connection, "SELECT * FROM usuario WHERE nome = '$agente_principal'");
//if($result){
//	if(pg_num_rows($result) == 0){ //agente nao encontrado
//		$erros = $erros.'&agente_principal';
//	}else{ //agente encontrado, seleciona o id do mesmo
//		$linha = pg_fetch_array($result, 0);
//		$agente_principal = $linha['id_usuario'];
//	}
//}else//retorna erro caso nao consiga acessar o banco de dados
//	$erros = $erros.'&agente_principal';

if(strlen($agente_apoio_1) > 0 && $agente_apoio_1 != null){ //se o agente foi informado, busca o mesmo no BD
	$result = pg_query($connection, "SELECT * FROM usuario WHERE nome = '$agente_apoio_1'");
	if($result){
		if(pg_num_rows($result) == 0){ //agente nao encontrado
			$erros = $erros.'&agente_apoio_1';
		}else{  //agente encontrado, seleciona o id do mesmo
			$linha = pg_fetch_array($result, 0);
			$agente_apoio_1 = $linha['id_usuario'];
		}
	}else //retorna erro caso nao consiga acessar o banco de dados
		$erros = $erros.'&agente_apoio_1';
}else //agente nao foi informado
	$agente_apoio_1 = 'null';

if(strlen($agente_apoio_2) > 0 && $agente_apoio_2 != null){ //se o agente foi informado, busca o mesmo no BD
	$result = pg_query($connection, "SELECT * FROM usuario WHERE nome = '$agente_apoio_2'");
	if($result){ //agente encontrado
		if(pg_num_rows($result) == 0){ //agente nao encontrado
			$erros = $erros.'&agente_apoio_2';
		}else{  //agente encontrado, seleciona o id do mesmo
			$linha = pg_fetch_array($result, 0);
			$agente_apoio_2 = $linha['id_usuario'];
		}
	}else //retorna erro caso nao consiga acessar o banco de dados
		$erros = $erros.'&agente_apoio_2';
}else //agente nao foi informado
	$agente_apoio_2 = 'null';

//if(strlen($pessoa_atendida_1) > 0){ //se a pessoa foi informada, busca a mesma no BD 
//	$result = pg_query($connection, "SELECT * FROM pessoa WHERE nome = '$pessoa_atendida_1'");
//	if($result){
//		if(pg_num_rows($result) == 0){ //pessoa nao encontrada
//			$erros = $erros.'&pessoa_atendida_1';
//		}else{  //pessoa encontrada, seleciona o id da mesma
//			$linha = pg_fetch_array($result, 0);
//			$pessoa_atendida_1 = $linha['id_pessoa'];
//		}
//	}else //erro no acesso ao BD
//		$erros = $erros.'&pessoa_atendida_1';
//}else //pessoa nao foi informada
	$pessoa_atendida_1 = 'null';

//if(strlen($pessoa_atendida_2) > 0){ //se a pessoa foi informada, busca a mesma no BD
//	$result = pg_query($connection, "SELECT * FROM pessoa WHERE nome = '$pessoa_atendida_2'");
//	if($result){
//		if(pg_num_rows($result) == 0){ //pessoa nao encontrada
//			$erros = $erros.'&pessoa_atendida_2';
//		}else{  //pessoa encontrada, seleciona o id da mesma
//			$linha = pg_fetch_array($result, 0);
//			$pessoa_atendida_2 = $linha['id_pessoa'];
//		}
//	}else //erro no acesso ao BD
//		$erros = $erros.'&pessoa_atendida_2';
//}else //pessoa nao foi informada
	$pessoa_atendida_2 = 'null';

if(strlen($chamado_id)==0)
	$chamado_id = 'null';

//caso ocorra algum erro na validacao, entao volta para a pagina e indica onde esta o erro
if(strlen($erros) > 0){
	header('location:index.php?pagina=cadastrarOcorrencia'.$erros);
//caso esteja tudo certo, procede com a inserção no banco de dados
}else{
	//insere a ocorrencia no banco de dados
	$query = "INSERT INTO ocorrencia 
			(chamado_id,ocorr_endereco_principal,ocorr_coordenada_latitude,ocorr_coordenada_longitude,
			ocorr_logradouro_id,agente_principal,agente_apoio_1,agente_apoio_2,
			data_ocorrencia,ocorr_titulo,ocorr_descricao,ocorr_origem,atendido_1,atendido_2,ocorr_cobrade,
			ocorr_fotos,ocorr_prioridade,ocorr_analisado,ocorr_congelado,ocorr_encerrado,
			usuario_criador,data_alteracao,ocorr_referencia, fotos, nome_pessoa1, nome_pessoa2)
			VALUES
			($chamado_id,'$endereco_principal',$latitude,$longitude,$logradouro_id,$id_criador,
			$agente_apoio_1,$agente_apoio_2,
			'$data_ocorrencia','$titulo','$descricao','$ocorr_origem',$pessoa_atendida_1,$pessoa_atendida_2,
			'$cobrade',$possui_fotos,'$prioridade',$analisado,$congelado,$encerrado,
			$id_criador,'$dataAtual',null, '$pg_array', '$nome_pessoa1', '$nome_pessoa2')";

	$result = pg_query($connection, $query);
	if(!$result){
		echo pg_last_error();
		//header('location:index.php?pagina=cadastrarOcorrencia&erroDB');
	}else{
		if($chamado_id != 'null'){
			$query = "UPDATE chamado SET usado = TRUE WHERE id_chamado = $chamado_id";
			$result = pg_query($connection, $query);
			if(!$result){
				//echo pg_last_error();
				header('location:index.php?pagina=cadastrarOcorrencia&erroDB');
			}else{
				header('location:index.php?pagina=cadastrarOcorrencia&sucesso');
			}
		}else{
			//echo pg_last_error();
			header('location:index.php?pagina=cadastrarOcorrencia&sucesso');
		}
	}
}