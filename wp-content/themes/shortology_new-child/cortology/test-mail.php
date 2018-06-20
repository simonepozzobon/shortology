<?php
include_once 'mail-functions.php';

$test = new CortologyMailFunctions ();

if($test->sendMail(null, "stefano.messi88@gmail.com", "Cortology - codice story machine", "body", "stefano.messi88@gmail.com")){
	echo "done";
} else {
	echo "error";
}

?>