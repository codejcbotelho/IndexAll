<?php
	
	# O Indexall é um projeto academico, ou seja, apenas para estudos.
	# A reprodução desse material para fins lucrativos está sujeito a processo diante da lei.
	
?>
<html>
<head>
	<title>Indexall</title>
	
	<style type="text/css">
		*{margin: 0px auto;}
		body{font-size: 10pt; font-family: Arial, Helvetica, serif-Sans; color: #252525;}
		
		#estrutura{
			width: 600px;
			margin-top: 100px;
			text-align: center;
			display: none;
		}
		
		#formulario{
			width: 350px;
			-webkit-border-radius: 100px;
			margin-bottom: 15px;
			margin-top: 25px;
			border: 1px solid #999999;
		}
		
		#formulario input{
			border: 0px;
			background: #FFFFFF;
			font-size: 12pt;
			padding: 10px;
		}
		
		#numimg{margin-bottom: 8px; font-size: 12pt;}
		#numimg span{color: #FF6600; font-weight: bold;}
	</style>
	
	<script type="text/javascript" src="jquery-1.4.2.min.js"></script>
	<script type="text/javascript">	
		$(document).ready(function(){
			$('#estrutura').fadeIn(500, function(){
				$('#campocont').focus();
				setInterval('contagem()', 1000); // 1 segundos
			});
		});
		
		function contagem(){
			$(document).ready(function(){
				$.get('contagem.php', function(data){
					$('#numimg').html(data).fadeIn(1500);
				});
			});
		}
	</script>
</head>

<body>
	<div id="estrutura">
		<img src="images/logo.png" alt="Indexall" title="Indexall" />
	
		<form method="GET" action="results.php" id="formulario">
			<input type="text" name="campocont" id="campocont" style="width: 200px;" />
			<input type="submit" value="Vasculhar..." />
		</form>
		
		<div id="numimg"></div>
		
		&copy;2011 Indexall - Simples, rápido e elegante.<br />
        Site desenvolvido pelos instrutores/professores do Grupo Jardins.
	</div>
</body>
</html>