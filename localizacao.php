<?
	require "conexao.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<? include "seo.php"; ?>
<? include "base.php"; ?>
<? include "analytics.php"; ?>
<link href="css/lemarc.css" rel="stylesheet" type="text/css">
</head>

<body>
<? include "topo.php"; ?>
    
<div class="box_conteudo">
<div class="box_titulo">LOCALIZAÇÃO</div>  
	
    <div style="width:1000px;margin:10px auto;">
	<?=$empresa[localizacao]?>
    </div>
    
</div>

<? include "rodape.php"; ?>

</body>
</html>