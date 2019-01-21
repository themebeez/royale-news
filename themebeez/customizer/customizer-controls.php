<?php

if( class_exists( 'WP_Customize_Control' ) ) :
	/**
	 * Class Royale_News_Theme_Customize_Dropdown_Taxonomies_Control
	 */
	class Royale_News_Dropdown_Taxonomies_Control extends WP_Customize_Control {

	  public $type = 'dropdown-taxonomies';

	  public $taxonomy = '';


	  public function __construct( $manager, $id, $args = array() ) {

	    $our_taxonomy = 'category';
	    if ( isset( $args['taxonomy'] ) ) {
	      $taxonomy_exist = taxonomy_exists( esc_attr( $args['taxonomy'] ) );
	      if ( true === $taxonomy_exist ) {
	        $our_taxonomy = esc_attr( $args['taxonomy'] );
	      }
	    }
	    $args['taxonomy'] = $our_taxonomy;
	    $this->taxonomy = esc_attr( $our_taxonomy );

	    parent::__construct( $manager, $id, $args );
	  }

	  public function render_content() {

	    $tax_args = array(
	      'hierarchical' => 0,
	      'taxonomy'     => $this->taxonomy,
	    );
	    $all_taxonomies = get_categories( $tax_args );

	    ?>
	    <label>
	      <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
	         <select <?php echo esc_attr( $this->link() ); ?>>
	            <?php
	              printf('<option value="%s" %s>%s</option>', '', selected($this->value(), '', false),esc_html__('Select', 'royale-news') );
	             ?>
	            <?php if ( ! empty( $all_taxonomies ) ): ?>
	              <?php foreach ( $all_taxonomies as $key => $tax ): ?>
	                <?php
	                  printf('<option value="%s" %s>%s</option>', esc_attr( $tax->term_id ), selected($this->value(), $tax->term_id, false), esc_html( $tax->name ) );
	                 ?>
	              <?php endforeach ?>
	           <?php endif ?>
	         </select>

	    </label>
	    <?php
	  }
	}

	/**
     * Class Royale_News_Dropdown_Multiple_Chooser
     */
	class Royale_News_Dropdown_Multiple_Chooser extends WP_Customize_Control{
        public $type = 'dropdown_multiple_chooser';
        public $placeholder = '';

        public function __construct($manager, $id, $args = array()){

            parent::__construct( $manager, $id, $args );
        }

        public function render_content(){
            if ( empty( $this->choices ) )
                    return;
            ?>
                <label>
                    <span class="customize-control-title">
                        <?php echo esc_html( $this->label ); ?>
                    </span>

                    <?php if($this->description){ ?>
                        <span class="description customize-control-description">
                        <?php echo wp_kses_post($this->description); ?>
                        </span>
                    <?php } ?>
                    <select multiple="multiple" class="hs-chosen-select" <?php $this->link(); ?>>
                        <?php
                        foreach ( $this->choices as $value => $label ){
                            $selected = '';
                            if( $value == $this->value() ) {
                                $selected = 'selected="selected"';
                            }
                            echo '<option value="' . esc_attr( $value ) . '"' . esc_attr( $selected ) . '>' . esc_html($label) . '</option>';
                        }
                        ?>
                    </select>
                </label>
            <?php
        }
    }
endif;
