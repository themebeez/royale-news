<?php

/*
 * Definition of category terms array
 */
if( !function_exists( 'royale_news_categories_choices' ) ) {

	function royale_news_categories_choices() {

		$category_terms = get_terms( 'category' );

		$post_categories = array();

		foreach( $category_terms as $category_term ) {
			$post_categories[$category_term->term_id] = $category_term->name;
		}

		return $post_categories;
	}
}


/*
 * Definition of sidebar position array
 */
if( !function_exists( 'royale_news_sidebar_choices' ) ) {

	function royale_news_sidebar_choices() {

		return array(
			'left'   		=> esc_html__('Left','royale-news'),
			'right'  		=> esc_html__('Right','royale-news'),
			'none'	 		=> esc_html__('None','royale-news'),
		);
	}
}

/*
 * Definition of logo position array
 */
if( !function_exists( 'royale_news_logo_align_choices' ) ) {

	function royale_news_logo_align_choices() {

		return array(
			'left' => esc_html__( 'Left', 'royale-news' ),
			'center' => esc_html__( 'Center', 'royale-news' ),
		);
	}
}