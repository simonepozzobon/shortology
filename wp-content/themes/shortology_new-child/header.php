<?php global $scrn; ?>
<!DOCTYPE html>
<!--[if lt IE 7 ]><html style="margin-top: 0 !important" class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html style="margin-top: 0 !important" class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html style="margin-top: 0 !important" class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--> <!--<![endif]-->
<html style="margin-top: 0 !important" <?php language_attributes(); ?>> <!--<![endif]--><head>
    <meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
    <title><?php wp_title('-');?></title>
    <meta name="description" content="Storie brevi ideate dallo studio creativo H-57">
	<meta property="og:title" content="<?php wp_title('-');?>" />
    <meta property="og:description" content="Shortology nasce quando grafica e umorismo s’incontrano, si piacciono e si appartano un attimo. Ne fanno parte libri, poster, magliette e molto altro - Shortology was born when graphic design and humor met, clicked and went off in a dark corner. It includes books, posters, t-shirts and much more." />
    <!-- Mobile Specific Metas
      ================================================== -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <!--[if lt IE 9]>
        <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!--[if IE]>
        <link href="<?php echo get_template_directory_uri() . '/css/ie.css';?>" rel='stylesheet' type='text/css'>
    <![endif]-->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
	<script src="<?php bloginfo('url'); ?>/js/responsiveslides.min.js"></script>


    <script type="text/javascript">
    var templateDir = "<?php echo get_template_directory_uri(); ?>";
    </script>
    <script>
  	$(function() {
    $(".rslides").responsiveSlides();
  	});
	</script>
    <script type="text/javascript">
    	$( document ).ready(function() {

			$( "nav ul#menu-top-menu li a" ).each(function( index ) {
			  if($( this ).text() == 'Blog') {
				this.href = this.href.replace('#','');
			  	return;
			  }
			});

		});
    </script>
    <script type="text/javascript">
    	$( document ).ready(function() {

			$( "nav ul#menu-top-menu li a" ).each(function( index ) {
			  if($( this ).text() == 'Slot Machine') {
				this.href = this.href.replace('#','');
			  	return;
			  }
			});

		});
    </script>


    <?php global $scrn;
    if(isset($scrn['integration_header'])) echo $scrn['integration_header'] . PHP_EOL;
    wp_head(); ?>
    <!-- ======================== TYPOGRAPHY ========================== -->
	<style>
    @font-face {
     font-family: TGoblique;
     src: url("<?php bloginfo('url'); ?>/fonts/Trade_Gothic_LT_Oblique.eot") /* EOT file for IE */
    }
    @font-face {
     font-family: TGoblique;
     src: url("<?php bloginfo('url'); ?>/fonts/Trade_Gothic_LT_Oblique.ttf") /* TTF file for CSS3 browsers */
    }

    @font-face {
     font-family: TGtwenty;
     src: url("<?php bloginfo('url'); ?>/fonts/Trade_Gothic_LT_Bold_Condensed_No._20_Oblique.eot") /* EOT file for IE */
    }
    @font-face {
     font-family: TGtwenty;
     src: url("<?php bloginfo('url'); ?>/fonts/Trade_Gothic_LT_Bold_Condensed_No._20_Oblique.ttf") /* TTF file for CSS3 browsers */
    }

    @font-face {
     font-family: TGbold;
     src: url("<?php bloginfo('url'); ?>/fonts/Trade_Gothic_LT_Bold.eot") /* EOT file for IE */
    }
    @font-face {
     font-family: TGbold;
     src: url("<?php bloginfo('url'); ?>/fonts/Trade_Gothic_LT_Bold.ttf") /* TTF file for CSS3 browsers */
    }

    @font-face {
     font-family: TGlight;
     src: url("<?php bloginfo('url'); ?>/fonts/Trade_Gothic_LT_Light.eot") /* EOT file for IE */
    }
    @font-face {
     font-family: TGlight;
     src: url("<?php bloginfo('url'); ?>/fonts/Trade_Gothic_LT_Light.ttf") /* TTF file for CSS3 browsers */
    }
    </style>
    <!-- ======================== TYPOGRAPHY ========================== -->
</head>
<body <?php body_class();?>>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/it_IT/sdk.js#xfbml=1&appId=1517648558459705&version=v2.0";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<!-- Primary Page Layout
    ================================================== -->
<a style="height:0px; width:0px; margin:0; padding:0; font-size:0; line-height:0;" id="intro"><!-- --></a>
    <div class="socialTop">
      <div class="Swrapper">
        <div class="fb">
          <div class="fb-like" data-href="https://www.facebook.com/Shortology/" data-layout="button" data-action="like" data-show-faces="false" data-share="true"></div>
        </div>
        <div class="ig">
          <a href="https://www.instagram.com/shortologyworld/" target="_blank"><img class="twitter-follow-button" src="<?php echo get_template_directory_uri(); ?>-child/helper/instagram.png" alt="instagram profile"></a>
        </div>
      </div>
    </div>
    <ul class="rslides">
  	  <li class="slide1"><!-- --></li>
  	  <li class="slide2"><!-- --></li>
  	  <li class="slide3"><!-- --></li>
  	  <li class="slide4"><!-- --></li>
  	  <li class="slide5"><!-- --></li>
  	  <li class="slide6"><!-- --></li>
	  <!--li class="slide7"></li>
  	  <li class="slide8"></li-->
	</ul>
      <!-- -->
    </div>

    <nav>
	  <?php wp_nav_menu(array(
		'theme_location' => 'top-menu',
		'container' => '',
		'fallback_cb' => 'show_top_menu',
		'menu_id' => 'menu-top-menu',
		'echo' => true,
		'walker' => new description_walker(),
		'depth' => 0)
		);
	  ?>
	</nav>
