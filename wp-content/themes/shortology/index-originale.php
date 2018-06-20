<!DOCTYPE html>
<!--[if lt IE 7 ]><html style="margin-top: 0 !important" class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html style="margin-top: 0 !important" class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html style="margin-top: 0 !important" class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--> <!--<![endif]-->
<html style="margin-top: 0 !important" lang="en-US"> <!--<![endif]-->
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title><?php
    /*
     * Print the <title> tag based on what is being viewed.
     */
    global $page, $paged;

    wp_title( '|', true, 'right' );

    // Add the blog name.
    bloginfo( 'name' );

    // Add the blog description for the home/front page.
    $site_description = get_bloginfo( 'description', 'display' );
    if ( $site_description && ( is_home() || is_front_page() ) )
        echo " | $site_description";

    // Add a page number if necessary:
    if ( $paged >= 2 || $page >= 2 )
        echo ' | ' . sprintf( __( 'Page %s', 'twentyten' ), max( $paged, $page ) );

    ?></title>
   
    <link rel="stylesheet" type="text/css" href="style.css">
    <!-- Mobile Specific Metas
      ================================================== -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <!--[if lt IE 9]>
        <script src="js/html5.js"></script>
    <![endif]-->

<link rel='stylesheet' id='flexslider-css'  href='<?php bloginfo('url'); ?>/css/custom_torrecchia_style.css?ver=1.0' type='text/css' media='all' />
<link rel='stylesheet' id='base-css'  href='<?php bloginfo('url'); ?>/css/base5152.css?ver=1.0' type='text/css' media='all' />
<link rel='stylesheet' id='layout-css'  href='<?php bloginfo('url'); ?>/css/layout5152.css?ver=1.0' type='text/css' media='all' />
<link rel='stylesheet' id='skeleton-css'  href='<?php bloginfo('url'); ?>/css/skeleton5152.css?ver=1.0' type='text/css' media='all' />
<link rel='stylesheet' id='flexslider-css'  href='<?php bloginfo('url'); ?>/css/flexslider5152.css?ver=1.0' type='text/css' media='all' />



<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:400,600,600italic,400italic' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Oswald:400,300,700' rel='stylesheet' type='text/css'>
<script type='text/javascript' src='<?php bloginfo('url'); ?>/js/jquery4511.js?ver=1.8.3'></script>
<script type='text/javascript' src='<?php bloginfo('url'); ?>/js/jquery.cycle.all.min9d52.js?ver=3.5.1'></script>
<script type='text/javascript' src='<?php bloginfo('url'); ?>/js/jquery.flexslider5152.js?ver=1.0'></script>


</head>
<body class="home blog">

<!-- Primary Page Layout
    ================================================== -->

    <div id="home">
    
        <div class="bg1"></div>
        
        <div class="title">
            <div class="intro-line"></div>
                            
              <div class="container">
                         <?php
                    $the_query = new WP_Query('pagename=home');
                    while ($the_query->have_posts()) : $the_query->the_post();
                    ?>
                    <!--<h1><?php the_title(); ?></h1> -->
					<?php the_content(); ?>
                    <?php endwhile; ?>
                       </div>
                        
        </div> <!-- end title -->
    </div> <!-- end intro -->
    
<!-- INIZIO MENU DI NAVIGAZIONE  -->
<nav>
<ul>
<li><a href="http://torrecchia.com/#home">Home</a></li>
<li><a href="http://torrecchia.com/#property">Property</a></li>
<li><a href="http://torrecchia.com/#history">History</a></li>
<li><a href="http://torrecchia.com/#photogallery">Photogallery</a></li>
<li><a href="http://torrecchia.com/#location">Location</a></li>
<li><a href="http://torrecchia.com/#contact">Contact</a></li>
</ul>     
</nav> 
<!-- FINE MENU DI NAVIGAZIONE  -->
   
<!-- INIZIO SEZIONE property  -->
<div class="bg " id="property">
   <div class="container">
                    <?php
                    $the_query = new WP_Query('pagename=property');
                    while ($the_query->have_posts()) : $the_query->the_post();
                    ?>
                    <h2 class="white"><?php the_title(); ?></h2>
                    <?php the_content(); ?>
                    <?php endwhile; ?>
   </div>
</div> <!-- end bg -->
        
<!-- FINE SEZIONE property  -->

<!-- INIZIO SEPARATORE 1  -->
        <div id="separator_1" class="separator1">
            <div class="bg2 bg" style="background-image: url('images/bg2.jpg') "></div>
            <p class="separator">SEPARATORE #1</p>
        </div>
<!-- FINE SEPARATORE 1  -->

<!-- INIZIO SEZIONE PROPERTY  -->
<div class="bg dark-bg" id="history">
            <div class="container">
                 
                        <?php
                    $the_query = new WP_Query('pagename=history');
                    while ($the_query->have_posts()) : $the_query->the_post();
                    ?>
                   <h2 class="white"><?php the_title(); ?></h2>
                    <?php the_content(); ?>
                    <?php endwhile; ?>    
            </div> <!-- end container -->
        </div> <!-- end bg -->
        
 <!-- FINE SEZIONE history  -->
 
   <!-- INIZIO SEPARATORE 2  -->
        <div id="separator_2" class="separator1">
            <div class="bg3 bg" style="background-image: url('images/bg3.jpg') "></div>
            <p class="separator">SEPARATORE #2</p>
        </div>
  <!-- FINE SEPARATORE 2  -->
  
  <!-- INIZIO SEZIONE photogallery  --> 
 <div class="bg " id="photogallery" >
<div class="container">
               
                         <?php
                    $the_query = new WP_Query('pagename=photogallery');
                    while ($the_query->have_posts()) : $the_query->the_post();
                    ?>
                     <h2><?php the_title(); ?></h2>
					 <?php the_content(); ?>
                    <?php endwhile; ?>     
            </div> <!-- end container -->
</div> <!-- end bg -->
  <!-- FINE SEZIONE photogallery  --> 
  
  
 <!-- INIZIO SEPARATORE 3  --> 
 <div id="separator_3" class="separator1">
            <div class="bg4 bg" style="background-image: url('images/bg4.jpg') "></div>
            <p class="separator">SEPARATORE #3</p>
        </div>
 <!-- fine SEPARATORE 3  -->   
 
 <!-- INIZIO SEZIONE ABOUT  --> 
 <div class="bg " id="location" >
<div class="container">
                
                         <?php
                    $the_query = new WP_Query('pagename=location');
                    while ($the_query->have_posts()) : $the_query->the_post();
                    ?>
                     <h2><?php the_title(); ?></h2>
                    <?php the_content(); ?>
                    <?php endwhile; ?>     
            </div> <!-- end container -->
</div> <!-- end bg -->
  <!-- FINE SEZIONE ABOUT  --> 
  
 
 <!-- INIZIO SEZIONE CONTACT -->   
    <div id="contact" class="dark-bg">
<div class="container">
                 
                         <?php
                    $the_query = new WP_Query('pagename=contact');
                    while ($the_query->have_posts()) : $the_query->the_post();
                    ?>
                    <h2 class="white"><?php the_title(); ?></h2>
					<?php the_content(); ?>
                    <?php endwhile; ?>      
            </div> <!-- end container -->
        
    </div> <!-- end contact -->
    
<!-- FINE SEZIONE CONTACT -->  

    
    
            
          
<!-- JS
    ================================================== -->
  
  <!-- fancybox -->
  <script type="text/javascript">
    function scrollTo(target){
          var myArray = target.split('#');
          var targetPosition = jQuery('#' + myArray[1]).offset().top;
          jQuery('html,body').animate({ scrollTop: targetPosition}, 'slow');
        }
    jQuery(document).ready(function() {

        jQuery("nav").sticky({topSpacing:0});

        /* This is basic - uses default settings */
      
        jQuery("a[class^='prettyPhoto']").prettyPhoto({
            social_tools: false,
            theme: 'light_square'
          });
      
        /* Using custom settings */
      
        jQuery('.proj-img').hover(function() {
            jQuery(this).find('i').stop().animate({
              opacity: 0.8
            }, 'fast');
            jQuery(this).find('a').stop().animate({
              "top": "0"
            });
          }, function() {
            jQuery(this).find('i').stop().animate({
              opacity: 0
            }, 'fast');
            jQuery(this).find('a').stop().animate({
              "top": "-600px"
            });
        });

          jQuery('.flexslider').flexslider({
            animation: "slide",
            slideshow: true,
            slideshowSpeed: 3500,
            animationSpeed: 1000
          });

          jQuery('nav ul').mobileMenu({
               defaultText: 'Navigate to...',
               className: 'mobile-menu',
               subMenuDash: '&ndash;'
          });

    });
    
  </script>
    
    
<!-- End Document
================================================== -->



 <script type='text/javascript' src='js/jquery.sticky5152.js?ver=1.0'></script>
<script type='text/javascript' src='js/jquery.smooth-scroll5152.js?ver=1.0'></script>
<script type='text/javascript' src='js/contact-form5152.js?ver=1.0'></script>
<script type='text/javascript' src='js/jquery.easing.1.35152.js?ver=1.0'></script>
<script type='text/javascript' src='js/jquery.prettyPhoto5152.js?ver=1.0'></script>
<script type='text/javascript' src='js/jquery.inview5152.js?ver=1.0'></script>
<script type='text/javascript' src='js/custom5152.js?ver=1.0'></script>
<script type='text/javascript' src='js/jquery.isotope.min5152.js?ver=1.0'></script>
<script type='text/javascript' src='js/jquery.mobilemenu5152.js?ver=1.0'></script>
 


</body>
</html>