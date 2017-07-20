<?php
/*
Template Name: Blog page BVG Site
*/
?>

<?php
/**
 * Template Name: Home Page
 * The home page template file
 */
?>

<?php get_header(); ?>

<h2>BVG Nachrichten</h2>

<?php 

  $paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;

  $query_args = array(
      'post_type' => 'post',
      'posts_per_page' => 5,
      'paged' => $paged,
      'page' => $paged,
      'cat' => -35
    );

  $wp_query = new WP_Query( $query_args ); ?>

  <?php if ( $wp_query->have_posts() ) : ?>

    <!-- the loop -->
    <?php while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>
      <article id="post-<?php the_ID(); ?>" <?php post_class('post'); ?>>

	<div class="entry-main">

		<?php do_action('vantage_entry_main_top') ?>

		<?php if ( ( the_title( '', '', false ) && siteorigin_page_setting( 'page_title' ) ) || ( has_post_thumbnail() && siteorigin_setting('blog_featured_image') ) || ( siteorigin_setting( 'blog_post_metadata' ) && get_post_type() == 'post' ) ) : ?>
			<header class="entry-header">

				<?php if( has_post_thumbnail() && siteorigin_setting('blog_featured_image') ): ?>
					<div class="entry-thumbnail"><?php vantage_entry_thumbnail(); ?></div>
				<?php endif; ?>

				<?php if ( the_title( '', '', false ) && siteorigin_page_setting( 'page_title' ) ) : ?>
					<h1 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'vantage' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
				<?php endif; ?>

				<?php if ( siteorigin_setting( 'blog_post_metadata' ) && get_post_type() == 'post' ) : ?>
                    <div class="entry-meta entry-meta-display" style="display: block;">
						<?php vantage_posted_on(); ?>
					</div><!-- .entry-meta -->
				<?php endif; ?>

			</header><!-- .entry-header -->
		<?php endif; ?>

		<div class="entry-content">
			<?php the_content(); ?>
			<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'vantage' ), 'after' => '</div>' ) ); ?>
		</div><!-- .entry-content -->

		<?php if( vantage_get_post_categories() && ! is_singular( 'jetpack-testimonial' ) ) : ?>
			<div class="entry-categories">
				<?php echo vantage_get_post_categories() ?>
			</div>
		<?php endif; ?>

		<?php if( is_singular() && siteorigin_setting( 'blog_author_box' ) ) : ?>
			<div class="author-box">
				<div class="avatar-box">
					<div class="avatar-wrapper"><?php echo get_avatar( get_the_author_meta( 'user_email' ), 70 ) ?></div>
				</div>
				<div class="box-content entry-content">
					<h3 class="box-title"><?php echo esc_html( get_the_author_meta( 'display_name' ) ) ?></h3>
					<div class="box-description">
						<?php if( get_the_author_meta( 'description' ) ) : ?>
							<?php echo wp_kses_post( wpautop( get_the_author_meta( 'description' ) ) ) ?>
						<?php elseif( current_user_can( 'edit_users', $post->post_author ) ) : ?>
							<a href="<?php echo get_edit_user_link( $post->post_author ); ?>"><?php _e( 'Add author biographical info.', 'vantage' ) ?></a>
						<?php endif; ?>
					</div>
				</div>
			</div>
		<?php endif; ?>


		<?php do_action('vantage_entry_main_bottom') ?>

	</div>

</article><!-- #post-<?php the_ID(); ?> -->
    <?php endwhile; ?>
    <!-- end of the loop -->

    <!-- pagination here -->
    <?php vantage_content_nav( 'nav-below' ); ?>
    <?php
      /*
      if (function_exists(custom_pagination)) {
        custom_pagination($the_query->max_num_pages,"",$paged);
      }
      */
    ?>

  <?php wp_reset_postdata(); ?>

  <?php else:  ?>
    <p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
  <?php endif; ?>

<?php get_footer(); ?>