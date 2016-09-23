<?php
/**
 * BVG functions and definitions
 *
 * @package bvg
 * @since bvg 1.0
 * @license GPL 2.0
 */

// Include Vantage
add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );
function my_theme_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );

}