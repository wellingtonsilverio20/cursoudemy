<?	
	require "sgc/config/conexao.php";
	require "sgc/funcoes/funcoes_mysql.php";
	require "sgc/funcoes/funcoes.php";
	require "sgc/funcoes/datavalor.php";
	
	$redes_sociais  = lista("SELECT * FROM redes_sociais WHERE id='1'");
	$empresa = lista("SELECT * FROM sobre WHERE id='1'");
	$configuracoes = lista("SELECT * FROM seo WHERE id='1'");
?>