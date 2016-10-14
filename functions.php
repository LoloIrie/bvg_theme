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

}
add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );


// Include JS
function my_theme_enqueue_js() {
    wp_enqueue_script( 'bvg-script', get_stylesheet_directory_uri() . '/bvg.js' );

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