<?php

$path = $_SERVER ['DOCUMENT_ROOT'];

include_once $path . '/wp-content/themes/shortology_new-child/cortology/cortology-functions.php';

$cortologyFunctions = new CortologyFunctions ();

echo json_encode ( $cortologyFunctions->getObjSlot () );
