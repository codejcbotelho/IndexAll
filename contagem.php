<?php
	
	require('conexao.php');
	
	$enderecos = mysql_query('SELECT * FROM enderecos');
	$imagens = mysql_query('SELECT * FROM imagens WHERE estado = 1');
	
	echo 'A caminho do sucesso!<br /><span>'.mysql_num_rows($imagens).'</span> imagens e <span>'.mysql_num_rows($enderecos).'</span> sites';
	
?>