<?

require "dbcon.php";
	
$per_page = 9;
$sqlc = "SELECT * FROM imoveis";
$rsdc = mysql_query($sqlc);
$cols = mysql_num_rows($rsdc);
$page = $_REQUEST['page'];

$start = ($page-1)*9;
$sql = "SELECT * FROM imoveis WHERE endereco LIKE '%".$_REQUEST[endereco]."%' LIMIT ".$start.",9";
$rsd = mysql_query($sql);

	while ($rows = mysql_fetch_assoc($rsd)){
	$tipo = mysql_fetch_array(mysql_query("SELECT * FROM tipo WHERE id='".$rows[tipo_id]."'"));
	$capa = mysql_fetch_array(mysql_query("SELECT * FROM fotos_imoveis WHERE imoveis_id='".$rows[id]."' AND capa='s'"));
	
	if($capa[foto]!=''){
		$foto_capa = "fotos/".$capa[foto];
	}else{
		$foto_capa = "img/modelo.png";
	}		
?>
	<div class="box_imovel">
       	<a href="<?=$rows[id]?>-<?=$rows[linkchave]?>">
	        <span><?=utf8_encode($tipo[nome])?></span>
            <img src="http://localhost/www.imoveisviverbem.com.br/<?=$foto_capa?>" width="186" height="138" border="0" />
            <p><?=utf8_encode($rows[titulo])?></p>
        </a>    
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