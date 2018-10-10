<?
	session_start();
	
	$codigoCaptcha = $_GET['palavra'];
	
	$imagemCaptcha = imagecreatefrompng("fundocaptch.png");
 
	$fonteCaptcha = imageloadfont("anonymous.gdf");
 
	$corCaptcha = imagecolorallocate($imagemCaptcha,255,0,0);
 
	imagestring($imagemCaptcha,$fonteCaptcha,15,5,$codigoCaptcha,$corCaptcha);
 
	header("Content-type: image/png");
 
	imagepng($imagemCaptcha);
 
	imagedestroy($imagemCaptcha);
?> 