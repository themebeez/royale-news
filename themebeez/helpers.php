<?php
/**
 * Helper Functions.
 *
 * @package Royale_News
 */


/**
 * Funtion To Get Google Fonts
 */
if ( !function_exists( 'royale_news_fonts_url' ) ) :

    /**
     * Return Font's URL.
     *
     * @since 1.0.0
     * @return string Fonts URL.
     */
    function royale_news_fonts_url()
    {

        $fonts_url = '';
        $fonts = array();
        $subsets = 'latin,latin-ext';

        /* translators: If there are characters in your language that are not supported by Merriweather, translate this to 'off'. Do not translate into your own language. */
        if ('off' !== _x('on', 'Roboto Condensed font: on or off', 'royale-news')) {
            $fonts[] = 'Roboto+Condensed:300,300i,400,400i,700,700i';
        }

        /* translators: If there are characters in your language that are not supported by Merriweather, translate this to 'off'. Do not translate into your own language. */
        if ('off' !== _x('on', 'Open Sans font: on or off', 'royale-news')) {
            $fonts[] = 'Open+Sans:400,600,700';
        }

        if ($fonts) {
            $fonts_url = add_query_arg(array(
                'family' => urldecode(implode('|', $fonts)),
                'subset' => urldecode($subsets),
            ), 'https://fonts.googleapis.com/css');
        }
        return $fonts_url;
    }
endif;

if ( ! function_exists( 'royale_news_primary_navigation_fallback' ) ) :

    /**
     * Fallback for primary navigation.
     *
     * @since 1.0.0
     */
    function royale_news_primary_navigation_fallback() {
        ?>
        <div class="primary-menu-container">
            <ul id="primary-menu" class="primary-menu">
                <li>
                    <a href="<?php echo esc_url( admin_url( 'nav-menus.php' ) ); ?>" title="<?php esc_attr_e( 'Add Menu', 'royale-news' ); ?>">
                        <?php
                            esc_html_e( 'Add a menu', 'royale-news' );
                        ?>
                    </a>
                </li>
            </ul>
        </div>
        <?php
    }

endif;



/*
 * Hook - Plugin Recommendation
 */
if ( ! function_exists( 'royale_news_recommended_plugins' ) ) :
    /**
     * Recommend plugins.
     *
     * @since 1.0.0
     */
    function royale_news_recommended_plugins() {

        $plugins = array(
            array(
                'name'     => 'Themebeez Toolkit',
                'slug'     => 'themebeez-toolkit',
                'required' => false,
            ),
        );

        tgmpa( $plugins );
    }

endif;
add_action( 'tgmpa_register', 'royale_news_recommended_plugins' );