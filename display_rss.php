<?php
/**
 * Template Name: RSS Seite
 *
 * @package bvg
 * @since bvg 1.0
 * @license GPL 2.0
 */

// HEADER
get_header();
?>

<div id="primary" class="content-area fullwidth">
	<div id="content" class="site-content" role="main">

		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'content', 'page' ); ?>

			<?php if ( comments_open() || '0' != get_comments_number() ) : ?>
				<?php comments_template( '', true ); ?>
			<?php endif; ?>

		<?php endwhile; // end of the loop. ?>

	</div><!-- #content .site-content -->
</div><!-- #primary .content-area -->

<?php
// SIDEBAR
// get_sidebar();
?>

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script>

	jQuery( document ).on( 'ready', function() {
		/* Add target for links */
		jQuery( '.widget_rss a' ).attr( 'target' , '_blank' );

		/* Preview news */
		jQuery( '.widget_rss ul a' ).each( function(){

			tooltip = '';
			contentRss = jQuery( this ).parent().find( '.rssSummary' ).html();
			if( contentRss != '' ){
                //console.log( contentRss );
				dateRss = jQuery( this ).parent().find( '.rss-date' ).html();
				authorRss = jQuery( this ).parent().find( 'cite' ).text();

				tooltip += jQuery( this ).text() + '\n<br /><br />\n';
				tooltip += '<div class="tooltip_content">' + contentRss + '</div>\n<br /><br />\n';
				if( authorRss != '' ){
					tooltip += authorRss + '\n<br /><br />\n';
				}
				if( dateRss != '' ) {
					tooltip += dateRss + '\n\n';
				}
			}

			jQuery( this ).attr( 'title', tooltip );
			//console.log( jQuery( this ).attr( 'title' ) );
		});

		jQuery( function() {
			jQuery( '.widget_rss a' ).tooltip({
				track: true,
				content: function(){
					if( jQuery( this ).attr( "title" ) === '' ){
						jQuery( this ).removeAttr( "title" );
						return false;
					}
					html = jQuery( this ).attr( "title" ).replace( '&lt;' , '<' );
					html = jQuery( this ).attr( "title" ).replace( '&rt;' , '>' );
					return html;
				}
			});
		} );

		jQuery( '.widget_bvg-block' ).each( function(){
			if( jQuery( this ).find( '.bvg_iframe_facebook' ) ){
				jQuery( this ).css( 'width' , 500 );
				jQuery( this ).css( 'margin' , 'auto' );
			}
		});

	});



	/*
	jQuery( '.widget_rss ul a' ).on( 'mouseover', function() {


	} );
	*/
</script>



<?php
// FOOTER
get_footer();
?>

