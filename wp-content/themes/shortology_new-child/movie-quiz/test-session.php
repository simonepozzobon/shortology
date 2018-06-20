<?php

session_start();

if(isset($_SESSION ['test'])){
	
	
	echo $_SESSION ['test'];
	session_unset();
	
}else {
	$_SESSION ['test'] = "aaa";

	echo "niente..."  . $_SESSION ['test'];
}


?>