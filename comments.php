<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Royale_News
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div class="col-md-12">
	<div id="comments" class="comments-area">

		<?php
		// You can start editing here -- including this comment!
		if ( have_comments() ) : ?>
			<h3 class="comments-title">
				<?php
				$royale_news_comment_count = get_comments_number();
				if ( 1 === $royale_news_comment_count ) {
					printf(
						/* translators: 1: title. */
						esc_html_e( 'One thought on &ldquo;%1$s&rdquo;', 'royale-news' ),
						'<span>' . get_the_title() . '</span>'
					);
				} else {
					printf( // WPCS: XSS OK.
						/* translators: 1: comment count number, 2: title. */
						esc_html( _nx( '%1$s thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', $royale_news_comment_count, 'comments title', 'royale-news' ) ),
						number_format_i18n( $royale_news_comment_count ),
						'<span>' . get_the_title() . '</span>'
					);
				}
				?>
			</h3><!-- .comments-title -->

			<?php the_comments_navigation(); ?>

			<ol class="comment-list">
				<?php
					wp_list_comments( array(
						'style'      => 'ul',
						'short_ping' => true,
						'avatar_size'	=> 60,
					) );
				?>
			</ol><!-- .comment-list -->

			<?php the_comments_navigation();

			// If comments are closed and there are comments, let's leave a little note, shall we?
			if ( ! comments_open() ) : ?>
				<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'royale-news' ); ?></p>
			<?php
			endif;

		endif; // Check for have_comments().

		comment_form();
		?>

	</div><!-- #comments -->
</div>
