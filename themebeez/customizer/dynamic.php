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

if ( ! function_exists( 'royale_news_dynamic_options' ) ) :

    function royale_news_dynamic_options(){
        $site_title_font = royale_news_get_option( 'royale_news_site_title_font_size' );
    ?>               
    <style>
        .site-title {
            font-size: <?php echo esc_attr( $site_title_font ); ?>px;
        }
    </style>
<?php }

endif;

add_action( 'wp_head', 'royale_news_dynamic_options' );