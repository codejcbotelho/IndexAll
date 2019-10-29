<?php
	
	## ROBO INDEXALL 1.0
	
	ob_start();
	
	ini_set('max_execution_time', 0);
	
	require('conexao.php');
	
	// redimensiona o tamanho da imagem || redimensionar(imagem, nome, largura, pasta)
	function redimensionar($imagem, $name, $largura, $pasta){
		$img = imagecreatefromjpeg($imagem);
		
		$x = imagesx($img);
		$y = imagesy($img);
		
		$altura = ($largura * $y)/$x;
		
		$nova = imagecreatetruecolor($largura, $altura);
		
		imagecopyresampled($nova, $img, 0, 0, 0, 0, $largura, $altura, $x, $y);
		imagejpeg($nova, $pasta.'/'.$name);
		
		imagedestroy($img);
		
		imagedestroy($nova);
		
		return $name;
	}
	
	$consulta = mysql_query('SELECT * FROM enderecos ORDER BY id DESC');
	
	if(mysql_num_rows($consulta) != 0){
		
		while($conteudos = mysql_fetch_assoc($consulta)){
			
			mysql_free_result($consulta);
			
			$pagina = @file_get_contents($conteudos['endereco']);
			preg_match_all('#http:\/\/www.([a-zA-Z0-9]+).([a-zA-Z0-9\.]+)#sm', $pagina, $enderecos);
			
			if(count($enderecos[0] != 0)){
				for($i = 0; $i <= count($enderecos[0]); $i++){
					
					$endereco = $enderecos[0][$i];
					$consulta = mysql_query("SELECT * FROM enderecos WHERE endereco = '$endereco'");
					
					if(mysql_num_rows($consulta) == 0 && !empty($endereco)){
						$inserir = mysql_query("INSERT INTO enderecos (`id`, `endereco`) VALUES (NULL, '$endereco')");
						
						if($inserir != false){
							$pagina2 = @file_get_contents($endereco);
							preg_match_all('#img src\=\"http\:\/\/([a-z0-9\.\-\_\/]+)\"#sm', $pagina2, $valores);
							
							$quantimg = count($valores[1]);
							
							if($quantimg != null){
								for($i = 0; $i <= $quantimg; $i++){
									
									$nomeimg = md5(time().$valores[1][$i]).'.jpg';
									@copy('http://'.$valores[1][$i], 'indexall_files/images/original/'.$nomeimg);
									mysql_query("INSERT INTO imagens (`id`, `imagem`, `endereco`, `hits`, `estado`) VALUES (NULL, '$nomeimg', 'http://".$valores[1][$i]."', '0', '1')");
								
									if(imagesx('http://'.$valores[1][$i]) < 240): redimensionar('indexall_files/images/original/'.$nomeimg, $nomeimg, 250, 'indexall_files/images/x240'); else: @copy('http://'.$valores[1][$i], 'indexall_files/images/x240/'.$nomeimg); endif;
								}
							}
							
							ob_end_clean();
						}
					}
					
					ob_end_clean();
				}
			}
			
		}
		
		ob_end_clean();
	}
	
	ob_end_clean();
	
	echo '<script>
	setInterval(\'recarregar()\', 1000);
	function recarregar(){
	location.href = \'indexallbotimg.php\';
	document.write(\'Processando...<br />\');
	}
	</script>';
	
?>