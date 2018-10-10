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
<script type="text/javascript" src="plugins/banner/engine1/jquery.js"></script>
<script type="text/javascript" src="js/jquery-form.js"></script>
<script>
jQuery(document).ready(function(){

	jQuery("#enviar").click(function(){
		var dados = jQuery("#frm_contato").serialize();
		jQuery('#retorno').html('<img src="js/ajax-loader.gif" alt="Enviando..."/> Enviando...');
		jQuery.ajax({
			type: "POST",
			url: "funcoes/contato.php",
			data: dados,
			success: function(data){
					if(data == '0'){
						window.location.href = "contato?enviado=s";
					}else{
						jQuery("#retorno").html(data);
					}
			}
		});
	});

});

</script>

</head>

<body>
<? include "topo.php"; ?>
    
<div class="box_conteudo">
<div class="box_titulo">CONTATO</div>  
<br />

Preencha o formulário abaixo.

<?
	if($_GET[enviado]=='s'){
?>	
	<div style="padding:10px; font:18px 'Trebuchet MS', Arial, Helvetica, sans-serif; color:#090;">
    	E-mail enviado com sucesso.
    </div>		
<?
	}
?>

<div id="form_contato">
<form id="frm_contato">
	<div style="width:450px; height:200px;margin:10px 5px; float:left;">

    	<label class="label_contato">
        	<input name="nome" type="text" class="input_contato" id="nome" placeholder="Nome" size="48" />
        </label>	

    	<label class="label_contato">
       	  <input name="email" type="text" class="input_contato" id="email" placeholder="E-mail" size="48" />
        </label>
        
        <label class="label_contato">
        	<input name="ddd" type="text" class="input_contato" id="ddd" placeholder="DDD" size="4" />
        </label>
        
        <label class="label_contato">
        	<input name="telefone" type="text" class="input_contato" id="telefone" placeholder="Telefone" size="38" />
        </label>
        
		<label>
        	<input name="cidade" type="text" class="input_contato" id="cidade" placeholder="Cidade" size="36" />
        </label>

  		<label class="label_contato">
            <select name="estado" id="estado" class="select_contato">
           	  <option value="">Estado</option>
<?
				$sql_estado = mysql_query("SELECT * FROM estados ORDER BY estado");
				while($dados_estado = mysql_fetch_array($sql_estado)){			
?>
				<option value="<?=$dados_estado[sigla]?>"><?=$dados_estado[sigla]?></option>  
<?
				}
?>                              
            </select>
      </label>
    </div>

	<div style="width:450px; height:250px;margin:10px 5px; float:left;">

    	<label class="label_contato">
       	  <input name="assunto" type="text" class="input_contato" id="assunto" placeholder="Assunto" size="48" />
        </label>    
        	
    	<label class="label_contato">
       	  <textarea name="mensagem" cols="46" rows="5" class="textarea_contato" id="mensagem" placeholder="Digite aqui sua mensagem."></textarea>
        </label>    
        
    	<label class="label_contato">
       	  <input type="hidden" name="acao" id="acao" value="envio">
          <input type="button" name="enviar" id="enviar" value="Enviar" class="button_contato">
        </label>

    	<label id="retorno" class="label_contato"></label>                    

    </div>

</form>
</div>
<div class="clear"></div>	
</div>

<? include "rodape.php"; ?>

</body>
</html>