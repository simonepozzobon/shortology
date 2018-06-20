<?php
	$path = $_SERVER ['DOCUMENT_ROOT'];

	//$test = "http://" . $_SERVER['HTTP_HOST'] . "/wp-content/themes/shortology_new-child/cortology/mail-functions.php";
	
	include_once $path . "/wp-content/themes/shortology_new-child/cortology/mail-functions.php";
	
	$mailFunctions = new CortologyMailFunctions();

	$mailFunctions->sendStoryMachineEmail("stefano.messi88@gmail.com", "Stefano", "Messi", "lorem", "la mia storia", "WH451SFIS352BU", 1, 2, 3, 4)
?>