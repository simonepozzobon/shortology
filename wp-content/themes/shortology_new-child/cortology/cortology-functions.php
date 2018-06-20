<?php
$path = $_SERVER ['DOCUMENT_ROOT'];

include_once $path . '/wp-config.php';
include_once $path . '/wp-load.php';
include_once $path . '/wp-includes/wp-db.php';
include_once $path . '/wp-includes/pluggable.php';
include_once $path . "/wp-content/themes/shortology_new-child/cortology/mail-functions.php";

class CortologyFunctions {
	function getCountImages() {
		global $wpdb;
		return $wpdb->get_var ( "SELECT COUNT(*) FROM cort_story_immagine" );
	}
	function getMinIdImage() {
		global $wpdb;
		return $wpdb->get_var ( "SELECT MIN(ID) FROM cort_story_immagine" );
	}
	function getMaxIdImage() {
		global $wpdb;
		return $wpdb->get_var ( "SELECT MAX(ID) FROM cort_story_immagine" );
	}
	function getRandomImage() {
		return rand ( $this->getMinIdImage (), $this->getMaxIdImage () );
	}
	function getImageId($imageCode = null) {
		global $wpdb;
		return $wpdb->get_var ( $wpdb->prepare ( "SELECT FK_IMMAGINE FROM cort_story_immagine_codice WHERE CODICE_IMMAGINE = %s", $imageCode ) );
	}
	function getImageCode($imageId = null) {
		global $wpdb;
		return $wpdb->get_var ( $wpdb->prepare ( "SELECT CODICE_IMMAGINE FROM cort_story_immagine_codice WHERE FK_IMMAGINE = %d order by RAND() limit 1", $imageId ) );
	}
	function encodeStorymachineCode($code) {
		/*
		 * ID IMMAGINE: 1 2 3 4 CODICE: aa bb cc dd a1b1(somma indici a + c) c1d1 a2b2 (somma indici b + d) c2d2
		 */

		$a1 = substr ( $code, 0, 1 );
		$a2 = substr ( $code, 1, 1 );
		$b1 = substr ( $code, 2, 1 );
		$b2 = substr ( $code, 3, 1 );
		$c1 = substr ( $code, 4, 1 );
		$c2 = substr ( $code, 5, 1 );
		$d1 = substr ( $code, 6, 1 );
		$d2 = substr ( $code, 7, 1 );

		$codiceControllo1 = $this->getImageId ( substr ( $code, 0, 2 ) ) + $this->getImageId ( substr ( $code, 4, 2 ) );
		$codiceControllo2 = $this->getImageId ( substr ( $code, 2, 2 ) ) + $this->getImageId ( substr ( $code, 6, 2 ) );

		$encoded = $a1 . $b1 . $codiceControllo1 . $c1 . $d1 . $a2 . $b2 . $codiceControllo2 . $c2 . $d2;

		return $encoded;
	}
	function objDecodeStorymachineCode($code = null) {
		$validCode = false;
		$codiceControllo1;
		$codiceControllo2;
		$realCode;
		$result = new ArrayObject ();
		if ($code != null && strlen ( trim($code) ) >= 10 && strlen ( trim($code) ) <= 14) {
			$code = trim($code);
			$indiceSecondoCodice;
			/*
			 * recupero il primo numero
			 */
			for($i = 2;; $i ++) {
				$temp = substr ( $code, $i, 1 );
				if (is_numeric ( $temp )) {
					$codiceControllo1 .= $temp;
				} else {
					$indiceSecondoCodice = $i;
					break;
				}
			}
			/*
			 * recupero il secondo numero
			 */
			for($i = $indiceSecondoCodice;; $i ++) {
				$temp = substr ( $code, $i, 1 );
				if (is_numeric ( $temp )) {
					$codiceControllo2 .= $temp;
				} else if (strlen ( $codiceControllo2 ) > 0 || $i >= strlen ( $code )) {
					break;
				}
			}
			/*
			 * recupero il cocdice reale e verifico i due codici di controllo
			 */
			if (strlen ( $codiceControllo1 ) > 0 && strlen ( $codiceControllo2 ) > 0) {

				$a1 = substr ( $code, 0, 1 );

				$b1 = substr ( $code, 1, 1 );

				$codiceControllo1 = substr ( $code, 2, strlen ( $codiceControllo1 ) );

				$c1 = substr ( $code, (2 + strlen ( $codiceControllo1 )), 1 );

				$d1 = substr ( $code, (3 + strlen ( $codiceControllo1 )), 1 );

				$a2 = substr ( $code, (4 + strlen ( $codiceControllo1 )), 1 );

				$b2 = substr ( $code, (5 + strlen ( $codiceControllo1 )), 1 );

				$codiceControllo2 = substr ( $code, (6 + strlen ( $codiceControllo1 )), strlen ( $codiceControllo2 ) );

				$c2 = substr ( $code, (6 + strlen ( $codiceControllo1 ) + strlen ( $codiceControllo2 )), 1 );

				$d2 = substr ( $code, (7 + strlen ( $codiceControllo1 ) + strlen ( $codiceControllo2 )), 1 );

				$realCode = $a1 . $a2 . $b1 . $b2 . $c1 . $c2 . $d1 . $d2;

				if (is_numeric ( $codiceControllo1 ) && is_numeric ( $codiceControllo2 )) {
					$imageId1 = $this->getImageId ( $a1 . $a2 );
					$imageId2 = $this->getImageId ( $b1 . $b2 );
					$imageId3 = $this->getImageId ( $c1 . $c2 );
					$imageId4 = $this->getImageId ( $d1 . $d2 );
					/*
					 * check if all image id are numeric
					 */
					if (is_numeric ( $imageId1 ) && is_numeric ( $imageId1 ) && is_numeric ( $imageId1 ) && is_numeric ( $imageId4 )) {
						/*
						 * check codici controllo
						 */
						if ((intval ( $codiceControllo1 ) === ($imageId1 + $imageId3)) && intval ( $codiceControllo2 ) === ($imageId2 + $imageId4)) {
							/*
							 * controllo se non ci sono immagini doppie vicine
							 */
							if ($imageId1 != $imageId2 && $imageId2 != $imageId3 && $imageId3 != $imageId4) {
								$validCode = true;
							}
						}
					}
				}
			}
		}
		/*
		 * return [ "codice-controllo-1" => $codiceControllo1, "codice-controllo-2" => $codiceControllo2, "real-code" => $realCode, "valid-code" => $validCode ];
		 */
		$result ["codice-controllo-1"] = $codiceControllo1;
		$result ["codice-controllo-2"] = $codiceControllo2;
		$result ["real-code"] = $realCode;
		$result ["valid-code"] = $validCode;
		return $result;
	}
	function getObjSlot() {
		$array = array (
				$this->getRandomImage ()
		);
		$code = $this->getImageCode ( $array [0] );

		while ( count ( $array ) < 4 ) {
			$temp = $this->getRandomImage ();
			if (! in_array ( $temp, $array )) {
				$array [count ( $array )] = $temp;
				$code .= $this->getImageCode ( $temp );
			}
			/*
			 * if ($array [count ( $array ) - 1] != $temp) { $array [count ( $array )] = $temp; $code .= $this->getImageCode ( $temp ); }
			 */
		}

		return array (
				"images" => $array,
				"code" => $this->encodeStorymachineCode ( $code )
		);
	}
	function aggiungiStoria() {
		global $wpdb;
		$cortologyMailFunctions = new CortologyMailFunctions ();
		$result = false;

		$objResult = new ArrayObject ();

		if (isset ( $_POST ['nome'] ) && isset ( $_POST ['cognome'] ) && isset ( $_POST ['email'] ) && isset ( $_POST ['storia'] ) && isset ( $_POST ['codice'] ) && isset ( $_POST ['titolo'] )) {

			$nome = trim ( $_POST ['nome'] );
			$cognome = trim ( $_POST ['cognome'] );
			$email = trim ( $_POST ['email'] );
			$storia = trim ( $_POST ['storia'] );
			$titolo = trim ( $_POST ['titolo'] );
			$code = trim ( $_POST ['codice'] );
			$privacy = isset ( $_POST ['privacy'] ) ? trim ( $_POST ['privacy'] ) : '';

			$objResult ['empty-nome'] = (empty ( $nome ));
			$objResult ['empty-cognome'] = (empty ( $cognome ));
			$objResult ['empty-email'] = (empty ( $email ));
			$objResult ['empty-storia'] = (empty ( $storia ));
			$objResult ['empty-codice'] = (empty ( $code ));
			$objResult ['empty-titolo'] = (empty ( $titolo ));
			$objResult ['empty-privacy'] = (empty ( $privacy ));
			$objResult ['invalid-email'] = (! filter_var ( $_POST ['email'], FILTER_VALIDATE_EMAIL ));

			if (filter_var ( $_POST ['email'], FILTER_VALIDATE_EMAIL ) && ! empty ( $code ) && ! empty ( $nome ) && ! empty ( $cognome ) && ! empty ( $storia ) && ! empty ( $titolo ) && ! empty( $privacy )) {

				$objDecode = $this->objDecodeStorymachineCode ( $code );

				if ($objDecode ["valid-code"] === true && ! empty ( $objDecode ["real-code"] )) {
					$resultInsert = $wpdb->insert ( "cort_story_storia", array (
							"nome" => $nome,
							"cognome" => $cognome,
							"email" => $email,
							"storia" => substr ( $storia, 0, 1100 ),
							"codice" => $code,
							"titolo" => $titolo
					), "%s" );
					if ($resultInsert === 1) {
						/*
						 * invia mail
						 */
						$immagine1 = $this->getImageId ( substr ( $objDecode ["real-code"], 0, 2 ) );
						$immagine2 = $this->getImageId ( substr ( $objDecode ["real-code"], 2, 2 ) );
						$immagine3 = $this->getImageId ( substr ( $objDecode ["real-code"], 4, 2 ) );
						$immagine4 = $this->getImageId ( substr ( $objDecode ["real-code"], 6, 2 ) );

						if ($cortologyMailFunctions->sendStoryMachineEmail ( $email, $nome, $cognome, $storia, $titolo, $code, $immagine1, $immagine2, $immagine3, $immagine4 )) {
							$objResult ['storia-inserita'] = true;
						} else {
							$objResult ['error-message'] = "Errore durante il salvataggio delle informazioni, si prega di riprovare piu tardi";
						}
					}
				} else {
					$objResult ['error-message'] = "Codice non valido";
				}
			}
		} else {
			$objResult ['error-message'] = "Uno o piu campi obbligatori mancanti";
		}
		return $objResult;
	}
}

if (isset ( $_POST ["sendCodeByEmail"] )) {
	$cortologyFunctions = new CortologyFunctions ();
	$objDecode = $cortologyFunctions->objDecodeStorymachineCode ( $_POST ["codice"] );
	if ($objDecode ["valid-code"]) {

		$immagine1 = $cortologyFunctions->getImageId ( substr ( $objDecode ["real-code"], 0, 2 ) );
		$immagine2 = $cortologyFunctions->getImageId ( substr ( $objDecode ["real-code"], 2, 2 ) );
		$immagine3 = $cortologyFunctions->getImageId ( substr ( $objDecode ["real-code"], 4, 2 ) );
		$immagine4 = $cortologyFunctions->getImageId ( substr ( $objDecode ["real-code"], 6, 2 ) );

		$cortologyMailFunctions = new CortologyMailFunctions ();

		echo $cortologyMailFunctions->sendCodeByEmail($_POST ["codice"], $immagine1, $immagine2, $immagine3, $immagine4);
	} else {
		echo "Codice non valido";
	}
}

?>
