<?php
/**
 * Default Options.
 *
 * @package Royale_News
 */

if ( ! function_exists( 'royale_news_get_option' ) ) :

	/**
	 * Get theme option.
	 *
	 * @since 1.0.0
	 *
	 * @param string $key Option key.
	 * @return mixed Option value.
	 */
	function royale_news_get_option( $key ) {

		if ( empty( $key ) ) {
			return;
		}

		$value = '';

		$default = royale_news_get_default_theme_options();

		$default_value = null;

		if ( is_array( $default ) && isset( $default[ $key ] ) ) {
			$default_value = $default[ $key ];
		}

		if ( null !== $default_value ) {
			$value = get_theme_mod( $key, $default_value );
		}
		else {
			$value = get_theme_mod( $key );
		}

		return $value;

	}

endif;

if ( ! function_exists( 'royale_news_get_default_theme_options' ) ) :

	/**
	 * Get default theme options.
	 *
	 * @since 1.0.0
	 *
	 * @return array Default theme options.
	 */
	function royale_news_get_default_theme_options() {

		$defaults = array();

		$defaults['royale_news_logo_position']			= 'left';
		$defaults['royale_news_site_title_font_size']	= 45;

		// Top Header
		$defaults['royale_news_ticker_news_title']		= '';
		$defaults['royale_news_ticker_news_category']	= 0;
		$defaults['royale_news_ticker_news_no']			= 5;
		$defaults['royale_news_enable_current_date']	= 1;
		$defaults['royale_news_enable_search_btn']		= 1;

		// BreadCrumb 
		$defaults['royale_news_enable_breadcrumb']		= 1;

		// Footer
		$defaults['royale_news_copyright_text']			= '';
		$defaults['royale_news_enable_scroll_top']		= 1;

		// Featured Posts In Blog Page
		$defaults['royale_news_enable_featured_post']	= 0;

		// Theme Sidebar
		$defaults['royale_news_sidebar_position']		= 'right';

		// Meta Options
		$defaults['royale_news_show_date']				= 1;
		$defaults['royale_news_show_author']			= 1;
		$defaults['royale_news_show_comments_no']		= 1;
		$defaults['royale_news_show_categories']		= 1;

		// Excerpt Length
		$defaults['royale_news_excerpt_length']		= 30;

		return $defaults;
	}

endif;
