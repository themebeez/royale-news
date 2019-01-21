<?php
/**
 * Bottom News Widgets Layouts
 *
 * @since 1.0.0
 */

if ( ! class_exists( 'Royale_News_Bottom_Widget_Layout_One' ) ) :
	/**
	* Bottom News Layout Class One
	*/
	class Royale_News_Bottom_Widget_Layout_One extends WP_Widget
	{
		
		function __construct()
		{
			$opts = array(
				'classname' => 'bottom-news-section-one',
				'description'	=> esc_html__( 'Bottom News Layout One. Place it within "FrontPage Bottom Widget Area"', 'royale-news' )
			);

			parent::__construct( 'royale-news-bottom-news-widget-one', esc_html__( 'RN: Bottom News Layout One', 'royale-news' ), $opts );
		}

		function widget( $args, $instance ) {
			$title = apply_filters( 'widget_title', ! empty( $instance['title'] ) ? $instance['title'] : '', $instance, $this->id_base );
			$cat = ! empty( $instance[ 'cat' ] ) ? $instance[ 'cat' ] : 0;
			$post_no = ! empty( $instance[ 'post_no' ] ) ? $instance[ 'post_no' ] : 5;
			echo $args[ 'before_widget' ];
			?>
			<div class="news-section-info clearfix">
			<?php
				if( !empty( $title ) ) :
					echo $args[ 'before_title' ]; 
					echo esc_html( $title );
					echo $args[ 'after_title' ];
				endif;
				?>
			</div>
			<?php
			$news_args = array(
				'cat' => $cat,
				'posts_per_page' => absint( $post_no ),
			);
			$news_query = new WP_Query( $news_args );
			if( $news_query->have_posts() ) :
				?>
				<div class="bottom-news-content news-section-content">
					<div class="row clearfix">
						<?php
							$i = 0;
							while( $news_query->have_posts() ) :
								$news_query->the_post();
								if( $i%3 == 0 && $i > 0 ) :
								?>
								<div class="row clearfix visible-md"></div>
								<?php
								endif;
								if( $i%2 == 0 && $i > 0 ) :
								?>
								<div class="row clearfix visible-sm"></div>
								<?php
								endif;
								if( $i%2 == 0 && $i > 0 ) :
								?>
								<div class="row clearfix visible-xs"></div>
								<?php
								endif;
								?>
								<div class="col-md-4 col-sm-6 col-xs-6">
									<div class="clearfix small-news-content">
										<div class="small-thumbnail">
											<a href="<?php the_permalink(); ?>">
											<?php
												if( has_post_thumbnail() ) :
													the_post_thumbnail( 'royale-news-thumbnail-1', array( 'class' => 'img-responsive' ) );
												else :
											?>
													<img src="<?php echo esc_url( get_template_directory_uri() . '/themebeez/assets/images/image-3.jpg' ); ?>" class="img-responsive">
											<?php
												endif;
											?>
											<div class="mask"></div><!-- .mask -->
											</a>
										</div><!-- .small-thumbnail -->
										<div class="news-detail">
											<h5 class="news-title">
												<a href="<?php the_permalink(); ?>">
													<?php
														the_title();
													?>
												</a>
											</h5><!-- .news-title -->
											<div class="entry-meta">
									            <?php
													royale_news_get_date();
												?>    
									        </div><!-- .entry-meta -->
										</div><!-- .news-detail -->
									</div><!-- .clearfix.small-news-content -->
								</div>
								<?php
								$i++;
							endwhile;
						?>
					</div>
				</div>
				<?php 
			endif;
			echo $args[ 'after_widget' ];
		}

		function update( $new_instance, $old_instance ) {
			$instance = $old_instance;

			$instance[ 'title' ] = sanitize_text_field( $new_instance[ 'title' ] );
			$instance[ 'cat' ] = $new_instance[ 'cat' ];
			$instance[ 'post_no' ] = absint( $new_instance[ 'post_no' ] );

			return $instance;
		}

		function form( $instance ) {

			$defaults = array(
				'title' => '',
				'cat' => array(),
				'post_no' => 5,
			);
			$instance = wp_parse_args( (array) $instance, $defaults );
			?>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><strong><?php echo esc_html__( 'Title: ', 'royale-news' ); ?></strong></label>
				<input type="text" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" class="widefat">
			</p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'cat' ) )?>"><strong><?php echo esc_html__( 'Select Category:', 'royale-news' ); ?></strong></label>
				<span class="widget_multicheck">
				<br>
				<?php
					$categories = get_terms(array( 'category' ), array( 'fields' => 'ids' ));

					array_unshift( $categories, 0 );

	                foreach($categories as $cat) {
	            ?>
	            <input id="<?php echo $this->get_field_id( 'cat' ) . $cat; ?>" name="<?php echo $this->get_field_name('cat'); ?>[]" type="checkbox" value="<?php echo $cat; ?>" <?php if(!empty($instance['cat'])) { ?><?php foreach ( $instance['cat'] as $checked ) { checked( $checked, $cat, true ); } ?><?php } ?>><?php if( $cat == 0 ) { echo esc_html__( 'Latest Posts', 'royale-news' ); } else { echo get_cat_name($cat); } ?>
	            <br>
	            <?php
	                }
	            ?>
	        	</span>
			</p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'post_no' ) )?>"><strong><?php echo esc_html__( 'Post No: ', 'royale-news' )?></strong></label>
				<input type="number" id="<?php echo esc_attr( $this->get_field_id( 'post_no' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'post_no' ) ); ?>" value="<?php echo esc_attr( $instance['post_no'] ); ?>" class="widefat">
			</p>
			<?php			
		}
	}
endif;

if ( ! class_exists( 'Royale_News_Bottom_Widget_Layout_Two' ) ) :
	/**
	* Bottom News Layout Class Two
	*/
	class Royale_News_Bottom_Widget_Layout_Two extends WP_Widget
	{
		
		function __construct()
		{
			$opts = array(
				'classname' => 'bottom-news-section-two',
				'description'	=> esc_html__( 'Bottom News Layout Two. Place it within "FrontPage Bottom Widget Area"', 'royale-news' )
			);

			parent::__construct( 'royale-news-bottom-news-widget-two', esc_html__( 'RN: Bottom News Layout Two', 'royale-news' ), $opts );
		}

		function widget( $args, $instance ) {
			$title = apply_filters( 'widget_title', ! empty( $instance['title'] ) ? $instance['title'] : '', $instance, $this->id_base );
			$cat = ! empty( $instance[ 'cat' ] ) ? $instance[ 'cat' ] : 0;
			$post_no = ! empty( $instance[ 'post_no' ] ) ? $instance[ 'post_no' ] : 5;
			echo $args[ 'before_widget' ];
			?>
			<div class="news-section-info clearfix">
			<?php
				if( !empty( $title ) ) :
					echo $args[ 'before_title' ]; 
					echo esc_html( $title );
					echo $args[ 'after_title' ];
				endif;
				?>
			</div>
			<?php
			$news_args = array(
				'cat' => $cat,
				'posts_per_page' => absint( $post_no ),
			);
			$news_query = new WP_Query( $news_args );
			if( $news_query->have_posts() ) :
				?>
				<div class="bottom-news-content news-section-content">
					<div class="row clearfix">
						<?php
							$i = 0;
							while( $news_query->have_posts() ) :
								$news_query->the_post();
								if( $i%3 == 0 && $i > 0 ) :
									?>
									<div class="row clearfix visible-md"></div>
									<?php 
								endif; 

								if( $i%2 == 0 && $i > 0 ) :
									?>
									<div class="row clearfix visible-sm"></div>
									<?php
								endif;
								?>
								<div class="col-md-4 col-sm-6 col-xs-12">
									<div class="big-news-content">
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
										<div class="news-detail">
											<h4 class="news-title">
												<a href="<?php the_permalink(); ?>">
													<?php
														the_title();
													?>
												</a>
											</h4><!-- .news-title -->
											<div class="entry-meta">
								                <?php
								                	royale_news_posted_on();
								                ?>         
								            </div><!-- .entry-meta -->
								            <div class="news-content">
						                    	<?php
						                    		the_excerpt();
						                    	?>
						                    </div><!-- .news-content -->
										</div><!-- .news-detail -->
									</div><!-- .big-news-content -->
								</div>
								<?php
								$i++;
							endwhile;
							wp_reset_postdata();
						?>
					</div>
				</div>
				<?php 
			endif;
			echo $args[ 'after_widget' ];
		}

		function update( $new_instance, $old_instance ) {
			$instance = $old_instance;

			$instance[ 'title' ] = sanitize_text_field( $new_instance[ 'title' ] );
			$instance[ 'cat' ] = $new_instance[ 'cat' ];
			$instance[ 'post_no' ] = absint( $new_instance[ 'post_no' ] );

			return $instance;
		}

		function form( $instance ) {

			$defaults = array(
				'title' => '',
				'cat' => array(),
				'post_no' => 5,
			);
			$instance = wp_parse_args( (array) $instance, $defaults );
			?>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><strong><?php echo esc_html__( 'Title: ', 'royale-news' ); ?></strong></label>
				<input type="text" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" class="widefat">
			</p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'cat' ) )?>"><strong><?php echo esc_html__( 'Select Category:', 'royale-news' ); ?></strong></label>
				<span class="widget_multicheck">
				<br>
				<?php
					$categories = get_terms(array( 'category' ), array( 'fields' => 'ids' ));

					array_unshift( $categories, 0 );

	                foreach($categories as $cat) {
	            ?>
	            <input id="<?php echo $this->get_field_id( 'cat' ) . $cat; ?>" name="<?php echo $this->get_field_name('cat'); ?>[]" type="checkbox" value="<?php echo $cat; ?>" <?php if(!empty($instance['cat'])) { ?><?php foreach ( $instance['cat'] as $checked ) { checked( $checked, $cat, true ); } ?><?php } ?>><?php if( $cat == 0 ) { echo esc_html__( 'Latest Posts', 'royale-news' ); } else { echo esc_html( get_cat_name( $cat ) ); } ?>
	            <br>
	            <?php
	                }
	            ?>
	        	</span>
			</p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'post_no' ) )?>"><strong><?php echo esc_html__( 'Post No: ', 'royale-news' )?></strong></label>
				<input type="number" id="<?php echo esc_attr( $this->get_field_id( 'post_no' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'post_no' ) ); ?>" value="<?php echo esc_attr( $instance['post_no'] ); ?>" class="widefat">
			</p>
			<?php			
		}
	}
endif;

?>