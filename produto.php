<?
	session_start();
	require "conexao.php";

	$id = explode("-",Url::getURL(1));
	
	$produto = lista("SELECT * FROM produtos WHERE id='".$id[0]."'");
	$capa = lista("SELECT * FROM fotos_produtos WHERE produtos_id='".$produto[id]."' AND capa='s'");
	if($capa[foto]==""){
		$capa[foto] = "modelo.png";
	}else{
		$capa[foto] = "".$capa[foto]."";
	}
	
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
<script type="text/javascript" src="plugins/lbox/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="plugins/lbox/lightbox/themes/default/jquery.lightbox.css" />
<!--[if IE 6]><link rel="stylesheet" type="text/css" href="plugins/lbox/lightbox/themes/default/jquery.lightbox.ie6.css" /><![endif]-->
<script type="text/javascript" src="plugins/lbox/lightbox/jquery.lightbox.js"></script>
<script type="text/javascript" src="js/jquery-form.js"></script>
<script>
jQuery(document).ready(function(){
	jQuery('.lightbox').lightbox();
	jQuery('#retorno').hide();

<!-- Carrinho -->
	jQuery('#add').click(function(){
		window.scroll(0,10);
			var dados = jQuery("#frm_orcamento").serialize();
 			jQuery('#result_carrinho').html('<img src="js/ajax-loader.gif" alt="Enviando..."/> Enviando...');
			jQuery.ajax({
				type: "POST",
				url: "funcoes/carrinho.php",
				data: dados,
				success: function(data){
						jQuery('#result_carrinho').html(data);
						jQuery('#retorno').show('slow');
				}
			});
	})
<!-- Carrinho -->

	
})
</script>
<style>
	#retorno{
		width:300px;
		height:50px;
		position:absolute;
		right:1px;
		top:60px;
	}
</style>

</head>

<body>
<? include "topo.php"; ?>
<!-- COnteudo -->    

<div id="retorno">
	<img src="img/item.png" width="227" height="54" />
</div>

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
	
    <!-- produto -->
	<div id="produto">
    	<h1><?=$produto[nome]?></h1>
        <div id="imagens">
        	<!-- capa -->
            <a href='fotos/<?=$capa[foto]?>' class="lightbox" title="<?=$produto[nome]?>" rel='<?=$produto[linkchave]?>'>
            	<img src="plugins/imagens/imagem.php?arquivo=<?=$capa[foto]?>&largura=450&altura=300" width="450" height="300" border="0" style="border:1px solid #EDEDED" title="<?=$produto[nome]?>" />
            </a>
            <!-- capa -->
            
            <!-- outras -->
<?	
		$sql_fotos = mysql_query("SELECT * FROM fotos_produtos WHERE produtos_id='".$produto[id]."' AND capa !='s'");
		while($dados_fotos=mysql_fetch_array($sql_fotos)){
?>
            <a href='fotos/<?=$dados_fotos[foto]?>' class="lightbox" rel='<?=$produto[linkchave]?>'>
            	<img src="plugins/imagens/imagem.php?arquivo=<?=$dados_fotos[foto]?>&largura=100&altura=100" width="100" height="100" border="0" class="miniaturas" style="border:1px solid #EDEDED"  />
            </a>    
<? 
		}
?>		
            <!-- outras -->
            
        </div>
        
        <!-- Itens opcionais 
        <div class="atributos">
        <form id="frm_orcamento" name="frm_orcamento">
<?
	// listando todos os grupos de atributos do sistema
	$i = 0;
	$total_atr = 0;
	$grupo_atr = mysql_query("SELECT * FROM grupo_atributos ORDER BY nome");
	while($dados_grupo = mysql_fetch_array($grupo_atr)){
		//  verificando se há atributo relacionado.
		$total_rel = contar("SELECT * FROM rel_atributos WHERE grupo_atributos_id='".$dados_grupo[id]."'");
		if($total_rel > 0){
			$total_atr++;
?>			
		<span class="trebuchet18cinzaescuro" style="display:block; padding:10px 10px; width:250px;"><?=$dados_grupo[nome]?></span>
<?    	
			$rel = mysql_query("SELECT * FROM rel_atributos WHERE grupo_atributos_id='".$dados_grupo[id]."'");
			while($dados_rel = mysql_fetch_array($rel)){
			$atributo = lista("SELECT * FROM atributos WHERE id='".$dados_rel[atributos_id]."'");		
?>
        <label>
            	<input type="radio" name="atr_<?=$i?>" id="atr_<?=$i?>" value="<?=$atributo[id]?>" /> 
           		<span class="trebuchet15cinzaescuro"><?=$dados_rel[id]?>-<?=$atributo[nome]?></span>
        </label>
<?
			}
		}
	$i++;	
	}
?>	
         
        <label style="margin-top:15px;">
            	<input name="qtd" type="text" id="qtd" placeholder="1" value="1" size="3" /> 
           		<span class="trebuchet15cinzaescuro">Quantidade</span>
        </label>         
        
        <label style="text-align:center;">
        	<input type="hidden" id="produto" name="produto" value="<?=$produto[id]?>" />
            <input type="hidden" id="acao" name="acao" value="adicionar" />
            <input type="hidden" id="total_atr" name="total_atr" value="<?=$total_atr?>" />
        	<img src="img/add.png" id="add" name="add" />
        </label>
        	
        </form>
        </div>
        <!-- Itens opcionais -->
        <div class="clear"></div>
        <!-- descrição -->
        <div class="descricao">
        <p class="trebuchet15cinza">Descrição</p>
        <span class="calibri15cinza"><?=$produto[nome]?></span>
        </div>
        <!-- descrição -->
        
        
    <div class="clear"></div>    
    </div>
	<!-- produto -->
    
		

	</div>
  <!-- Produtos -->
    
<div class="clear"></div>    
</div>
<!-- Conteudo -->
<? include "rodape.php"; ?>

</body>
</html>