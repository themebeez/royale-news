<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Royale_News
 */

get_header(); 
	?>
	<div id="primary" class="content-area <?php royale_news_inner_container_class(); ?>">
		<main id="main" class="site-main">
			<div class="container">
				<div class="row section">
					<?php
					$sidebar_position = royale_news_get_option( 'royale_news_sidebar_position' );

					if( $sidebar_position == 'none' || !is_active_sidebar( 'sidebar-1' ) ) {
						$class = 'col-md-12';
					} else {
						$class = 'col-md-8';
					}

					if( $sidebar_position == 'left' ) {
						get_sidebar();
					}
					?>
					<div class="<?php echo esc_attr( $class ); ?> sticky-section">
						<div class="row clearfix news-section">
							<div class="col-md-12">
								<div class="news-section-info clearfix">
									<h3 class="section-title">
										<?php
										/* translators: %s: search query. */
										printf( esc_html__( 'Search Results for: %s', 'royale-news' ), '<span>' . get_search_query() . '</span>' );
										?>
									</h3><!-- .section-title -->
								</div><!-- .news-section-info -->
								<?php
								if( have_posts() ) {

									/* Start the Loop */
									while ( have_posts() ) : the_post();

										/**
										 * Run the loop for the search to output the results.
										 * If you want to overload this in a child theme then include a file
										 * called content-search.php and that will be used instead.
										 */
										get_template_part( 'template-parts/content', 'search' );

									endwhile;
								} else {

									get_template_part( 'template-parts/content', 'none' );								
								}
								?>
							</div>
							<?php
							/**
							* Hook - royale_news_pagination.
							*
							* @hooked royale_news_pagination_action - 10
							*/
							do_action( 'royale_news_pagination' );
							?>
						</div><!-- .row.clearfix.news-section -->
					</div>
					<?php
					if( $sidebar_position == 'right' ) {
						get_sidebar();
					}
					?>
				</div><!-- .row.section -->
			</div><!-- .container -->
		</main><!-- .main-container -->
	</div>
	<?php
get_footer();
	