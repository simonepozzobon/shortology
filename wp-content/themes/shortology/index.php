<!DOCTYPE html>
<!--[if lt IE 7 ]><html style="margin-top: 0 !important" class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html style="margin-top: 0 !important" class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html style="margin-top: 0 !important" class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--> <!--<![endif]-->
<html style="margin-top: 0 !important" <?php language_attributes(); ?>><!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
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

<!-- ======================== TYPOGRAPHY ========================== -->
<style type="text/css">
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

<!--[end TYPO]-->
<link rel='stylesheet' id='base-css'  href='<?php bloginfo('url'); ?>/css/base5152.css?ver=1.0' type='text/css' media='all' />
<link rel='stylesheet' id='layout-css'  href='<?php bloginfo('url'); ?>/css/layout5152.css?ver=1.0' type='text/css' media='all' />
<link rel='stylesheet' id='skeleton-css'  href='<?php bloginfo('url'); ?>/css/skeleton5152.css?ver=1.0' type='text/css' media='all' />
<link rel='stylesheet' id='flexslider-css'  href='<?php bloginfo('url'); ?>/css/custom_shortology_style.css?ver=1.0' type='text/css' media='all' />


<link href='http://fonts.googleapis.com/css?family=Oswald:300,400' rel='stylesheet' type='text/css'>

<script type='text/javascript' src='<?php bloginfo('url'); ?>/js/jquery4511.js?ver=1.8.3'></script>
<script type='text/javascript' src='<?php bloginfo('url'); ?>/js/jquery.cycle.all.min9d52.js?ver=3.5.1'></script>

<?php
    /* Always have wp_head() just before the closing </head>
     * tag of your theme, or you will break many plugins, which
     * generally use this hook to add elements to <head> such
     * as styles, scripts, and meta tags.
     */
    wp_head();
?>
<script type="text/javascript">
function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}
function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}
</script>
<!-- INIZIO GOOGLE ANALYTICS -->
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-12074210-23']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
<!-- FINE GOOGLE ANALYTICS -->
</head>
<body class="home blog" onLoad="MM_preloadImages('images/amazon-hover.png')">
<!-- Primary Page Layout
    ================================================== -->

<!-- INIZIO INTRO  -->

    <div id="intro">
    
        <div class="bg1"></div>
        
        <div class="container" style="width:98%; padding:0px !important;">
                                        
            
                         <?php
                    $the_query = new WP_Query('pagename=intro');
                    while ($the_query->have_posts()) : $the_query->the_post();
                    ?>
                   
					<?php the_content(); ?>
                    <?php endwhile; ?>
                     
                        
        </div> <!-- end title -->
    </div> <!-- end intro -->
<!-- FINE INTRO -->
    
<!-- INIZIO MENU DI NAVIGAZIONE  -->
<nav>
<ul>
<li><a href="http://www.shortology.it/#intro">Home</a></li>
<li><a href="http://www.shortology.it/#bg1">The Book</a></li>
<li><a href="http://www.shortology.it/#bg2">Licensing</a></li>
<li><a href="http://www.shortology.it/#bg3">Elements</a></li>
<li><a href="http://www.shortology.it/#bg4">Media</a></li>
<li><a href="http://www.shortology.it/#bg5">Store</a></li>
<li><a href="http://www.shortology.it/#bg6">Awards</a></li>
</ul>     
</nav> 
<!-- FINE MENU DI NAVIGAZIONE  -->
   
<!-- INIZIO SEZIONE HOME  -->
<div class="bg " id="home">
   <div class="container">
                    <?php
                    $the_query = new WP_Query('pagename=home');
                    while ($the_query->have_posts()) : $the_query->the_post();
                    ?>
                   
                    <?php the_content(); ?>
                    <?php endwhile; ?>
   </div>
</div>
<!-- FINE SEZIONE HOME  -->
        


<!-- INIZIO SEPARATORE #1  -->
<div class="separator" id="bg1"> </div>
<!-- FINE SEPARATORE #1  -->
     


<!-- INIZIO SEZIONE BOOK -->   
 <div class="bg " id="book" >
<div class="container">
 <?php
                    $the_query = new WP_Query('pagename=book');
                    while ($the_query->have_posts()) : $the_query->the_post();
                    ?>
                    
                    <?php the_content(); ?>
                    <?php endwhile; ?>     
            </div> <!-- end container -->
</div>
 <!-- FINE SEZIONE BOOK -->   
    

 
   <!-- INIZIO SEPARATORE #2  -->
        <div class="separator" id="bg2" > </div>
  <!-- FINE SEPARATORE #2  -->
  
  
  <!-- INIZIO SEZIONE LICENSING  --> 
 <div class="bg " id="licensing" >
<div class="container">
               <?php
                    $the_query = new WP_Query('pagename=licensing');
                    while ($the_query->have_posts()) : $the_query->the_post();
                    ?>
                    
					 <?php the_content(); ?>
                    <?php endwhile; ?>     
            </div> <!-- end container -->
</div> 
  <!-- FINE SEZIONE LICENSING   --> 
  
  
   <!-- INIZIO SEPARATORE #3  -->
        <div class="separator" id="bg3" >  </div>
<!-- FINE SEPARATORE #3  -->   
 
 <!-- INIZIO SEZIONE ELEMENTS  --> 
 <div class="bg " id="elements" >

                
                         <?php
                    $the_query = new WP_Query('pagename=elements');
                    while ($the_query->have_posts()) : $the_query->the_post();
                    ?>
                   
                    <?php the_content(); ?>
                    <?php endwhile; ?>     
            
</div>
  <!-- FINE SEZIONE ELEMENTS  --> 
  
    <!-- INIZIO SEPARATORE #4  -->
        <div class="separator" id="bg4" > </div>
 <!-- FINE SEPARATORE #4  -->   
 
 <!-- INIZIO SEZIONE MEDIA  --> 
 <div class="bg " id="media" >
<div class="container">
                
                         <?php
                    $the_query = new WP_Query('pagename=media');
                    while ($the_query->have_posts()) : $the_query->the_post();
                    ?>
                    
                    <?php the_content(); ?>
                    <?php endwhile; ?>     
            </div> <!-- end container -->
</div>
  <!-- FINE SEZIONE MEDIA  --> 
   
   
   <!-- INIZIO SEPARATORE #5  -->
        <div class="separator" id="bg5" > </div>
<!-- FINE SEPARATORE 5  -->
   
  
 <!-- INIZIO SEZIONE STORE -->   
 <div class="bg " id="store" >
<div class="container">
                
                         <?php
                    $the_query = new WP_Query('pagename=store');
                    while ($the_query->have_posts()) : $the_query->the_post();
                    ?>
                    
                    <?php the_content(); ?>
                    <?php endwhile; ?>     
            </div> <!-- end container -->
        
    </div>
<!-- FINE SEZIONE STORE -->  


<!-- INIZIO SEPARATORE #6  -->
        <div class="separator" id="bg6" > </div>
<!-- FINE SEPARATORE 6  -->
   
  
 <!-- INIZIO SEZIONE AWARDS -->   
 <div class="bg" id="awards" >
<div class="container">
                
                         <?php
                    $the_query = new WP_Query('pagename=awards');
                    while ($the_query->have_posts()) : $the_query->the_post();
                    ?>
                    
                    <?php the_content(); ?>
                    <?php endwhile; ?>     
            </div> <!-- end container -->
        
    </div>
<!-- FINE SEZIONE STORE -->  

<div id="footer">
<div class="container" style="padding-top:20px;"><img src="<?php bloginfo('url'); ?>/images/bkg_footer.png" width="700" height="85" usemap="#MapFooter">
  <map name="MapFooter">
    <area shape="rect" coords="495,15,564,43" href="http://www.h-57.com/" target="_blank" alt="H-57">
    <area shape="rect" coords="410,14,482,44" href="mailto:info@h-57.com" target="_blank" alt="Contact">
<area shape="rect" coords="573,15,603,43" href="http://pinterest.com/hangar57/" target="_blank" alt="Pinterest">
    <area shape="rect" coords="617,14,646,44" href="https://www.facebook.com/ShortologyH57" target="_blank" alt="Facebook">
    <area shape="rect" coords="656,12,687,45" href="https://twitter.com/Shortology_H57" target="_blank" alt="Twitter">
  </map>

  <!-- INIZIO MENU DI NAVIGAZIONE  -->
<nav>
<ul>
<li><a href="http://www.shortology.it/#intro">Home</a></li>
<li><a href="http://www.shortology.it/#bg1">The Book</a></li>
<li><a href="http://www.shortology.it/#bg2">Licensing</a></li>
<li><a href="http://www.shortology.it/#bg3">Elements</a></li>
<li><a href="http://www.shortology.it/#bg4">Media</a></li>
<li><a href="http://www.shortology.it/#bg5">Store</a></li>
<li><a href="http://www.shortology.it/#bg6">Awards</a></li>
</ul>     
</nav> 
<!-- FINE MENU DI NAVIGAZIONE  -->

</div>
</div>
 <!-- ========================== JAVASCRIPT ======================== -->
  
  <!-- fancybox -->
  <script type="text/javascript">
    function scrollTo(target){
          var myArray = target.split('#');
          var targetPosition = jQuery('#' + myArray[1]).offset().top;
          jQuery('html,body').animate({ scrollTop: targetPosition}, 'slow');
        }
    jQuery(document).ready(function() {

        jQuery("nav").sticky({topSpacing:0});


      
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
<script type='text/javascript' src='js/jquery.easing.1.35152.js?ver=1.0'></script>
<script type='text/javascript' src='js/jquery.inview5152.js?ver=1.0'></script>
<script type='text/javascript' src='js/custom5152.js?ver=1.0'></script>
<script type='text/javascript' src='js/jquery.isotope.min5152.js?ver=1.0'></script>
<script type='text/javascript' src='js/jquery.mobilemenu5152.js?ver=1.0'></script>
 

<?php
    /* Always have wp_footer() just before the closing </body>
     * tag of your theme, or you will break many plugins, which
     * generally use this hook to reference JavaScript files.
     */

    wp_footer();
?>
<script type="text/javascript">
          $("a.video").click(function () {
             $.fancybox({
                'padding': 0,
                 'autoScale': false,
                 'transitionIn': 'none',
                 'transitionOut': 'none',
                 'title': this.title,
                 'width': 680,
                 'height': 495,
                'href': this.href.replace(new RegExp("watch\\?v=", "i"), 'v/'),
                'type': 'swf',
                 'swf': { 'allowfullscreen': 'true'}
            });
             return false;

         });
</script>

<!-- Start of StatCounter Code for Default Guide -->
<script type="text/javascript">
var sc_project=9054030; 
var sc_invisible=1; 
var sc_security="ec80f4a4"; 
var scJsHost = (("https:" == document.location.protocol) ?
"https://secure." : "http://www.");
document.write("<sc"+"ript type='text/javascript' src='" +
scJsHost+
"statcounter.com/counter/counter.js'></"+"script>");
</script>
<noscript><div class="statcounter"><a title="web analytics"
href="http://statcounter.com/" target="_blank"><img
class="statcounter"
src="http://c.statcounter.com/9054030/0/ec80f4a4/1/"
alt="web analytics"></a></div></noscript>
<!-- End of StatCounter Code for Default Guide -->
</body>
</html>