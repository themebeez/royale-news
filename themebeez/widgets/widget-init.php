<?php
/**
 * Widget - Function
 *
 * @package Royale_News
 */

/**
 * Load widgets
 */
require get_template_directory() . '/themebeez/widgets/royale-news-highlight.php';
require get_template_directory() . '/themebeez/widgets/royale-news-widget-layouts.php';
require get_template_directory() . '/themebeez/widgets/royale-news-sidebar-widgets.php';
require get_template_directory() . '/themebeez/widgets/royale-news-bottom-widget-layouts.php';

if( !function_exists( 'royale_news_register_widgets' ) ) {
	/*
	 * Function to register widgets
	 */
	function royale_news_register_widgets() {

		/*
			Bottom Widget One Register
		*/
		register_widget( 'Royale_News_Bottom_Widget_Layout_One' );

		/*
			Bottom Widget Two Register
		*/
		register_widget( 'Royale_News_Bottom_Widget_Layout_Two' );

		/*
			Main Highlight Widget Register
		*/
		register_widget( 'Royale_News_Main_Featured_Posts' );

		/*
			Main Highlight With Slider Widget Register
		*/
		register_widget( 'Royale_News_Main_Featured_Posts_Two' );

		/*
			Slider Highlight Widget Register
		*/
		register_widget( 'Royale_News_Slider_Featured_Posts' );

		/**
		 * Register Sidebar Widget One
		 */
		register_widget( 'Royale_News_Sidebar_Widget_One' );

		/**
		 * Register Sidebar Widget Two
		 */
		register_widget( 'Royale_News_Sidebar_Widget_Two' );

		/**
		 * Register News Widget One
		 */
		register_widget( 'Royale_News_Widget_Layout_One' );

		/**
		 * Register News Widget Two
		 */
		register_widget( 'Royale_News_Widget_Layout_Two' );
	}
}
add_action( 'widgets_init', 'royale_news_register_widgets' );