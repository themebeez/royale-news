<?php
/**
 * Sidebar Widgets Layouts
 *
 * @since 1.0.0
 */

if ( ! class_exists( 'Royale_News_Sidebar_Widget_One' ) ) :
	/**
	* News Sidebar Widget One Class
	*/
	class Royale_News_Sidebar_Widget_One extends WP_Widget
	{
		
		function __construct()
		{
			$opts = array(
				'classname' => 'recent-posts',
				'description'	=> esc_html__( 'Displays posts. Place it in "Sidebar" or "Footer Widget Area".', 'royale-news' )
			);

			parent::__construct( 'royale-news-sidebar-widget-one', esc_html__( 'RN: Recent Posts', 'royale-news' ), $opts );
		}

		function widget( $args, $instance ) {
			$title = apply_filters( 'widget_title', ! empty( $instance['title'] ) ? $instance['title'] : '', $instance, $this->id_base );
			$cat = ! empty( $instance[ 'cat' ] ) ? $instance[ 'cat' ] : absint( 0 );
			$post_no = ! empty( $instance[ 'post_no' ] ) ? $instance[ 'post_no' ] : absint( 6 );

			echo $args[ 'before_widget' ];
                if( !empty( $title ) ) :
    				echo $args[ 'before_title' ]; 
                    echo esc_html( $title );
    				echo $args[ 'after_title' ];
                endif;
				$arguments_one = array(
					'cat'	=> absint( $cat ),
					'posts_per_page' => absint( $post_no ),
				); 
				$query_one = new WP_Query( $arguments_one );
				if( $query_one->have_posts() ) :
				?>
					<div class="widget-content clearfix">
						<?php
							$i = 0;
							while( $query_one->have_posts() ) :
								$query_one->the_post();
								if( $i%2 == 0 ) :
						?>
								<div class="clearfix visible-xs"></div>
						<?php
								endif;
						?>
								<div class="col-xs-12 col-sm-12 col-md-12">
									<div class="row small-news-container">
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
									</div><!-- .small-news-container -->
								</div>
						<?php
								$i = $i + 1;
							endwhile;
							wp_reset_postdata();
						?>
					</div>
				<?php 
				endif;
			echo $args[ 'after_widget' ]; 
		}

		function update( $new_instance, $old_instance ) {
			$instance = $old_instance;

			$instance[ 'title' ] = sanitize_text_field( $new_instance[ 'title' ] );
			$instance[ 'cat' ] = absint( $new_instance[ 'cat' ] );
			$instance[ 'post_no' ] = absint( $new_instance[ 'post_no' ] );

			return $instance;
		}

		function form( $instance ) {

			$title = ! empty( $instance[ 'title' ] ) ? $instance[ 'title' ] : '';
			$cat = ! empty( $instance[ 'cat' ] ) ? $instance[ 'cat' ] : absint( 0 );
			$post_no = ! empty( $instance[ 'post_no' ] ) ? $instance[ 'post_no' ] : absint( 6 );
			?>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><strong><?php echo esc_html__( 'Title: ', 'royale-news' ); ?></strong></label>
				<input type="text" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" value="<?php echo esc_attr( $title ); ?>" class="widefat">
			</p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'cat' ) )?>"><strong><?php echo esc_html__( 'Select Category: ', 'royale-news' ); ?></strong></label>
				<?php
					$cat_args = array(
						'orderby'	=> 'name',
						'hide_empty'	=> 0,
						'id'	=> $this->get_field_id( 'cat' ),
						'name'	=> $this->get_field_name( 'cat' ),
						'class'	=> 'widefat',
						'taxonomy'	=> 'category',
						'selected'	=> absint( $cat ),
						'show_option_all'	=> esc_html__( 'Show Recent Posts', 'royale-news' )
					);
					wp_dropdown_categories( $cat_args );
				?>
			</p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'post_no' ) )?>"><strong><?php echo esc_html__( 'Post No: ', 'royale-news' )?></strong></label>
				<input type="number" id="<?php echo esc_attr( $this->get_field_id( 'post_no' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'post_no' ) ); ?>" value="<?php echo esc_attr( $post_no ); ?>" class="widefat">
			</p>
			<?php			
		}
	}
endif;

if( ! class_exists( 'Royale_News_Sidebar_Widget_Two' ) ) :
    /**
     * Social widget class.
     *
     * @since 1.0.0
     */
    class Royale_News_Sidebar_Widget_Two extends WP_Widget {
        function __construct() {
            $opts = array(
                'classname'   => '',
                'description' => esc_html__( 'Social Links Widget. Place it in "Sidebar".', 'royale-news' ),
            );

            parent::__construct( 'royale-news-social-widget', esc_html__( 'RN: Social Widget', 'royale-news' ), $opts );
        }


        function widget( $args, $instance ) {

            $title          = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );

            $facebook       = ! empty( $instance['facebook'] ) ? $instance['facebook'] : '';
            $twitter        = ! empty( $instance['twitter'] ) ? $instance['twitter'] : '';
            $google_plus    = ! empty( $instance['google_plus'] ) ? $instance['google_plus'] : '';
            $instagram      = ! empty( $instance['instagram'] ) ? $instance['instagram'] : '';
            $linkedin       = ! empty( $instance['linkedin'] ) ? $instance['linkedin'] : '';
            $youtube       	= ! empty( $instance['youtube'] ) ? $instance['youtube'] : '';

            echo $args['before_widget'];
            if( !empty( $title ) ) :
                echo $args['before_title'];
                echo esc_html( $title );
                echo $args['after_title'];
            endif;
            ?>
            <div class="widget-social-links">
                <ul class="social-links-list">
                    <?php
                        if( !empty( $facebook ) ) :
                    ?>
                        <li class="facebook-link">
                        	<a href="<?php echo esc_attr( esc_url( $facebook ) ); ?>" class="clearfix">
                        		<?php esc_html_e( 'Facebook', 'royale-news'); ?>
                        		<span class="social-icon">
                        			<i class="fa fa-facebook"></i>
                        		</span>                        		
                        	</a>
                        </li>
                    <?php
                        endif;
                        if( !empty( $twitter ) ) :
                    ?>
                        <li class="twitter-link">
                        	<a href="<?php echo esc_attr( esc_url( $twitter ) ); ?>" class="clearfix">
                        		<?php esc_html_e( 'Twitter', 'royale-news'); ?>
                        		<span class="social-icon">
                        			<i class="fa fa-twitter"></i>
                        		</span>
                        	</a>
                        </li>
                    <?php
                        endif;
                        if( !empty( $google_plus ) ) :
                    ?>
                        <li class="googleplus-link">
                        	<a href="<?php echo esc_attr( esc_url( $google_plus ) ); ?>" class="clearfix">
                        		<?php esc_html_e( 'Google Plus', 'royale-news'); ?>
                        		<span class="social-icon">
                        			<i class="fa fa-google-plus"></i>
                        		</span>
                        	</a>
                        </li>
                    <?php
                        endif;
                        if( !empty( $instagram ) ) :
                    ?>
                        <li class="instagram-link">
                        	<a href="<?php echo esc_attr( esc_url( $instagram ) ); ?>" class="clearfix">
                        		<?php esc_html_e( 'Instagram', 'royale-news'); ?>
                        		<span class="social-icon">
                        			<i class="fa fa-instagram"></i>
                        		</span>
                        	</a>
                        </li>
                    <?php
                        endif;
                        if( !empty( $linkedin ) ) :
                    ?>
                        <li class="linkedin-link">
                        	<a href="<?php echo esc_attr( esc_url( $linkedin ) ); ?>" class="clearfix">
                        		<?php esc_html_e( 'Linked In', 'royale-news'); ?>
                        		<span class="social-icon">
                        			<i class="fa fa-linkedin"></i>
                        		</span>
                        	</a>
                        </li>
                    <?php
                        endif;
                        if( !empty( $youtube ) ) :
                    ?>
                        <li class="youtube-link">
                        	<a href="<?php echo esc_attr( esc_url( $youtube ) ); ?>" class="clearfix">
                        		<?php esc_html_e( 'Youtube', 'royale-news'); ?>
                        		<span class="social-icon">
                        			<i class="fa fa-youtube"></i>
                        		</span>
                       		</a>
                       	</li>
                    <?php
                        endif;
                    ?>
                </ul>
            </div>
            <?php
            echo $args['after_widget'];

        }

        function update( $new_instance, $old_instance ) {
            $instance = $old_instance;

            $instance[ 'title' ]        = sanitize_text_field( $new_instance[ 'title' ] );
            $instance[ 'facebook' ]     = esc_url_raw( $new_instance[ 'facebook' ] );
            $instance[ 'twitter' ]      = esc_url_raw( $new_instance[ 'twitter' ] );
            $instance[ 'google_plus' ]  = esc_url_raw( $new_instance[ 'google_plus' ] );
            $instance[ 'instagram' ]    = esc_url_raw( $new_instance[ 'instagram' ] );
            $instance[ 'linkedin' ]    	= esc_url_raw( $new_instance[ 'linkedin' ] );
            $instance[ 'youtube' ]      = esc_url_raw( $new_instance[ 'youtube' ] );

            return $instance;
        }

        function form( $instance ) {

            $instance = wp_parse_args( (array) $instance, array(
                'title'         => '',
                'facebook'      => '',
                'twitter'       => '',
                'google_plus'   => '',
                'instagram'     => '',
                'linkedin'     	=> '',
                'youtube'       => '',

            ) );
            ?>
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>">
                    <strong><?php esc_html_e( 'Title: ', 'royale-news' ); ?></strong>
                </label>
                <input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>">
            </p>

            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'facebook' ) ); ?>">
                    <strong><?php esc_html_e( 'Facebook Link:', 'royale-news' ); ?></strong>
                </label>
                <input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'facebook' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'facebook' ) ); ?>" value="<?php echo esc_attr( $instance['facebook'] ); ?>">
            </p>

            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'twitter' ) ); ?>">
                    <strong><?php esc_html_e( 'Twitter Link:', 'royale-news' ); ?></strong>
                </label>
                <input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'twitter' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'twitter' ) ); ?>" value="<?php echo esc_attr( $instance['twitter'] ); ?>">
            </p> 

            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'google_plus' ) ); ?>">
                    <strong><?php esc_html_e( 'Google Plus Link:', 'royale-news' ); ?></strong>
                </label>
                <input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'google_plus' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'google_plus' ) ); ?>" value="<?php echo esc_attr( $instance['google_plus'] ); ?>">
            </p>

            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'instagram' ) ); ?>">
                    <strong><?php esc_html_e( 'Instagram Link:', 'royale-news' ); ?></strong>
                </label>
                <input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'instagram' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'instagram' ) ); ?>" value="<?php echo esc_attr( $instance['instagram'] ); ?>">
            </p> 

            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'linkedin' ) ); ?>">
                    <strong><?php esc_html_e( 'linkedin Link:', 'royale-news' ); ?></strong>
                </label>
                <input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'linkedin' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'linkedin' ) ); ?>" value="<?php echo esc_attr( $instance['linkedin'] ); ?>">
            </p>

            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'youtube' ) ); ?>">
                    <strong><?php esc_html_e( 'Youtube Link:', 'royale-news' ); ?></strong>
                </label>
                <input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'youtube' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'youtube' ) ); ?>" value="<?php echo esc_attr( $instance['youtube'] ); ?>">
            </p>           
            <?php
        }
    }

endif;