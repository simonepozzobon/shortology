    <script type="text/javascript">
	$(document).ready( function(){
        $('#toggle-contact').toggle(
			function(){
                $('#contact').slideDown();
            },
            function(){
                $('#contact').slideUp();
            }
        );
		});
   </script>

   <script type="text/javascript">
	$(function(){
 		$('#toggle-contact').click(function(){
  		$('html, body').animate({ scrollTop: $('#testlink').offset().top }, 2000);
   		return false;
 		});
	});
	</script>

     <!-- end contact -->


    <div id="footer">
        <div class="container">
            <div class="sixteen columns">
              <div class="footerLinks">
				<span class="logo"><!-- --></span>
                <ul>
                  <li><a class="contact" href="javascript:void(0)" id="toggle-contact" title="CONTACT US"><!-- --></a></li>
                  <li><a class="company" href="http://www.h-57.com/" title="H-57.com" target="_blank"><!-- --></a></li>
                  <li><a class="ig" href="https://www.instagram.com/shortologyworld/" title="Instagram" target="_blank"><!-- --></a></li>
                  <li><a class="fb" href="https://www.facebook.com/Shortology/" title="FACEBOOK" target="_blank"><!-- --></a></li>
                  <li class="last"><a class="tw" href="https://twitter.com/Shortology_H57" title="TWITTER" target="_blank"><!-- --></a></li>
                </ul>
                <div class="credits cleared"><p>Powered by: <a href="mailto:info@dinodelmancino.com?subject=Contact mail from Shortology.it" title="Send me an email">Dino Del Mancino</a></p></div>
				<hr style="border-color:#FFFFFF;" />
   				</div>
            </div>
        </div>
    </div>
    <span id="testlink" href="#test"><!-- --></span>

<!-- JS
    ================================================== -->
  <!-- GA -->
  <!--script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-12074210-23']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

  </script-->
  <!-- GA -->
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

          jQuery('nav ul#menu-top-menu').mobileMenu({
               defaultText: '<?php _e("Navigate to...", "SCRN");?>',
               className: 'mobile-menu',
               subMenuDash: '&ndash;'
          });

    });

  </script>


<!-- End Document
================================================== -->

<?php global $scrn;
if(isset($scrn['integration_footer'])) echo $scrn['integration_footer'] . PHP_EOL; ?>

 <?php wp_footer(); ?>

</body>
</html>
