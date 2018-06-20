<?php 
/*  attivare le featured images  */
if ( function_exists( 'add_theme_support' ) ) {
  add_theme_support( 'post-thumbnails' );
}


/*funzione per fissare la lunghezza dell'excerpt*/
function new_excerpt_length($length) {
	return 15;
}
add_filter('excerpt_length', 'new_excerpt_length');


/* funzione per definire l'esistenza e lo stile delle sidebar e dei widget */

if ( function_exists('register_sidebar') )
    register_sidebar(array(
		'before_widget' => '<div class="widget">',
		'before_title' => '<h3> ',
		'after_title' => '</h3>',
        'after_widget' => '</div>',
		
	 ));
	

if ( function_exists('register_sidebar') )
    register_sidebar(array(
		'name'=>'dynamic_header',
		'before_widget' => '',
		'before_title' => '',
		'after_title' => '',
        'after_widget' => '',
		
	 ));
	
	
	if ( function_exists('register_sidebar') )
    register_sidebar(array(
		'name'=>'dynamic_footer',
		'before_widget' => '<div class="widgetbox">',
		'before_title' => '<h3> ',
		'after_title' => '</h3>',
        'after_widget' => '</div>',
		
	 ));


if ( function_exists('register_sidebar') )
    register_sidebar(array(
	    'name'=>'dynamic_sidebar_blog',
		'before_widget' => '<div class="widget">',
		'before_title' => '<h3> ',
		'after_title' => '</h3>',
        'after_widget' => '</div>',
		
	 ));
	
if ( function_exists('register_sidebar') )
    register_sidebar(array(
	    'name'=>'dynamic_search',
	 ));
	
	
/* funzione per personalizzare il "read more" nell'excerpt e renderlo cliccabile*/
function new_excerpt_more($more) {
	return '<a href="'. get_permalink($post->ID) . '">' . '...' . '</a>';
}
add_filter('excerpt_more', 'new_excerpt_more');


/* funzione per abilitare gli excerpt delle pagine */
add_post_type_support( 'page', 'excerpt' );

/*  attivare le featured images  */
if ( function_exists( 'add_theme_support' ) ) {
  add_theme_support( 'post-thumbnails' );
}


/* ****************** funzione per paginazione *************************** */

/** 
* A pagination function 
* @param integer $range: The range of the slider, works best with even numbers 
* Used WP functions: 
* get_pagenum_link($i) - creates the link, e.g. http://site.com/page/4 
* previous_posts_link(' &#171; '); - returns the Previous page link 
* next_posts_link(' &#187; '); - returns the Next page link 
*/  
function get_pagination($range = 8){  
  // $paged - number of the current page  
  global $paged, $wp_query;  
  // How much pages do we have?  
  if ( !$max_page ) {  
    $max_page = $wp_query->max_num_pages;  
  }  
  // We need the pagination only if there are more than 1 page  
  if($max_page > 1){  
    if(!$paged){  
      $paged = 1;  
    }  
    // On the first page, don't put the First page link  
    if($paged != 1){  
      echo '<a href="' . get_pagenum_link(1) . '"> First </a>';  
    }  
    // To the previous page  
    previous_posts_link(' &#171; ');  
    // We need the sliding effect only if there are more pages than is the sliding range  
    if($max_page > $range){  
      // When closer to the beginning  
      if($paged < $range){  
        for($i = 1; $i <= ($range + 1); $i++){  
          echo '<a href="' . get_pagenum_link($i) .' "';  
          if($i==$paged) echo 'class="current"';  
          echo ">$i</a>";  
        }  
      }  
      // When closer to the end  
      elseif($paged >= ($max_page - ceil(($range/2)))){  
        for($i = $max_page - $range; $i <= $max_page; $i++){  
          echo '<a href="' . get_pagenum_link($i) .' "';  
          if($i==$paged) echo 'class="current"';  
          echo ">$i</a>";  
        }  
      }  
      // Somewhere in the middle  
      elseif($paged >= $range && $paged < ($max_page - ceil(($range/2)))){  
        for($i = ($paged - ceil($range/2)); $i <= ($paged + ceil(($range/2))); $i++){  
          echo '<a href="' . get_pagenum_link($i) .' "';  
          if($i==$paged) echo 'class="current"';  
          echo ">$i</a>";  
        }  
      }  
    }  
    // Less pages than the range, no sliding effect needed  
    else{  
      for($i = 1; $i <= $max_page; $i++){  
        echo '<a href="' . get_pagenum_link($i) .' "';  
        if($i==$paged) echo 'class="current"';  
        echo ">$i</a>";  
      }  
    }  
    // Next page  
    next_posts_link(' &#187; ');  
    // On the last page, don't put the Last page link  
    if($paged != $max_page){  
      echo '<a href="' . get_pagenum_link($max_page) . '"> Last </a>';  
    }  
  }  
}

?>