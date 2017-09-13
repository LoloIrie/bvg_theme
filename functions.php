<?php
/**
 * BVG functions and definitions
 *
 * @package bvg
 * @since bvg 1.0
 * @license GPL 2.0
 */

// Include CSS
function my_theme_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'customBar-style', get_stylesheet_directory_uri() . '/jquery.mCustomScrollbar.min.css' );
}
add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );


// Include JS
function my_theme_enqueue_js() {
    wp_enqueue_script( 'bvg-script', get_stylesheet_directory_uri() . '/bvg.js' );
    wp_enqueue_script( 'customBar-script', get_stylesheet_directory_uri() . '/jquery.mCustomScrollbar.concat.min.js' );
}
add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_js' );


// Custom HTML Head
function bvg_custom_head(){
    //echo '<meta name="description" content="BVG Goldbach-Laufach Badminton Verein Webseite (Aschaffenburg Sport und Hobby)" />';

    echo '<meta name="description" content="';
    bloginfo('name');
    echo " - ";

    if( is_single() ){
        single_post_title('', true);
    }else{
        bloginfo('description');
    }
    echo '" />';
}
add_action('wp_head', 'bvg_custom_head', 1);


// Custom Footer
function bvg_add_footer(){
    echo '
    <script>
        (function($){
            $(window).on("load",function(){
                $.mCustomScrollbar.defaults.scrollButtons.enable=true;
                //$(".bvg_block").mCustomScrollbar();
                //$(".panel-grid-cell").mCustomScrollbar();
                $(".bvg_home_panel_1").mCustomScrollbar({
                    theme: "3d"
                });
/*
                $("body").mCustomScrollbar({
                    theme: "3d"
                });
*/
            });
        })(jQuery);
    </script>
    ';
    
    //echo '<a class="twitter-timeline" data-width="300" data-height="400" data-theme="dark" href="https://twitter.com/BVG_GL">Tweets by BVG_GL</a> <script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>';
}
add_action('wp_footer', 'bvg_add_footer', 1);

function custom_pagination($numpages = '', $pagerange = '', $paged='') {

  if (empty($pagerange)) {
    $pagerange = 2;
  }

  /**
   * This first part of our function is a fallback
   * for custom pagination inside a regular loop that
   * uses the global $paged and global $wp_query variables.
   * 
   * It's good because we can now override default pagination
   * in our theme, and use this function in default quries
   * and custom queries.
   */
  global $paged;
  if (empty($paged)) {
    $paged = 1;
  }
  if ($numpages == '') {
    global $wp_query;
    $numpages = $wp_query->max_num_pages;
    if(!$numpages) {
        $numpages = 1;
    }
  }

  /** 
   * We construct the pagination arguments to enter into our paginate_links
   * function. 
   */
  $pagination_args = array(
    'base'            => get_pagenum_link(1) . '%_%',
    'format'          => 'page/%#%',
    'total'           => $numpages,
    'current'         => $paged,
    'show_all'        => False,
    'end_size'        => 1,
    'mid_size'        => $pagerange,
    'prev_next'       => True,
    'prev_text'       => __('&laquo;'),
    'next_text'       => __('&raquo;'),
    'type'            => 'plain',
    'add_args'        => false,
    'add_fragment'    => ''
  );

  $paginate_links = paginate_links($pagination_args);

  if ($paginate_links) {
    echo "<nav class='custom-pagination'>";
      echo "<span class='page-numbers page-num'>Page " . $paged . " of " . $numpages . "</span> ";
      echo $paginate_links;
    echo "</nav>";
  }

}

