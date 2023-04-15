<?php
/**
 * Dynamic Options hook.
 *
 * This file contains option values from customizer
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Royale_News
 */

if ( ! function_exists( 'royale_news_dynamic_options' ) ) {
	/**
	 * Renders dynamic CSS.
	 *
	 * @since 1.0.0
	 */
	function royale_news_dynamic_options() {

		$site_title_font = royale_news_get_option( 'royale_news_site_title_font_size' );

		$disable_google_fonts = royale_news_get_option( 'royale_news_disable_google_fonts' );

		$body_font_family = royale_news_get_option( 'royale_news_body_font_family' );

		$headings_font_family = royale_news_get_option( 'royale_news_headings_font_family' );
		?>               
		<style>
			.site-title, .site-title a {
				font-size: <?php echo esc_attr( $site_title_font ); ?>px;
			}
			<?php
			if ( $disable_google_fonts ) {
				?>
				body {
					font-family: <?php echo esc_attr( $body_font_family ); ?>;
				}

				h1, h2, h3, h4, h5, h6, .section-title, .sidebar .widget-title {

					font-family: <?php echo esc_attr( $headings_font_family ); ?>;
				}
				<?php
			}
			?>
		</style>
		<?php
	}
}
add_action( 'wp_head', 'royale_news_dynamic_options' );
