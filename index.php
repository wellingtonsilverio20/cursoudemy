<?php
require "classes/Url.class.php";

        $modulo = Url::getURL(0);
        
        if( $modulo == null )
            $modulo = "home";
        
        if( file_exists( "" . $modulo . ".php" ) )
            require "" . $modulo . ".php";
        else
            require "404.php";

//Url::getURL();
?>

