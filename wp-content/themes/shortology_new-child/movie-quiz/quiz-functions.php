<?php
$path = $_SERVER ['DOCUMENT_ROOT'];

include_once $path . '/wp-config.php';
include_once $path . '/wp-load.php';
include_once $path . '/wp-includes/wp-db.php';
include_once $path . '/wp-includes/pluggable.php';

session_start();

class UserQuiz {
	public $id;
	public $nome;
	public $cognome;
	public $nickname;
	public $email;
	public $listaQuizTerminati;
};

class QuizFunctionsNew {
	
	function getClassifica(){
		global $wpdb;
		return $wpdb->get_results("SELECT NICKNAME, SUM(PUNTEGGIO) AS PUNTEGGIO, SUM(TEMPO) AS TEMPO
		FROM(
		select u.nickname, c.fk_quiz, sum(IFNULL(punteggio, 0)) AS PUNTEGGIO, sum(IFNULL(TEMPO, 0)) AS TEMPO,
		count(*) AS RISPOSTE_DATE, (SELECT COUNT(*) FROM cort_quiz_domanda D INNER JOIN cort_quiz_anag Q ON Q.ID=D.FK_QUIZ WHERE Q.ID=c.FK_QUIZ) AS DOMANDE_QUIZ
		from cort_quiz_classifica c
		inner join cort_quiz_utente u on u.id = c.fk_utente
		left join cort_quiz_risposta r on c.fk_risposta = r.id
		where c.fk_quiz != 4
		group by u.nickname, c.fk_quiz
		)sublist
		where RISPOSTE_DATE = DOMANDE_QUIZ
		group by nickname
		order by PUNTEGGIO desc, TEMPO asc
		limit 10");
	}
	
	/*
	 * recupero la lista di tutti i quiz
	 */
	function getQuizList(){
		global $wpdb;
		$quizList = $wpdb->get_results("select * from cort_quiz_anag order by posizione");
		foreach ($quizList as $quiz){
			$domandeQuiz = $wpdb->get_var($wpdb->prepare("select count(*) from cort_quiz_domanda where fk_quiz = %d ", $quiz->ID));
			$risposteUtente = $wpdb->get_var($wpdb->prepare("select count(*) from cort_quiz_classifica where fk_utente = %d and fk_quiz = %d ", array($_SESSION["user-quiz"], $quiz->ID)));
			if($risposteUtente >= $domandeQuiz) {
				$quiz->USED = true;
			} else {
				$quiz->USED = false;
			}
		}
		return $quizList;
	}
	
	function getDomande($idQuiz){
		global $wpdb;
		/*
		 * cancello tutte le vecchie risposte per il quiz selezionato
		 */
		$wpdb->delete("cort_quiz_classifica", array ( "fk_utente" => $_SESSION["user-quiz"], "fk_quiz" => $idQuiz ));
		return $wpdb->get_results($wpdb->prepare("select * from cort_quiz_domanda where FK_QUIZ = %d order by posizione", $idQuiz));
	}
	
	function getRisposte($idDomanda){
		global $wpdb;
		return $wpdb->get_results($wpdb->prepare("select * from cort_quiz_risposta where FK_DOMANDA = %d order by posizione", $idDomanda));
	}
	
	function setUserInSession($user){
		$cort_user_quiz = new UserQuiz();
		$cort_user_quiz->id = $user->ID;
		$_SESSION["user-quiz"] = $cort_user_quiz->id;
	}
	
	function login(){
		global $wpdb;
		$errorLogin = null;
		if(isset($_POST["email"]) && !empty($_POST["email"])){
			if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
				$userLogin = $wpdb->get_row ( $wpdb->prepare ( "SELECT * FROM cort_quiz_utente WHERE EMAIL = %s", $_POST["email"] ) );
				if($userLogin != null){
					$this->setUserInSession($userLogin);
				}else{
					$errorLogin = "Attenzione! Email non presente";
				}
			}else{
				$errorLogin = "Attenzione! Email non valida";
			}
		}else{
			$errorLogin = "Attenzione! Inserisci la tua email";
		}
		return $errorLogin;
	}
	
	function registraUtente(){
		global $wpdb;
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
								if($newUser != null){
									$this->setUserInSession($newUser);
								}
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
		return $errorRegister;
	}
	
	/*
	 * da verificare
	 */
	function inseriscRisposta(){
		global $wpdb;
		$risposta;
		if(isset($_POST["risposta"]) && isset($_POST["tempo"]) && isset($_SESSION["user-quiz"]) && isset($_POST["quiz-id"])) {
			if(isset($_SESSION["user-quiz"])){				
				$risposta = $wpdb->insert ( "cort_quiz_classifica", array ( "fk_utente" => $_SESSION["user-quiz"], "fk_risposta" => $_POST["risposta"], "tempo" => $_POST["tempo"], "fk_quiz" => $_POST["quiz-id"] ), "%d" );
			}else{
				$risposta = "Utente non loggato";
			}
		} else{
			$risposta = "Mancano i dati(risposta, tempo, utente)";
		}
		return $risposta;
	}
	
	function getPuntiByQuizId($quizId){
		global $wpdb;
		return $wpdb->get_var($wpdb->prepare(" select sum(punteggio) from cort_quiz_classifica c inner join cort_quiz_risposta r on c.fk_risposta=r.id where c.fk_quiz = %d and c.fk_utente = %d", array($quizId, $_SESSION["user-quiz"])));
	}
}

if(isset($_POST["insert-risposta"])) {
	$quizFunctions = new QuizFunctionsNew(); 
	echo $quizFunctions->inseriscRisposta();
	exit;
}else if(isset($_POST["calcola-punteggio-quiz"])){
	if(isset($_POST["quiz-id"])){
		$quizFunctions = new QuizFunctionsNew();
		echo $quizFunctions->getPuntiByQuizId($_POST["quiz-id"]);
		exit;
	}	
}
?>