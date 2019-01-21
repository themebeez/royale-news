<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Royale_News
 */

?>

<div class="archive-section-content" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="row clearfix archive-news-content">
		<div class="col-sm-6 gutter-right">
			<div class="news-image">
				<a href="<?php the_permalink(); ?>">
			<?php
				if( has_post_thumbnail() ) :
					the_post_thumbnail( 'royale-news-thumbnail-3', array( 'class' => 'img-responsive' ) );
				else :
			?>
				<img src="<?php echo esc_url( get_template_directory_uri() . '/themebeez/assets/images/image-1.jpg' ); ?>" class="img-responsive">
			<?php
				endif;
			?>
				<div class="mask"></div><!-- .mask -->
			</a>
				<?php
					royale_news_get_categories();
				?>
			</div><!-- .news-image -->
		</div>
		<div class="col-sm-6 gutter-left">
			<div class="news-detail">
				<h4 class="news-title">
					<a href="<?php the_permalink(); ?>">
						<?php
							the_title();
						?>
					</a>
				</h4><!-- .news-title -->
				<?php
					if ( 'post' === get_post_type() ) : 
				?>
					<div class="entry-meta">
						<?php royale_news_posted_on(); ?>
					</div><!-- .entry-meta -->
				<?php
					endif; 
				?>
			    <div class="news-content">
		            <?php the_excerpt(); ?>
		            <a href="<?php the_permalink(); ?>" class="btn-more">
		            	<?php echo esc_html__( 'Read More', 'royale-news' ); ?>
		            </a><!-- .btn-more -->
		        </div><!-- .news-content -->
			</div>
		</div>
	</div><!-- .row.clearfix.archive-news-content #post-<?php the_ID(); ?> -->
</div><!-- .archive-section-content -->


