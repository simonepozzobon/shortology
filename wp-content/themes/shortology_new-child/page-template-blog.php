<?php
/*
Template name: Blog page template
*/
get_header();
global $scrn;
the_post();
$nrposts = get_post_meta($post->ID, '_blog_nrposts', true);
$fullwidth = get_post_meta($post->ID, '_blog_fullwidth', true);
$categories = get_post_meta($post->ID, '_blog_categories', true);
?>
 <div class="bg dark-bg" style="text-align: left" id="blog">
    <div class="container">
        <div class="sixteen columns">
            <div class="headline">
                    <h2><span class="lines"><?php $top_title = get_post_meta($post->ID, 'top_title', true); if($top_title != '') echo $top_title; else the_title();?></span></h2>
            </div>
        </div>
        <div class="clear"></div>
        <!-- start sixteen columns -->
        <div class="<?php if($fullwidth == 2) echo 'twelve'; else echo 'sixteen';?> columns">
            <?php
            $args['posts_per_page'] = $nrposts;
            if(count($categories) > 0)
                $args['category__in'] = $categories;
            $paged = is_front_page() ? get_query_var( 'page' ) : get_query_var( 'paged' );
            $args['paged'] = $paged;
            query_posts($args);
            $i = 1;
            if(have_posts()) : while(have_posts()) : the_post();
                $thumbnail = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );?>
                <div <?php post_class('post inblog');?>>
                <a href="<?php the_permalink();?>">
                        <p class="post-title"><?php the_title();?></p>
                        <p class="post-info">
                            <?php
                             _e('on', 'SCRN'); echo ' '; the_time("d M, Y");
                            echo ' - '; comments_popup_link(esc_html__('0 comments','SCRN'), esc_html__('1 comment','SCRN'), '% '.esc_html__('comments','SCRN'));
                            ?>
                        </p>
                    </a>
                    <?php if(has_post_thumbnail() ) { ?>
                        <a href="<?php the_permalink();?>">
                            <?php
                            $thumb = aq_resize($thumbnail, 600, 2000, true);
                            if($thumb == '' && $fullwidth != 2) {
                                 //trying to resize it to smaller dimensions
                                $thumb = aq_resize($thumbnail, 600, 2000, true);
                            }
                            if($thumb == '') {
                                //too small image, we keep the original one
                                $thumb = $thumbnail;
                            }
                            ?>
                            <img src="<?php echo $thumb;?>" class="scale-with-grid" alt="<?php the_title();?>" />
                        </a>
                    <?php } ?>

                    <!--p><?php the_excerpt();?></p-->
                    <div class="clear" style="height:10px;" ><!-- --></div>
                    <a href="<?php the_permalink();?>" style="float:left;" class="moreBlog">
                        <div class="button1"><?php _e('Read more', 'SCRN');?></div>
                    </a>
                    <div class="addthisBlog" style="float:right;">
                      <!-- AddThis Button BEGIN -->
                      <div class="addthis_toolbox addthis_default_style addthis_32x32_style">
                        <a class="addthis_button_facebook"></a>
                        <a class="addthis_button_twitter"></a>
                        <a class="addthis_button_google_plusone_share"></a>
                        <a class="addthis_button_pinterest_share"></a>
                        <a class="addthis_button_compact"></a><!--a class="addthis_counter addthis_bubble_style"></a-->
                      </div>
                    <script type="text/javascript">var addthis_config = {"data_track_addressbar":true};</script>
                    <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-534a825a3f93f0dd"></script>
                    <!-- AddThis Button END -->
                    </div>
                    <div class="clear" style="height:20px;" ><!-- --></div>
                </div>

                <!-- end post -->
            <?php endwhile;
            get_template_part('includes/pagination');
            endif; wp_reset_query();?>
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
