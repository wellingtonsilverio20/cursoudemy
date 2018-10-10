<?
	require "funcoes_seguranca.php";
	require "../conexao.php";

if($_POST[acao]=='envio'){
	require "../sgc/enviar.php";

	if( !isEmail($_POST[email]) ){
		echo utf8_encode("E-mail inválido");
	}else{
		if( ($_POST[nome]!="") || ($_POST[mensagem]!="") || ($_POST[assunto]!="")){
			
			$destinatario = lista("SELECT * FROM emails WHERE id='1'");
			//contanto os destinatários
			
			$destinatario[email_contato] = str_replace("{nome}",utf8_decode($_POST[nome]),$destinatario[email_contato]);
			$destinatario[email_contato] = str_replace("{email}",$_POST[email],$destinatario[email_contato]);
			$destinatario[email_contato] = str_replace("{telefone}",$_POST[ddd]."-".$_POST[telefone],$destinatario[email_contato]);
			$destinatario[email_contato] = str_replace("{cidade}",utf8_decode($_POST[cidade])."-".$_POST[estado],$destinatario[email_contato]);
			$destinatario[email_contato] = str_replace("{msg}",utf8_decode($_POST[mensagem]),$destinatario[email_contato]);
			
			$emails = explode(",",$destinatario[contato]);
			$total_emails = count($emails);
			for($i=1; $i <= $total_emails; $i++){
				$id_array = $i - 1;
				$envio = enviar(utf8_decode($_POST[nome]),$_POST[email],$emails[$id_array],$destinatario[destinatario],$_POST['assunto'],$destinatario[email_contato]);
			}
			
			echo $envio;
		}else{
			echo "Preencha todos os campos.";
		}
	}
		
}
?>