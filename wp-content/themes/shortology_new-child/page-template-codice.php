<?php
/* 
Template name: Codice page template
*/

$path = $_SERVER ['DOCUMENT_ROOT'];

include_once $path . '/wp-content/themes/shortology_new-child/cortology/cortology-functions.php';

global $scrn;


get_header();

$cortologyFunctions = new CortologyFunctions();

?>
 <div class="bg dark-bg cortBkg" style="text-align: left" id="blog">
    <div class="container">
        <div class="clear"></div>
        <!-- start sixteen columns -->
        <div class="<?php if($fullwidth == 2) echo 'twelve'; else echo 'sixteen';?> columns">
        
        
        
        <?php 
        	$errorMessage = null;
        	if(isset($_POST["codice"])) {
				$testValidCode = $cortologyFunctions->objDecodeStorymachineCode($_POST["codice"]);
				if($testValidCode["valid-code"] == true) {
		?>
        			<form id="formCreateStory" action="/story-machine" method="post" >
						<input type="hidden" name="codice" value="<?php echo $_POST["codice"]; ?>" />
					</form>
					<script type="text/javascript">
						$("#formCreateStory").submit();
					</script>
        <?php
        		} else{
        			$errorMessage = "Codice non valido";		
        		} 
        	}
        ?>
		
		<div class="codIntro">
            <p style="font-family:Helvetica, Arial, sans-serif!important;" class="noFont">Inserisci il codice della tua storia e comincia a scrivere la tua sceneggiatura</p>
            <div class="cleared" style="display:block; width:500px;">
              <p style="font-family:Helvetica, Arial, sans-serif!important;" class="label noFont">[&nbsp;&nbsp;<span>codice storia</span>&nbsp; &nbsp;]</p>
              <form id="formCodiceStoria" action="" method="post">
              	<input name="codice" class="copyCodice cleared" value="<?php if(isset($_POST["codice"])) echo $_POST["codice"];?>" />
              </form>
              <div id="errorMessage" style="color: red; font-family:Helvetica, Arial, sans-serif!important;"><?php echo $errorMessage; ?></div>
            </div>
          	<a style="font-family:Helvetica, Arial, sans-serif!important;" id="codBtn" class="codBtn2" href="#" title="Avanti" onclick="$('#formCodiceStoria').submit();">Avanti</a>
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