<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Royale_News
 */

get_header(); 
	
	/**
	* Hook - royale_news_breadcrumb.
	*
	* @hooked royale_news_breadcrumb_action - 10
	*/
	do_action( 'royale_news_breadcrumb' );
	?>
	<div id="primary" class="content-area <?php royale_news_inner_container_class(); ?>">
		<main id="main" class="site-main">
			<div class="container">
				<div class="row">
					<?php
					$royale_news_sidebar_position = royale_news_get_option( 'royale_news_sidebar_position' );

					if( $royale_news_sidebar_position == 'none' || !is_active_sidebar( 'sidebar-1' ) ) {
						$class = 'col-md-12';
					} else {
						$class = 'col-md-8';
					}

					if( $royale_news_sidebar_position == 'left' ) {
						get_sidebar();
					}
					?>
					<div class="<?php echo esc_attr( $class ); ?> sticky-section">
						<div class="row">
							<?php
							while ( have_posts() ) : the_post();

								get_template_part( 'template-parts/content', 'single' );

								/**
								* Hook - royale_news_post_navigation.
								*
								* @hooked royale_news_post_navigation_action - 10
								*/
								do_action( 'royale_news_post_navigation' );

								// If comments are open or we have at least one comment, load up the comment template.
								if ( comments_open() || get_comments_number() ) {
									comments_template();
								}

							endwhile; // End of the loop.
							?>
						</div><!-- .row.clearfix.news-section -->
					</div>
					<?php
					if( $royale_news_sidebar_position == 'right' ) {
						get_sidebar();
					}
					?>
				</div><!-- .row.section -->
			</div><!-- .container -->
		</main><!-- .main-container -->
	</div>
	<?php
get_footer();
