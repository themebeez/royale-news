<?php
/**
 * Royale News Theme Customizer
 *
 * @package Royale_News
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function royale_news_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	// Dropdown Category Class
	require_once trailingslashit( get_template_directory() ) . '/themebeez/customizer/customizer-controls.php'; 

	// Sanitization Callback
	require_once trailingslashit( get_template_directory() ) . '/themebeez/customizer/sanitize.php'; 

	// Customization Options
	require_once trailingslashit( get_template_directory() ) . '/themebeez/customizer/options.php';

	// Upspell
	require_once trailingslashit( get_template_directory() ) . '/themebeez/upgrade-to-pro/upgrade.php';

	$wp_customize->register_section_type( 'Royale_News_Customize_Section_Upsell' );

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'        => '.site-title a',
			'render_callback' => 'royale_news_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'        => '.site-description',
			'render_callback' => 'royale_news_customize_partial_blogdescription',
		) );
	}

	// Register sections.
	$wp_customize->add_section(
		new Royale_News_Customize_Section_Upsell(
			$wp_customize,
			'theme_upsell',
			array(
				'title'    => esc_html__( 'Royale News Pro', 'royale-news' ),
				'pro_text' => esc_html__( 'Upgrade to Pro', 'royale-news' ),
				'pro_url'  => 'https://themebeez.com/themes/royale-news/',
				'priority' => 1,
			)
		)
	);

}
add_action( 'customize_register', 'royale_news_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function royale_news_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function royale_news_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function royale_news_customize_preview_js() {
	wp_enqueue_script( 'royale-news-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'royale_news_customize_preview_js' );

/**
 * Enqueue scripts for customizer
 */
function royale_news_customizer_js() {
     

    wp_enqueue_style( 'chosen', get_template_directory_uri() .'/themebeez/assets/admin/css/chosen.css' );

    wp_enqueue_style( 'royale-news-upgrade', get_template_directory_uri() . '/themebeez/upgrade-to-pro/upgrade.css');

    wp_enqueue_style( 'royale-news-admin', get_template_directory_uri() . '/themebeez/assets/admin/css/admin.css');

    wp_enqueue_script('royale-news-upgrade', get_template_directory_uri() . '/themebeez/upgrade-to-pro/upgrade.js', array('jquery'), '20151215', true);
    
    wp_enqueue_script( 'chosen', get_template_directory_uri() .'/themebeez/assets/admin/js/chosen.js', array('jquery'),'1.8.3', true  );   

	wp_enqueue_script( 'royale-news-admin', get_template_directory_uri() .'/themebeez/assets/admin/js/admin.js', array('jquery'),'1.0.0', true  );  
}
add_action( 'customize_controls_enqueue_scripts', 'royale_news_customizer_js' );
