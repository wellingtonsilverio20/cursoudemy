<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Super JQuery Pagination</title>
<link rel="stylesheet" type="text/css" media="screen" href="css.css" />
<script type="text/javascript" src="jquery-1.3.2.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	
	function showLoader(){
	
		$('.search-background').fadeIn(500);
	}
	
	function hideLoader(){
	
		$('.search-background').fadeOut(500);
	};
	
	$("#paging_button li").click(function(){
		
		showLoader();
		
		$("#paging_button li").css({'background-color' : ''});
		$(this).css({'background-color' : '#006699'});

		$("#content").load("data.php?page=" + this.id, hideLoader);
		
		return false;
	});
	
	$("#1").css({'background-color' : '#006699'});
	showLoader();
	$("#content").load("data.php?page=1", hideLoader);
	
});
</script>
</head>
<body>
<?php

$per_page = 9;
include("dbcon.php");
$sql = "select * from imoveis";
$rsd = mysql_query($sql);
$count = mysql_num_rows($rsd);
$pages = ceil($count/$per_page);

?>

<div align="center" style="width:770px; margin:0 auto;">
	
		<div class="search-background">
			<label><img src="loader.gif" alt="" /></label>
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
	</div>
</div>

</body>
</html>
