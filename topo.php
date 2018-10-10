<!-- Topo-->
<div id="div_topo">
	<!--conteudo topo -->
    <div id="conteudo_topo">
  	<ul>
       	<li><a href="home">HOME</a></li>
        <li><a href="empresa">EMPRESA</a></li>
        <li><a href="servicos">SERVIÇOS</a></li>
        <li><a href="produtos">PRODUTOS</a></li>
  		<li><a href="localizacao">LOCALIZAÇÃO</a></li>
        <li><a href="contato">CONTATO</a></li>
    </ul>
        <!--Box Orçamento 
      <div id="box_orcamento">
      	<span class="trebuchet18marrom">
        	<a href="carrinho.php" class="trebuchet18marrom" style="text-decoration:none">Carrinho de Orçamento</a>
        </span><br />
      	<a href="carrinho.php" class="trebuchet18marrom" style="text-decoration:none">
        	<img src="img/carrinho.png" style="float:left; margin-left:25px;" border="0" />
        </a>
        <div id="result_carrinho" style="float:left;">(<?=count($_SESSION['carrinho'])?>) iten(s).</div>
      </div>
        <!--Box Orçamento -->
        
    </div>
    <!--conteudo topo -->
  <div class="clear"></div>    
</div>
<!-- Topo-->
    <div style="width:1000px; margin:0px auto;">
        <!--Logo -->
            <h1>
            	<img src="img/logo.png" width="381" title="<?=$configuracoes[titulo]?>" height="154" style="float:left; margin-top:30px;">
        	</h1>
        <!-- Logo -->
        <!-- Box Login -->
        <div id="box_login">
            <? /*if($usuario[nome]=='') { ?>
            	<a href="cadastre-se" class="trebuchet15cinza">Login</a>
			<? } else { ?>
            	<a href="area-restrita" class="trebuchet15cinza">Área Restrita</a>
            <? } */?> 
        <a href="<?=$redes_sociais[facebook]?>">
        	<img src="img/facebook.png" width="24" height="24" border="0">
        </a>
        <a href="<?=$redes_sociais[twitter]?>">
        	<img src="img/twitter.png" width="24" height="24" border="0">
         </a>
        <div class="clear"></div>
        </div>
        <!-- Box Login -->
        
	  <div class="clear"></div>
    </div>