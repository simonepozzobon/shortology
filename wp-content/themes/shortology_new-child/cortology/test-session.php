<?php

if(isset($_REQUEST ['test'])){
	
	
	echo $_REQUEST ['test'];
	
}else {
	$_REQUEST ['test'] = "aaa";
	
	echo "niente..."  . $_REQUEST ['test'];
}


?>