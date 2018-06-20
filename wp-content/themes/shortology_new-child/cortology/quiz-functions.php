<?php
$path = $_SERVER ['DOCUMENT_ROOT'];

include_once $path . '/wp-config.php';
include_once $path . '/wp-load.php';
include_once $path . '/wp-includes/wp-db.php';
include_once $path . '/wp-includes/pluggable.php';

class CortUserQuiz {
	public $id;
	public $nickname;
	public $prossimoQuiz;
	public $prossimaDomanda;
};

class QuizFunctions {
	
	function getQuizList(){
		global $wpdb;
		return $wpdb->get_results("select * from cort_quiz_anag order by id");
	}
	
	
	function getDomande($idQuiz){
		global $wpdb;
		return $wpdb->get_results($wpdb->prepare("select * from cort_quiz_domanda where FK_QUIZ = %d order by id", $idQuiz));
	}
	
	function getRisposte($idDomanda){
		global $wpdb;
		return $wpdb->get_results($wpdb->prepare("select * from cort_quiz_risposta where FK_DOMANDA = %d order by id", $idDomanda));
	}
	
	function registraUtente(){
		$errorRegister = "";
		/*
		 * controllo che ci siano tutti i campi
		*/
		if(isset($_POST["nome"]) && isset($_POST["cognome"]) && isset($_POST["email"]) && isset($_POST["nickname"]) && isset($_POST["privacy"])) {
			if(!empty($_POST["nome"]) && !empty($_POST["cognome"]) && !empty($_POST["email"]) && !empty($_POST["nickname"])){		
				if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {						
					/*
					 * controllo che email e nickname non siano gia presenti
					 */		
					$testEmail = $wpdb->get_var ( $wpdb->prepare ( "SELECT COUNT(*) FROM cort_quiz_utente WHERE EMAIL = %s", $_POST["email"] ) );
						
					if($testEmail == 0){
		
						$testNickname = $wpdb->get_var ( $wpdb->prepare ( "SELECT COUNT(*) FROM cort_quiz_utente WHERE NICKNAME = %s", $_POST["nickname"] ) );
		
						if($testNickname == 0){
							/*
							 * se la insert va a buon fine setto l'utente in sessione tenendo traccia dell'ultima risposta data
							*/
								
							$testInsert = $wpdb->insert("cort_quiz_utente", array("nome" => $_POST["nome"], "cognome" => $_POST["cognome"], "email" => $_POST["email"], "nickname" => $_POST["nickname"] ), "%s");
		
							if($testInsert === 1){
								$newUser = $wpdb->get_row ( $wpdb->prepare ( "SELECT * FROM cort_quiz_utente WHERE EMAIL = %s", $_POST["email"] ) );
// 								$cort_user_quiz = new CortUserQuiz();
// 								$cort_user_quiz->nickname = $newUser->NICKNAME;
// 								$cort_user_quiz->prossimoQuiz = 1;
// 								$cort_user_quiz->prossimaDomanda = 1;
								$_SESSION["cort_user_id"] = null;
								$_SESSION["cort_user_id"] = $newUser->ID;//"test";//$cort_user_quiz;
							}else{
								$errorRegister = "Attenzione! Si e' verificato un errore durante la registrazione, riprova piu tardi.";
							}
						}else{
							$errorRegister = "Attenzione! Nickname gia presente";
						}
					}else{
						$errorRegister = "Attenzione! Email gia presente";
					}
				} else {
					$errorRegister = "Attenzione! Email non valida";
				}
			} else {
				$errorRegister = "Attenzione! tutti i campi sono obbligatori!";
			}
		}else{
			$errorRegister = "Attenzione! tutti i campi sono obbligatori!";
		}
		echo $errorRegister;
	}
	
	function login(){
		global $wpdb;
		
		$errorLogin = "";
		if(isset($_POST["email"]) && !empty($_POST["email"])){
			if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
				$userLogin = $wpdb->get_row ( $wpdb->prepare ( "SELECT * FROM cort_quiz_utente WHERE EMAIL = %s", $_POST["email"] ) );
				if($userLogin != null){
					$cort_user_quiz = new CortUserQuiz();
					$cort_user_quiz->nickname = $userLogin->NICKNAME;
					$cort_user_quiz->prossimoQuiz = 1;
					$cort_user_quiz->prossimaDomanda = 1;
						
					$_SESSION["cort_user_id"] = $userLogin->ID;//$cort_user_quiz;
				}else{
					$errorLogin = "Attenzione! Email non presente";
				}
			}else{
				$errorLogin = "Attenzione! Email non valida";
			}
		}else{
			$errorLogin = "Attenzione! Inserisci la tua email";
		}
		echo $errorLogin;
	}
	
	function inseriscRisposta(){
		if(isset($_POST["quiz"]) && isset($_POST["domanda"]) && isset($_POST["risposta"])){
			echo $_POST["quiz"] . $_POST["domanda"] . $_POST["risposta"];
		}else{
			echo "Mancano i dati!!";
		}
		exit;
	}
	
	function checkRequest() {
		
		if(isset($_POST["userId"])){
			$_SESSION["cort_user_id"] = $_POST["userId"];
		}
		
		if(isset($_POST["method"])) {
			$method = $_POST["method"];
			if(!empty($method)) {
				if($method == "login") {
					$errorLogin = $this->login();
					if(!empty($errorLogin)){
						$_REQUEST["error-login"] = $errorLogin;
					}
				} else if($method == "register") {
					$errorRegister = $this->registraUtente();
					if(!empty($errorRegister)){
						$_REQUEST["error-register"] = $errorRegister;
					}
				}
			}
		} else if(isset($_POST["insert-risposta"])) {
			echo $this->inseriscRisposta();
		}
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
}
?>