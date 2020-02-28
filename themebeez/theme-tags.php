<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Royale_News
 */

if( ! function_exists( 'royale_news_get_author' ) ) :

	function royale_news_get_author() {

		$show_author = royale_news_get_option( 'royale_news_show_author' );

		if( $show_author == 1 ) {

			if ( 'post' === get_post_type() ) {
				?>
				<span class="author vcard">
					<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"><?php echo esc_html( get_the_author() ); ?></a>
				</span>
				<?php
			}
		}

	}
endif;

if( ! function_exists( 'royale_news_get_date' ) ) :

	function royale_news_get_date() {

		$show_date = royale_news_get_option( 'royale_news_show_date' );

		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( 'c' ) ),
			esc_html( get_the_modified_date() )
		);

		if( $show_date == 1 ) {
			?>
			<span class="posted-date">
				<a href="<?php the_permalink(); ?>" rel="bookmark"><?php echo $time_string; // phpcs:ignore ?></a>
			</span>
			<?php
		}
	}
endif;


if( ! function_exists( 'royale_news_get_categories' ) ) :

	function royale_news_get_categories() {

		$show_categories = royale_news_get_option( 'royale_news_show_categories' );

		if( $show_categories == 1 ) {
			//Hide category and tag text for pages.
			if ( 'post' === get_post_type() ) {
				/* translators: used between list items, there is a space after the comma */
				$categories_list = get_the_category_list( ' ' );
				if ( $categories_list ) {
					?>
					<span class="cat-links"><?php echo $categories_list; // phpcs:ignore ?></span>
					<?php
				}
			}
		}
	}
endif;

if( ! function_exists( 'royale_news_get_comments_no' ) ) :

	function royale_news_get_comments_no() {

		$show_comments_no = royale_news_get_option( 'royale_news_show_comments_no' );

		// get_comments_number returns only a numeric value
		$num_comments = get_comments_number(); 

		if( $show_comments_no == 1 && comments_open() ) {

			?>
			<span class="comments-link">
				<a href="<?php the_permalink(); ?>"><?php echo esc_html( number_format_i18n( $num_comments ) ); ?></a>
			</span>
			<?php
		}
	}
endif;