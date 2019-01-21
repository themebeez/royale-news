<?php
/**
 * Custom Widgets
 *
 * @since 1.0.0
 */

if( ! class_exists( 'Royale_News_Main_Featured_Posts' ) ) :
	/**
	 * Main Featured Posts
	 *
	 * @since 1.0.0
	 */
	class Royale_News_Main_Featured_Posts extends WP_Widget
	{
		
		function __construct()
		{
			$opts = array(
				'classname' => '',
				'description'	=> esc_html__( 'Displays three distinct featured posts. Place it in "Featured Posts Widget Area" widget area.', 'royale-news' )
			);
			parent::__construct( 'royale-news-main-highlight', esc_html__( 'RN: Main Featured Posts', 'royale-news' ), $opts );
		}

		function widget( $args, $instance ) {
			$cat_1 = ! empty( $instance[ 'cat_1' ] ) ? $instance[ 'cat_1' ] : absint( 0 );
			$cat_2 = ! empty( $instance[ 'cat_2' ] ) ? $instance[ 'cat_2' ] : absint( 0 );
			$cat_3 = ! empty( $instance[ 'cat_3' ] ) ? $instance[ 'cat_3' ] : absint( 0 );
			?>
			<div class="row clearfix section highlight-section">
			<?php
				$left_args = array(
					'cat'				=> absint( $cat_1 ),
					'posts_per_page'	=> 1,
					'post__not_in'		=> get_option("sticky_posts")
				);
				$left_query = new WP_Query( $left_args );
				if( $left_query->have_posts() ) :
					while( $left_query->have_posts() ) :
						$left_query->the_post();
			?>
						<div class="col-md-8 gutter-right">
							<div class="highlight-left">
								<a href="<?php the_permalink(); ?>">
								<?php
									if( has_post_thumbnail() ) :
										the_post_thumbnail( 'royale-news-thumbnail-3', array( 'class' => 'img-responsive' ) );
									else :
								?>
									<img src="<?php echo esc_url( get_template_directory_uri() . '/themebeez/assets/images/image-1.jpg' )?>" class="img-responsive">
								<?php
									endif;
								?>
								<div class="mask"></div><!-- .mask -->
								</a>
								<?php
									royale_news_get_categories();
								?>
								<div class="highlight-info">
									<h3 class="news-title">
										<a href="<?php the_permalink(); ?>">
											<?php
												the_title();
											?>
										</a>
									</h3><!-- .news-title -->
									<div class="entry-meta">
					                    <?php royale_news_posted_on(); ?>      
					                </div><!-- .entry-meta -->
								</div><!-- .highlight-info -->
							</div><!-- .highlight-left -->
						</div><!-- .gutter-right -->
			<?php
					endwhile;
					wp_reset_postdata();
				endif;
			?>
				<div class="col-md-4 gutter-left">
				<?php
					$right_top_args = array(
						'cat'				=> absint( $cat_2 ),
						'posts_per_page'	=> 1,
						'post__not_in'=>get_option("sticky_posts")
					);
					$right_top_query = new WP_Query( $right_top_args );
					if( $right_top_query->have_posts() ) :
						while( $right_top_query->have_posts() ) :
							$right_top_query->the_post();
				?>
							<div class="highlight-right highlight-right-top">
								<a href="<?php the_permalink(); ?>">
								<?php
									if( has_post_thumbnail() ) :
										the_post_thumbnail( 'royale-news-thumbnail-2', array( 'class' => 'img-responsive' ) );
									else :
								?>
									<img src="<?php echo esc_url( get_template_directory_uri() . '/themebeez/assets/images/image-2.jpg' )?>" class="img-responsive">
								<?php
									endif;
								?>
								<div class="mask"></div><!-- .mask -->
								</a>
								<?php
									royale_news_get_categories();
								?>
								<div class="highlight-info">
									<h4 class="news-title">
										<a href="<?php the_permalink(); ?>">
											<?php
												the_title();
											?>
										</a>
									</h4><!-- .news-title -->
									<div class="entry-meta">
										<?php
											royale_news_get_date();
										?>  
					                </div><!-- .entry-meta -->
								</div><!-- .highlight-info -->
							</div><!-- .highlight-right.highlight-right-top -->
				<?php
						endwhile;
						wp_reset_postdata();
					endif;
					$right_bottom_args = array(
						'cat'				=> absint( $cat_3 ),
						'posts_per_page'	=> 1,
						'post__not_in'		=> get_option("sticky_posts")
					);
					$right_bottom_query = new WP_Query( $right_bottom_args );
					if( $right_bottom_query->have_posts() ) :
						while( $right_bottom_query->have_posts() ) :
							$right_bottom_query->the_post();
				?>
							<div class="highlight-right highlight-right-bottom">
								<a href="<?php the_permalink(); ?>">
								<?php
									if( has_post_thumbnail() ) :
										the_post_thumbnail( 'royale-news-thumbnail-2', array( 'class' => 'img-responsive' ) );
									else :
								?>
									<img src="<?php echo esc_url( get_template_directory_uri() . '/themebeez/assets/images/image-2.jpg' )?>" class="img-responsive">
								<?php
									endif;
								?>
								<div class="mask"></div><!-- .mask -->
								</a>
								<?php
									royale_news_get_categories();
								?>
								</span><!-- .cat-links -->
								<div class="highlight-info">
									<h4 class="news-title">
										<a href="<?php the_permalink(); ?>">
											<?php
												the_title();
											?>
										</a>
									</h4><!-- .news-title -->
									<div class="entry-meta">
					                    <?php
											royale_news_get_date();
										?>     
					                </div><!-- .entry-meta -->
								</div><!-- .highlight-info -->
							</div><!-- .highlight-right.highlight-right-bottom -->
				<?php
						endwhile;
						wp_reset_postdata();
					endif;	
				?>
				</div><!-- .gutter-left -->
			</div><!-- .row.clearfix.section.highlight-section -->
			<?php
		}
		function update( $new_instance, $old_instance ) {
			$instance = $old_instance;

			$instance[ 'cat_1' ] = absint( $new_instance[ 'cat_1' ] );
			$instance[ 'cat_2' ] = absint( $new_instance[ 'cat_2' ] );
			$instance[ 'cat_3' ] = absint( $new_instance[ 'cat_3' ] );

			return $instance;
		}
		function form( $instance ) {
			$cat_1 = ! empty( $instance[ 'cat_1' ] ) ? $instance[ 'cat_1' ] : absint( 0 );
			$cat_2 = ! empty( $instance[ 'cat_2' ] ) ? $instance[ 'cat_2' ] : absint( 0 );
			$cat_3 = ! empty( $instance[ 'cat_3' ] ) ? $instance[ 'cat_3' ] : absint( 0 );
			?>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'cat_1' ) )?>"><?php echo esc_html__( 'Left Highlight:', 'royale-news' ); ?></label>
				<br>
				<?php
					$cat_args_1 = array(
						'orderby'	=> 'name',
						'hide_empty'	=> 0,
						'id'	=> $this->get_field_id( 'cat_1' ),
						'name'	=> $this->get_field_name( 'cat_1' ),
						'class'	=> 'widefat',
						'taxonomy'	=> 'category',
						'selected'	=> absint( $cat_1 ),
						'show_option_all'	=> esc_html__( 'Show Recent Posts', 'royale-news' )
					);
					wp_dropdown_categories( $cat_args_1 );
				?>
			</p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'cat_2' ) )?>"><?php echo esc_html__( 'Right Top Highlight:', 'royale-news' ); ?></label>
				<?php
					$cat_args_2 = array(
						'orderby'	=> 'name',
						'hide_empty'	=> 0,
						'id'	=> $this->get_field_id( 'cat_2' ),
						'name'	=> $this->get_field_name( 'cat_2' ),
						'class'	=> 'widefat',
						'taxonomy'	=> 'category',
						'selected'	=> absint( $cat_2 ),
						'show_option_all'	=> esc_html__( 'Show Recent Posts', 'royale-news' )
					);
					wp_dropdown_categories( $cat_args_2 );
				?>
			</p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'cat_3' ) )?>"><?php echo esc_html__( 'Right Bottom Highlight:', 'royale-news' ); ?></label>
				<br>
				<?php
					$cat_args_3 = array(
						'orderby'	=> 'name',
						'hide_empty'	=> 0,
						'id'	=> $this->get_field_id( 'cat_3' ),
						'name'	=> $this->get_field_name( 'cat_3' ),
						'class'	=> 'widefat',
						'taxonomy'	=> 'category',
						'selected'	=> absint( $cat_3 ),
						'show_option_all'	=> esc_html__( 'Show Recent Posts', 'royale-news' )
					);
					wp_dropdown_categories( $cat_args_3 );
				?>
			</p>
			<?php
		}
	}
endif;

if( ! class_exists( 'Royale_News_Slider_Featured_Posts' ) ) :
	/**
	 * Slider Highlight 
	 *
	 */
	class Royale_News_Slider_Featured_Posts extends WP_Widget
	{
		
		function __construct()
		{
			$opts = array(
				'classname' => '',
				'description' => esc_html__( 'Displays posts as featured posts in Slider. Place it in "Featured Posts Wiget Area" widget area. It only works in the widget area.', 'royale-news' )
			);
			parent::__construct( 'royale-news-slider-highlight', esc_html__( 'RN: Slider Featured Posts', 'royale-news' ), $opts );
		}
		
		function widget( $args, $instance ) {
			$cat = ! empty( $instance[ 'cat' ] ) ? $instance[ 'cat' ] : '';
			$post_no = ! empty( $instance[ 'post_no' ] ) ? $instance[ 'post_no' ] : 5;

			$slider_arguments = array(
				'cat'				=> $cat,
				'posts_per_page' 	=> absint( $post_no ),
				'post_type'			=> 'post', 
				'post__not_in'		=> get_option("sticky_posts")
			);

			$slider_query = new WP_Query( $slider_arguments );
			if( $slider_query->have_posts() ) :
			?>
				<div class="row clearfix section highlight-section">
					<div class="col-sm-12">
						<div class="owl-carousel highlight-carousel">
							<?php
								while( $slider_query->have_posts() ) :
									$slider_query->the_post();
							?>
									<div class="item">
										<div class="news-highlight-content">
											<a href="<?php the_permalink(); ?>">
											<?php
												if( has_post_thumbnail() ) :
													the_post_thumbnail( 'royale-news-thumbnail-3', array( 'class' => 'img-responsive' ) );
												else :
											?>
												<img src="<?php echo esc_url( get_template_directory_uri() . '/themebeez/assets/images/image-1.jpg' )?>" class="img-responsive">
											<?php
												endif;
											?>
											<div class="mask"></div><!-- .mask -->
											</a>
											<?php
												royale_news_get_categories();
											?>
											<div class="highlight-info">
												<h3 class="news-title">
													<a href="<?php the_permalink(); ?>">
														<?php
															the_title();
														?>
													</a>
												</h3><!-- .news-title -->
												<div class="entry-meta">
								                    <?php
														royale_news_get_date();
													?>     
								                </div><!-- .entry-meta -->
											</div><!-- .highlight-info -->
										</div><!-- .news-highlight-content -->						
									</div><!-- .item -->
							<?php
								endwhile;
								wp_reset_postdata();
							?>
						</div><!-- .owl-carousel.highlight-carousel -->
					</div>
				</div><!-- .row.clearfix.section.highlight-section -->
			<?php
			endif;
		}


		function update( $new_instance, $old_instance ) {
			$instance = $old_instance;

			$instance[ 'cat' ] = $new_instance[ 'cat' ];
			$instance[ 'post_no' ] = absint( $new_instance[ 'post_no' ] );

			return $instance;
		}


		function form( $instance ) {

			$defaults = array(
				'cat' => array(),
				'post_no' => 5,
			);
			$instance = wp_parse_args( (array) $instance, $defaults );
			?>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'cat' ) )?>"><strong><?php echo esc_html__( 'Select Category: ', 'royale-news' ); ?></strong></label>
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

if( ! class_exists( 'Royale_News_Main_Featured_Posts_Two' ) ) :
	/**
	 * Main Featured Posts Two
	 *
	 * @since 1.0.0
	 */
	class Royale_News_Main_Featured_Posts_Two extends WP_Widget
	{
		
		function __construct()
		{
			$opts = array(
				'classname' => '',
				'description'	=> esc_html__( 'Displays featured posts with layout similar to "RN: Main Featured Posts" widget but with slider. Place it in "Featured Posts Widget Area" widget area.', 'royale-news' )
			);
			parent::__construct( 'royale-news-main-highlight-two', esc_html__( 'RN: Main Featured Posts With Slider', 'royale-news' ), $opts );
		}

		function widget( $args, $instance ) {
			$cat_1 = ! empty( $instance[ 'cat_1' ] ) ? $instance[ 'cat_1' ] : 0;
			$slider_post_no = ! empty( $instance[ 'slider_post_no' ] ) ? $instance[ 'slider_post_no' ] : 3;
			$cat_2 = ! empty( $instance[ 'cat_2' ] ) ? $instance[ 'cat_2' ] : 0;
			$cat_3 = ! empty( $instance[ 'cat_3' ] ) ? $instance[ 'cat_3' ] : 0;
			?>
			<div class="row clearfix section highlight-section">
			<?php
				$left_args = array(
					'cat'				=> absint( $cat_1 ),
					'posts_per_page'	=> absint( $slider_post_no ),
					'post__not_in'		=> get_option("sticky_posts")
				);
				$left_query = new WP_Query( $left_args );
				if( $left_query->have_posts() ) :
					?>
					<div class="col-md-8 gutter-right">
						<div class="highlight-left">
							<div class="owl-carousel highlight-left-carousel">
								<?php
									while( $left_query->have_posts() ) :
										$left_query->the_post();
										?>
										<div class="item">
											<div class="highlight-fimg">
												<a href="<?php the_permalink(); ?>">
												<?php
													if( has_post_thumbnail() ) :
														the_post_thumbnail( 'royale-news-thumbnail-3', array( 'class' => 'img-responsive' ) );
													else :
														?>
														<img src="<?php echo esc_url( get_template_directory_uri() . '/themebeez/assets/images/image-1.jpg' )?>" class="img-responsive">
														<?php
													endif;
												?>
												<div class="mask"></div><!-- .mask -->
												</a>
											</div>
											<?php
												royale_news_get_categories();
											?>
											<div class="highlight-info">
												<h3 class="news-title">
													<a href="<?php the_permalink(); ?>">
														<?php
															the_title();
														?>
													</a>
												</h3><!-- .news-title -->
												<div class="entry-meta">
								                    <?php royale_news_posted_on(); ?>      
								                </div><!-- .entry-meta -->
											</div><!-- .highlight-info -->
										</div><!-- .item -->
										<?php
									endwhile;
									wp_reset_postdata();
								?>
							</div><!-- .owl-carousel.highlight-left-carousel -->
						</div><!-- .highlight-left -->
					</div><!-- .gutter-right -->
					<?php	
				endif;
			?>
				<div class="col-md-4 gutter-left">
				<?php
					$right_top_args = array(
						'cat'				=> absint( $cat_2 ),
						'posts_per_page'	=> 1,
						'post__not_in'=>get_option("sticky_posts")
					);
					$right_top_query = new WP_Query( $right_top_args );
					if( $right_top_query->have_posts() ) :
						while( $right_top_query->have_posts() ) :
							$right_top_query->the_post();
				?>
							<div class="highlight-right highlight-right-top">
								<a href="<?php the_permalink(); ?>">
								<?php
									if( has_post_thumbnail() ) :
										the_post_thumbnail( 'royale-news-thumbnail-2', array( 'class' => 'img-responsive' ) );
									else :
								?>
									<img src="<?php echo esc_url( get_template_directory_uri() . '/themebeez/assets/images/image-2.jpg' )?>" class="img-responsive">
								<?php
									endif;
								?>
								<div class="mask"></div><!-- .mask -->
								</a>
								<?php
									royale_news_get_categories();
								?>
								<div class="highlight-info">
									<h4 class="news-title">
										<a href="<?php the_permalink(); ?>">
											<?php
												the_title();
											?>
										</a>
									</h4><!-- .news-title -->
									<div class="entry-meta">
										<?php
											royale_news_get_date();
										?>  
					                </div><!-- .entry-meta -->
								</div><!-- .highlight-info -->
							</div><!-- .highlight-right.highlight-right-top -->
				<?php
						endwhile;
						wp_reset_postdata();
					endif;
					$right_bottom_args = array(
						'cat'				=> absint( $cat_3 ),
						'posts_per_page'	=> 1,
						'post__not_in'		=> get_option("sticky_posts")
					);
					$right_bottom_query = new WP_Query( $right_bottom_args );
					if( $right_bottom_query->have_posts() ) :
						while( $right_bottom_query->have_posts() ) :
							$right_bottom_query->the_post();
				?>
							<div class="highlight-right highlight-right-bottom">
								<a href="<?php the_permalink(); ?>">
								<?php
									if( has_post_thumbnail() ) :
										the_post_thumbnail( 'royale-news-thumbnail-2', array( 'class' => 'img-responsive' ) );
									else :
								?>
									<img src="<?php echo esc_url( get_template_directory_uri() . '/themebeez/assets/images/image-2.jpg' )?>" class="img-responsive">
								<?php
									endif;
								?>
								<div class="mask"></div><!-- .mask -->
								</a>
								<?php
									royale_news_get_categories();
								?>
								</span><!-- .cat-links -->
								<div class="highlight-info">
									<h4 class="news-title">
										<a href="<?php the_permalink(); ?>">
											<?php
												the_title();
											?>
										</a>
									</h4><!-- .news-title -->
									<div class="entry-meta">
					                    <?php
											royale_news_get_date();
										?>     
					                </div><!-- .entry-meta -->
								</div><!-- .highlight-info -->
							</div><!-- .highlight-right.highlight-right-bottom -->
				<?php
						endwhile;
						wp_reset_postdata();
					endif;	
				?>
				</div><!-- .gutter-left -->
			</div><!-- .row.clearfix.section.highlight-section -->
			<?php
		}
		function update( $new_instance, $old_instance ) {
			$instance = $old_instance;

			$instance[ 'cat_1' ] = absint( $new_instance[ 'cat_1' ] );
			$instance[ 'slider_post_no' ] = absint( $new_instance[ 'slider_post_no' ] );
			$instance[ 'cat_2' ] = absint( $new_instance[ 'cat_2' ] );
			$instance[ 'cat_3' ] = absint( $new_instance[ 'cat_3' ] );

			return $instance;
		}
		function form( $instance ) {
			$cat_1 = ! empty( $instance[ 'cat_1' ] ) ? $instance[ 'cat_1' ] : 0;
			$slider_post_no = ! empty( $instance[ 'slider_post_no' ] ) ? $instance[ 'slider_post_no' ] : 3;
			$cat_2 = ! empty( $instance[ 'cat_2' ] ) ? $instance[ 'cat_2' ] : 0;
			$cat_3 = ! empty( $instance[ 'cat_3' ] ) ? $instance[ 'cat_3' ] : 0;
			?>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'cat_1' ) )?>"><?php echo esc_html__( 'Left Highlight:', 'royale-news' ); ?></label>
				<br>
				<?php
					$cat_args_1 = array(
						'orderby'	=> 'name',
						'hide_empty'	=> 0,
						'id'	=> $this->get_field_id( 'cat_1' ),
						'name'	=> $this->get_field_name( 'cat_1' ),
						'class'	=> 'widefat',
						'taxonomy'	=> 'category',
						'selected'	=> absint( $cat_1 ),
						'show_option_all'	=> esc_html__( 'Show Recent Posts', 'royale-news' )
					);
					wp_dropdown_categories( $cat_args_1 );
				?>
			</p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'slider_post_no' ) )?>"><strong><?php echo esc_html__( 'Slider Post No: ', 'royale-news' )?></strong></label>
				<input type="number" id="<?php echo esc_attr( $this->get_field_id( 'slider_post_no' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'slider_post_no' ) ); ?>" value="<?php echo esc_attr( $instance['slider_post_no'] ); ?>" class="widefat">
			</p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'cat_2' ) )?>"><?php echo esc_html__( 'Right Top Highlight:', 'royale-news' ); ?></label>
				<?php
					$cat_args_2 = array(
						'orderby'	=> 'name',
						'hide_empty'	=> 0,
						'id'	=> $this->get_field_id( 'cat_2' ),
						'name'	=> $this->get_field_name( 'cat_2' ),
						'class'	=> 'widefat',
						'taxonomy'	=> 'category',
						'selected'	=> absint( $cat_2 ),
						'show_option_all'	=> esc_html__( 'Show Recent Posts', 'royale-news' )
					);
					wp_dropdown_categories( $cat_args_2 );
				?>
			</p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'cat_3' ) )?>"><?php echo esc_html__( 'Right Bottom Highlight:', 'royale-news' ); ?></label>
				<br>
				<?php
					$cat_args_3 = array(
						'orderby'	=> 'name',
						'hide_empty'	=> 0,
						'id'	=> $this->get_field_id( 'cat_3' ),
						'name'	=> $this->get_field_name( 'cat_3' ),
						'class'	=> 'widefat',
						'taxonomy'	=> 'category',
						'selected'	=> absint( $cat_3 ),
						'show_option_all'	=> esc_html__( 'Show Recent Posts', 'royale-news' )
					);
					wp_dropdown_categories( $cat_args_3 );
				?>
			</p>
			<?php
		}
	}
endif;