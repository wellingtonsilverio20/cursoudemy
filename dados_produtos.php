<?
	
	require "conexao.php";

	$page = $_REQUEST['page'];
	$categoria = $_REQUEST['categoria'];
	$subcategoria = $_REQUEST['subcategoria'];

	if($categoria!=''){
		$clausula .=" AND categorias_id='".$categoria."'";
	}

	if($subcategoria!=''){
		$clausula .=" AND subcategorias_id='".$subcategoria."'";		
	}
	
	if($_REQUEST[busca]!=''){
		$clausula .=" AND nome LIKE '%".$_REQUEST[busca]."%'";
	}


	$start = ($page-1)*9;
	$sql = "SELECT * FROM produtos WHERE id > 0 ".$clausula." LIMIT ".$start.",9";
	$rsd = mysql_query($sql);

	while ($rows = mysql_fetch_assoc($rsd)){
	$capa = mysql_fetch_array(mysql_query("SELECT * FROM fotos_produtos WHERE produtos_id='".$rows[id]."' AND capa='s'"));
	
	if($capa[foto]!=''){
		$imagem = $capa[foto];
	}else{
		$imagem = "modelo.png";
	}	
?>            
            <div class="box_produtos_home">
                <h1><?=utf8_encode($rows[nome])?></h1>
                <img src="plugins/imagens/imagem.php?arquivo=<?=$imagem?>&largura=160&altura=200" width="160" height="200" border="0" />
                <a href="produto/<?=$rows[id]?>-<?=$rows[linkchave]?>" class="botao_home" style="text-decoration:none;">VER DETALHES [+]</a>
            </div>
<?
	}
?> 

<script type="text/javascript">
jQuery(document).ready(function(){
	
	var Timer  = '';
	var selecter = 0;
	var Main =0;
	
	bring(selecter);
	
});

function bring ( selecter ){	
	jQuery('div.shopp:eq(' + selecter + ')').stop().animate({
		opacity  : '1.0',
		height: '60px'
		
	},300,function(){
		
		if(selecter < 6)
		{
			clearTimeout(Timer); 
		}
	});
	
	selecter++;
	var Func = function(){ bring(selecter); };
	Timer = setTimeout(Func, 200);
}

</script>