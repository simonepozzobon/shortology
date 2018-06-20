<?php 

include_once 'quiz-functions.php';

//echo $_SERVER['DOCUMENT_ROOT'];

$showFirstPage = true;
$showPageLogin = false;
$showPageRegistrati = false;
$showQuizList = false;
$showQuiz = false;

$user = new UserQuiz();
$quizSelected = null;
$quizList = null;
$listaDomande = null;

$erroreRegistrazione = null;


$quizFunctions = new QuizFunctionsNew();

/*
 * controllo se devo effettuare un logout
 */
if(isset($_GET["logout"])){
	$showFirstPage = true;
	$showPageRegistrati = false;
	session_unset();
}
/*
 * Controllo se ha cliccato sul primo bottone "INIZIA"
 */
if(isset($_GET["start"])){
	$showFirstPage = false;
	if($_GET["start"] == 'login'){
		$showPageLogin = true;
	}else{
		$showPageRegistrati = true;
	}
}
/*
 * Controllo se ha cliccato sul bottone LOGIN
 */
if(isset($_POST["login"])){
	$erroreLogin = $quizFunctions->login();
}
/*
 * controllo se sta effettuando una registrazione / login
 */
if(isset($_POST["registrati"])){
	/*
	 * registra
	 */
	$erroreRegistrazione = $quizFunctions->registraUtente();
}
/*
 * controllo se ho 1 utente in sessione
 */
if(isset($_SESSION["user-quiz"])) {
	$showQuizList = true;
	$showFirstPage = false;
	$showPageLogin = false;
	$showPageRegistrati = false;
	$user = $_SESSION["user-quiz"];
	/*
	 * controllo se ha selezionato un quiz
	 */
	if(isset($_POST["quiz-selected"])){
		$showQuiz = true;
		$showQuizList = false;
		$quizSelected = $_POST["quiz-selected"];
		$listaDomande = $quizFunctions->getDomande($quizSelected);
	}else{
		/*
		 * recupero la lista dei quiz
		 * oggetto quiz: tutte le colonne della tabella + boolean done
		 */
		$quizList = $quizFunctions->getQuizList();
	}
}
?>

<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>MovieQuiz: Form</title>
		<link href="MQstyle.css" rel="stylesheet" type="text/css" />
		<link href="progress.css" rel="stylesheet" type="text/css" />
		<script src="js/jquery.min.js"><!-- --></script>		
		<?php if($showQuizList) { ?>
			<script type="text/javascript" src="js/movie-quiz-list.js"><!-- --></script>
		<?php } else if($showQuiz) { ?>
			<script type="text/javascript" src="js/movie-quiz.js"><!-- --></script>
		<?php } ?>

		<style type="text/css">
			.error-registrazione{
				text-align: center;
				color: red;
			}
			
			#layerCover{
				position: absolute;
				display: none;
				width: 100%;
				height: 100%;
				background: rgba(0, 0, 0, 0.8);
				z-index: 9999;
			}
		</style>
	</head>
	<body>
		<div id="layerCover"></div>
		<div id="quizContainer" style="position: relative;width: 100%;height: 100%;display: inline-block;">
			<?php if($showFirstPage){ ?>
				<div class="MQwrapper">
					<h1 class="movieQuiz">MOVIE QUIZ</h1>
					<div class="intro">
						<p>Ti piace il cinema? T&eacute;stati con 3 test!<br /><br />Ne sai di brutto di film, registi e attori? Se con gli amici la conversazione finisce sul cinema, modestamente ci fai sempre la tua signora figura? Mettiti alla prova con questi 3 test per cinefili veri (ma anche finti). Per i 3 migliori classificati, oltre alla gloria cinematografica imperitura, potrebbbe esserci anche una piacevole sorpresa. Ah, ultima cosa: il quarto test (Che regista sei?) non fa parte del contest, &egrave; solo per divertimento. Buone risposte a tutti!<br /><br />La classifica &egrave; aggiornata in tempo reale sul maxischermo. Guarda come stai andando!</p>
						<span class="btnContainer"> <a title="INIZIA" href="?start"
							class="smallBtn centered">Inizia</a>
						</span>
						<!-- 
						<span class="btnContainer"> <a title="INIZIA" href="?start=login"
							class="smallBtn centered">Login</a>
						</span>
						 -->
					</div>
				</div>
			<?php } else if($showPageRegistrati){ ?>
				<div class="MQwrapper">
					<h1 class="movieQuiz">MOVIE QUIZ</h1>
					<div class="formIntro">
						<form method="post" action="#">
							<input type="hidden" name="registrati" value="registrati" />
							<div style="display: block;" class="cleared">
								<p class="labelForm">[ nome ]</p>
								<input value="<?php if(isset($_POST["nome"])) echo $_POST["nome"]; ?>" name="nome" class="copyForm right" />
							</div>
							<div style="display: block;" class="cleared">
								<p class="labelForm">[ cognome ]</p>
								<input value="<?php if(isset($_POST["cognome"])) echo $_POST["cognome"]; ?>" name="cognome" class="copyForm right" />
							</div>
							<div style="display: block;" class="cleared">
								<p style="font-family: Helvetica, Arial, sans-serif !important;"
									class="labelForm noFont">[ nickname ]</p>
								<input value="<?php if(isset($_POST["nickname"])) echo $_POST["nickname"]; ?>" name="nickname" class="copyForm right" />
							</div>
							<div style="display: block;" class="cleared">
								<p class="labelForm">[ email ]</p>
								<input value="<?php if(isset($_POST["email"])) echo $_POST["email"]; ?>" name="email" class="copyForm right" />
							</div>
							<div style="display: block;" class="cleared">
								<p class="accept right">Ho letto e accetto le <a style="font-family: Helvetica, Arial, sans-serif !important;" target="_blank" href="/wp-content/themes/shortology_new-child/images/privacy.pdf">regole di cortology</a> <input type="checkbox" name="privacy" <?php if(isset($_POST["privacy"])) { ?> checked="checked" <?php }?>></p>
							</div>
							<?php if(!empty($erroreRegistrazione)) { ?>
								<div style="display: block;" class="cleared error-registrazione">
									<span><?php echo $erroreRegistrazione; ?></span>
								</div>
							<?php } ?>
							<div style="display: block; padding-top: 15px;" class="cleared">
								<input type="submit" value="Gioca!" title="Invia Storia" class="smallBtn right" />
							</div>
						</form>
					</div>
				</div>
			<?php } else if($showPageLogin){ ?>
				<div class="MQwrapper">
					<h1 class="movieQuiz">MOVIE QUIZ</h1>
					<div class="formIntro">
						<form method="post" action="#">
							<input type="hidden" name="login" value="login" />
							<div style="display: block;" class="cleared">
								<p class="labelForm">[ email ]</p>
								<input value="<?php if(isset($_POST["email"])) echo $_POST["email"]; ?>" name="email" class="copyForm right" />
							</div>
							<?php if(!empty($erroreLogin)) { ?>
								<div style="display: block;" class="cleared error-registrazione">
									<span><?php echo $erroreLogin; ?></span>
								</div>
							<?php } ?>
							<div style="display: block; padding-top: 15px;" class="cleared">
								<input type="submit" value="Gioca!" title="Invia Storia" class="smallBtn right" />
							</div>
						</form>
					</div>
				</div>
			<?php } else if($showQuizList){ ?>
				<form id="formQuizList" action="#" method="post">
					<input type="hidden" name="quiz-selected" />
				</form>
				<div class="MQwrapper">
					<h1 class="movieQuiz">MOVIE QUIZ</h1>
					<div class="main">
						<?php foreach ($quizList as $quiz) { ?>
							<?php if($quiz->USED) { ?>
								<span class="mainBtnContainer"> <span class="mainBtn used"><?php echo $quiz->NOME; ?></span></span>
							<?php } else { ?>
								<span class="mainBtnContainer"> <a title="<?php echo $quiz->NOME; ?>" data-quiz-id="<?php echo $quiz->ID; ?>" href="#" class="mainBtn"><?php echo $quiz->NOME; ?></a></span>
							<?php  } ?>
							
						<?php } ?>
						<p class="exit">
							Non vuoi pi&ugrave; giocare? <a href="?logout" title="LOGOUT">Effettua il Log Out.</a>
						</p>
					</div>
				</div>
			<?php } else if($showQuiz){ ?>
				<?php if($quizSelected == 3 || $quizSelected == 1) { ?>
					<div class="container-progress" data-hide="true">
						<div class="progress">
							<div id="progressBar" class="progress-bar-20s"></div>
							<input id="tempoTotaleCountDown" type="hidden" value="20" />
						</div>
					</div>
				<?php } else { ?>
					<div class="container-progress" data-hide="true">
						<div class="progress">
							<div id="progressBar" class="progress-bar"></div>
							<input id="tempoTotaleCountDown" type="hidden" value="10" />
						</div>
					</div>
				<?php }?>
				<input type="hidden" data-quiz-id="<?php echo $quizSelected; ?>" />
				<!-- <progress id="progressBar" max="10" value="0"></progress> -->
				<?php if($quizSelected == 1) { ?>
					<div class="MQwrapper">
				    	<h1 class="beccaIlfilm">BECCA IL FILM</h1>
				    	<div class="start">
				    		<p>Cerca di riconoscere il film rappresentato dalle icone,<br />scegliendo tra le quattro soluzioni proposte.<br /><br />Sei pronto?</p>
				    	</div>
				    	<div class="main">
				      		<span class="mainBtnContainer">
				        		<a title="Ciak, azione!" href="" class="mainBtn" data-start-quiz>Ciak, azione!</a>
				      		</span>
				    	</div>
				  	</div>
					<!-- LISTA DOMANDE -->
					<?php foreach ($listaDomande as $domanda) { ?>
						<div class="MQwrapper" data-hide="true" data-domanda="<?php echo $domanda->ID; ?>">
							<img class="hint" src="images/movieQuiz/<?php echo $domanda->IMMAGINE; ?>.png" />
							<div class="main">
								<?php foreach ($quizFunctions->getRisposte($domanda->ID) as $risposta) { ?>
									<span class="mainBtnContainer"> <a data-risposta="<?php echo $risposta->ID; ?>" title="<?php echo $risposta->POSIZIONE; ?>" href="#" class="mainBtn"><?php echo $risposta->RISPOSTA; ?></a> </span> 
								<?php } ?>
							</div>
						</div>
					<?php } ?>
				<?php } else if($quizSelected == 2){ ?>
					<div data-quiz-intro="INTRUSO" class="MQwrapper">
						<h1 class="intruso">SCOPRI L’INTRUSO</h1>
						<div class="start">
							<p>
								Per ogni film indicato, ci sono quattro icone. Tre hanno a che fare con la trama del film stesso, una non c'entra nulla. Trovala!<br /> <br />Sei pronto?
							</p>
						</div>
						<div class="main">
							<span class="mainBtnContainer"> <a title="Ciak, azione!" href="" class="mainBtn" data-start-quiz>Ciak, azione!</a>
							</span>
						</div>
					</div>
					<!-- LISTA DOMANDE -->
					<?php foreach ($listaDomande as $domanda) { ?>
						<div class="MQwrapper" data-hide="true" data-domanda="<?php echo $domanda->ID; ?>">
							<p class="titIntruso">[ <?php echo $domanda->DOMANDA; ?> ]</p>
							<div class="contIntruso">
								<div class="cleared">
									<?php foreach ($quizFunctions->getRisposte($domanda->ID) as $risposta) { ?>
										<span class="icoBtnContainer"> <a data-risposta="<?php echo $risposta->ID; ?>" title="<?php echo $risposta->POSIZIONE; ?>" href="#" class="icoBtn"><img src="images/movieQuiz/<?php echo $risposta->IMMAGINE; ?>.png" /></a> </span>
									<?php } ?>
								</div>
							</div>
						</div>
					<?php } ?>
				<?php } else if($quizSelected == 3){ ?>
					<div data-quiz-intro="CURIOSITA" class="MQwrapper">
						<h1 class="curiosita">CINECURIOSITA'</h1>
						<div class="start">
							<p>
								Rispondi alle domande scegliendo la soluzione giusta tra le quattro proposte. Questo &egrave; il test pi&ugrave; tosto: occhio!<br /> <br />Sei pronto?
							</p>
						</div>
						<div class="main">
							<span class="mainBtnContainer"> <a title="Ciak, azione!"
								href="" class="mainBtn" data-start-quiz>Ciak, azione!</a>
							</span>
						</div>
					</div>
					<!-- LISTA DOMANDE -->
					<?php foreach ($listaDomande as $domanda) { ?>
						<div class="MQwrapper" data-hide="true" data-domanda="<?php echo $domanda->ID; ?>">
							<img class="ico" src="images/movieQuiz/<?php echo $domanda->IMMAGINE; ?>.png" />
							<p class="txtIntruso"><?php echo $domanda->DOMANDA; ?></p>
							<div class="main">
								<?php foreach ($quizFunctions->getRisposte($domanda->ID) as $risposta) { ?>
									<span class="mainBtnContainer"> <a data-risposta="<?php echo $risposta->ID; ?>" title="<?php echo $risposta->POSIZIONE; ?>" href="#" class="mainBtn smallIco"><?php echo $risposta->RISPOSTA; ?></a> </span> 
								<?php } ?>
							</div>
						</div>
					<?php } ?>
				<?php } else if($quizSelected == 4){ ?>
					<div data-quiz-intro="REGISTA" class="MQwrapper">
						<h1 class="regista">CHE REGISTA SEI?</h1>
						<div class="start">
							<p>
								Rispondi alle domande e alla fine saprai...<br /> <br />Sei pronto?
							</p>
						</div>
						<div class="main">
							<span class="mainBtnContainer"> <a title="Ciak, azione!" href="" class="mainBtn" data-start-quiz>Ciak, azione!</a>
							</span>
						</div>
					</div>
					<!-- LISTA DOMANDE -->
					<?php foreach ($listaDomande as $domanda) { ?>
						<div class="MQwrapper" data-hide="true" data-domanda="<?php echo $domanda->ID; ?>">
							<img class="ico" src="images/movieQuiz/<?php echo $domanda->IMMAGINE; ?>.png" />
							<p class="txtIntruso"><?php echo $domanda->DOMANDA; ?></p>
							<div class="contRegista">
								<?php foreach ($quizFunctions->getRisposte($domanda->ID) as $risposta) { ?>
									<span class="registaBtnContainer"> <a data-risposta="<?php echo $risposta->ID; ?>" title="<?php echo $risposta->POSIZIONE; ?>" href="#" class="registaBtn"><img src="images/movieQuiz/<?php echo $risposta->IMMAGINE; ?>.png" /><?php echo $risposta->RISPOSTA; ?></a> </span>
								<?php } ?>
							</div>
						</div>
					<?php } ?>
				<?php } ?>
				
				<!-- END -->
				<div data-hide="true" class="MQwrapper" data-end-quiz>
					<div class="main middle">
						<span class="mainBtnContainer"> <a title="The End" href="" class="mainBtn" data-end="<?php echo $quizSelected;?>">The End</a>
						</span>
					</div>
				</div>
				
				<!-- PUNTEGGIO QUIZ -->
				<div data-hide="true" class="MQwrapper">
					<div class="start" data-esito-quiz-loading>
						<h1></h1>
						<p class="points">Solo un secondo<br/> stiamo calcolando il tuo punteggio...</p>
					</div>
					<div data-hide="true" data-esito-quiz>
						<h1 class="bravo">BRAVO</h1>
						<div class="start">
							<p class="points">Hai totalizzato <span data-punteggio-quiz></span> punti!</p>
						</div>
						<div class="main">
							<span class="mainBtnContainer"> <a title="Gioca ancora!" href="?start" class="mainBtn">Gioca ancora!</a> </span>
							<span class="mainBtnContainer"> <a title="Log Out" href="?logout" class="mainBtn">Log Out</a> </span>
						</div>
					</div>
				</div>
				
				<!--  CHE REGISTA SEI -->
				<div data-hide="true" class="MQwrapper" data-end-quiz-regista="1"><!-- 0-3 -->					
					<img class="ico" src="images/movieQuiz/cr_r_02.png" />
					<h1 class="sergej">sergej</h1>
					<div>
						<p class="points">S&igrave;, proprio lui, quella della corazzata Pot&euml;mkin. Cribbio, sei davvero ascetico e rigoroso prima di tutto con te stesso e poi, sospettiamo fortemente, anche con gli altri. Pochi fronzoli, princ&igrave;pi incrollabili e una seriet&agrave; assoluta, che nel migliore dei casi &egrave; coerenza e nel peggiore &egrave; seriet&agrave; assoluta. Eppure il tuo fascino sta un po&rsquo; anche in questo personaggio intransigente che ti sei creato addosso. Perch&eacute;, guardiamoci in faccia, un po&rsquo; ci fai, ammettilo. Ah no? Cavolo, sembrava di s&igrave;.</p>
					</div>
					<div class="main">
						<span class="mainBtnContainer"> <a title="Gioca ancora!" href="?start" class="mainBtn">Gioca ancora!</a> </span>
						<span class="mainBtnContainer"> <a title="Log Out" href="?logout" class="mainBtn">Log Out</a> </span>
					</div>
				</div>
				<div data-hide="true" class="MQwrapper" data-end-quiz-regista="2"><!-- 4-7 -->
					<img class="ico" src="images/movieQuiz/cr_r_01.png" />
					<h1 class="woody">woody</h1>
					<div>
						<p class="points">Tendenzialmente c&rsquo;&egrave; della complessit&agrave; intellettuale e affascinante in te, che per&ograve; tende a sconfinare nella stravaganza, la quale agli altri pu&ograve; sembrare a sua volta incoerenza. Ti piace riflettere, approfondire, sapere. D&rsquo;altra parte per&ograve;, non disdegni i piaceri della vita come mangiare, bere, riprodursi e fare i test. Insomma, ti piacerebbe essere un filosofo, ma poi ti annoieresti. Oppure una rockstar, ma sei troppo snob. Vedi che c&rsquo;&egrave; della complessit&agrave; in te? Te l&rsquo;avevamo anche detto.</p>
					</div>
					<div class="main">
						<span class="mainBtnContainer"> <a title="Gioca ancora!" href="?start" class="mainBtn">Gioca ancora!</a> </span>
						<span class="mainBtnContainer"> <a title="Log Out" href="?logout" class="mainBtn">Log Out</a> </span>
					</div>
				</div>
				<div data-hide="true" class="MQwrapper" data-end-quiz-regista="3"><!-- 8-11 -->
					<img class="ico" src="images/movieQuiz/cr_r_08.png" />
					<h1 class="fellini">fellini</h1>
					<div>
						<p class="points">La realt&agrave; non &egrave; carina quanto dovrebbe? Benissimo, dici tu, rifugiamoci nei sogni. Nell&rsquo;immaginazione. &Egrave; l&igrave; che dai il meglio di te. Non hai l&rsquo;animo del rivoluzionario barricadero, questo no. Il tuo mondo sono le fantasie che hai in testa, spesso cos&igrave; potenti che ti freghi da solo e ci credi tu stesso. C&rsquo;&egrave; della poesia l&igrave; dentro, in quella testolina, perfino della sensibilit&agrave; creativa. Ma anche un gran casino, dai! Mettici ordine ogni tanto, altrimenti passi dalla svagatezza artistoide alla neurodeliri.</p>
					</div>
					<div class="main">
						<span class="mainBtnContainer"> <a title="Gioca ancora!" href="?start" class="mainBtn">Gioca ancora!</a> </span>
						<span class="mainBtnContainer"> <a title="Log Out" href="?logout" class="mainBtn">Log Out</a> </span>
					</div>
				</div>
				<div data-hide="true" class="MQwrapper" data-end-quiz-regista="4"><!-- 12-15 -->
					<img class="ico" src="images/movieQuiz/cr_r_03.png" />
					<h1 class="steven">steven</h1>
					<div>
						<p class="points">Fondamentalmente, sei una persona buona, giusta, razionale. Certo, a volte &egrave; uno sforzo, ma ti sforzi sempre di sforzarti. A te ci si pu&ograve; affidare stando tranquilli, perch&eacute; difficilmente tradirai. Se hai figli, sei un buon padre o una buona madre. Se hai una madre e un padre, sei un buon figlio. Ti piace il lieto fine, soprattutto se vinci tu convincendo tutti che le cose brutte non si fanno. Se per vincere bisogna fare delle cose brutte, non ti tiri indietro. Ma del resto, potrai avere pure una debolezza, no?</p>
					</div>
					<div class="main">
						<span class="mainBtnContainer"> <a title="Gioca ancora!" href="?start" class="mainBtn">Gioca ancora!</a> </span>
						<span class="mainBtnContainer"> <a title="Log Out" href="?logout" class="mainBtn">Log Out</a> </span>
					</div>
				</div>
				<div data-hide="true" class="MQwrapper" data-end-quiz-regista="5"><!-- 16-19 -->
					<img class="ico" src="images/movieQuiz/cr_r_07.png" />
					<h1 class="coen">coen</h1>
					<div>
						<p class="points">In te c&rsquo;&egrave; una componente completamente pazza e una molto razionale. Sembrerebbe il ritratto di un caso clinico, e infatti lo &egrave;. Facendo ordine: sei sostanzialmente buono e affidabile, anche se c&rsquo;&egrave; qualcosa che ti annoia in tutto questo. &Egrave; pi&ugrave; forte di te. I tuoi bei valori ce li hai, per carit&agrave;. Ma la tentazione &egrave; sempre di vedere cosa succede a fregarsene. In te c&rsquo;&egrave; grossa curiosit&agrave;, ecco. Se fossi un gatto non sarebbe una buona notizia, ma essendo un essere umano, puoi divertirti assai.</p>
					</div>
					<div class="main">
						<span class="mainBtnContainer"> <a title="Gioca ancora!" href="?start" class="mainBtn">Gioca ancora!</a> </span>
						<span class="mainBtnContainer"> <a title="Log Out" href="?logout" class="mainBtn">Log Out</a> </span>
					</div>
				</div>
				<div data-hide="true" class="MQwrapper" data-end-quiz-regista="6"><!-- 20-23 -->
					<img class="ico" src="images/movieQuiz/cr_r_06.png" />
					<h1 class="mel">mel</h1>
					<div>
						<p class="points">Mass&igrave;, divertiamoci e chissenefrega, il resto si vedr&agrave;! Ecco, questo &egrave; un po&rsquo; il tuo motto. E tra l&rsquo;altro &egrave; un gran bel motto, ce lo presti? Sai goderti la vita al massimo, senza troppe vergogne, almeno non tue. Tra l&rsquo;altro, quelli intorno a te spesso vorrebbero imitarti, ma alla fine non hanno il coraggio. Tu invece hai il coraggio ma non il senso della misura. Sei assai divertente in molte situazioni, tra le quali non rientra per esempio una cena con l&rsquo;ambasciatore della Santa Sede. L&igrave; potresti fare grossi danni.</p>
					</div>
					<div class="main">
						<span class="mainBtnContainer"> <a title="Gioca ancora!" href="?start" class="mainBtn">Gioca ancora!</a> </span>
						<span class="mainBtnContainer"> <a title="Log Out" href="?logout" class="mainBtn">Log Out</a> </span>
					</div>
				</div>
				<div data-hide="true" class="MQwrapper" data-end-quiz-regista="7"><!-- 24-27 -->
					<img class="ico" src="images/movieQuiz/cr_r_04.png" />
					<h1 class="martin">martin</h1>
					<div>
						<p class="points">Che dire, sei un bel mix di ribellione e divertimento, durezza e umorismo, onore e disonore. Sembri uno che prende tutto di petto, senza scorciatoie, ma poi hai le tue parti molli, e non intendiamo parti fisiche. Un patatone spietato, ecco. Nel senso che sai piantare un casino se serve e poi commuoverti per un nonnulla. In questa vita o nella prossima vita, potresti essere un killer o un benefattore. Dipende da come ti gira. Ah, se sei un killer, cancella questa descrizione. Stavamo scherzando. Ci mancherebbe.</p>
					</div>
					<div class="main">
						<span class="mainBtnContainer"> <a title="Gioca ancora!" href="?start" class="mainBtn">Gioca ancora!</a> </span>
						<span class="mainBtnContainer"> <a title="Log Out" href="?logout" class="mainBtn">Log Out</a> </span>
					</div>
				</div>
				<div data-hide="true" class="MQwrapper" data-end-quiz-regista="8"><!-- 28-30 -->
					<img class="ico" src="images/movieQuiz/cr_r_05.png" />
					<h1 class="quentin">quentin</h1>
					<div>
						<p class="points">Concretezza, adrenalina, un tocco di cinismo e, nel caso, di sana e simpaticissima violenza. Ecco il tuo ritratto. Niente mezze misure, ti piacciono le sensazioni forti. Per te, la vita non &egrave; uno sport per signorine, nemmeno nel caso in cu tu sia effettivamente una signorina. S&igrave;, vabb&egrave;, ci sono le regole, ma vuoi mettere il piacere di ignorarle? Se il fine &egrave; provare tutte le esperienze della vita, qualche mezzo poco ortodosso si pu&ograve; giustificare. Secondo te. Secondo le forze dell&rsquo;ordine, a volte no.</p>
					</div>
					<div class="main">
						<span class="mainBtnContainer"> <a title="Gioca ancora!" href="?start" class="mainBtn">Gioca ancora!</a> </span>
						<span class="mainBtnContainer"> <a title="Log Out" href="?logout" class="mainBtn">Log Out</a> </span>
					</div>
				</div>
			<?php } ?>
		</div>
	</body>
</html>