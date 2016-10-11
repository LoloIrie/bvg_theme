<?php
/**
 * Template Name: Ausschreibungen Seite
 *
 * @package bvg
 * @since bvg 1.0
 * @license GPL 2.0
 */
?>

<?php

$badminton_levels = array(
	'',
	'Hobby',
	'C-Klasse',
	'B-Klasse',
	'A-Klasse',
	'Bezirksklasse',
	'Verbandsliga',
	'Hessenliga',
	'Oberliga',
	'Regionalliga',
	'2. Bundesliga',
	'1. Bundesliga',
	'Jugend',
	'Schüler',
	'Minis'
);

get_header();

/* Intro Text */
echo '<div id="primary" class="content-area">
	<div id="content" class="site-content" role="main">

		
			
<article id="" class=" page type-page status-publish hentry post">

	<div class="entry-main">

		
					<header class="entry-header"><h1 class="entry-title">';
the_title();
echo '</h1></header>';

echo '<br />';
echo nl2br( $post->post_content );
echo '<br /><br />';

//echo 'TODAY: ' . date( 'Ymd' );

/* Get events */
$args = array(
	'post_type' => 'ausschreibungen',
	'posts_per_page' => 10,
	'meta_key' => 'date_start',
	'orderby' => 'date_start',
	'order' => 'ASC',
	'meta_query' => array(
		'key' => 'date_start',
		'value' => date( 'Ymd' ),
		'compare' => '>'
	)
);
$loop = new WP_Query( $args );



/* Events list */
echo '<div class="bvg_block" >';
while ( $loop->have_posts() ) : $loop->the_post();

	echo '<div class="widget_bvg-block" >';
	$date_start = get_post_meta($post->ID, 'date_start', true);
	$date_end = get_post_meta($post->ID, 'date_end', true);
	$location = get_post_meta($post->ID, 'bvg_location', true);
	$bvg_disciplines = get_post_meta($post->ID, 'bvg_disciplines', true);
	$bvg_level = get_post_meta($post->ID, 'bvg_level', true);
	$url = get_post_meta($post->ID, 'url', true);
	$file1 = get_field( 'datei_1' );
	$file2 = get_field( 'datei_2' );
	//var_dump( $file2 );



		// Event title / date
		echo '<div class="entry-title ausschreibung_item_title">';
			$date = date_parse_from_format( 'Ymd' , $date_start);
			if( !empty( $date_end ) && $date_end != $date_start ){

				$date_start_formatted = $date[ 'day' ] . '.' .$date[ 'month' ];
				echo $date_start_formatted;

				$date = date_parse_from_format( 'Ymd' , $date_end);
				$date_end_formatted = $date[ 'day' ] . '.' .$date[ 'month' ] . '.' .$date[ 'year' ];
				echo ' - ' . $date_end_formatted;
			}else{
				$date_start_formatted = $date[ 'day' ] . '.' .$date[ 'month' ] . '.' .$date[ 'year' ];
				echo $date_start_formatted;
			}
			echo ' : ';
			the_title();
		echo ' <a href="#">Mehr Infos !?</a></div>';



		echo '<div class="entry-content ausschreibung_item_content" >';


			// Event description
			echo '<div class="ausschreibung_label">' . __('Infos' , 'ausschreibungen') . '</div>';
			the_content();



			// Event link
			if( !empty( $url ) ){
				echo '<div class="ausschreibung_label">' . __('Link' , 'ausschreibungen') . '</div>';
				echo '<p><a href="'.$url.'" target="_blank" >Turnierseite anzeigen</a></p>';

			}



			//  Event location
			echo '<div class="ausschreibung_label">' . __('Ort' , 'ausschreibungen') . '</div>';
			echo '<p>' . $location . ' (<a href="https://www.google.de/maps/place/'.$location.'" target="_blank" >Google Map</a>)</p>';

			//  Event disciplines
			echo '<div class="ausschreibung_label">' . __('Disziplinen' , 'ausschreibungen') . '</div>';
			echo '<p>';
			foreach( $bvg_disciplines as $discipline  ){
				echo $discipline.' ';
			}
			echo '</p>';



			//  Event level
			echo '<div class="ausschreibung_label">' . __('Spielniveau' , 'ausschreibungen') . '</div>';
			echo '<p>';
			foreach( $bvg_level as $level  ){
				echo $badminton_levels[ $level ].'<br />';
			}
			echo '</p>';



			//  Files
			if( $file1 ){
				echo '<div class="ausschreibung_label">' . __('Dateien' , 'ausschreibungen') . '</div>';
				echo '<p>';
				$css_class = get_css_class_from_file( $file1 );
				echo '<a class="'.$css_class.'" href="'.$file1[ 'url' ].'">'.$file1[ 'title' ].'</a>';
				if( $file2 ){
					$css_class = get_css_class_from_file( $file2 );
					echo '<br /><a class="'.$css_class.'" href="'.$file2[ 'url' ].'">'.$file2[ 'title' ].'</a>';
				}
				echo '</p>';
			}


		echo '</div>';

	echo '</div>';
endwhile;
echo '</div>';

?>


<?php

echo '</div>
</article>
</div></div>

<script>
	jQuery( \'.ausschreibung_item_title\' ).on( \'click\', function(){
 		jQuery( \'.ausschreibung_item_title\' ).next().slideUp();
 		jQuery( this ).next().slideDown();
 		
 	});

</script>';

get_footer(); ?>


<?php

function get_css_class_from_file( $file ){
	$css = '';

	switch( $file[ 'mime_type' ] ){
		case 'application/vnd.ms-excel':
		case 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet':
			$css = 'dl_xls';
			break;

		case 'application/msword':
		case 'application/vnd.openxmlformats-officedocument.wordprocessingml.document':
			$css = 'dl_doc';
			break;

		default:
			$css = 'dl_pdf';
	}

	return $css;
}


?>
