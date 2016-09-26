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



jQuery( document ).on( 'ready' , function(){

    // Set icons
    jQuery( '.so-widget' ).each(function(){
        if( jQuery( this ).attr( 'data-id' ) == 'bvg_block' ){
            jQuery( this ).addClass( 'widget_icon_bvg_block' );
        }
        if( jQuery( this ).attr( 'data-id' ) == 'bvg_calendar' ){
            jQuery( this ).addClass( 'widget_icon_bvg_calendar' );
        }
        if( jQuery( this ).attr( 'data-id' ) == 'bvg_team_clt' ){
            jQuery( this ).addClass( 'widget_icon_bvg_team_clt' );
        }
        if( jQuery( this ).attr( 'data-id' ) == 'bvg_nuliga_calendar' ){
            jQuery( this ).addClass( 'widget_icon_bvg_nuliga_calendar' );
        }
        if( jQuery( this ).attr( 'data-id' ) == 'bvg_nuliga_team_calendar' ){
            jQuery( this ).addClass( 'widget_icon_bvg_nuliga_team_calendar' );
        }
        if( jQuery( this ).attr( 'data-id' ) == 'bvg_nuliga_team_table' ){
            jQuery( this ).addClass( 'widget_icon_bvg_nuliga_team_table' );
        }
    });

    // Not eidtable widgets...
    jQuery( '.not_editable' ).each(function(){
        jQuery( this ).find( '.actions' ).remove();
        jQuery( this ).find( '.title' ).removeClass( 'title' ).addClass( 'title_not_editable' );
    });
});