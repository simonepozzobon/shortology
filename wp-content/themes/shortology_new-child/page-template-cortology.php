<?php
/* 
Template name: Cortology page template
*/
global $scrn;

$scrn['integration_header'] =
'<link rel="stylesheet" href="/wp-content/themes/shortology_new-child/magnific-popup.css" type="text/css" media="screen" />
 <link rel="stylesheet" href="/wp-content/themes/shortology_new-child/magnific-popup-custom.css" type="text/css" media="screen" />
 <script type="text/javascript" src="/wp-content/themes/shortology_new-child/js/jquery.magnific-popup.js"></script>
 <script type="text/javascript" src="/wp-content/themes/shortology_new-child/js/cortology.js"></script>
<meta property="og:type" content="website" />
 <meta property="og:image" content="http://www.shortology.it/wp-content/themes/shortology_new-child/images/cortologymain_ogimage.png" />
 ';

get_header();
?>
	<style>
		.listaIntro{
			float: left;	
			margin-left: 10px;
			width: 100%;
		}
	</style>
 <div class="bg dark-bg cortBkg" style="text-align: left" id="blog">
    <div class="container">
        <div class="sixteen columns">
            <div class="headline">
				<img class="cortTit" src="/wp-content/themes/shortology_new-child/images/cortologyHeadline.png" alt="CORTOLOGY by SHORTOLOGY" title="CORTOLOGY by SHORTOLOGY"/>
				<h4 class="titImgC" style="text-align:center;"><strong><?php $top_title = get_post_meta($post->ID, 'top_title', true); if($top_title != '') echo $top_title; else the_title();?></strong></h4>
            </div>
        </div>
        <div class="clear"></div>
        <!-- start sixteen columns -->
        <div class="<?php if($fullwidth == 2) echo 'twelve'; else echo 'sixteen';?> columns">
        <div class="cortIntro">
        <p class="noFont" style="font-family:Helvetica, Arial, sans-serif!important;"><strong style="text-transform:uppercase; font-size:15px; color:#000000;">C’è uno sceneggiatore di cinema nascosto dentro di te?<br />Fallo uscire di lì!</strong><br /><br />
		<span class="listaIntro"><span style="float: left;">1) </span><span style="float: left;margin-left: 5px;width: 95%;">Schiaccia il tasto Gioca!</span></span><br />
		<span class="listaIntro"><span style="float: left;">2) </span><span style="float: left;margin-left: 5px;width: 95%;">Tira la leva della Story Machine finch&eacute; non esce una sequenza di icone che ti ispira</span></span><br />
		<span class="listaIntro"><span style="float: left;">3) </span><span style="float: left;margin-left: 5px;width: 95%;">Scrivi la sceneggiatura del tuo cortometraggio</span></span><br /><br />
		<span style="margin-top: 10px;float: left;">Unica regola: la trama deve comprendere i 4 oggetti o personaggi rappresentati dalle icone, nell&rsquo;ordine in cui appaiono nella Story Machine. E ora, vai e scrivi!</span></p>

		<!-- 
        Cortology è la tua grande occasione per scrivere un film. Anzi, un cortometraggio, per la precisione. Che poi, se vogliamo davvero essere precisi, sarà un micro-corto della durata massima di 3 minuti. Le regole sono semplici. Vai sulla pagina della nostra STORY MACHINE e tira la leva finché non esce una combinazione di icone che ti attira. Quando l’hai trovata, scrivi il soggetto di un corto la cui trama preveda, nell’ordine esatto in cui appaiono, le 4 icone della tua combinazione. Hai a disposizione al massimo 1.000 caratteri spazi compresi. Poi, mandaci la tua opera entro il 30 novembre. Tra tutti i partecipanti, sceglieremo a nostro insindacabile giudizio le migliori trame e le faremo girare a una casa di produzione cinematografica, con tanto di veri e affermati registi in carne e ossa e una troupe al completo.<br /><br />E ora, comincia a giocare, ma soprattutto a scrivere.<br /><br /> 
<a style="font-family:Helvetica, Arial, sans-serif!important;" href="#popup-more-info" id="openMoreInfoModal">Qui</a> trovi qualche consiglio in pi&ugrave;.</p> -->



	<div id="popup-more-info" class="popup-more-info mfp-hide">
		<p class="noFont" style="font-family:Helvetica, Arial, sans-serif!important; font-weight:normal!important;">
			Cortology &egrave; la tua grande occasione per scrivere un film. Anzi, un cortometraggio, per la precisione. Che poi, se vogliamo davvero essere precisi, sar&agrave; un micro-corto della durata massima di 3 minuti. Hai a disposizione al massimo 1.000 caratteri spazi compresi. Tra tutti i partecipanti, sceglieremo a nostro insindacabile giudizio le migliori trame e le faremo girare a una casa di produzione cinematografica, con tanto di veri e affermati registi in carne e ossa e una troupe al completo.
			<br><br/>
			Non c&rsquo;&egrave; un genere prestabilito, n&eacute; argomenti vietati. Evita, &egrave; ovvio, la volgarit&agrave; gratuita e il cattivo gusto, ma qui devi fare da solo con quello che ti dice il tuo buon senso, non possiamo aiutarti.
			<br><br/>
			Vuoi scrivere una storia completamente pazza? Ottimo. Un horror? Fico. Un corto romantico? Ok. Un drammone? Ganzo. Fantascienza? Cool. Magari una cosa tipo Scorsese, Hitchcock, Spielberg, Bu&ntilde;uel, Fellini, Cameron, Moretti, Allen, Vanzina, Nolan, Anderson, Chaplin, Lynch, Monty Python? Vanno tutti bene, per carit&agrave;. Ma meglio ancora se scrivi una cosa tipo te. Ispirati, ma non copiare. Ma che te lo diciamo a fare?
			<br><br/>
			Sii sintetico, chiaro, semplice. Non dare nulla per scontato, tutto quello che serve deve stare nei 1.000 caratteri. Sono pochi, lo sappiamo. Ma una grande storia sta anche in poco spazio, anzi, pi&ugrave; &egrave; potente e meno ci vuole per raccontarne l&rsquo;essenza.
			<br><br/>
			Non preoccuparti della realizzazione, dei costi e dei modi. O meglio, non preoccupartene troppo. Sar&agrave; la produzione con il regista a decidere come rendere al meglio quello che hai scritto. &Egrave; ovvio che se prevedi di girare sulla Luna, o di ricoprire il Pentagono di cioccolata bisogner&agrave; inventarsi qualcosa di molto fantasioso. In ogni caso, non precluderti nessuna idea perch&eacute; &egrave; difficile da realizzare, ma tieni conto che il budget di produzione non sar&agrave; quello di Avatar e che il corto finale potr&agrave; durare al massimo 3 minuti. Pi&ugrave; sei semplice e punti alla storia, pi&ugrave; sar&agrave; facile girare il tuo film. E comunque, una grande storia si pu&ograve; svolgere anche tutta in una stanza.
			<br><br/>
			&Egrave; tutto. Buona scrittura!
		</p>
	</div>




<!--
		<div id="popup-more-info" class="popup-more-info mfp-hide">
		<p class="noFont" style="font-family:Helvetica, Arial, sans-serif!important; font-weight:normal!important;">
        Non c’è un genere prestabilito, né argomenti vietati. Evita, è ovvio, la volgarità gratuita e il cattivo gusto, ma qui devi fare da solo con quello che ti dice il tuo buon senso, non possiamo aiutarti. 
<br /><br />
Vuoi scrivere una storia completamente pazza? Ottimo. Un horror? Fico. Un corto romantico? Ok. Un drammone? Ganzo. Fantascienza? Cool.
Magari una cosa tipo Scorsese, Hitchcock, Spielberg, Buñuel, Fellini, Cameron, Moretti, Allen, Vanzina, Nolan, Anderson, Chaplin, Lynch, Monty Python? Vanno tutti bene, per carità. Ma meglio ancora se scrivi una cosa tipo te. Ispirati, ma non copiare. Ma che te lo diciamo a fare?
<br /><br />
Sii sintetico, chiaro, semplice. Non dare nulla per scontato, tutto quello che serve deve stare nei 1.000 caratteri. Sono pochi, lo sappiamo. Ma una grande storia sta anche in poco spazio, anzi, più è potente e meno ci vuole per raccontarne l’essenza.
<br /><br />
Non preoccuparti della realizzazione, dei costi e dei modi. O meglio, non preoccupartene troppo. Sarà la produzione con il regista a decidere come rendere al meglio quello che hai scritto. È ovvio che se prevedi di girare sulla Luna, o di ricoprire il Pentagono di cioccolata bisognerà inventarsi qualcosa di molto fantasioso. In ogni caso, non precluderti nessuna idea perché è difficile da realizzare, ma tieni conto che il budget di produzione non sarà quello di Avatar e che il corto finale potrà durare al massimo 3 minuti. Più sei semplice e punti alla storia, più sarà facile girare il tuo film.<br />E comunque, una grande storia si può svolgere anche tutta in una stanza.
<br /><br />
È tutto. Buona scrittura!

        </p>
		</div>
		-->
		<span style="min-height:50px; width:100%; display:block;float: left;margin-top: 20px;">
		  <a style="font-family:Helvetica, Arial, sans-serif!important;" class="cortBtn" href="/codice/" title="Ho già il codice">Ho già il codice</a>
          <a style="font-family:Helvetica, Arial, sans-serif!important;" class="cortBtn last" href="/story-machine/" title="Gioca!">Gioca!</a>
        </span>
        </div>

        </div> <!-- end sixteen columns -->

        <!-- start sidebar -->
        <div class="four columns">
            <div class="sidebar">
                <?php 
                if($fullwidth == 2) 
                    dynamic_sidebar("Right sidebar");
                ?>
            </div>
        </div>
        <!-- end sidebar -->

    </div>
</div>
<div id="contact">
        <div class="container">
        
            <div class="sixteen columns">
                <h2 class="white"><span class="lines"><?php _e('Contact', 'SCRN');?></span></h2>
            </div> <!-- end sixteen columns -->

            <?php if(isset($scrn['contact_description']) && $scrn['contact_description'] != '') { ?>
                <div class="sixteen columns">
                    <p class="desk"><?php echo esc_attr($scrn['contact_description']);?></p>
                </div> <!-- end sixteen columns -->
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

                            <input type="submit" id="submit" value="<?php _e('send', 'SCRN');?>" class="submit-button" />
                        </form>
                    <?php } ?>
                        
                </div> <!-- end contact-form -->
            </div> <!-- end eight columns -->
            
            <div class="eight columns">
                
                <div class="contact-info">
                    
                    <h5><?php _e('Contact Info', 'SCRN');?></h5>
                
                    <?php if(isset($scrn['phone']) && $scrn['phone'] != '') { ?><p class="white"><img src="<?php echo get_template_directory_uri();?>/images/icn-phone.png" alt="" /> <?php echo $scrn['phone'];?></p><?php } ?>
                    <?php if(isset($scrn['email']) && $scrn['email'] != '') { ?><p class="white"><img src="<?php echo get_template_directory_uri();?>/images/icn-email.png" alt="" /> <a href="mailto:<?php echo $scrn['email'];?>"><?php echo encEmail($scrn['email']);?></a></p><?php } ?>
                    <?php if(isset($scrn['location']) && $scrn['location'] != '') { ?><p class="white"><img src="<?php echo get_template_directory_uri();?>/images/icn-address.png" alt="" /> <?php echo $scrn['location'];?></p><?php } ?>
                </div> <!-- end contact-info -->
                
                <div class="social">
                    <ul>
                        <?php if(isset($scrn['twitter_username'])  && $scrn['twitter_username'] != '') { ?><li><a target="_blank" href="http://twitter.com/<?php echo $scrn['twitter_username'];?>"><img src="<?php echo get_template_directory_uri();?>/images/icn-twitter2.png" alt="Twitter icon" /></a></li><?php } ?>
                        <?php if(isset($scrn['facebook_url'])  && $scrn['facebook_url'] != '') { ?><li><a target="_blank" href="<?php echo $scrn['facebook_url'];?>"><img src="<?php echo get_template_directory_uri();?>/images/icn-facebook2.png" alt="Facebook icon" /></a></li><?php } ?>
                        <?php if(isset($scrn['gplus_url'])  && $scrn['gplus_url'] != '') { ?><li><a target="_blank" href="<?php echo $scrn['gplus_url'];?>"><img src="<?php echo get_template_directory_uri();?>/images/icn-gplus.png" alt="Google+ icon" /></a></li><?php } ?>
                        <?php if(isset($scrn['linkedin_url'])  && $scrn['linkedin_url'] != '') { ?><li><a target="_blank" href="<?php echo $scrn['linkedin_url'];?>"><img src="<?php echo get_template_directory_uri();?>/images/icn-linkedin.png" alt="LinkedIn icon" /></a></li><?php } ?>
                        <?php if(isset($scrn['forrst_url'])  && $scrn['forrst_url'] != '') { ?><li><a target="_blank" href="<?php echo $scrn['forrst_url'];?>"><img src="<?php echo get_template_directory_uri();?>/images/icn-forrst.png" alt="Forrst icon" /></a></li><?php } ?>
                        <?php if(isset($scrn['skype_url'])  && $scrn['skype_url'] != '') { ?><li><a target="_blank" href="<?php echo $scrn['skype_url'];?>"><img src="<?php echo get_template_directory_uri();?>/images/icn-skype.png" alt="Skype icon" /></a></li><?php } ?>
                        <?php if(isset($scrn['dribbble_url'])  && $scrn['dribbble_url'] != '') { ?><li><a target="_blank" href="<?php echo $scrn['dribbble_url'];?>"><img src="<?php echo get_template_directory_uri();?>/images/icn-dribbble.png" alt="Dribbble icon" /></a></li><?php } ?>
                        <?php if(isset($scrn['pinterest_url'])  && $scrn['pinterest_url'] != '') { ?><li><a target="_blank" href="<?php echo $scrn['pinterest_url'];?>"><img src="<?php echo get_template_directory_uri();?>/images/icn-pinterest.png" alt="Pinterest icon" /></a></li><?php } ?>
                        <?php if(isset($scrn['vimeo_url'])  && $scrn['vimeo_url'] != '') { ?><li><a target="_blank" href="<?php echo $scrn['vimeo_url'];?>"><img src="<?php echo get_template_directory_uri();?>/images/icn-vimeo.png" alt="Vimeo icon" /></a></li><?php } ?>
                    </ul>
                </div> <!-- end social -->
                
            </div> <!-- end eight columns -->
            
            <div class="clear"></div>
            
            
        </div> <!-- end container -->
        
    </div>
<?php get_footer();?>