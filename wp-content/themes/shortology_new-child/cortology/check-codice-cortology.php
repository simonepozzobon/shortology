<?php
	if($_POST["codice"]) {
		$test = $cortologyFunctions->objDecodeStorymachineCode($_POST["codice"]);
		if($test["valid-code"] === true){
			header("Location: /story-machine");
		} else {
			$_REQUEST["error"] = "Codice non valido";
			header("Location: /codice");
		}
	}else{	
		$_REQUEST["error"] = "Codice mancante";
		header("Location: /codice");
	}
?>