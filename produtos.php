<?
	require "conexao.php";
	
	$categoria = explode("-",Url::getURL(1));
	$subcategoria = explode("-",Url::getURL(2));
	$busca = $_GET[busca];
	$pagina = Url::getURL(4);

	if( ($categoria[0]!='') && ($categoria[0]!='0') ){
		$categoria = $categoria[0];
		$clausula .=" AND categorias_id='".$categoria."'";
	}else{
		$categoria = '';
	}

	if( ($subcategoria[0]!='') && ($subcategoria[0]!='0') ){
		$subcategoria = $subcategoria[0];
		$clausula .=" AND subcategorias_id='".$subcategoria."'";		
	}else{
		$subcategoria = '';
	}
	
	if($_GET[busca]!=''){
		$clausula .=" AND nome LIKE '%".$_GET[busca]."%'";
	}
	
	
	if($_GET[pagina] > 0){
		$pagina = $pagina;
	}else{
		$pagina = 1;
	}
	

	$per_page = 9;
	$sql = "SELECT * FROM produtos WHERE id > 0 ".$clausula."  ORDER BY nome";
	$rsd = mysql_query($sql);
	$count = mysql_num_rows($rsd);
	$pages = ceil($count/$per_page);
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<? include "seo.php"; ?>
<? include "base.php"; ?>
<? include "analytics.php"; ?>
<link href="css/lemarc.css" rel="stylesheet" type="text/css">
<link href="css/menu_produtos.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" media="screen" href="plugins/paginacao/css.css" />
<link rel="stylesheet" type="text/css" href="plugins/banner/engine1/style.css" />
<script type="text/javascript" src="plugins/banner/engine1/jquery.js"></script>
<script>
jQuery(document).ready(function(){
	
<!-- Paginação -->	
	function showLoader(){	
		jQuery('.search-background').fadeIn(200);
	}
	
	function hideLoader(){
		jQuery('.search-background').fadeOut(200);
	};
	
	jQuery("#paging_button li").click(function(){
		
		showLoader();
		
		jQuery("#paging_button li").css({'background-color' : ''});
		jQuery(this).css({'background-color' : '#006699'});

		jQuery("#content").load("dados_produtos.php?categoria=<?=$categoria?>&subcategoria=<?=$subcategoria?>&busca=<?=$_GET[busca]?>&page=" + this.id, hideLoader);
		
		return false;
	});
	
	jQuery("#1").css({'background-color' : '#006699'});
	showLoader();
	jQuery("#content").load("dados_produtos.php?categoria=<?=$categoria?>&subcategoria=<?=$subcategoria?>&busca=<?=$_GET[busca]?>&page=1", hideLoader);
})

</script>
<!-- Paginação -->

</head>

<body>
<? include "topo.php"; ?>
<!-- COnteudo -->    
<div class="box_conteudo">
	<div class="box_titulo">PRODUTOS</div>  
    
    <!-- Menu Produtos -->
    <div style="width:200px;float:left; margin-left:5px; margin-top:10px; margin-bottom:10px;">
    
    <span class="calibri20cinza" style="display:block; margin-left:5px; margin-top:0px;">Categorias</span><br />

	<ul class='menu-vv'>
<?
	$sql = mysql_query("SELECT * FROM categorias ORDER BY nome");
	while($dados = mysql_fetch_array($sql)){
		$total_sub = contar("SELECT * FROM subcategorias WHERE categorias_id='".$dados[id]."'");
?>
    	<li>
    	<a href='produtos/<?=$dados[id]?>-<?=$dados[linkchave]?>/?pagina=<?=$pagina?>'><?=$dados[nome]?></a>
<? 
	if($total_sub > 0){
?>
			<ul>
<?
			$sql_sub = mysql_query("SELECT * FROM subcategorias WHERE categorias_id='".$dados[id]."'");
			while($dados_sub = mysql_fetch_array($sql_sub)){
?>
				<li>
        			<a href="produtos/<?=$dados[id]?>-<?=$dados[linkchave]?>/<?=$dados_sub[id]?>-<?=$dados_sub[linkchave]?>/?pagina=<?=$pagina?>"><?=$dados_sub[nome]?></a>
        		</li>    
<?
			}
?>		
			</ul>
<?
	}
?>	
    	</li>
<?
	}
?>	
	</ul>
</div>  
  <!-- Menu Produtos -->
  
  
  <!-- Produtos -->
  <div style="width:750px; float:right;">
	<div id="div_busca">
      	<form action="produtos" id="frm_busca" name="frm_busca" method="get">
          	<input type="text" name="busca" id="busca" value="<?=$_GET[busca]?>" size="60" placeholder="Busque pelo nome do produto." />
            <input type="submit" name="buscar" id="buscar" value="Buscar" />
        </form>
		<hr />
    </div>
    <div class="clear"></div>

<?
	if($count > 0){
?>		
        <div class="search-background">
			<label><img src="plugins/paginacao/loader.gif" alt="" /></label>
		</div>
	
		<div id="content"></div>
		
        <div style="clear:both"></div>
	
	<div id="paging_button" align="center">
			<ul>
<?php
		//Show page links
		for($i=1; $i<=$pages; $i++){
			echo '<li id="'.$i.'">'.$i.'</li>';
		}
?>
			</ul>
		</div> <br />


<?
	}else{
?>	
	<span class="trebuchet15cinza">(
	<?=$count?>) produtos encontrados. </span>
<? 
	}
?>	    
<br />

	</div>
  <!-- Produtos -->
    
<div class="clear"></div>    
</div>
<!-- Conteudo -->
<? include "rodape.php"; ?>

</body>
</html>