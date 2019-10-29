<?
	
	require('conexao.php');
	
	$seleciona = mysql_query("SELECT * FROM imagens WHERE endereco LIKE '%".$_GET['campocont']."%' ORDER BY id DESC");
	
	$quantresults = mysql_num_rows($seleciona);
	
?>
<html>
<head>
<title>results</title>
<style type="text/css">
*{margin: 0px auto;}
body{margin: 15px 10px 70px 10px; background: #252525;}
#estrutura{}
#campo{position: fixed; bottom: 10; width: 800px; left: 50%; margin-left: -400px; background: #FFFFFF; -webkit-border-radius: 100px; z-index: 10000; text-align: center;}
#campo input{padding: 10px; font-size: 15pt; margin-top: 5px; margin-bottom: 5px; border: 0px;}
</style>

<script type="text/javascript" src="jquery-1.4.2.min.js"></script>
<script type="text/javascript">
	
	$(document).ready(function(){
		var width = screen.width - 100;
		$('#estrutura').css({width: width});
	});
	
	$(document).ready(
	<?
		
		$final = null;
		
		for($i = 0; $i <= $quantresults; $i++){
		echo 'function(){$(\'#'.$i.'\').show(170';
		echo ($i == $quantresults) ? '' : ', ';
		$final .= ');}';
		}
		
		echo $final;
		
	?>
	);

</script>
</head>
<body onLoad="javascript: document.getElementById('campocont').focus();">

<div id="estrutura">
<?
	
	$i = 0;
	
	while($resultados = mysql_fetch_assoc($seleciona)){
		if(file_exists('indexall_files/images/x240/'.$resultados['imagem']) == true){
		echo '<div id="'.$i.'" onclick="javascript: location.href = \'indexall_files/images/original/'.$resultados['imagem'].'\'" style="cursor: pointer; width: 135px; height: 135px; background: #292929 url(\'indexall_files/images/x240/'.$resultados['imagem'].'\') center center no-repeat; float: left; -webkit-border-radius: 15px; margin: 0px 10px 15px 0px; display: none;"></div>';
		$i++;
		}
	}
	
?>
</div>


<form method="GET" action="results.php" id="campo">
		<input type="text" name="campocont" id="campocont" style="width: 400px;" />
		<input type="submit" value="Vasculhar..." />
</form>
</body>
</html>