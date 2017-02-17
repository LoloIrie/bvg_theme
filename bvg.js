/*
 Theme Name:   BVG
 Theme URI:    http://lignoplan.com/wordpress_9
 Description:  Vantage Child Theme für den BVG Verein
 Author:       Laurent Dorier
 Author URI:   http://etalkers.org
 Template:     vantage
 Version:      1.0.0
 License:      GNU General Public License v2 or later
 License URI:  http://www.gnu.org/licenses/gpl-2.0.html
 Tags:         light, dark, two-columns, right-sidebar, responsive-layout, accessibility-ready
 Text Domain:  vantage
*/

/*
Doc child theme
https://codex.wordpress.org/Child_Themes#How_to_Create_a_Child_Theme
File called from the bvg_widgets plugin
*/
console.log( 'JS File for BVG ok' );


jQuery( document ).on( 'ready' , function(){
    console.log( 'Los...' );

    // Sidebar Slidedown effect
    jQuery( '.widget-area aside h3' ).on( 'mouseover click' , function(){
        if( jQuery( this ).next().css( 'display' ) === 'none' ){
            jQuery( '.widget-area aside ul' ).slideUp();
            jQuery( this ).next().slideDown();
        }
    });

    // Add link to Blog on the startpage
    jQuery( '.sow-carousel-title h3').on( 'click' , function(){
        document.location = 'http://lignoplan.com/wordpress_9/blog';
    });

    // Resize main container for the background picture if required
    jQuery( document ).ready(function() {
        if( jQuery( '#main' ).width() > 800 && jQuery( '#main' ).height() < 1200 ){
            jQuery( '#main' ).height( 1200 );
        }
    });
});