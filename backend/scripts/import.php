<?php 

require_once("..".DIRECTORY_SEPARATOR."config".DIRECTORY_SEPARATOR."config.php");

//Retirar tempo de execução da página, usar com cuidado...
set_time_limit(0);


echo "<br>==SCRIPT PARA IMPORTAÇÃO DE DADOS PARA BANCO DE DADOS==</br>";
echo "<hr/>";


/*SCRIPT DE IMPORTAÇÃO DE PAÍSES*/
/*
echo "<br>==IMPORTAÇÃO DE LISTA DE PAÍSES==</br><br/>";

$paises = json_decode(file_get_contents("paises-no-formato-JSON-master".DIRECTORY_SEPARATOR."countriesJson_ptBR.json"), true);

$sql = new Sql();

foreach ($paises as $pais) {

	echo "==================================<br/>";
	echo "Importando país...<br/>";
	echo "DDI=> ".$pais["fone"]."<br/>";
	echo "Nome do país=> ".$pais["nome"]."<br/>";
	echo "Nome Formal=> ".$pais["nomeFormal"]."<br/>";
	echo "Sigla 01=> ".$pais["iso"]."<br/>";
	echo "Sigla 02=> ".$pais["iso3"]."<br/>";
	echo "==================================<br/><br/>";

	$rawQuery = "INSERT INTO tbl_paises (nome, sigla01, sigla02, nomeFormal, ddi) VALUES (:nome,:sigla01, :sigla02, :nomeFormal, :ddi)";

	$sql->query($rawQuery, array(
		":nome" => utf8_decode($pais["nome"]),
		":sigla01" => $pais["iso"],
		":sigla02" => $pais["iso3"],
		":nomeFormal" => utf8_decode($pais["nomeFormal"]),
		":ddi" => $pais["fone"]
	));

}

echo "Importação efetuada com sucesso, cheque agora o banco de dados";

$result = $sql->select("SELECT * FROM tbl_paises");

echo utf8_encode($result[0]['nome']);
echo utf8_encode($result[0]['nomeFormal']);

*/

/*SCRIPT DE IMPORTAÇÃO DE ESTADOS E CIDADES

echo "<br>==IMPORTAÇÃO DE LISTA DE ESTADOS E MUNICÍPIOS==</br><br/>";

$estados_cidades = json_decode(file_get_contents("estados-cidades-no-formato-JSON".DIRECTORY_SEPARATOR."estados-cidades.json"), true);

$sql = new Sql();

foreach ($estados_cidades as $estados) {
	
	foreach ($estados as $estado) {
		
		$id_estado_inserido = $sql->insert("INSERT INTO tbl_uf (nome, sigla, id_pais) VALUES (:nome ,:sigla ,:id_pais);", array(
			":nome"=> utf8_decode($estado["nome"]),
			":sigla"=> $estado["sigla"],
			":id_pais"=> 30 //Id do Brasil no banco
		));

		echo "Estado id=> ". $id_estado_inserido. " inserido...";
		echo "<br/>Sigla=>".$estado["sigla"]."<br/>";
		echo "<hr/>";
		echo "Cidades=====<br>";
		foreach ($estado["cidades"] as $cidade) {
			$id_municipio_inserido = $sql->insert("INSERT INTO tbl_municipios (nome, id_uf) VALUES (:nome, :id_uf);", array(
				":nome" => utf8_decode($cidade),
				":id_uf" => $id_estado_inserido
			));			

			echo "Município id=> ". $id_municipio_inserido. " inserido..."; 
		}


	}

}*/

/*SCRIPT DE IMPORTAÇÃO DE BANCOS BRASILEIROS*/

echo "<br>==IMPORTAÇÃO DE LISTA DE ESTADOS E MUNICÍPIOS==</br><br/>";

$bancos_br = json_decode(file_get_contents("bancos-br-no-formato-JSON".DIRECTORY_SEPARATOR."banks_BR.json"), true);

$sql = new Sql();

foreach ($bancos_br as $banco) {
	
	echo "Importando banco...<br/>";

	echo "==================================<br/>";
	echo "Banco=> ". $banco["name"]."<br/>";
	echo "Sigla=>".$banco["short_name"]."<br/>";
	echo "Código=>".$banco["code"]."<br/>";
	
	if (isset($banco["jurisdiction"])) {
		echo "Jurisdição=>" . $banco["jurisdiction"]. "<br/>";
		$juris = $banco["jurisdiction"];
	}
		
	else{
		echo "Jurisdição=> NÃO INFORMADA<br/>";
		$juris = NULL;	
	} 
		

	if (isset($banco["website"])) {

		echo "website=>".$banco["website"]."<br/>";
		$website = $banco["website"];
	}
		
	else {
		echo "website=> NÃO INFORMADO<br/>";
		$website = NULL;	
	} 
		
	
	echo "==================================<br/>";

	$id_banco_inserido = $sql->insert("INSERT INTO tbl_bancos (nome, sigla, codigo, jurisdicao, website, id_pais) VALUES (:nome, :sigla, :codigo, :jurisdicao, :website, :id_pais);", array(
			":nome"=> utf8_decode($banco["name"]),
			":sigla"=> utf8_decode($banco["short_name"]),
			":codigo"=> utf8_decode($banco["code"]),
			":jurisdicao"=> utf8_decode($juris),
			":website"=> utf8_decode($website),
			":id_pais"=> 30 //Id do Brasil no banco
		));

	echo "<br/>Banco ".$id_banco_inserido. "inserido...";

}


 ?>