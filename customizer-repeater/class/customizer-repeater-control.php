<?php
if ( class_exists( 'WP_Customize_Control' ) ) {
	return null;
}

class Customizer_Repeater extends WP_Customize_Control {

	public $id;
	private $boxtitle = array();
	private $customizer_repeater_image_control = false;
	private $customizer_repeater_icon_control = false;
	private $customizer_repeater_title_control = false;
	private $customizer_repeater_subtitle_control = false;
	private $customizer_repeater_text_control = false;
	private $customizer_repeater_link_control = false;
	private $customizer_repeater_shortcode_control = false;
	private $customizer_repeater_repeater_control = false;

	/*Class constructor*/
	public function __construct( $manager, $id, $args = array() ) {
		parent::__construct( $manager, $id, $args );
		/*Get options from customizer.php*/
		$this->boxtitle   = __('Cusomizer Repeater','switch-lite');
		if ( ! empty( $this->label ) ){
			$this->boxtitle = $this->label;
		}

		if ( ! empty( $args['customizer_repeater_image_control'] ) ) {
			$this->customizer_repeater_image_control = $args['customizer_repeater_image_control'];
		}

		if ( ! empty( $args['customizer_repeater_icon_control'] ) ) {
			$this->customizer_repeater_icon_control = $args['customizer_repeater_icon_control'];
		}

		if ( ! empty( $args['customizer_repeater_title_control'] ) ) {
			$this->customizer_repeater_title_control = $args['customizer_repeater_title_control'];
		}

		if ( ! empty( $args['customizer_repeater_subtitle_control'] ) ) {
			$this->customizer_repeater_subtitle_control = $args['customizer_repeater_subtitle_control'];
		}

		if ( ! empty( $args['customizer_repeater_text_control'] ) ) {
			$this->customizer_repeater_text_control = $args['customizer_repeater_text_control'];
		}

		if ( ! empty( $args['customizer_repeater_link_control'] ) ) {
			$this->customizer_repeater_link_control = $args['customizer_repeater_link_control'];
		}

		if ( ! empty( $args['customizer_repeater_shortcode_control'] ) ) {
			$this->customizer_repeater_shortcode_control = $args['customizer_repeater_shortcode_control'];
		}

		if ( ! empty( $args['customizer_repeater_repeater_control'] ) ) {
			$this->customizer_repeater_repeater_control = $args['customizer_repeater_repeater_control'];
		}

		if ( ! empty( $args['id'] ) ) {
			$this->id = $args['id'];
		}
	}

	/*Enqueue resources for the control*/
	public function enqueue() {
		wp_enqueue_style( 'customizer-repeater-font-awesome', 
			 plugins_url('/css/font-awesome.min.css',  __FILE__ ));

		wp_enqueue_style( 'customizer-repeater-admin-stylesheet', 
			plugins_url('/css/admin-style.css',  __FILE__ ));

		wp_enqueue_script( 'customizer-repeater-script', 
			 plugins_url('/js/customizer_repeater.js',  __FILE__ ), array('jquery'), '1.0.1', true);

		wp_enqueue_script( 'customizer-repeater-fontawesome-iconpicker',
			 plugins_url('/js/fontawesome-iconpicker.min.js',  __FILE__ ), array('jquery'), '1.0.0', true);

		wp_enqueue_script( 'customizer-repeater-iconpicker-control',
			 plugins_url('/js/iconpicker-control.js',  __FILE__ ), array('jquery'), '1.0.0', true);

		wp_enqueue_style( 'customizer-repeater-fontawesome-iconpicker-script',
			plugins_url('/css/fontawesome-iconpicker.min.css',  __FILE__ ));
	}

	public function render_content() {

		/*Get default options*/
		$this_default = json_decode( $this->setting->default );

		/*Get values (json format)*/
		$values = $this->value();

		/*Decode values*/
		$json = json_decode( $values );

		if ( ! is_array( $json ) ) {
			$json = array( $values );
		} ?>

		<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
		<div class="customizer-repeater-general-control-repeater customizer-repeater-general-control-droppable">
			<?php
			if ( ( count( $json ) == 1 && '' === $json[0] ) || empty( $json ) ) {
				if ( ! empty( $this_default ) ) {
					$this->iterate_array( $this_default ); ?>
					<input type="hidden"
					       id="customizer-repeater-<?php echo $this->id; ?>-colector" <?php $this->link(); ?>
					       class="customizer-repeater-colector"
					       value="<?php echo esc_textarea( json_encode( $this_default ) ); ?>"/>
					<?php
				} else {
					$this->iterate_array(); ?>
					<input type="hidden"
					       id="customizer-repeater-<?php echo $this->id; ?>-colector" <?php $this->link(); ?>
					       class="customizer-repeater-colector"/>
					<?php
				}
			} else {
				$this->iterate_array( $json ); ?>
				<input type="hidden" id="customizer-repeater-<?php echo $this->id; ?>-colector" <?php $this->link(); ?>
				       class="customizer-repeater-colector" value="<?php echo esc_textarea( $this->value() ); ?>"/>
				<?php
			} ?>
			</div>
		<button type="button" class="button add_field customizer-repeater-new-field">
			<?php esc_html_e( 'Add New Field', 'switch-lite' ); ?>
		</button>
		<?php
	}

	private function iterate_array($array = array()){
		/*Counter that helps checking if the box is first and should have the delete button disabled*/
		$it = 0;
		if(!empty($array)){
			foreach($array as $icon){ ?>
				<div class="customizer-repeater-general-control-repeater-container customizer-repeater-draggable">
					<div class="customizer-repeater-customize-control-title">
						<?php echo esc_html( $this->boxtitle); ?>
					</div>
					<div class="customizer-repeater-box-content-hidden">
						<?php
						$choice = $image_url = $icon_value = $title = $subtitle = $text = $link = $shortcode = $repeater = '';
						if(!empty($icon->choice)){
							$choice = $icon->choice;
						}
						if(!empty($icon->image_url)){
							$image_url = $icon->image_url;
						}
						if(!empty($icon->icon_value)){
							$icon_value = $icon->icon_value;
						}
						if(!empty($icon->title)){
							$title = $icon->title;
						}
						if(!empty($icon->subtitle)){
							$subtitle =  $icon->subtitle;
						}
						if(!empty($icon->text)){
							$text = $icon->text;
						}
						if(!empty($icon->link)){
							$link = $icon->link;
						}
						if(!empty($icon->shortcode)){
							$shortcode = $icon->shortcode;
						}

						if(!empty($icon->social_repeater)){
							$repeater = $icon->social_repeater;
						}

						if($this->customizer_repeater_image_control == true && $this->customizer_repeater_icon_control == true) {
							$this->icon_type_choice( $choice );
						}
						if($this->customizer_repeater_image_control == true){
							$this->image_control($image_url, $choice);
						}
						if($this->customizer_repeater_icon_control == true){
							$this->icon_picker_control($icon_value, $choice);
						}
						if($this->customizer_repeater_title_control==true){
							$this->input_control(array(
								'label' => __('Title','switch-lite'),
								'class' => 'customizer-repeater-title-control',
							), $title);
						}
						if($this->customizer_repeater_subtitle_control==true){
							$this->input_control(array(
								'label' => __('Subtitle','switch-lite'),
								'class' => 'customizer-repeater-subtitle-control',
							), $subtitle);
						}
						if($this->customizer_repeater_text_control==true){
							$this->input_control(array(
								'label' => __('Text','switch-lite'),
								'class' => 'customizer-repeater-text-control',
								'type'  => 'textarea'
							), $text);
						}
						if($this->customizer_repeater_link_control){
							$this->input_control(array(
								'label' => __('Link','switch-lite'),
								'class' => 'customizer-repeater-link-control',
								'sanitize_callback' => 'esc_url'
							), $link);
						}
						if($this->customizer_repeater_shortcode_control==true){
							$this->input_control(array(
								'label' => __('Shortcode','switch-lite'),
								'class' => 'customizer-repeater-shortcode-control',
							), $shortcode);
						}
						if($this->customizer_repeater_repeater_control==true){
							$this->repeater_control($repeater);
						} ?>

						<input type="hidden" class="social-repeater-box-id" value="<?php if ( ! empty( $this->id ) ) {
							echo esc_attr( $this->id );
						} ?>">
						<button type="button" class="social-repeater-general-control-remove-field button" <?php if ( $it == 0 ) {
							echo 'style="display:none;"';
						} ?>>
							<?php esc_html_e( 'Delete field', 'switch-lite' ); ?>
						</button>

					</div>
				</div>

				<?php
				$it++;
			}
		} else { ?>
			<div class="customizer-repeater-general-control-repeater-container">
				<div class="customizer-repeater-customize-control-title">
					<?php echo esc_html( $this->boxtitle); ?>
				</div>
				<div class="customizer-repeater-box-content-hidden">
					<?php
					if ( $this->customizer_repeater_image_control == true && $this->customizer_repeater_icon_control == true ) {
						$this->icon_type_choice();
					}
					if ( $this->customizer_repeater_image_control == true ) {
						$this->image_control();
					}
					if ( $this->customizer_repeater_icon_control == true ) {
						$this->icon_picker_control();
					}
					if ( $this->customizer_repeater_title_control == true ) {
						$this->input_control( array(
							'label' => __( 'Title', 'switch-lite' ),
							'class' => 'customizer-repeater-title-control',
						) );
					}
					if ( $this->customizer_repeater_subtitle_control == true ) {
						$this->input_control( array(
							'label' => __( 'Subtitle', 'switch-lite' ),
							'class' => 'customizer-repeater-subtitle-control'
						) );
					}
					if ( $this->customizer_repeater_text_control == true ) {
						$this->input_control( array(
							'label' => __( 'Text', 'switch-lite' ),
							'class' => 'customizer-repeater-text-control',
							'type'  => 'textarea'
						) );
					}
					if ( $this->customizer_repeater_link_control == true ) {
						$this->input_control( array(
							'label' => __( 'Link', 'switch-lite' ),
							'class' => 'customizer-repeater-link-control'
						) );
					}
					if ( $this->customizer_repeater_shortcode_control == true ) {
						$this->input_control( array(
							'label' => __( 'Shortcode', 'switch-lite' ),
							'class' => 'customizer-repeater-shortcode-control'
						) );
					}
					if($this->customizer_repeater_repeater_control==true){
						$this->repeater_control();
					} ?>
					<input type="hidden" class="social-repeater-box-id">
					<button type="button" class="social-repeater-general-control-remove-field button" style="display:none;">
						<?php esc_html_e( 'Delete field', 'switch-lite' ); ?>
					</button>
				</div>
			</div>
			<?php
		}
	}

	private function input_control( $options, $value='' ){ ?>
		<span class="customize-control-title"><?php echo $options['label']; ?></span>
		<?php
		if( !empty($options['type']) && $options['type'] === 'textarea' ){ ?>
			<textarea class="<?php echo esc_attr($options['class']); ?>" placeholder="<?php echo $options['label']; ?>"><?php echo ( !empty($options['sanitize_callback']) ?  call_user_func_array( $options['sanitize_callback'], array( $value ) ) : esc_attr($value) ); ?></textarea>
			<?php
		} else { ?>
			<input type="text" value="<?php echo ( !empty($options['sanitize_callback']) ?  call_user_func_array( $options['sanitize_callback'], array( $value ) ) : esc_attr($value) ); ?>" class="<?php echo esc_attr($options['class']); ?>" placeholder="<?php echo $options['label']; ?>"/>
			<?php
		}
	}

	private function icon_picker_control($value = '', $show = ''){ ?>
		<div class="social-repeater-general-control-icon" <?php if( $show === 'customizer_repeater_image' || $show === 'customizer_repeater_none' ) { echo 'style="display:none;"'; } ?>>
            <span class="customize-control-title">
                <?php esc_html_e('Icon','switch-lite'); ?>
            </span>
			<span class="description customize-control-description">
                <?php
                echo sprintf(
	                __( 'Note: Some icons may not be displayed here. You can see the full list of icons at %1$s', 'switch-lite' ),
	                sprintf( '<a href="http://fontawesome.io/icons/" rel="nofollow">%s</a>', esc_html__( 'http://fontawesome.io/icons/', 'switch-lite' ) )
                ); ?>
            </span>
			<div class="input-group icp-container">
				<input data-placement="bottomRight" class="icp icp-auto" value="<?php if(!empty($value)) { echo esc_attr( $value );} ?>" type="text">
				<span class="input-group-addon"></span>
			</div>
		</div>
		<?php
	}

	private function image_control($value = '', $show = ''){ ?>
		<div class="customizer-repeater-image-control" <?php if( $show === 'customizer_repeater_icon' || $show === 'customizer_repeater_none' ) { echo 'style="display:none;"'; } ?>>
            <span class="customize-control-title">
                <?php esc_html_e('Image','switch-lite')?>
            </span>
			<input type="text" class="widefat custom-media-url" value="<?php echo esc_attr( $value ); ?>">
			<input type="button" class="button button-primary customizer-repeater-custom-media-button" value="<?php esc_html_e('Upload Image','switch-lite'); ?>" />
		</div>
		<?php
	}

	private function icon_type_choice($value='customizer_repeater_icon'){ ?>
		<span class="customize-control-title">
            <?php esc_html_e('Image type','switch-lite');?>
        </span>
		<select class="customizer-repeater-image-choice">
			<option value="customizer_repeater_icon" <?php selected($value,'customizer_repeater_icon');?>><?php esc_html_e('Icon','switch-lite'); ?></option>
			<option value="customizer_repeater_image" <?php selected($value,'customizer_repeater_image');?>><?php esc_html_e('Image','switch-lite'); ?></option>
			<option value="customizer_repeater_none" <?php selected($value,'customizer_repeater_none');?>><?php esc_html_e('None','switch-lite'); ?></option>
		</select>
		<?php
	}

	private function repeater_control($value = ''){
		$social_repeater = array();
		$show_del        = 0; ?>
		<span class="customize-control-title"><?php esc_html_e( 'Social icons', 'switch-lite' ); ?></span>
		<?php
		if(!empty($value)) {
			$social_repeater = json_decode( html_entity_decode( $value ), true );
		}
		if ( ( count( $social_repeater ) == 1 && '' === $social_repeater[0] ) || empty( $social_repeater ) ) { ?>
			<div class="customizer-repeater-social-repeater">
				<div class="customizer-repeater-social-repeater-container">
					<div class="customizer-repeater-rc input-group icp-container">
						<input data-placement="bottomRight" class="icp icp-auto" value="<?php if(!empty($value)) { echo esc_attr( $value ); } ?>" type="text">
						<span class="input-group-addon"></span>
					</div>

					<input type="text" class="customizer-repeater-social-repeater-link"
					       placeholder="<?php esc_html_e( 'Link', 'switch-lite' ); ?>">
					<input type="hidden" class="customizer-repeater-social-repeater-id" value="">
					<button class="social-repeater-remove-social-item" style="display:none">
						<?php esc_html_e( 'X', 'switch-lite' ); ?>
					</button>
				</div>
				<input type="hidden" id="social-repeater-socials-repeater-colector" class="social-repeater-socials-repeater-colector" value=""/>
			</div>
			<button class="social-repeater-add-social-item"><?php esc_html_e( 'Add icon', 'switch-lite' ); ?></button>
			<?php
		} else { ?>
			<div class="customizer-repeater-social-repeater">
				<?php
				foreach ( $social_repeater as $social_icon ) {
					$show_del ++; ?>
					<div class="customizer-repeater-social-repeater-container">
						<div class="customizer-repeater-rc input-group icp-container">
							<input data-placement="bottomRight" class="icp icp-auto" value="<?php if( !empty($social_icon['icon']) ) { echo esc_attr( $social_icon['icon'] ); } ?>" type="text">
							<span class="input-group-addon"></span>
						</div>
						<input type="text" class="customizer-repeater-social-repeater-link"
						       placeholder="<?php esc_html_e( 'Link', 'switch-lite' ); ?>"
						       value="<?php if ( ! empty( $social_icon['link'] ) ) {
							       echo esc_url( $social_icon['link'] );
						       } ?>">
						<input type="hidden" class="customizer-repeater-social-repeater-id"
						       value="<?php if ( ! empty( $social_icon['id'] ) ) {
							       echo esc_attr( $social_icon['id'] );
						       } ?>">
						<button class="social-repeater-remove-social-item"
						        style="<?php if ( $show_del == 1 ) {
							        echo "display:none";
						        } ?>"><?php esc_html_e( 'X', 'switch-lite' ); ?></button>
					</div>
					<?php
				} ?>
				<input type="hidden" id="social-repeater-socials-repeater-colector"
				       class="social-repeater-socials-repeater-colector"
				       value="<?php echo esc_textarea( html_entity_decode( $value ) ); ?>" />
			</div>
			<button class="social-repeater-add-social-item"><?php esc_html_e( 'Add icon', 'switch-lite' ); ?></button>
			<?php
		}
	}
}