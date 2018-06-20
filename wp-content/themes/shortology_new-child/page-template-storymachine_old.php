<?php
/* 
Template name: Story Machine page template
*/

$path = $_SERVER ['DOCUMENT_ROOT'];

include_once $path . '/wp-includes/class-phpmailer.php';
include_once $path . '/wp-content/themes/shortology_new-child/cortology/cortology-functions.php';

global $scrn;

$scrn['integration_header'] = 
'<link rel="stylesheet" href="/wp-content/themes/shortology_new-child/magnific-popup.css" type="text/css" media="screen" />
 <link rel="stylesheet" href="/wp-content/themes/shortology_new-child/magnific-popup-custom.css" type="text/css" media="screen" />
 <script type="text/javascript" src="/wp-content/themes/shortology_new-child/js/jquery.magnific-popup.js"></script>
 <script type="text/javascript" src="/wp-content/themes/shortology_new-child/js/jquery.slotmachine.js"></script>
 <script type="text/javascript" src="/wp-content/themes/shortology_new-child/js/storymachine.js"></script>
 <link rel="stylesheet" href="/wp-content/themes/shortology_new-child/storymachine.css" type="text/css" media="screen" />
 <meta property="og:type" content="website" />
 <meta property="og:image" content="http://www.shortology.it/wp-content/themes/shortology_new-child/images/cortology_ogimage.png" />';
get_header();

$cortologyFunctions = new CortologyFunctions();

?>

<style>
.copyCodice{
	margin-bottom: 5px;
}

.errorMessage{
	color: red;
}
</style>


<div class="bg dark-bg cortBkg" style="text-align: left" id="blog">
	<div class="container">
		<div class="sixteen columns">
			<div class="headline">
				<h4 id="titleSlot" class="cortSmH4">
					<strong><?php $top_title = get_post_meta($post->ID, 'top_title', true); if($top_title != '') echo $top_title; else the_title();?></strong>
				</h4>
				<h4 id="titleInsertStory" class="cortSmH4" style="display: none;"><strong>CORTOLOGY</strong></h4>
			</div>
		</div>
		<div class="clear"></div>
		<!-- start sixteen columns -->
		<div class="<?php if($fullwidth == 2) echo 'twelve'; else echo 'sixteen';?> columns">
			<?php 
				$formResult = null;
			
				if(isset($_POST["method"]) && $_POST["method"] === 'insert-story') {

					$formResult = $cortologyFunctions->aggiungiStoria();
					
					if($formResult["storia-inserita"] != null && $formResult["storia-inserita"]) {
        	?>
		        		<form id="formInsertStoryDone" action="" method="post">
		        			<input type="hidden" name="method" value="insert-story-done" />
		        		</form>
		        		<script type="text/javascript">
		        			$("#formInsertStoryDone").submit();
		        		</script>		        		
			<?php 
					}
        		} else if(isset($_POST["method"]) && $_POST["method"] === 'insert-story-done') {
        	?>
        			<div style="text-align: center;">
        				<h4 style="font-family:Helvetica, Arial, sans-serif!important; font-style:normal!important; font-size:18px!important;">Grazie per aver partecipato!!!</h4>
						<h4 style="font-family:Helvetica, Arial, sans-serif!important; font-style:normal!important; font-size:18px!important;">Sei ancora ispirato? <a style="font-family:Helvetica, Arial, sans-serif!important; font-style:normal!important; font-size:18px!important;" href="">Scrivi un'altra storia!</a></h4>
        			</div>
	        <?php 
	        	} 
	        	if(isset($_POST["codice"]) || $formResult != null) {
					$showErrors = $formResult != null;
	        ?>
            		<div class="cleared" style="margin:0 auto; width:370px;">
						<?php 
							$objDecodeSlot = $cortologyFunctions->objDecodeStorymachineCode($_POST["codice"]);
							if($objDecodeSlot["valid-code"] === true){
						?>
							<span class="imgFormStorymachine slot<?php echo($cortologyFunctions->getImageId(substr($objDecodeSlot["real-code"], 0, 2)));?>"></span>
							<span class="arrowHalf"><!-- --></span>
							<span class="imgFormStorymachine slot<?php echo($cortologyFunctions->getImageId(substr($objDecodeSlot["real-code"], 2, 2)));?>"></span>
							<span class="arrowHalf"><!-- --></span>
							<span class="imgFormStorymachine slot<?php echo($cortologyFunctions->getImageId(substr($objDecodeSlot["real-code"], 4, 2)));?>"></span>
							<span class="arrowHalf"><!-- --></span>
							<span class="imgFormStorymachine slot<?php echo($cortologyFunctions->getImageId(substr($objDecodeSlot["real-code"], 6, 2)));?>"></span>
						<?php 
							}
						?>
					</div>
        			<div id="cortInsertStory" class="formIntro" style="text-align: right; margin: auto;">
						<form action="/story-machine" method="post">
							<input type="hidden" name="codice" value="<?php echo isset($_POST["codice"]) ? $_POST["codice"] : $_POST["codice"]; ?>" />
							<input type="hidden" name="method" value="insert-story">
							<div class="cleared" style="display:block;">
								<p class="labelForm noFont" style="font-family:Helvetica, Arial, sans-serif!important;">[ nome ]</p>
								<input class="copyForm cleared" name="nome" value="<?php echo isset($_POST["nome"]) ? $_POST["nome"] : ""?>" />
								<?php if($showErrors && $formResult["empty-nome"]){ ?><div class="errorMessage">Nome Mancante</div><?php }?>
							</div>
							<div class="cleared" style="display:block;">
								<p class="labelForm noFont" style="font-family:Helvetica, Arial, sans-serif!important;">[ cognome ]</p>
								<input class="copyForm cleared" name="cognome" value="<?php echo isset($_POST["cognome"]) ? $_POST["cognome"] : ""?>" />
								<?php if($showErrors && $formResult["empty-cognome"]){ ?><div class="errorMessage">Cognome Mancante</div><?php }?>
							</div>
							<div class="cleared" style="display:block;">
								<p class="labelForm noFont" style="font-family:Helvetica, Arial, sans-serif!important;">[ email ]</p>
								<input class="copyForm cleared" name="email" value="<?php echo isset($_POST["email"]) ? $_POST["email"] : ""?>" />
								<?php if($showErrors && $formResult["empty-email"]){ ?><div class="errorMessage">Email Mancante</div><?php }?>
								<?php if($showErrors && $formResult["empty-email"] === false && $formResult["invalid-email"]){ ?><div class="errorMessage">Email non valida</div><?php }?>
							</div>
							<div class="cleared" style="display:block;">
								<p class="labelForm noFont" style="font-family:Helvetica, Arial, sans-serif!important;">[ titolo ]</p>
								<input class="copyForm cleared" name="titolo" value="<?php echo isset($_POST["titolo"]) ? $_POST["titolo"] : ""?>" />
								<?php if($showErrors && $formResult["empty-titolo"]){ ?><div class="errorMessage">Titolo Mancante</div><?php }?>
							</div>
							<div class="cleared" style="display:block;">
								<p class="labelForm noFont" style="font-family:Helvetica, Arial, sans-serif!important;">[ STORIA ]</p>
								<div id="countTextareaStory" style="font-family:Helvetica, Arial, sans-serif!important;margin-top: 20px;float: right;">1000</div>
								<textarea id="textareaStory" class="copyFormStoria cleared" name="storia" value="<?php echo isset($_POST["storia"]) ? $_POST["storia"] : ""?>" style="color: black;display: inline;"><?php echo isset($_POST["storia"]) ? $_POST["storia"] : ""?></textarea>
								<?php if($showErrors && $formResult["empty-storia"]){ ?><div class="errorMessage">Storia Mancante</div><?php }?>
							</div>							
							<div class="cleared" style="display:block;">
								<p class="labelForm labelLeft noFont" style="font-family:Helvetica, Arial, sans-serif!important;"><a style="font-family:Helvetica, Arial, sans-serif!important;" href="#popupEsempio" id="openPopupEsempio">Esempio storia</a></p>
								<p class="labelForm labelLeft noFont" style="font-family:Helvetica, Arial, sans-serif!important;">Ho letto e accetto le <a href="/wp-content/themes/shortology_new-child/images/privacy.pdf" target="_blank" style="font-family:Helvetica, Arial, sans-serif!important;">regole di cortology</a> <input type="checkbox" name="privacy" <?php if(isset($_POST["privacy"])){ ?>checked="checked"<?php }?> /></p>
								<?php if($showErrors && $formResult["empty-privacy"]){ ?><div class="cleared errorMessage">Privacy Mancante</div><?php }?>
							</div>
							<div class="cleared" style="display:block; padding-top:15px;">
								<input class="codBtn" style="font-family:Helvetica, Arial, sans-serif!important; text-transform:none; font-weight:bold!important; font-size:15px;" title="Invia Storia" type="submit" value="Invia!" />
							</div>
							
							<div id="popupEsempio" class="popup-privacy mfp-hide cortBkg">
								<div class="cleared" style="margin:50px auto 10px; max-width:300:px;">
									<center><img src="/wp-content/themes/shortology_new-child/images/acquaclada.jpg" /></center>
								</div>
								<div class="cleared" style="margin:10px auto; max-width:300px;">
									<strong style="font:Helvetica, Arial, sans-serif; font-size:13px;">[ L'ACQUA CALDA ]</strong>
								</div>
								<div class="cleared" style="margin:0 auto; max-width:300px;">
									<p style="font:Helvetica, Arial, sans-serif; font-size:13px; line-height:18px;"><strong>Erano entrambi mezzi sordi, uno lavorava in fabbrica, uno al lunapark. Si incontrarono in una visita guidata di un sommergibile da crociera della Marina e incisero un cd di musica industriale ludica che divent&ograve; la musica ambient di fabbriche e lunapark.</strong></p>
								</div>
							</div>
							<!--p id="popupPrivacy" class="popup-privacy mfp-hide">
							La Privacy Ã¨ un valore che H-57 S.r.l., con sede legale in Viale Coni Zugna 5 - 20144 Milano - Italy (Titolare del trattamento, in seguito definita â€œH-57â€�) riconosce e rispetta.
<br /><br />
Prima di inviarci i tuoi dati personali richiesti nel modulo di registrazione, ti preghiamo di leggere la presente informativa relativa al trattamento dei tuoi dati personali, resa in conformitÃ  allâ€™art. 13 D. Lgs. 30 giugno 2003 n. 196.
<br /><br />
1. I tuoi dati personali saranno archiviati nei sistemi informatici di H-57, assicurando il rispetto delle misure di sicurezza richieste dal D. Lgs. 196/2003, ai fini di consentirti di partecipare alla presente Iniziativa (in seguito definita â€œIniziativaâ€�).
<br /><br />
2. Al fine di garantire il rispetto delle condizioni di partecipazione allâ€™Iniziativa, anche al fine del riconoscimento di benefici alla stessa collegati, nel corso della navigazione all'interno di questo sito web (in seguito definito il â€œSitoâ€�) vengono raccolte informazioni che permettono di identificare il tuo computer e browser, attraverso dei file chiamati "Cookies" ed altri metodi informatici di raccolta, agli stessi assimilabili (ai fini di questo documento congiuntamente definiti â€˜â€™Cookiesâ€™â€™). La maggior parte dei browser web accetta automaticamente i Cookie, ma Ã¨ anche possibile modificare lâ€™impostazione per rifiutarli. Ti informiamo che disattivando i cookies, alcune funzioni che rendono piÃ¹ agevole la navigazione potrebbero non funzionare correttamente. I Cookies utilizzati da H-57 si distinguono in tre tipologie e finalitÃ : - Cookies funzionali che ci consentono di mantenere traccia delle tue scelte, quali ad esempio la selezione della lingua o la dimensione del carattere utilizzato, al fine di offrirti unâ€™esperienza digitale personalizzata; - Cookies necessari per navigare sul Sito, che consentono funzioni quali lâ€™identificazione e la gestione di una sessione di navigazione, ad esempio permettendo di mantenere attiva la connessione allâ€™area protetta durante la navigazione attraverso le pagine del Sito; - Cookies richiesti per la prevenzione di eventuali frodi in relazione allâ€™adesione allâ€™Iniziativa. Le informazioni raccolte attraverso i Cookie ai fini di prevenzioni di eventuali frodi legate allâ€™adesione allâ€™Iniziativa sono: indirizzo ip, browser, mac address del pc dal quale tu stai richiedendo lâ€™adesione allâ€™Iniziativa.
<br /><br />
3. In presenza del tuo consenso, i tuoi dati personali potranno altresÃ¬ essere utilizzati per consentire a H-57 di informarti in relazione a future offerte di prodotti o attivitÃ  promozionali, sempre nel rispetto delle misure di sicurezza applicabili al trattamento.
<br /><br />
4. Il conferimento dei tuoi dati personali Ã¨ facoltativo ma in assenza del tuo consenso al trattamento per le finalitÃ  sopra specificate (i) non ti sarÃ  consentito partecipare allâ€™Iniziativa o (ii) ricevere offerte di prodotti o informazioni circa attivitÃ  promozionali (a) da H-57 e/o (b) da certi partners commerciali selezionati di H-57 e rivenditori autorizzati di H-57.
<br /><br />
5. H-57 si occupa di mantenere i tuoi dati personali al sicuro e di proteggerli da divulgazioni inappropriate. Abbiamo attuato una serie di misure per assicurare la sicurezza dei tuoi dati personali sui nostri sistemi. I dati personali da noi raccolti sono contenuti in reti sicure e accessibili solo da un numero limitato di incaricati che hanno diritti di accesso speciali a tali sistemi.
<br /><br />
6. In ogni momento potrai esercitare i diritti di cui allâ€™art. 7 del D. Lgs. 196/2003 (tra cui chi richiedere lâ€™aggiornamento, la modifica, l'integrazione dei tuoi dati personali, opporsi per motivi legittimi al trattamento, conoscere lâ€™elenco dei responsabili del trattamento) scrivendo allâ€™indirizzo di posta elettronica <a href="mailto:info@H-57.com">info@H-57.com</a>. </p-->
						</form>
						<?php 
							if($formResult != null && $formResult["error-message"] != null){
						?>
							<div class="cleared" style="display:block; padding-top:15px;">
								<strong class="errorMessage">Attenzione: <?php echo $formResult["error-message"]; ?></strong>
							</div>
						<?php 
							}
						?>
					</div>
         	<?php 
	        	} else if(!isset($_POST["method"]) && !isset($_POST["codice"])){
				
					$totImg = $cortologyFunctions->getCountImages();
	        ?>
				<div class="cortSlot">
					<p class="noFont" style="font-family:Helvetica, Arial, sans-serif!important;">Tira la leva e genera una storia. Puoi provare tutte le volte che vuoi!</p>
					<div class="slotDivContainer" style="clear: both;">
						<div id="machine1" class="slotContainer slotMachine">
							<?php 
								for ($i = 1; $i <= $totImg; $i++) {
									echo '<div class="slot slot'.$i.'"></div>';
								}
							?>
						</div>
						<span class="arrow">
							<!-- -->
						</span>
						<div id="machine2" class="slotContainer slotMachine">
							<?php 
								for ($i = 1; $i <= $totImg; $i++) {
									echo '<div class="slot slot'.$i.'"></div>';
								}
							?>
						</div>
						<span class="arrow">
							<!-- -->
						</span>
						<div id="machine3" class="slotContainer slotMachine">
							<?php 
								for ($i = 1; $i <= $totImg; $i++) {
									echo '<div class="slot slot'.$i.'"></div>';
								}
							?>
						</div>
						<span class="arrow">
							<!-- -->
						</span>
						<div id="machine4" class="slotContainer slotMachine">
							<?php 
								for ($i = 1; $i <= $totImg; $i++) {
									echo '<div class="slot slot'.$i.'"></div>';
								}
							?>
						</div>
						<img id="btnSlot" class="bar" src="/wp-content/themes/shortology_new-child/images/slotBar.gif" alt="Gioca!" title="Gioca" />
					</div>					
					<div id="slotResult" style="display: none;">
						<p style="font-family:Helvetica, Arial, sans-serif!important;" class="noFont">Ti piace questa combinazione?<br />Scrivi la tua sceneggiatura!</p>
						<span style="height:65px; display:block; width:100%;">
                        <a style="font-family:Helvetica, Arial, sans-serif!important;" id="linkStoria" class="slotBtn" href="#" title="Scrivi la tua sceneggiatura!">Scrivi la tua sceneggiatura!</a>
                        </span>
						<p class="noFont" style="font-family:Helvetica, Arial, sans-serif!important;">
							Hai bisogno di tempo per pensarci?<br />Copiati questo codice per tornare a questa combinazione di icone,<br />oppure <a style="font-family:Helvetica, Arial, sans-serif!important;" href="#popupSendCode" id="openSendCodeModal">scegli di riceverlo via mail</a>.<br />
							<br /><span style="margin-right: 3px;">[</span><span id="codice"></span><span style="margin-left: 3px;">]</span><br /><br />
                            <a style="font-family:Helvetica, Arial, sans-serif!important;" href="/cortology" >Rileggi il regolamento</a>
						</p>
						
						<div id="popupSendCode" class="popup-send-code mfp-hide cortBkg">
							<div class="cleared" style="display:block;">
								<p class="labelForm noFont" style="font-family:Helvetica, Arial, sans-serif!important;">[ email ]</p>
								<input id="emailForCode" name="email" class="copyForm cleared"  />
							</div>
							<div class="cleared" style="display:block; height:80px;">
								<a style="font-family:Helvetica, Arial, sans-serif!important; text-decoration:none; font-weight:bold;" id="sendCodeByEmail" class="slotBtn" href="#" title="Invia!">Invia!</a>
							</div>
							<div class="cleared" style="display:block;">
								<span id="messageSendCodeByEmail"></span>
							</div>
						</div>
						
						<form id="formCreateStory" action="/story-machine" method="post" >
							<input type="hidden" name="codice" id="codiceForm" />
						</form>
					</div>
				</div>
        	<?php 
	        	}
	        ?>
        </div>
		<!-- end sixteen columns -->

		<!-- start sidebar -->
		<div class="four columns">
			<div class="sidebar">
                <?php
				if ($fullwidth == 2)
					dynamic_sidebar ( "Right sidebar" );
				?>
            </div>
		</div>
		<!-- end sidebar -->

	</div>
</div>
<div id="contact">
	<div class="container">

		<div class="sixteen columns">
			<h2 class="white">
				<span class="lines"><?php _e('Contact', 'SCRN');?></span>
			</h2>
		</div>
		<!-- end sixteen columns -->

            <?php if(isset($scrn['contact_description']) && $scrn['contact_description'] != '') { ?>
                <div class="sixteen columns">
			<p class="desk"><?php echo esc_attr($scrn['contact_description']);?></p>
		</div>
		<!-- end sixteen columns -->
            <?php } ?>
            
            <div class="clear"></div>

		<div class="eight columns">
			<div class="contact-form">

                    <?php include_once( ABSPATH . 'wp-admin/includes/plugin.php' ); 
                    if(is_plugin_active('contact-form-7/wp-contact-form-7.php') && isset($scrn['contactform7']) && $scrn['contactform7'] != '') { 
                        echo do_shortcode($scrn['contactform7']);
                    } else { ?>
                    
                        <div class="done">
                            <?php _e('<b>Thank you!</b> We have received your message.', 'SCRN');?> 
                        </div>

				<form method="post" action="process.php">
					<p><?php _e('name', 'SCRN');?></p>
					<input type="text" name="name" class="text" />

					<p><?php _e('email', 'SCRN');?></p>
					<input type="text" name="email" class="text" id="email" />

					<p><?php _e('message', 'SCRN');?></p>
					<textarea name="comment" class="text"></textarea>

					<input type="submit" id="submit"
						value="<?php _e('send', 'SCRN');?>" class="submit-button" />
				</form>
                    <?php } ?>
                        
                </div>
			<!-- end contact-form -->
		</div>
		<!-- end eight columns -->

		<div class="eight columns">

			<div class="contact-info">

				<h5><?php _e('Contact Info', 'SCRN');?></h5>
                
                    <?php if(isset($scrn['phone']) && $scrn['phone'] != '') { ?><p
					class="white">
					<img
						src="<?php echo get_template_directory_uri();?>/images/icn-phone.png"
						alt="" /> <?php echo $scrn['phone'];?></p><?php } ?>
                    <?php if(isset($scrn['email']) && $scrn['email'] != '') { ?><p
					class="white">
					<img
						src="<?php echo get_template_directory_uri();?>/images/icn-email.png"
						alt="" /> <a href="mailto:<?php echo $scrn['email'];?>"><?php echo encEmail($scrn['email']);?></a>
				</p><?php } ?>
                    <?php if(isset($scrn['location']) && $scrn['location'] != '') { ?><p
					class="white">
					<img
						src="<?php echo get_template_directory_uri();?>/images/icn-address.png"
						alt="" /> <?php echo $scrn['location'];?></p><?php } ?>
                </div>
			<!-- end contact-info -->

			<div class="social">
				<ul>
                        <?php if(isset($scrn['twitter_username'])  && $scrn['twitter_username'] != '') { ?><li><a
						target="_blank"
						href="http://twitter.com/<?php echo $scrn['twitter_username'];?>"><img
							src="<?php echo get_template_directory_uri();?>/images/icn-twitter2.png"
							alt="Twitter icon" /></a></li><?php } ?>
                        <?php if(isset($scrn['facebook_url'])  && $scrn['facebook_url'] != '') { ?><li><a
						target="_blank" href="<?php echo $scrn['facebook_url'];?>"><img
							src="<?php echo get_template_directory_uri();?>/images/icn-facebook2.png"
							alt="Facebook icon" /></a></li><?php } ?>
                        <?php if(isset($scrn['gplus_url'])  && $scrn['gplus_url'] != '') { ?><li><a
						target="_blank" href="<?php echo $scrn['gplus_url'];?>"><img
							src="<?php echo get_template_directory_uri();?>/images/icn-gplus.png"
							alt="Google+ icon" /></a></li><?php } ?>
                        <?php if(isset($scrn['linkedin_url'])  && $scrn['linkedin_url'] != '') { ?><li><a
						target="_blank" href="<?php echo $scrn['linkedin_url'];?>"><img
							src="<?php echo get_template_directory_uri();?>/images/icn-linkedin.png"
							alt="LinkedIn icon" /></a></li><?php } ?>
                        <?php if(isset($scrn['forrst_url'])  && $scrn['forrst_url'] != '') { ?><li><a
						target="_blank" href="<?php echo $scrn['forrst_url'];?>"><img
							src="<?php echo get_template_directory_uri();?>/images/icn-forrst.png"
							alt="Forrst icon" /></a></li><?php } ?>
                        <?php if(isset($scrn['skype_url'])  && $scrn['skype_url'] != '') { ?><li><a
						target="_blank" href="<?php echo $scrn['skype_url'];?>"><img
							src="<?php echo get_template_directory_uri();?>/images/icn-skype.png"
							alt="Skype icon" /></a></li><?php } ?>
                        <?php if(isset($scrn['dribbble_url'])  && $scrn['dribbble_url'] != '') { ?><li><a
						target="_blank" href="<?php echo $scrn['dribbble_url'];?>"><img
							src="<?php echo get_template_directory_uri();?>/images/icn-dribbble.png"
							alt="Dribbble icon" /></a></li><?php } ?>
                        <?php if(isset($scrn['pinterest_url'])  && $scrn['pinterest_url'] != '') { ?><li><a
						target="_blank" href="<?php echo $scrn['pinterest_url'];?>"><img
							src="<?php echo get_template_directory_uri();?>/images/icn-pinterest.png"
							alt="Pinterest icon" /></a></li><?php } ?>
                        <?php if(isset($scrn['vimeo_url'])  && $scrn['vimeo_url'] != '') { ?><li><a
						target="_blank" href="<?php echo $scrn['vimeo_url'];?>"><img
							src="<?php echo get_template_directory_uri();?>/images/icn-vimeo.png"
							alt="Vimeo icon" /></a></li><?php } ?>
                    </ul>
			</div>
			<!-- end social -->

		</div>
		<!-- end eight columns -->

		<div class="clear"></div>


	</div>
	<!-- end container -->

</div>
<?php get_footer();?>