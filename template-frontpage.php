<?php
/**
 * Template Name: FrontPage
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Royale_News
 */

	get_header(); 
?>
<main class="main-container">
	<div class="container">
	<?php
		if ( is_active_sidebar( 'sidebar-2' ) ) {
			dynamic_sidebar( 'sidebar-2' );
		}
	?>
	</div><!-- .container -->
	<div class="container">
		<div class="row clearfix section">
			<?php
				$sidebar_position = royale_news_get_option( 'royale_news_sidebar_position' );
				if( $sidebar_position == 'none' || !is_active_sidebar( 'sidebar-1' ) ) :
					$class = 'col-md-12';
				else :
					$class = 'col-md-8';
				endif;
				if( $sidebar_position == 'left' ) :
					get_sidebar();
				endif;
			?>
			<div class="<?php echo esc_attr( $class ); ?>">
				<?php
					if ( is_active_sidebar( 'sidebar-3' ) ) {
						dynamic_sidebar( 'sidebar-3' );
					}
				?>
			</div>
			<?php
				if( $sidebar_position == 'right' ) :
					get_sidebar();
				endif;
			?>
		</div><!-- .row.clearfix.section -->	
	</div><!-- .container -->
	<div class="container">
		<?php
			if( is_active_sidebar( 'sidebar-6' ) ) {
				dynamic_sidebar( 'sidebar-6' );
			}
		?>
	</div>
</main><!-- .main-container -->

<?php
	get_footer();
?>