<?php
header("Content-Type: application/xml; charset=UTF-8");
echo '<?xml version="1.0" encoding="UTF-8"?>';

$hoje = date('Y-m-d');
?>

<urlset
xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9
http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">
<url>
<loc>http://www.acrilicoslemarc.com.br/</loc>
  <lastmod><?php echo $hoje;?></lastmod>
  <priority>1.00</priority>
  <changefreq>daily</changefreq>
</url>
<url>
  <loc>http://www.acrilicoslemarc.com.br/home</loc>
  <lastmod><?php echo $hoje;?></lastmod>
  <priority>0.80</priority>
  <changefreq>daily</changefreq>
</url>
<url>
  <loc>http://www.acrilicoslemarc.com.br/empresa</loc>
  <lastmod><?php echo $hoje;?></lastmod>
  <priority>0.80</priority>
  <changefreq>daily</changefreq>
</url>
<url>
  <loc>http://www.acrilicoslemarc.com.br/servicos</loc>
  <lastmod><?php echo $hoje;?></lastmod>
  <priority>0.80</priority>
  <changefreq>daily</changefreq>
</url>
<url>
  <loc>http://www.acrilicoslemarc.com.br/produtos</loc>
  <lastmod><?php echo $hoje;?></lastmod>
  <priority>0.80</priority>
  <changefreq>daily</changefreq>
</url>
<url>
  <loc>http://www.acrilicoslemarc.com.br/localizacao</loc>
  <lastmod><?php echo $hoje;?></lastmod>
  <priority>0.80</priority>
  <changefreq>daily</changefreq>
</url>

<url>
  <loc>http://www.acrilicoslemarc.com.br/contato</loc>
  <lastmod><?php echo $hoje;?></lastmod>
  <priority>0.80</priority>
  <changefreq>daily</changefreq>
</url>
	<?php
	require "conexao.php";
/*
Tabela Produtos	
*/
$sql_tabela = mysql_query("SELECT id,linkchave FROM produtos ORDER BY id DESC");
while($tabela = mysql_fetch_assoc($sql_tabela)){
echo "<url>
		<loc>http://www.acrilicoslemarc.com.br/produto/".$tabela['id']."-".$tabela['linkchave']."</loc>
		<lastmod>".$hoje."</lastmod>
		<changefreq>daily</changefreq>
		<priority>0.6</priority>
	</url>";
}

/*
Tabela categorias	
*/
$sql_tabela2 = mysql_query("SELECT id,linkchave FROM categorias ORDER BY id DESC");
while($tabela2 = mysql_fetch_assoc($sql_tabela2)){
echo "<url>
		<loc>http://www.acrilicoslemarc.com.br/produtos/".$tabela2['id']."-".$tabela2['linkchave']."</loc>
		<lastmod>".$hoje."</lastmod>
		<changefreq>daily</changefreq>
		<priority>0.6</priority>
	</url>";

/*
Tabela subcategorias	
*/
	$sql_tabela3 = mysql_query("SELECT id,linkchave FROM subcategorias WHERE categorias_id='".$tabela2[id]."' ORDER BY id DESC");
	while($tabela3 = mysql_fetch_assoc($sql_tabela3)){
	echo "<url>
		<loc>http://www.acrilicoslemarc.com.br/produtos/".$tabela2['id']."-".$tabela2['linkchave']."/".$tabela3['id']."-".$tabela3['linkchave']."</loc>
		<lastmod>".$hoje."</lastmod>
		<changefreq>daily</changefreq>
		<priority>0.6</priority>
	</url>";
	}

}

?>
</urlset>