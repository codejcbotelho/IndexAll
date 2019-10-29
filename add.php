<?php
	
	## add url no banco de dados
	
	require('conexao.php');
	
	if(!empty($_GET['url'])){
	$endereco = $_GET['url'];
	mysql_query("INSERT INTO enderecos (`id`, `endereco`) VALUES (NULL, '$endereco')");
	echo '<script>document.getElementById(\'url\').focus();</script>';
	}
	
	echo '<form method="get" action="add.php">
	<input type="text" id="url" name="url" />
	<input type="submit" value="add" />
	</form>';
	
?>