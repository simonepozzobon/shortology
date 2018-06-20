<?php 

include_once 'quiz-functions.php';

$quizFunctions = new QuizFunctions();

$quizFunctions->checkRequest();

?>
<html>

	<head>
		<title>Test quiz</title>
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
		<script type="text/javascript">

			$(document).ajaxStart(function() {
				$("#layerLoading").show();
			});
			
			$(document).ajaxStop(function() {
				$("#layerLoading").hide();
			});
			
			$(document).ajaxError(function(event, jqXHR, ajaxSettings, thrownError) {
				$("#layerLoading").hide();
				alert("Generic error during ajax request: " + thrownError);
			});

		
			$(document).ready(function(){
				$("a[id^='risposta']").click(function(event){
					event.preventDefault();
					$.ajax({
						type : "POST",
						url  : 'http://shortology.dinodelmancino.com/wp-content/themes/shortology_new-child/cortology/test-quiz.php',
						data : {'insert-risposta' : 'true', 'domanda' : $(this).attr("data-domanda"), 'risposta' : $(this).attr("data-risposta"), 'quiz' : $(this).attr("data-quiz") },
						success : function(data){
							console.info(data);
						}
					});
				});				
			});
		</script>
	</head>
	
	<body style="overflow: hidden;margin: 0;">
	
		
		<?php if(isset($_SESSION["cort_user_id"])) { ?>
		
			
		
		
			<?php if(isset($_POST["quiz-id"])) { ?>
					
					<?php foreach ($quizFunctions->getDomande($_POST["quiz-id"]) as $domanda) { ?>
						<div data-domanda-corrente="<?php echo ($cortUserQuiz->prossimaDomanda === $domanda->ID); ?>">
							<fieldset style="margin: 20px; padding: 20px;">
								<legend><?php echo $domanda->DOMANDA; ?></legend>
								<?php foreach ($quizFunctions->getRisposte($domanda->ID) as $risposta) { ?>
									<div style="margin: 5px;padding: 5px;">
										<a href="#" id="risposta_<?php echo $risposta->ID;?>" data-risposta="<?php echo $risposta->ID;?>" data-domanda="<?php echo $domanda->ID;?>" data-quiz="<?php echo $quiz->ID;?>"><?php echo $risposta->RISPOSTA;?></a>
									</div>
								<?php } ?>
							</fieldset>
						</div>
					<?php } ?>
					
			
					<div id="endQuiz">
					
						<label>Bravo hai finito!!!</label>
						<form action="" method="post">
							<input type="hidden" id="userId" name="userId" value="<?php echo $_SESSION["cort_user_id"] ?>" />	
							<button type="submit">Inizia 1 altro quiz!</button>
						</form>
						
					
					</div>
			
			
		
			<?php } else { 
				$quizList = $quizFunctions->getQuizList();
			?>
				<fieldset>
					<legend>Seleziona il quiz</legend>
					<form action="" method="post">
						<input type="hidden" name="method" value="start-quiz" />
						<input type="hidden" id="userId" name="userId" value="<?php echo $_SESSION["cort_user_id"] ?>" />	
						<?php foreach ($quizList as $quiz) { ?>
							<button type="submit" name="quiz-id" value="<?php echo $quiz->ID; ?>"><?php echo $quiz->NOME?></button><br />
						<?php } ?>
					</form>
				</fieldset>
			<?php }?>
		<?php } else if(isset($_GET["registrati"])) { ?>
			<fieldset>
				<legend>Cortology Quiz - Registrati</legend>
				<i>Compila tutti i campi e inizia a giocare!</i>
				<form action="" method="post">
					<input type="hidden" name="method" value="register">
					<div>Nome*: <input name="nome" value="<?php if(isset($_POST["nome"])) echo $_POST["nome"]; ?>" /></div>
					<div>Cognome*: <input name="cognome" value="<?php if(isset($_POST["cognome"])) echo $_POST["cognome"]; ?>" /></div>
					<div>Email*: <input name="email" value="<?php if(isset($_POST["email"])) echo $_POST["email"]; ?>" /></div>
					<div>Nickname*: <input name="nickname" value="<?php if(isset($_POST["nickname"])) echo $_POST["nickname"]; ?>" /></div>
					<div>Accetto tutto tutto* <input type="checkbox" name="privacy" <?php if(isset($_POST["privacy"])){ ?> checked="checked" <?php }?>/></div>
					<div><input type="submit" value="Invia!"></div>
					<div><?php if($errorRegister != null){ echo $errorRegister;} ?></div>
				</form>
			</fieldset>
		<?php } else if(isset($_GET["login"])) { ?>
			<fieldset>
				<legend>Cortology Quiz - Login</legend>
				<i>Inserisci la tua email per continuare a giocare!</i>
				<form action="" method="post">
					<input type="hidden" name="method" value="login">
					<div>Email: <input name="email" value="<?php if(isset($_POST["email"])) echo $_POST["email"]; ?>" /></div>
					<div><input type="submit" value="Login" /></div>
					<div><?php if($errorLogin != null){ echo $errorLogin;} ?></div>
				</form>
			</fieldset>
		<?php } else { ?>
			<div>
				<h1>Cosa vuoi fare?</h1>
				<div><a href="?registrati">Registrati</a></div>
				<div><a href="?login">Login</a></div>
			</div>
		<?php } ?>
			
	</body>
	
</html>