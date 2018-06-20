<?php 
	include_once 'cortology-functions.php';

	$test = new CortologyFunctions();
	
	$objSlot = $test->getObjSlot();
	
	$decodedSlot = $test->objDecodeStorymachineCode($objSlot["code"]);
	
	echo json_encode($objSlot);
	
	echo json_encode($decodedSlot);
	
?>