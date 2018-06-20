<?php
$path = $_SERVER ['DOCUMENT_ROOT'];

include_once $path . '/wp-includes/class-phpmailer.php';

class CortologyMailFunctions {
	
	function getEmailAdmin(){
		return 'info@h-57.com';
	}
	
	function sendCodeByEmail($codice, $immagine1, $immagine2, $immagine3, $immagine4){
		$message = "Errore durante l'invio del codice, si prega di riprovare piu tardi";
		if(isset($_POST["email"]) && isset($_POST["codice"])) {
			if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){

				$httpRoot = "http://$_SERVER[HTTP_HOST]";
				$demFolder = $httpRoot . "/wp-content/themes/shortology_new-child/cortology/dem";
				$arrowSrc = "$httpRoot/wp-content/themes/shortology_new-child/images/arrow.png";
				$arrowTag = '<img src="'.$arrowSrc.'" style="margin-bottom: 25px;margin-top: 0px;width: 40px;height: 15px;" />';
				$imgTempStart = '<img src="'.$httpRoot.'/wp-content/themes/shortology_new-child/images/slot-images/300icone_';
				$imgTempEnd = '.png" />';
				
				$immagine1Tag = $imgTempStart . $immagine1 . $imgTempEnd;
				$immagine2Tag = $imgTempStart . $immagine2 . $imgTempEnd;
				$immagine3Tag = $imgTempStart . $immagine3 . $imgTempEnd;
				$immagine4Tag = $imgTempStart . $immagine4 . $imgTempEnd;
				
				$demHtmlCodice = file_get_contents($demFolder . "/dem-codice.html");
				
				$demHtmlCodice = str_replace("{http}", $httpRoot, $demHtmlCodice);
				$demHtmlCodice = str_replace("{folder-dem}", $demFolder, $demHtmlCodice);
				$demHtmlCodice = str_replace("{codice}", $codice, $demHtmlCodice);
				$demHtmlCodice = str_replace("{arrow}", $arrowTag, $demHtmlCodice);
				$demHtmlCodice = str_replace("{immagine-1}", $immagine1Tag, $demHtmlCodice);
				$demHtmlCodice = str_replace("{immagine-2}", $immagine2Tag, $demHtmlCodice);
				$demHtmlCodice = str_replace("{immagine-3}", $immagine3Tag, $demHtmlCodice);
				$demHtmlCodice = str_replace("{immagine-4}", $immagine4Tag, $demHtmlCodice);

				if($this->sendMail(null, $_POST["email"], "Cortology - codice story machine", $demHtmlCodice, null)){
					$message = "Ti abbiamo inviato il codice, controlla la posta!";
				}
			}else{
				$message = "Email non valida";
			}
		} else{
			$message = "Codice o email mancante";
		}
		return $message;
	}
	
	function sendStoryMachineEmail($userEmail, $nome, $cognome, $storia, $titolo, $codice, $immagine1, $immagine2, $immagine3, $immagine4){
		$subject = "Cortology - story machine";
		return $this->sendMail(null, $userEmail, $subject, $this->getBodyMessageForStoryMachine($nome, $cognome, $storia, $titolo, $codice, $immagine1, $immagine2, $immagine3, $immagine4), $this->getEmailAdmin());
	}
	
	function getBodyMessageForStoryMachine($nome, $cognome, $storia, $titolo, $codice, $immagine1, $immagine2, $immagine3, $immagine4) {
		$httpRoot = "http://$_SERVER[HTTP_HOST]";
		$demFolder = $httpRoot . "/wp-content/themes/shortology_new-child/cortology/dem";
		$arrowSrc = "$httpRoot/wp-content/themes/shortology_new-child/images/arrow.png";
		$arrowTag = '<img src="'.$arrowSrc.'" style="margin-bottom: 25px;margin-top: 0px;width: 40px;height: 15px;" />';
		$imgTempStart = '<img src="'.$httpRoot.'/wp-content/themes/shortology_new-child/images/slot-images/300icone_';
		$imgTempEnd = '.png" />';

		$immagine1Tag = $imgTempStart . $immagine1 . $imgTempEnd;
		$immagine2Tag = $imgTempStart . $immagine2 . $imgTempEnd;
		$immagine3Tag = $imgTempStart . $immagine3 . $imgTempEnd;
		$immagine4Tag = $imgTempStart . $immagine4 . $imgTempEnd;
	
		$demHtml = file_get_contents($demFolder . "/dem.html");
	
		$demHtml = str_replace("{folder-dem}", $demFolder, $demHtml);
		$demHtml = str_replace("{nome}", $nome, $demHtml);
		$demHtml = str_replace("{cognome}", $cognome, $demHtml);
		$demHtml = str_replace("{titolo}", $titolo, $demHtml);
		$demHtml = str_replace("{storia}", $storia, $demHtml);
		$demHtml = str_replace("{codice}", $codice, $demHtml);
		$demHtml = str_replace("{arrow}", $arrowTag, $demHtml);
		$demHtml = str_replace("{immagine-1}", $immagine1Tag, $demHtml);
		$demHtml = str_replace("{immagine-2}", $immagine2Tag, $demHtml);
		$demHtml = str_replace("{immagine-3}", $immagine3Tag, $demHtml);
		$demHtml = str_replace("{immagine-4}", $immagine4Tag, $demHtml);
	
		return $demHtml;
	}
	
	function sendMail($from = null, $to, $subject = null, $body = null, $bcc = null) {
		$mailProperties = parse_ini_file("mail.properties");
		$mail = new PHPMailer;
		/*
		 * set smtp
		*/
		$mail->IsSMTP();
		$mail->Host = $mailProperties["host"];
		$mail->Port = $mailProperties["port"];
		$mail->SMTPAuth = true;
		$mail->Username = $mailProperties["username"];
		$mail->Password = $mailProperties["password"];
		/*
		 * set mail
		*/
		$mail->IsHTML(true);
		$mail->CharSet = 'UTF-8';
		$mail->From = $from != null ? $from : $mailProperties["from"];
		$mail->FromName = 'Cortology';
		$mail->AddAddress($to);
	
		$mail->Subject = $subject != null ? $subject : $mailProperties["subject"];
		$mail->Body    = $body;
	
		if(!empty($bcc)){
			$mail->addBCC($bcc);
		}
		
		if($mailProperties["debug"]){
			$mail->addBCC($mailProperties["debugEmail"]);
		}
	
		return $mail->Send();
	}
}
?>