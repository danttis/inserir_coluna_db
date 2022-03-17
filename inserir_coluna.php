<?php
include 'connect.php';

$checar = $conexao->prepare( "IF EXISTS( SELECT * FROM NOME_DO_SE_BANCO.INFORMATION_SCHEMA.COLUMNS 
            WHERE UPPER(TABLE_NAME) = UPPER('SUA_TABELA') 
            AND  UPPER(COLUMN_NAME) = UPPER('id_usuario'))");
			
$checar->execute();
if(!$checar{
	echo "<script>alert('Coluna já existe!');</script>";
}
else{

	$nova_coluna = $conexao->prepare("ALTER TABLE SUA_TABELA ADD id_usuario INT(10)");
	$nova_coluna->execute();
}	
$check_sistema = $conexao->prepare("select * from OUTRA_TABELA"); // no caso eu vou inserir o id usuario a tabela SUA_TABELA , usando o id_sistema que é comum nas duas tabelas.
$check_sistema->execute();

	while($array = $check_sistema ->fetch(PDO::FETCH_OBJ)){
	$id_sistema_sk = $array->id;
	$id_user = $array->id_usuario;
		$sql = $conexao->prepare("UPDATE SUA_TABELA SET id_usuario='$id_user' WHERE id_sistema='$id_sistema_sk';");
        $sql->execute();
	
}

?>