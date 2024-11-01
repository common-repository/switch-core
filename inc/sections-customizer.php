<?php
	/**
 * Register core customizer.
 */

function switch_core_customize_register( $wp_customize ) {

    $wp_customize->add_panel( 'panel_id', array(
        'priority'        => 90,
        'capability'      => 'edit_theme_options',
        'theme_supports'  => '',
        'title'           => esc_html__( 'Switch Page Sections', 'switch-core' ),
        'description'     => esc_html__( 'Switch page sections', 'switch-core' ),

    	) 
    );



    // Plugin Primary color
    $wp_customize->add_section( 'colors', array(
          'priority'       => 40,
          'capability'     => 'edit_theme_options',
          'theme_supports' => '',
          'description'    => '',
          'panel'          => 'panel_id',
      )
    );

    //Slider title Color//
    $wp_customize->add_setting(
        'plugin_primary_color',
        array(
            'default' => '#51BBE5',
            'sanitize_callback' => 'sanitize_hex_color',
            'transport'   => 'refresh'
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'plugin_primary_color',
            array(
               'label'    => esc_html__( 'Plugin Primary Color', 'switch-core' ),
               'type'     => 'color',
               'section'  => 'colors',
               'settings' => 'plugin_primary_color',
               'priority' => 90,
            )
        )
    );
 
    // Slider section
    $wp_customize->add_section( 'section_slider', array(
          'priority'       => 90,
          'capability'     => 'edit_theme_options',
          'theme_supports' => '',
          'title'          => esc_html__( 'Slider', 'switch-core' ),
          'description'    => '',
          'panel'          => 'panel_id',
      )
    );


	// Slider section eveable
	$wp_customize->add_setting( 'slider_enable', array(
	          'capability'        => 'edit_theme_options',
	          'transport'   => 'refresh',
	          'default'           => 'enable',
	          'sanitize_callback' => 'esc_url',
	    ) 
	 );

	$wp_customize->add_control( 'slider_enable', array(
	    'priority'    => 90,
	    'section'     => 'section_slider',
	    'label'       => esc_html__( 'Slider Enable/Disable', 'switch-core' ),
	    'description' => '',
	    'type'        => 'checkbox',
	    'std'         => '1'

	) );

	// Slider Overlay Color//
    $wp_customize->add_setting(
        'overlay_color',
        array(
            'default' => 'rgba(27, 30, 39, 0.9)',
            'sanitize_callback' => 'sanitize_hex_color',
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'overlay_color',
            array(
               'label'    => esc_html__( 'Overlay Color', 'switch-core' ),
               'type'     => 'color',
               'section'  => 'section_slider',
               'settings' => 'overlay_color',
               'priority' => 90,
            )
        )
    );


	// Slider customizer //
	$wp_customize->add_setting( 'slider_repeater', 
	    array(
           'sanitize_callback' => 'customizer_repeater_sanitize',
              'default' => json_encode(

              array(  
                array(  
                  'image_url' => plugins_url('/assets/images/demo-bg.jpg',  __FILE__ ),
                  'title'     => esc_html__( 'Welcome to Switch Plugin', 'switch-core' ),
                  'subtitle'  => esc_html__( 'We must understand what your needs are in order to offer.', 'switch-core' ),
                  'text'      => esc_html__( 'Get Started', 'switch-core' ),
                  'link'      => esc_html__( 'https://themesgrove.com', 'switch-core' ),
                  'id'        => 'slider',
                ),
             array(  
                  'image_url' => plugins_url('/assets/images/demo-bg.jpg',  __FILE__ ),
                  'title'     => esc_html__( 'We must understand what your needs are in order to offer.', 'switch-core' ),
                  'text'      => esc_html__( 'Get Started', 'switch-core' ),
                  'link'      => esc_html__( 'https://themesgrove.com', 'switch-core' ),
                  'id'        => 'slider',
                ),
              )
            )
        )
    );


	$wp_customize->add_control( new Customizer_Repeater( $wp_customize, 'slider_repeater', 
	      array(
	          'label'    => esc_html__('Slider','switch-core'),
	          'section'  => 'section_slider',
	          'priority' => 90,
	          'customizer_repeater_image_control' => true,
	          'customizer_repeater_title_control' => true,
	          'customizer_repeater_subtitle_control' => true,
	          'customizer_repeater_link_control' => true,
	          'customizer_repeater_text_control' => true,
	         ) 
	      ) 
	);


	// Slider Ttile Font Size//
	$wp_customize->add_setting('title_font_size', array(
	    'default'     => esc_html__('48','switch-core'),
	    'sanitize_callback' => 'sanitize_text_field',
	    'transport'   => 'refresh'
	));
	$wp_customize->add_control( 'title_font_size', array(
	    'settings' => 'title_font_size',
	    'label'    =>  esc_html__('Title Font Size','switch-core'),
	    'section'  => 'section_slider',
	    'type'     => 'text',
	    'priority' => 90,
	));

	// Slider Ttile trnasform//
	$wp_customize->add_setting('title_transform', array(
	    'default'     => esc_html__('capitalize','switch-core'),
	    'sanitize_callback' => 'sanitize_text_field',
	    'transport'   => 'refresh'
	));
	$wp_customize->add_control( 'title_transform', array(
	    'settings' => 'title_transform',
	    'label'    =>  esc_html__('Title Transform','switch-core'),
	    'section'  => 'section_slider',
	    'type'     => 'select',
	    'priority' => 90,
	    'choices'  => array(
	      'uppercase'    => esc_html__('Uppercase','switch-core'),
	      'capitalize'   => esc_html__('Capitalize','switch-core'),
	      'lowercase'    => esc_html__('Lowercase','switch-core'),
	      
	    )
	));



    //Slider title Color//
    $wp_customize->add_setting(
        'title_color',
        array(
            'default' => '#fff',
            'sanitize_callback' => 'sanitize_hex_color',
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'title_color',
            array(
               'label'    => esc_html__( 'Title Color', 'switch-core' ),
               'type'     => 'color',
               'section'  => 'section_slider',
               'settings' => 'title_color',
               'priority' => 90,
            )
        )
    );

	// Slider Content Font Size//
	$wp_customize->add_setting('content_font_size', array(
	    'default'     => esc_html__('18','switch-core'),
	    'sanitize_callback' => 'sanitize_text_field',
	    'transport'   => 'refresh'
	));
	$wp_customize->add_control( 'content_font_size', array(
	    'settings' => 'content_font_size',
	    'label'    =>  esc_html__('Content Font Size','switch-core'),
	    'section'  => 'section_slider',
	    'type'     => 'text',
	    'priority' => 90,
	));



    // Slider Content Color//
    $wp_customize->add_setting(
        'content_color',
        array(
            'default' => '#fff',
            'sanitize_callback' => 'sanitize_hex_color',
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'content_color',
            array(
               'label'    => esc_html__( 'Content Color', 'switch-core' ),
               'type'     => 'color',
               'section'  => 'section_slider',
               'settings' => 'content_color',
               'priority' => 90,
            )
        )
    );

    // Slider button Color//
    $wp_customize->add_setting(
        'btn_border_color',
        array(
            'default' => '#fff',
            'sanitize_callback' => 'sanitize_hex_color',
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'btn_order_color',
            array(
               'label'    => esc_html__( 'Button Text Color', 'switch-core' ),
               'type'     => 'color',
               'section'  => 'section_slider',
               'settings' => 'btn_border_color',
               'priority' => 90,
            )
        )
    );



    // Slider button hover border Color//
    $wp_customize->add_setting(
        'btn_hover_border_color',
        array(
            'default' => '#fff',
            'sanitize_callback' => 'sanitize_hex_color',
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'btn_hover_order_color',
            array(
               'label'    => esc_html__( 'Button Hover Border/Text Color', 'switch-core' ),
               'type'     => 'color',
               'section'  => 'section_slider',
               'settings' => 'btn_hover_border_color',
               'priority' => 90,
            )
        )
    );





        // Feature Section Start


    // Feature section //
    $wp_customize->add_section( 'section_feature', array(
            'priority'       => 90,
            'capability'     => 'edit_theme_options',
            'theme_supports' => '',
            'title'          => esc_html__( 'Feature', 'switch-core' ),
            'description'    => '',
            'panel'          => 'panel_id',
        )
    );


    // Feature Enable Dissble //
    $wp_customize->add_setting( 'feature_enable', array(
            'capability'        => 'edit_theme_options',
            'transport'   => 'refresh',
            'default'           => 'enable',
            'sanitize_callback' => 'esc_url',
        ) 
      );

    $wp_customize->add_control( 'feature_enable', array(
        'priority'          => 90,
        'section'           => 'section_feature',
        'label'             => esc_html__( 'Feature Enable/Disable', 'switch-core' ),
        'description'       => '',
        'type'    => 'checkbox',
        'std'     => '1'

    ) );


    // Feature Section background color //
    $wp_customize->add_setting(
        'section_bg_color',
        array(
            'default' => '#f9f9f9',
            'sanitize_callback' => 'sanitize_hex_color',
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'section_bg_color',
            array(
               'label'    => esc_html__( 'Section Bg Color', 'switch-core' ),
               'type'     => 'color',
               'section'  => 'section_feature',
               'settings' => 'section_bg_color',
               'priority' => 90,
            )
        )
    );


	// Feature Section Title //
	$wp_customize->add_setting('feature_title', array(
	    'default'     => esc_html__('Our Front End Feature','switch-core'),
	    'sanitize_callback' => 'sanitize_text_field',
	    'transport'   => 'refresh'
	));
	$wp_customize->add_control( 'feature_title', array(
	    'settings' => 'feature_title',
	    'label'    =>  esc_html__('Section Title','switch-core'),
	    'section'  => 'section_feature',
	    'type'     => 'textarea',
	    'priority' => 90,
	));


	// Feature Section Description //
	$wp_customize->add_setting('feature_desc', array(
	    'default'     => 'Our first step is targeted towards understanding. We must understand what your needs are in order to offer.',
	    'sanitize_callback' => 'sanitize_text_field',
	    'transport'   => 'refresh'
	));
	$wp_customize->add_control( 'feature_desc', array(
	    'settings' => 'feature_desc',
	    'label'    =>  esc_html__('Section Description','switch-core'),
	    'section'  => 'section_feature',
	    'type'     => 'textarea',
	    'priority' => 90,

    ));

    // Feature Section title content color //
    $wp_customize->add_setting(
        'feature_section_title_color',
        array(
            'default' => '#3a3a3a',
            'sanitize_callback' => 'sanitize_hex_color',
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'feature_section_title_color',
            array(
               'label'    => esc_html__( 'Section Title/Subtitle Color', 'switch-core' ),
               'type'     => 'color',
               'section'  => 'section_feature',
               'settings' => 'feature_section_title_color',
               'priority' => 90,
            )
        )
    );


    // Feature Ttile trnasform//
	$wp_customize->add_setting('feature_section_transform', array(
	    'default'     => esc_html__('capitalize','switch-core'),
	    'sanitize_callback' => 'sanitize_text_field',
	    'transport'   => 'refresh'
	));
	$wp_customize->add_control( 'feature_section_transform', array(
	    'settings' => 'feature_section_transform',
	    'label'    =>  esc_html__('Section Transform','switch-core'),
	    'section'  => 'section_feature',
	    'type'     => 'select',
	    'priority' => 90,
	    'choices'  => array(
	      'uppercase'    => esc_html__('Uppercase','switch-core'),
	      'capitalize'   => esc_html__('Capitalize','switch-core'),
	      'lowercase'    => esc_html__('Lowercase','switch-core'),
	      
	    )
	));



    // Feature Repeater //
    $wp_customize->add_setting( 'feature_repeater', 
        array(
           'sanitize_callback' => 'customizer_repeater_sanitize',
              'default' => json_encode(

              array(  
                array(  
                  'image_url' => plugins_url('/assets/images/icon-demo.png',  __FILE__ ),
                  'title'  => esc_html__( 'Developer', 'switch-core' ),
                  'text'   => esc_html__( 'Nulla quis lorem ut libero malesuada feugiat. Nulla porttitor accumsan tincidunt. Vivamus magna justo, lacinia eget consectetur sed, convallis at tellus.', 'switch-core' ),
                  'id'      => 'feature',
                ),

                array(  
                  'image_url' => plugins_url('/assets/images/icon-demo.png',  __FILE__ ),
                  'title'  => esc_html__( 'Partnership', 'switch-core' ),
                  'text'   => esc_html__( 'Nulla quis lorem ut libero malesuada feugiat. Nulla porttitor accumsan tincidunt. Vivamus magna justo, lacinia eget consectetur sed, convallis at tellus.', 'switch-core' ),
                ),
                array(  
                  'image_url' => plugins_url('/assets/images/icon-demo.png',  __FILE__ ),
                  'title'  => esc_html__( 'Business Chic', 'switch-core' ),
                  'text'   => esc_html__( 'Nulla quis lorem ut libero malesuada feugiat. Nulla porttitor accumsan tincidunt. Vivamus magna justo, lacinia eget consectetur sed, convallis at tellus.', 'switch-core' ),
                ),

                array(  
                  'image_url' => plugins_url('/assets/images/icon-demo.png',  __FILE__ ),
                  'title'  => esc_html__( 'Design', 'switch-core' ),
                  'text'   => esc_html__( 'Nulla quis lorem ut libero malesuada feugiat. Nulla porttitor accumsan tincidunt. Vivamus magna justo, lacinia eget consectetur sed, convallis at tellus.', 'switch-core' ),
                ),

                array(  
                  'image_url' => plugins_url('/assets/images/icon-demo.png',  __FILE__ ),
                  'title'  => esc_html__( 'Web Development', 'switch-core' ),
                  'text'   => esc_html__( 'Nulla quis lorem ut libero malesuada feugiat. Nulla porttitor accumsan tincidunt. Vivamus magna justo, lacinia eget consectetur sed, convallis at tellus.', 'switch-core' ),
                ),

                array(  
                  'image_url' => plugins_url('/assets/images/icon-demo.png',  __FILE__ ),
                  'title'  => esc_html__( 'Discovery', 'switch-core' ),
                  'text'   => esc_html__( 'Nulla quis lorem ut libero malesuada feugiat. Nulla porttitor accumsan tincidunt. Vivamus magna justo, lacinia eget consectetur sed, convallis at tellus.', 'switch-core' ),
                ),
              )
            )
        )
    );
    $wp_customize->add_control( new Customizer_Repeater( $wp_customize, 'feature_repeater', 
      array(
          'label'    => esc_html__('Feature','switch-core'),
          'section'  => 'section_feature',
          'priority' => 90,
          'customizer_repeater_image_control' => true,
          'customizer_repeater_title_control' => true,
          'customizer_repeater_text_control' => true,
         ) 
      ) 
    );




	// Feature Ttile Font Size//
	$wp_customize->add_setting('feature_title_size', array(
	    'default'     => esc_html__('18','switch-core'),
	    'sanitize_callback' => 'sanitize_text_field',
	    'transport'   => 'refresh'
	));
	$wp_customize->add_control( 'feature_title_size', array(
	    'settings' => 'feature_title_size',
	    'label'    =>  esc_html__('Title Font Size','switch-core'),
	    'section'  => 'section_feature',
	    'type'     => 'text',
	    'priority' => 90,
	));


    // Feature item title content color //
    $wp_customize->add_setting(
        'feature_item_title_color',
        array(
            'default' => '#3a3a3a',
            'sanitize_callback' => 'sanitize_hex_color',
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'feature_item_title_color',
            array(
               'label'    => esc_html__( 'Title Color', 'switch-core' ),
               'type'     => 'color',
               'section'  => 'section_feature',
               'settings' => 'feature_item_title_color',
               'priority' => 90,
            )
        )
    );



	// feature Ttile trnasform//
	$wp_customize->add_setting('feature_title_transform', array(
	    'default'     => esc_html__('uppercase','switch-core'),
	    'sanitize_callback' => 'sanitize_text_field',
	    'transport'   => 'refresh'
	));
	$wp_customize->add_control( 'feature_title_transform', array(
	    'settings' => 'feature_title_transform',
	    'label'   =>  esc_html__('Title Transform','switch-core'),
	    'section' => 'section_feature',
	    'type'    => 'select',
	    'priority' => 90,
	    'choices' => array(
	      'uppercase'    => esc_html__('Uppercase','switch-core'),
	      'capitalize'   => esc_html__('Capitalize','switch-core'),
	      'lowercase'    => esc_html__('Lowercase','switch-core'),
	      
	    )
	));


    // Feature Item background color //
    $wp_customize->add_setting(
        'item_bg_color',
        array(
            'default' => '#fff',
            'sanitize_callback' => 'sanitize_hex_color',
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'item_bg_color',
            array(
               'label'          => esc_html__( 'Item Bg Color', 'switch-core' ),
               'type'           => 'color',
               'section'        => 'section_feature',
               'settings'       => 'item_bg_color',
               'priority' => 90,
            )
        )
    );



 	// Feature Shadow Image //
	$wp_customize->add_setting('shadow_bg', array(
	    'default'     => plugins_url('assets/images/shadow.png',  __FILE__ ),
	    'sanitize_callback' => 'sanitize_text_field',
	    'transport'   => 'refresh'
	  ));
	$wp_customize->add_control( new WP_Customize_Image_Control( 
	  $wp_customize, 'shadow_bg',
	      array(
	        'label'    => esc_html__( 'Item Shadow', 'switch-core' ),
	        'section'  => 'section_feature',
	        'settings' => 'shadow_bg',
	        'priority' => 90,
	    ) 
	  ) 
	);



        // About Section start


    // About section //
    $wp_customize->add_section( 'section_about', array(
          'priority'       => 90,
          'capability'     => 'edit_theme_options',
          'theme_supports' => '',
          'title'          => esc_html__( 'About', 'switch-core' ),
          'description'    => '',
          'panel'          => 'panel_id',
      )
    );


	// About Enable Dissble //
	$wp_customize->add_setting( 'about_enable', array(
	        'capability'     => 'edit_theme_options',
	       'transport'   => 'refresh',
	        'default'        => 'enable',
	        'sanitize_callback' => 'esc_url',
	    ) 
	);
	$wp_customize->add_control( 'about_enable', array(
	      'priority'          => 90,
	      'section'           => 'section_about',
	      'label'             => esc_html__( 'About Enable/Disable', 'switch-core' ),
	      'description'       => '',
	      'type'    => 'checkbox',
	      'std'     => '1'

	) );




	// About Section Background Image //
	$wp_customize->add_setting('about_section_bg', array(
	    'default'        => '',
	    'sanitize_callback' => 'sanitize_text_field',
	    'transport'   => 'refresh'
	));
	$wp_customize->add_control( new WP_Customize_Image_Control( 
	$wp_customize, 'about_section_bg',
	      array(
	        'label'    => esc_html__( 'Section Bg Image', 'switch-core' ),
	        'section'  => 'section_about',
	        'settings' => 'about_section_bg',
	        'priority'          => 90,
	    ) 
	  ) 
	);


	// About Section Title //
	$wp_customize->add_setting('about_title', array(
	    'default'        => esc_html__('About Us','switch-core'),
	    'sanitize_callback' => 'sanitize_text_field',
	    'transport'   => 'refresh'
	  ));
	$wp_customize->add_control( 'about_title', array(
	    'settings' => 'about_title',
	    'label'   =>  esc_html__('Section Title','switch-core'),
	    'section' => 'section_about',
	    'type'    => 'textarea',
	    'priority'          => 90,
	));



	$wp_customize->add_setting('about_desc', array(
	    'default'        => 'We must understand what your needs are in order to offer.',
	    'sanitize_callback' => 'sanitize_text_field',
	    'transport'   => 'refresh'
	));
	$wp_customize->add_control( 'about_desc', array(
	    'settings' => 'about_desc',
	    'label'    =>  esc_html__('Section Description','switch-core'),
	    'section'  => 'section_about',
	    'type'     => 'textarea',
	    'priority'          => 90,

	));

	// About section title/subtitle color //
	$wp_customize->add_setting(
        'about_section_title_color',
        array(
            'default' => '#fff',
            'sanitize_callback' => 'sanitize_hex_color',
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'about_section_title_color',
            array(
               'label'    => esc_html__( 'Section Title/Subtitle Color', 'switch-core' ),
               'type'     => 'color',
               'section'  => 'section_about',
               'settings' => 'about_section_title_color',
               'priority' => 90,
            )
        )
    );

    // About Ttile trnasform//
	$wp_customize->add_setting('about_section_transform', array(
	    'default'     => esc_html__('capitalize','switch-core'),
	    'sanitize_callback' => 'sanitize_text_field',
	    'transport'   => 'refresh'
	));
	$wp_customize->add_control( 'about_section_transform', array(
	    'settings' => 'about_section_transform',
	    'label'    =>  esc_html__('Section Transform','switch-core'),
	    'section'  => 'section_about',
	    'type'     => 'select',
	    'priority' => 90,
	    'choices'  => array(
	      'uppercase'    => esc_html__('Uppercase','switch-core'),
	      'capitalize'   => esc_html__('Capitalize','switch-core'),
	      'lowercase'    => esc_html__('Lowercase','switch-core'),
	      
	    )
	));



	// About Image //
	$wp_customize->add_setting('about_image', array(
	    'default'        => plugins_url('/assets/images/about-demo.jpg',  __FILE__ ),
	    'sanitize_callback' => 'sanitize_text_field',
	    'transport'   => 'refresh'
	  ));
	$wp_customize->add_control( new WP_Customize_Image_Control( 
	  $wp_customize, 'about_image',
	      array(
	        'label'    => esc_html__( 'About Image', 'switch-core' ),
	        'section'  => 'section_about',
	        'settings' => 'about_image',
	        'priority' => 90,
	    ) 
	  ) 
	);


	// Sub Title //
	$wp_customize->add_setting('about_sub_title', array(
	    'default'        => esc_html__('Little more about us','switch-core'),
	    'sanitize_callback' => 'sanitize_text_field',
	    'transport'   => 'refresh'
	  ));
	$wp_customize->add_control( 'about_sub_title', array(
	    'settings' => 'about_sub_title',
	    'label'    =>  esc_html__('Sub Title','switch-core'),
	    'section'  => 'section_about',
	    'type'     => 'textarea',
	    'priority' => 90,
	));


	// About us description  //
	$wp_customize->add_setting('about_sub_desc', array(
	    'default'  => 'Velit consectetur adipisicing elit. Laborum, obcaecati, veritatis, voluptatem perferendis ipsum optio mollitia culpa excepturi necessitatibus eveniet ad asperiores inventore aliquid. Velit.',
	    'sanitize_callback' => 'sanitize_text_field',
	    'transport'   => 'refresh'
	  ));
	$wp_customize->add_control( 'about_sub_desc', array(
	    'settings' => 'about_sub_desc',
	    'label'    =>  esc_html__('Sub Description','switch-core'),
	    'section'  => 'section_about',
	    'type'     => 'textarea',
	    'priority' => 90,

	));



    // Item color //
    $wp_customize->add_setting(
        'about_color',
        array(
            'default' => '#fff',
            'sanitize_callback' => 'sanitize_hex_color',
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'about_color',
            array(
               'label'      => esc_html__( 'Color', 'switch-core' ),
               'type'       => 'color',
               'section'    => 'section_about',
               'settings'   => 'about_color',
               'priority'   => 90,
            )
        )
    );





    // Testimonial section //
    $wp_customize->add_section( 'section_testimonial', array(
          'priority'       => 90,
          'capability'     => 'edit_theme_options',
          'theme_supports' => '',
          'title'          => esc_html__( 'Testimonial', 'switch-core' ),
          'description'    => '',
          'panel'          => 'panel_id',
      )
    );


    // Testimonial Enable Dissble //
	$wp_customize->add_setting( 'testimonial_enable', array(
	        'capability'      => 'edit_theme_options',
	        'transport'   => 'refresh',
	        'default'         => 'enable',
	        'sanitize_callback' => 'esc_url',
	    ) 
	  );

	$wp_customize->add_control( 'testimonial_enable', array(
	    'priority'          => 90,
	    'section'           => 'section_testimonial',
	    'label'             => esc_html__( 'Testimonial Enable/Disable', 'switch-core' ),
	    'description'       => '',
	    'type'    => 'checkbox',
	    'std'         => '1'

	) );


	// Section Background Image //
	$wp_customize->add_setting('testimonial_section_bg', array(
	    'default'        =>'',
	    'sanitize_callback' => 'sanitize_text_field',
	    'transport'   => 'refresh'
	  ));
	$wp_customize->add_control( new WP_Customize_Image_Control( 
	  $wp_customize, 'testimonial_section_bg',
	      array(
	        'label'    => esc_html__( 'Section Bg Image', 'switch-core' ),
	        'section'  => 'section_testimonial',
	        'settings' => 'testimonial_section_bg',
	        'priority' => 90,
	    ) 
	  ) 
	);

	// Testimonial section title
	$wp_customize->add_setting('testimonial_title', array(
	    'default'     => esc_html__('Clients Testimonials','switch-core'),
	    'sanitize_callback' => 'sanitize_text_field',
	    'transport'   => 'refresh'
	));
	$wp_customize->add_control( 'testimonial_title', array(
	    'settings' => 'testimonial_title',
	    'label'    =>  esc_html__('Section Title','switch-core'),
	    'section'  => 'section_testimonial',
	    'type'     => 'textarea',
	    'priority' => 90,
	));


	// Testimonial section desc
	$wp_customize->add_setting('testimonial_desc', array(
	    'default'     => '',
	    'sanitize_callback' => 'sanitize_text_field',
	    'transport'   => 'refresh'
	));
	$wp_customize->add_control( 'testimonial_desc', array(
	    'settings' => 'testimonial_desc',
	    'label'    =>  esc_html__('Section Description','switch-core'),
	    'section'  => 'section_testimonial',
	    'type'     => 'textarea',
	    'priority' => 90,

	));

    // Testimonial Section title/sub color //
    $wp_customize->add_setting(
        'testimonial_section_title_color',
        array(
            'default' => '#fff',
            'sanitize_callback' => 'sanitize_hex_color',
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'testimonial_section_title_color',
            array(
               'label'    => esc_html__( 'Section Title/Subtitle Color', 'switch-core' ),
               'type'     => 'color',
               'section'  => 'section_testimonial',
               'settings' => 'testimonial_section_title_color',
               'priority' => 90,
            )
        )
    );


    // Testimonial Ttile trnasform//
	$wp_customize->add_setting('testimonial_section_transform', array(
	    'default'     => esc_html__('capitalize','switch-core'),
	    'sanitize_callback' => 'sanitize_text_field',
	    'transport'   => 'refresh'
	));
	$wp_customize->add_control( 'testimonial_section_transform', array(
	    'settings' => 'testimonial_section_transform',
	    'label'    =>  esc_html__('Section Transform','switch-core'),
	    'section'  => 'section_testimonial',
	    'type'     => 'select',
	    'priority' => 90,
	    'choices'  => array(
	      'uppercase'    => esc_html__('Uppercase','switch-core'),
	      'capitalize'   => esc_html__('Capitalize','switch-core'),
	      'lowercase'    => esc_html__('Lowercase','switch-core'),
	      
	    )
	));


    $wp_customize->add_setting( 'testimonial_repeater', 
        array(
           'sanitize_callback' => 'customizer_repeater_sanitize',
              'default' => json_encode(

              array(  
                array(  
                  'image_url' => plugins_url('/assets/images/testimoni-demo.jpg',  __FILE__ ) ,
                  'title'     => esc_html__( 'Zahang Farish', 'switch-core' ),
                  'subtitle'  => esc_html__( 'Developer', 'switch-core' ),
                  'text'      => esc_html__(' Vivamus magna justo, lacinia eget consectetur sed, convallis at tellus. Quisque velit nisi, pretium ut lacinia in, elementum id enim. Praesent sapien massa, convallis a pellentesque nec, egestas non nisi. Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui. Nulla porttitor accumsan tincidunt. Donec sollicitudin molestie malesuada. Cras ultricies ligula sed magna dictum porta.', 'switch-core' ),
                  'id'        => 'testimonial',
                ),

                array(  
                  'image_url' => plugins_url('/assets/images/testimoni-demo.jpg',  __FILE__ ),
                  'title'     => esc_html__( 'Hasrul Hisham', 'switch-core' ),
                  'subtitle'  => esc_html__( 'Software Engenier', 'switch-core' ),
                  'text'      => esc_html__(' Vivamus magna justo, lacinia eget consectetur sed, convallis at tellus. Quisque velit nisi, pretium ut lacinia in, elementum id enim. Praesent sapien massa, convallis a pellentesque nec, egestas non nisi. Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui. Nulla porttitor accumsan tincidunt. Donec sollicitudin molestie malesuada. Cras ultricies ligula sed magna dictum porta.', 'switch-core' ),
                ),
                array(  
                  'image_url' => plugins_url('/assets/images/testimoni-demo.jpg',  __FILE__ ),
                  'title'     => esc_html__( 'Jonathan Morgan', 'switch-core' ),
                  'subtitle'  => esc_html__( 'CEO Twitter', 'switch-core' ),
                  'text'      => esc_html__(' Vivamus magna justo, lacinia eget consectetur sed, convallis at tellus. Quisque velit nisi, pretium ut lacinia in, elementum id enim. Praesent sapien massa, convallis a pellentesque nec, egestas non nisi. Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui. Nulla porttitor accumsan tincidunt. Donec sollicitudin molestie malesuada. Cras ultricies ligula sed magna dictum porta.', 'switch-core' ),
                ),
              )
            )
        )
      );
    $wp_customize->add_control( new Customizer_Repeater( $wp_customize, 'testimonial_repeater', 
      array(
          'label'    => esc_html__('Testimonial','switch-core'),
          'section'  => 'section_testimonial',
          'priority' => 90,
          'customizer_repeater_image_control' => true,
          'customizer_repeater_title_control' => true,
          'customizer_repeater_subtitle_control' => true,
          'customizer_repeater_text_control' => true,
         ) 
      ) 
    );



    // Testimonial color
    $wp_customize->add_setting(
      'testimoni_color',
      array(
          'default' => '#fff',
          'sanitize_callback' => 'sanitize_hex_color',
      )
    );
    $wp_customize->add_control(
      new WP_Customize_Color_Control(
          $wp_customize,
          'testimoni_color',
          array(
             'label'          => esc_html__( 'Testimoni Color', 'switch-core' ),
             'type'           => 'color',
             'section'        => 'section_testimonial',
             'settings'       => 'testimoni_color',
             'priority' => 90,
          )
      )
    );

 
    // Testimonial name/designation color //
    $wp_customize->add_setting(
        'testimonial_name_color',
        array(
            'default' => '#fff',
            'sanitize_callback' => 'sanitize_hex_color',
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'testimonial_name_color',
            array(
               'label'    => esc_html__( 'Name/Designation', 'switch-core' ),
               'type'     => 'color',
               'section'  => 'section_testimonial',
               'settings' => 'testimonial_name_color',
               'priority' => 90,
            )
        )
    );

        // Team sectino start

    // Team section //
    $wp_customize->add_section( 'section_team', array(
          'priority'       => 90,
          'capability'     => 'edit_theme_options',
          'theme_supports' => '',
          'title'          => esc_html__( 'Team', 'switch-core' ),
          'description'    => '',
          'panel'          => 'panel_id',
      )
    );


	// Team Enable Dissble //
	$wp_customize->add_setting( 'team_enable', array(
	        'capability'      => 'edit_theme_options',
	        'transport'   => 'refresh',
	        'default'         => 'enable',
	        'sanitize_callback' => 'esc_url',
	    ) 
	  );

	$wp_customize->add_control( 'team_enable', array(
	    'priority'          => 90,
	    'section'           => 'section_team',
	    'label'             =>esc_html__( 'Team Enable/Disable', 'switch-core' ),
	    'description'       => '',
	    'type'    => 'checkbox',
	    'std'     => '1'

	) );


    // Team Section bg color //
    $wp_customize->add_setting(
        'team_section_bg_color',
        array(
            'default' => '#f9f9f9',
            'sanitize_callback' => 'sanitize_hex_color',
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'team_section_bg_color',
            array(
               'label'    => esc_html__( 'Section Bg Color', 'switch-core' ),
               'type'     => 'color',
               'section'  => 'section_team',
               'settings' => 'team_section_bg_color',
               'priority' => 90,
            )
        )
    );


	// Team Section Title //
	$wp_customize->add_setting('team_title', array(
	    'default'        => esc_html__('Our Team','switch-core'),
	    'sanitize_callback' => 'sanitize_text_field',
	    'transport'   => 'refresh'
	));
	$wp_customize->add_control( 'team_title', array(
	    'settings' => 'team_title',
	    'label'    =>  esc_html__('Section Title','switch-core'),
	    'section'  => 'section_team',
	    'type'     => 'textarea',
	    'priority'          => 90,
	));


	// Team section description //
	$wp_customize->add_setting('team_desc', array(
	    'default'        => 'We must understand what your needs are in order to offer.',
	    'sanitize_callback' => 'sanitize_text_field',
	    'transport'   => 'refresh'
	  ));
	$wp_customize->add_control( 'team_desc', array(
	    'settings' => 'team_desc',
	    'label'    =>  esc_html__('Section Description','switch-core'),
	    'section'  => 'section_team',
	    'type'     => 'textarea',
	    'priority'          => 90,

	  )
    );




    // Team Section title content color //
    $wp_customize->add_setting(
        'team_section_title_color',
        array(
            'default' => '#3a3a3a',
            'sanitize_callback' => 'sanitize_hex_color',
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'team_section_title_color',
            array(
               'label'    => esc_html__( 'Section Title/Subtitle Color', 'switch-core' ),
               'type'     => 'color',
               'section'  => 'section_team',
               'settings' => 'team_section_title_color',
               'priority' => 90,
            )
        )
    );

    // Teaml Ttile trnasform//
	$wp_customize->add_setting('team_section_transform', array(
	    'default'     => esc_html__('capitalize','switch-core'),
	    'sanitize_callback' => 'sanitize_text_field',
	    'transport'   => 'refresh'
	));
	$wp_customize->add_control( 'team_section_transform', array(
	    'settings' => 'team_section_transform',
	    'label'    =>  esc_html__('Section Transform','switch-core'),
	    'section'  => 'section_team',
	    'type'     => 'select',
	    'priority' => 90,
	    'choices'  => array(
	      'uppercase'    => esc_html__('Uppercase','switch-core'),
	      'capitalize'   => esc_html__('Capitalize','switch-core'),
	      'lowercase'    => esc_html__('Lowercase','switch-core'),
	      
	    )
	));



    // team customizer //
    $wp_customize->add_setting( 'team_repeater', 
        array(
           'sanitize_callback' => 'customizer_repeater_sanitize',
              'default' => json_encode(

              array(  
                array(  
                  'image_url' => plugins_url('/assets/images/demo-team.jpg',  __FILE__ ) ,
                  'title'     => esc_html__( 'Sukma Wanee', 'switch-core' ),
                  'subtitle'  => esc_html__( 'Marketting', 'switch-core' ),
                  'text'      => esc_html__( 'Nulla quis lorem ut libero malesuada feugiat. Nulla porttitor accumsan tincidunt. Vivamus magna justo, lacinia eget consectetur sed, convallis at tellus.', 'switch-core' ),
                  'shortcode' => '[social-icon]',
                  'id'        => 'team',
                ),

              array(  
                  'image_url' => plugins_url('/assets/images/demo-team.jpg',  __FILE__ ) ,
                  'title'     => esc_html__( 'Mmu Zaman', 'switch-core' ),
                  'subtitle'  => esc_html__( 'Developer', 'switch-core' ),
                  'text'      => esc_html__( 'Nulla quis lorem ut libero malesuada feugiat. Nulla porttitor accumsan tincidunt. Vivamus magna justo, lacinia eget consectetur sed, convallis at tellus.', 'switch-core' ),
                  'shortcode' => '[social-icon]'
                ),
                array(  
                  'image_url' => plugins_url('/assets/images/demo-team.jpg',  __FILE__ ),
                  'title'     => esc_html__( 'Zety Delova', 'switch-core' ),
                  'subtitle'  => esc_html__( 'Manager', 'switch-core' ),
                  'text'      => esc_html__( 'Nulla quis lorem ut libero malesuada feugiat. Nulla porttitor accumsan tincidunt. Vivamus magna justo, lacinia eget consectetur sed, convallis at tellus.', 'switch-core' ),
                  'shortcode' => '[social-icon]'
                ),
              )
            )
        )
    );


    $wp_customize->add_control( new Customizer_Repeater( $wp_customize, 'team_repeater', 
      array(
          'label'    => esc_html__('Team','switch-core'),
          'section'  => 'section_team',
          'priority' => 90,
          'customizer_repeater_image_control' => true,
          'customizer_repeater_title_control' => true,
          'customizer_repeater_subtitle_control' => true,
          'customizer_repeater_text_control' => true,
         ) 
      ) 
    );




    // Team Item bg color //
    $wp_customize->add_setting(
        'team_item_bg_color',
        array(
            'default' => '#fff',
            'sanitize_callback' => 'sanitize_hex_color',
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'team_item_bg_color',
            array(
               'label'          => esc_html__( 'Item Bg Color', 'switch-core' ),
               'type'           => 'color',
               'section'        => 'section_team',
               'settings'       => 'team_item_bg_color',
               'priority' => 90,
            )
        )
    );

    // Team Name  color //
    $wp_customize->add_setting(
        'team_name_color',
        array(
            'default' => '#51BBE5',
            'sanitize_callback' => 'sanitize_hex_color',
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'team_name_color',
            array(
               'label'          => esc_html__( 'Name Color', 'switch-core' ),
               'type'           => 'color',
               'section'        => 'section_team',
               'settings'       => 'team_name_color',
               'priority' => 90,
            )
        )
    );


    // Team Designation  color //
    $wp_customize->add_setting(
        'team_designation_color',
        array(
            'default' => '#333',
            'sanitize_callback' => 'sanitize_hex_color',
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'team_designation_color',
            array(
               'label'          => esc_html__( 'Designation Color', 'switch-core' ),
               'type'           => 'color',
               'section'        => 'section_team',
               'settings'       => 'team_designation_color',
               'priority' => 90,
            )
        )
    );


    // Team Designation  color //
    $wp_customize->add_setting(
        'team_desc_color',
        array(
            'default' => '#3a3a3a',
            'sanitize_callback' => 'sanitize_hex_color',
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'team_desc_color',
            array(
               'label'          => esc_html__( 'Desc Color', 'switch-core' ),
               'type'           => 'color',
               'section'        => 'section_team',
               'settings'       => 'team_desc_color',
               'priority' => 90,
            )
        )
    );


    // Team round color //
    $wp_customize->add_setting(
        'team_round_color',
        array(
            'default' => '#51BBE5',
            'sanitize_callback' => 'sanitize_hex_color',
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'team_round_color',
            array(
               'label'          => esc_html__( 'Round Color', 'switch-core' ),
               'type'           => 'color',
               'section'        => 'section_team',
               'settings'       => 'team_round_color',
               'priority' => 90,
            )
        )
    );



    // Portfolio section
    $wp_customize->add_section( 'section_portfolio', array(
          'priority'       => 90,
          'capability'     => 'edit_theme_options',
          'theme_supports' => '',
          'title'          => esc_html__( 'Portfolio', 'switch-core' ),
          'description'    => '',
          'panel'          => 'panel_id',
      )
    );


    // Portfilo section eveable
    $wp_customize->add_setting( 'portfolio_enable', array(
          'capability'      => 'edit_theme_options',
          'transport'   => 'refresh',
          'default'         => 'enable',
          'sanitize_callback' => 'esc_url',
      ) 
    );
	$wp_customize->add_control( 'portfolio_enable', array(
	      'priority'          => 90,
	      'section'           => 'section_portfolio',
	      'label'             => esc_html__( 'Portfolio Enable/Disable', 'switch-core' ),
	      'description'       => '',
	      'type'    => 'checkbox',
	      'std'         => '1'

	  )
   	);


   // portfolio Section bg color //
    $wp_customize->add_setting(
        'portfolio_bg_color',
        array(
            'default' => '#f9f9f9',
            'sanitize_callback' => 'sanitize_hex_color',
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'team_bg_color',
            array(
               'label'    => esc_html__( 'Section Bg Color', 'switch-core' ),
               'type'     => 'color',
               'section'  => 'section_portfolio',
               'settings' => 'portfolio_bg_color',
               'priority' => 90,
            )
        )
    );


	// Portfolio Section Title //
	$wp_customize->add_setting('portfolio_title', array(
	    'default'   => esc_html__('Our Portfolio','switch-core'),
	    'sanitize_callback' => 'sanitize_text_field',
	    'transport' => 'refresh'
	));
	$wp_customize->add_control( 'portfolio_title', array(
	    'settings' => 'portfolio_title',
	    'label'    =>  esc_html__('Section Title','switch-core'),
	    'section'  => 'section_portfolio',
	    'type'     => 'textarea',
	    'priority'          => 90,
	));


	// Portfolio section description //
	$wp_customize->add_setting('portfolio_desc', array(
	    'default'        => 'We must understand what your needs are in order to offer.',
	    'sanitize_callback' => 'sanitize_text_field',
	    'transport'   => 'refresh'
	));
	$wp_customize->add_control( 'portfolio_desc', array(
	    'settings' => 'portfolio_desc',
	    'label'    =>  esc_html__('Section Description','switch-core'),
	    'section'  => 'section_portfolio',
	    'type'     => 'textarea',
	    'priority'          => 90,

	));

    // Portfolio Section title/sub color //
    $wp_customize->add_setting(
        'portfolio_section_title_color',
        array(
            'default' => '#3a3a3a',
            'sanitize_callback' => 'sanitize_hex_color',
            'transport'   => 'refresh'
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'portfolio_section_title_color',
            array(
               'label'    => esc_html__( 'Section Title/Subtitle Color', 'switch-core' ),
               'type'     => 'color',
               'section'  => 'section_portfolio',
               'settings' => 'portfolio_section_title_color',
               'priority' => 90,
            )
        )
    );


    // Portfolio Ttile trnasform//
	$wp_customize->add_setting('portfolio_section_transform', array(
	    'default'     => esc_html__('capitalize','switch-core'),
	    'sanitize_callback' => 'sanitize_text_field',
	    'transport'   => 'refresh'
	));
	$wp_customize->add_control( 'portfolio_section_transform', array(
	    'settings' => 'portfolio_section_transform',
	    'label'    =>  esc_html__('Section Transform','switch-core'),
	    'section'  => 'section_portfolio',
	    'type'     => 'select',
	    'priority' => 90,
	    'choices'  => array(
	      'uppercase'    => esc_html__('Uppercase','switch-core'),
	      'capitalize'   => esc_html__('Capitalize','switch-core'),
	      'lowercase'    => esc_html__('Lowercase','switch-core'),
	      
	    )
	));

    // Portfolio customizer //
    $wp_customize->add_setting( 'portfolio_repeater', 
         array(
           'sanitize_callback' => 'customizer_repeater_sanitize',
              'default' => json_encode(

              array(  
                array(  
                  'image_url' => plugins_url('/assets/images/portfolio-demo.jpg',  __FILE__ ),
                  'subtitle'  => esc_html__( 'onepage, eucation, blog', 'switch-core' ),
                  'text'      => esc_html__( 'Onepage', 'switch-core' ),
                  'link'      => esc_html__( 'https://themesgrove.com', 'switch-core' ),
                  'id'        => 'portfolio',
                ),

                array(  
                  'image_url' => plugins_url('/assets/images/portfolio-demo.jpg',  __FILE__ ) ,
                  'subtitle'  => esc_html__( 'corporate, business, blog', 'switch-core' ),
                  'text'      => esc_html__( 'Corporate', 'switch-core' ),
                  'link'      => esc_html__( 'https://themesgrove.com', 'switch-core' ),
                ),
                array(  
                  'image_url' => plugins_url('/assets/images/portfolio-demo.jpg',  __FILE__ ),
                  'subtitle'  => esc_html__( 'business', 'switch-core' ),
                  'text'      => esc_html__( 'Business', 'switch-core' ),
                  'link'      => esc_html__( 'https://themesgrove.com', 'switch-core' ),
                ),
                array(  
                  'image_url' => plugins_url('/assets/images/portfolio-demo.jpg',  __FILE__ ),
                  'subtitle'  => esc_html__( 'restaurent, ecommerce', 'switch-core' ),
                  'text'      => esc_html__( 'Ecommerce', 'switch-core' ),
                  'link'      => esc_html__( 'https://themesgrove.com', 'switch-core' ),
                ),

                 array(  
                  'image_url' => plugins_url('/assets/images/portfolio-demo.jpg',  __FILE__ ),
                  'subtitle'  => esc_html__( 'blog, coporate', 'switch-core' ),
                  'text'      => esc_html__( 'Blog', 'switch-core' ),
                  'link'      => esc_html__( 'https://themesgrove.com', 'switch-core' ),
                ),

                array(  
                  'image_url' => plugins_url('/assets/images/portfolio-demo.jpg',  __FILE__ ),
                  'subtitle'  => esc_html__( 'onepager, eucation', 'switch-core' ),
                  'text'      => esc_html__( 'Education', 'switch-core' ),
                  'link'      => esc_html__( 'https://themesgrove.com', 'switch-core' ),
                ),
              )
            )
        )
      );
    $wp_customize->add_control( new Customizer_Repeater( $wp_customize, 'portfolio_repeater', 
      array(
          'label'    => esc_html__('Portfolio','switch-core'),
          'section'  => 'section_portfolio',
          'priority' => 90,
          'customizer_repeater_image_control' => true,
          'customizer_repeater_subtitle_control' => true,
          'customizer_repeater_link_control' => true,
          'customizer_repeater_text_control' => true,
         ) 
      ) 
    );

    // Portfolio filter color //
    $wp_customize->add_setting(
        'filter_color',
        array(
            'default' => '#747474',
            'sanitize_callback' => 'sanitize_hex_color',
            'transport'   => 'refresh'
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'filter_color',
            array(
               'label'    => esc_html__( 'Filter Color', 'switch-core' ),
               'type'     => 'color',
               'section'  => 'section_portfolio',
               'settings' => 'filter_color',
               'priority' => 90,
            )
        )
    );

    // Portfolio filter hover color //
    $wp_customize->add_setting(
        'filter_hover_color',
        array(
            'default' => '#fff',
            'sanitize_callback' => 'sanitize_hex_color',
            'transport'   => 'refresh'
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'filter_hover_color',
            array(
               'label'    => esc_html__( 'Filter Hover Color', 'switch-core' ),
               'type'     => 'color',
               'section'  => 'section_portfolio',
               'settings' => 'filter_hover_color',
               'priority' => 90,
            )
        )
    );



        // Contact section start

	// Contact section //
	$wp_customize->add_section( 'section_contact', array(
	        'priority'       => 90,
	        'capability'     => 'edit_theme_options',
	        'theme_supports' => '',
	        'title'          => esc_html__( 'Contact', 'switch-core' ),
	        'description'    => '',
	        'panel'          => 'panel_id',
	    )
	);


	// Contact Enable Dissble //
	$wp_customize->add_setting( 'contact_enable', array(
	        'capability'      => 'edit_theme_options',
	        'transport'   => 'refresh',
	        'default'         => 'enable',
	        'sanitize_callback' => 'esc_url',
	    ) 
	);

	$wp_customize->add_control( 'contact_enable', array(
	    'priority'          => 90,
	    'section'           => 'section_contact',
	    'label'             => esc_html__( 'Contact Enable/Disable', 'switch-core' ),
	    'description'       => '',
	    'type'    => 'checkbox',
	    'std'     => '1'

	) );

	// Contat Bg color //
    $wp_customize->add_setting(
        'contact_bg_color',
        array(
            'default' => '#333',
            'sanitize_callback' => 'sanitize_hex_color',
            'transport'   => 'refresh'
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'contact_bg_color',
            array(
               'label'    => esc_html__( 'Background Color', 'switch-core' ),
               'type'     => 'color',
               'section'  => 'section_contact',
               'settings' => 'contact_bg_color',
               'priority' => 90,
            )
        )
    );

	// Contact Section Title //
	$wp_customize->add_setting('contact_title', array(
	    'default'     => esc_html__('Get In Touch','switch-core'),
	    'sanitize_callback' => 'sanitize_text_field',
	    'transport'   => 'refresh'
	));
	$wp_customize->add_control( 'contact_title', array(
	    'settings' => 'contact_title',
	    'label'    =>  esc_html__('Section Title','switch-core'),
	    'section'  => 'section_contact',
	    'type'     => 'textarea',
	    'priority'          => 90,
	));

	// Contact Map link //
	$wp_customize->add_setting('contact_map', array(
	    'default'     => esc_html__('[wpgmza id="1"]','switch-core'),
	    'sanitize_callback' => 'sanitize_text_field',
	    'transport'   => 'refresh'
	));

	$wp_customize->add_control( 'contact_map', array(
	    'settings' => 'contact_map',
	    'label'    =>  esc_html__('Map Shortcode','switch-core'),
	    'section'  => 'section_contact',
	    'type'     => 'textarea',
	    'priority' => 90,
	));




	// Contact Form shortcode //
	$wp_customize->add_setting('contact_shotcode', array(
	    'default'  => '[contact-form-7 id="2151" title="Switch Contact"]',
	    'sanitize_callback' => 'sanitize_text_field',
	    'transport'   => 'refresh'
	));
	$wp_customize->add_control( 'contact_shotcode', array(
	    'settings' => 'contact_shotcode',
	    'label'    =>  esc_html__('Contact Form 7 Shortcode','switch-core'),
	    'section'  => 'section_contact',
	    'type'     => 'textarea',
	    'priority'          => 90,

	));



	// Contat title color //
    $wp_customize->add_setting(
        'contact_title_color',
        array(
            'default' => '#fff',
            'sanitize_callback' => 'sanitize_hex_color',
            'transport'   => 'refresh'
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'contact_title_color',
            array(
               'label'    => esc_html__( 'Title Color', 'switch-core' ),
               'type'     => 'color',
               'section'  => 'section_contact',
               'settings' => 'contact_title_color',
               'priority' => 90,
            )
        )
    );

    // Contact Ttile trnasform//
	$wp_customize->add_setting('contact_section_transform', array(
	    'default'     => esc_html__('capitalize','switch-core'),
	    'sanitize_callback' => 'sanitize_text_field',
	    'transport'   => 'refresh'
	));
	$wp_customize->add_control( 'contact_section_transform', array(
	    'settings' => 'contact_section_transform',
	    'label'    =>  esc_html__('Title Transform','switch-core'),
	    'section'  => 'section_contact',
	    'type'     => 'select',
	    'priority' => 90,
	    'choices'  => array(
	      'uppercase'    => esc_html__('Uppercase','switch-core'),
	      'capitalize'   => esc_html__('Capitalize','switch-core'),
	      'lowercase'    => esc_html__('Lowercase','switch-core'),
	      
	    )
	));


	// Contact address
	$wp_customize->add_setting('contact_address', array(
	    'default'     => '35/4 Lake Circus Kolabagan',
	    'sanitize_callback' => 'sanitize_text_field',
	    'transport'   => 'refresh'
	));
	$wp_customize->add_control( 'contact_address', array(
	    'settings' => 'contact_address',
	    'label'    =>  esc_html__('Address','switch-core'),
	    'section'  => 'section_contact',
	    'type'     => 'textarea',
	    'priority'          => 90,
	));


    // Contact Mail
	$wp_customize->add_setting('contact_mail', array(
	    'default'     => 'support@switch.com',
	    'sanitize_callback' => 'sanitize_text_field',
	    'transport'   => 'refresh'
	));
	$wp_customize->add_control( 'contact_mail', array(
	    'settings' => 'contact_mail',
	    'label'    =>  esc_html__('Mail','switch-core'),
	    'section'  => 'section_contact',
	    'type'     => 'text',
	    'priority'          => 90,
	));

	// Contact Phone
	$wp_customize->add_setting('contact_phone', array(
	    'default'     => '+8800 02 911 4147',
	    'sanitize_callback' => 'sanitize_text_field',
	    'transport'   => 'refresh'
	));
	$wp_customize->add_control( 'contact_phone', array(
	    'settings' => 'contact_phone',
	    'label'    =>  esc_html__('Phone','switch-core'),
	    'section'  => 'section_contact',
	    'type'     => 'text',
	    'priority'          => 90,
	));

	// Contat info bg color //
    $wp_customize->add_setting(
        'contact_info_bg_color',
        array(
            'default' => '#fff',
            'sanitize_callback' => 'sanitize_hex_color',
            'transport'   => 'refresh'
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'contact_info_bg_color',
            array(
               'label'    => esc_html__( 'Info Bg Color', 'switch-core' ),
               'type'     => 'color',
               'section'  => 'section_contact',
               'settings' => 'contact_info_bg_color',
               'priority' => 90,
            )
        )
    );

    // Contat info color //
    $wp_customize->add_setting(
        'contact_info_color',
        array(
            'default' => '#333',
            'sanitize_callback' => 'sanitize_hex_color',
            'transport'   => 'refresh'
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'contact_info_color',
            array(
               'label'    => esc_html__( 'Info Color', 'switch-core' ),
               'type'     => 'color',
               'section'  => 'section_contact',
               'settings' => 'contact_info_color',
               'priority' => 90,
            )
        )
    );


}
add_action( 'customize_register', 'switch_core_customize_register' );

// Custom Css

function switch_core_customize_css(){
    ?>
        <style type="text/css">

        input[type="text"]:focus, input[type="email"]:focus, input[type="url"]:focus, input[type="password"]:focus, input[type="search"]:focus, input[type="number"]:focus, input[type="tel"]:focus, input[type="range"]:focus, input[type="date"]:focus, input[type="month"]:focus, input[type="week"]:focus, input[type="time"]:focus, input[type="datetime"]:focus, input[type="datetime-local"]:focus, input[type="color"]:focus, textarea:focus{
              border-color: <?php echo esc_attr(get_theme_mod('plugin_primary_color', '#51BBE5')); ?> !important;
        }

              .slider .btn-line a{
                border:1px solid <?php echo esc_attr(get_theme_mod('plugin_primary_color', '#51BBE5')); ?>;
              }

              .slider .btn-line a p,
              .slider .carousel .carousel-control{
                color:<?php echo esc_attr(get_theme_mod('btn_border_color', '#fff')); ?>;
              }
              .slider .carousel .carousel-indicators li{
              	background-color:<?php echo esc_attr(get_theme_mod('btn_border_color', '#fff')); ?>;
              }

              .slider .btn-line a:hover p{
              		color: <?php echo esc_attr(get_theme_mod('btn_hover_border_color', '#fff')); ?>;
              }
              .slider .carousel .carousel-control{
                background-color: <?php echo esc_attr(get_theme_mod('plugin_primary_color', '#51BBE5')); ?>;
              }
              ul.wpuf-form .wpuf-submit input[type=submit]{
                background-color: <?php echo esc_attr(get_theme_mod('plugin_primary_color', '#51BBE5')); ?>;
                    background-color: <?php echo esc_attr(get_theme_mod('plugin_primary_color', '#51BBE5')); ?> !important;
				    text-shadow: none !important;
				    border-color: <?php echo esc_attr(get_theme_mod('plugin_primary_color', '#51BBE5')); ?> !important;
              }



              .slider .btn-line a span{
              	background: <?php echo esc_attr(get_theme_mod('btn_hover_border_color', '#fff')); ?>;
              }
             .contact .contact-info i{
                  background-color:<?php echo esc_attr(get_theme_mod('plugin_primary_color', '#51BBE5')); ?>;
              }

              .slider .carousel .item:before{
                  background:<?php echo esc_attr(get_theme_mod('overlay_color')); ?>;
                  opacity: 0.6;
              }

              .slider .carousel .item .carousel-caption .slider-title{
                 <?php if (get_theme_mod('title_color')):?> 
                    color:<?php echo esc_attr(get_theme_mod('title_color', '#fff')); ?>;
                  <?php else: ?>
                    color:#fff;
                <?php endif; ?>

                 <?php if (get_theme_mod('title_font_size')):?> 
                      font-size:<?php echo esc_attr(get_theme_mod('title_font_size', '48')); ?>px;
                 <?php else: ?>
                    font-size:44px;
                 <?php endif; ?>

                <?php if (get_theme_mod('title_transform')):?> 
                    text-transform:<?php echo esc_attr(get_theme_mod('title_transform', 'capitalize')); ?>;
                 <?php else: ?>
                    text-transform: capitalize;
                 <?php endif; ?>

              }  

              .slider .carousel .item .carousel-caption .slider-desc{
                <?php if (get_theme_mod('content_color')):?> 
                    color:<?php echo esc_attr(get_theme_mod('content_color', '#fff')); ?>;
                  <?php else: ?>
                    color:#fff;
                <?php endif; ?>

                <?php if (get_theme_mod('content_font_size')):?> 
                      font-size:<?php echo esc_attr(get_theme_mod('content_font_size', '16')); ?>px;
                <?php else: ?>
                   font-size:16px;
                <?php endif; ?>
              } 


              <?php if (get_theme_mod('plugin_primary_color')):?>
                .slider .carousel .carousel-indicators li.active,
                .slider .carousel .carousel-indicators li:hover {
                    background-color: <?php echo esc_attr(get_theme_mod('plugin_primary_color', '#51BBE5')); ?>;
                    border: 1px solid <?php echo esc_attr(get_theme_mod('plugin_primary_color', '#51BBE5')); ?>;
                }
              <?php endif; ?>

                .feature{
                    background-color: <?php echo esc_attr(get_theme_mod('section_bg_color', '#f9f9f9'));?>;
                 }

                 .feature .section-title,
                 .feature .section-desc{
                 	color: <?php echo esc_attr(get_theme_mod('feature_section_title_color', '#3a3a3a')); ?>;
                 }
                 .feature .section-title{
                 	 text-transform:<?php echo esc_attr(get_theme_mod('feature_section_transform', 'capitalize')); ?>;
                 }

              .feature .block{
                  <?php if (get_theme_mod('item_bg_color')):?>
                    background-color: <?php echo esc_attr(get_theme_mod('item_bg_color', '#fff')); ?>;
                  <?php else: ?>
                    background-color:#fff;
                  <?php endif; ?>
              }
            <?php if (get_theme_mod('shadow_bg')):?>
              .feature .drop-shadow:after{
                background-image:url(<?php echo esc_attr(get_theme_mod('shadow_bg'));?>);
              }
            <?php endif; ?>


            .feature .block .feature-title{
            	
              <?php if (get_theme_mod('feature_title_size')):?>
                 font-size: <?php echo esc_attr(get_theme_mod('feature_title_size', '18'));?>px;
              <?php else: ?>
                  font-size:18px;
              <?php endif; ?>

              <?php if (get_theme_mod('feature_title_transform')):?> 
                  text-transform:<?php echo esc_attr(get_theme_mod('feature_title_transform', 'uppercase')); ?>;
               <?php else: ?>
                  text-transform: uppercase;
               <?php endif; ?>
            }
			.feature .block .feature-title,
			.feature .block .feature-desc{
				color:<?php echo esc_attr(get_theme_mod('feature_item_title_color', '#3a3a3a')); ?>;
			}

            <?php  $about_bg = get_theme_mod('about_section_bg', plugins_url('/assets/images/about-demo.jpg',  __FILE__ ));?>

            .about{ 
               <?php if ($about_bg):?> 
                  background-image:url(<?php echo esc_url($about_bg);?>);
                  background-repeat: no-repeat;
                  background-size: cover;
                <?php endif; ?>  
            }

            .about .section-title,
            .about .section-desc{
             	color: <?php echo esc_attr(get_theme_mod('about_section_title_color', '#fff')); ?>;
             }
  			.about .section-title{
             	text-transform:<?php echo esc_attr(get_theme_mod('about_section_transform', 'capitalize')); ?>;
            }

  			.about .sub-title,
            .about .sub-desc{
                <?php if (get_theme_mod('about_color')):?> 
                  color:<?php echo esc_attr(get_theme_mod('about_color', '#fff')); ?>;
                <?php endif; ?>   
            }


          <?php  $testimonial_bg = get_theme_mod('testimonial_section_bg', plugins_url('/assets/images/testimoni-demo.jpg',  __FILE__ ));?>

           .testimonial{ 
                <?php if ($testimonial_bg):?> 
                    background-image:url(<?php echo esc_url($testimonial_bg); ?>);
                    background-repeat: no-repeat;
                    background-size: cover;
                    background-attachment: fixed; 
                <?php endif; ?> 

                    
            }

            .testimonial .section-title,
            .testimonial .section-desc{
             	color: <?php echo esc_attr(get_theme_mod('testimonial_section_title_color', '#fff')); ?>;
            }

            .testimonial .section-title{
                text-transform:<?php echo esc_attr(get_theme_mod('testimonial_section_transform', 'capitalize')); ?>;
            }

            .testimonial .testimonial-details .desc{
            	color:<?php echo esc_attr(get_theme_mod('testimoni_color', '#fff')); ?>; 
            }

            .testimonial .testimonial-details .name,
            .testimonial .testimonial-details .designation{
            	color:<?php echo esc_attr(get_theme_mod('testimonial_name_color', '#fff')); ?>; 
            }


            <?php if (get_theme_mod('plugin_primary_color')):?>
                .testimonial-slider .owl-dot.active span{
                     border: 3px solid <?php echo esc_attr(get_theme_mod('plugin_primary_color', '#51BBE5')); ?>;
                }
                .testimonial-slider .owl-dots span:hover{
                    border-color:<?php echo esc_attr(get_theme_mod('plugin_primary_color', '#51BBE5')); ?>;
                }
            <?php endif; ?>


            <?php if (get_theme_mod('team_section_bg_color')):?>
              .team{
                background-color: <?php echo esc_attr(get_theme_mod('team_section_bg_color', '#f9f9f9')); ?>;
              }
            <?php endif; ?>


            .team .section-title,
            .team .section-desc{
	         	color: <?php echo esc_attr(get_theme_mod('team_section_title_color', '#3a3a3a')); ?>;
	         }
	        .team .section-title{
                text-transform:<?php echo esc_attr(get_theme_mod('team_section_transform', 'capitalize')); ?>;
            }


            <?php if (get_theme_mod('team_item_bg_color')):?>
              .team .team-block{
                background-color: <?php echo esc_attr(get_theme_mod('team_item_bg_color', '#fff')); ?>;
              }
            <?php endif; ?>

            <?php if (get_theme_mod('team_round_color')):?>
              .team .team-block .ih-item.circle.effect1 .spin{
                  border: 5px solid <?php echo esc_attr(get_theme_mod('team_round_color', '#51BBE5')); ?>;
                  border-right-color: #ddd;
                  border-bottom-color: #ddd;
              }
            <?php endif; ?>

            <?php if (get_theme_mod('team_name_color')):?>
              .team .team-block .caption .name{
                  color:<?php echo esc_attr(get_theme_mod('team_name_color', '#51BBE5')); ?>;
              }
            <?php endif; ?>


            .team .team-block .caption .desc{
                color:<?php echo esc_attr(get_theme_mod('team_desc_color', '#3a3a3a')); ?>;
            }

            .team .team-block .caption .designation{
                color:<?php echo esc_attr(get_theme_mod('team_designation_color', '#333')); ?>;
            }


            .portfolio{
                background-color: <?php echo esc_attr(get_theme_mod('portfolio_bg_color', '#f9f9f9')); ?>;
            }

            .portfolio .section-title,
            .portfolio .section-desc{
             	color: <?php echo esc_attr(get_theme_mod('portfolio_section_title_color', '#fff')); ?>;
            }

            .portfolio .section-title{
                text-transform:<?php echo esc_attr(get_theme_mod('portfolio_section_transform', 'capitalize')); ?>;
            }

            #portfolio .da-thumbs .item a div{
                background: <?php echo esc_attr(get_theme_mod('plugin_primary_color', '#51BBE5')); ?> ;
                opacity: 0.9;
            }

            #portfolio #da-thumbs .item .portfolio-buttons a,
            #portfolio #da-thumbs .item .portfolio-buttons a:hover,
            a[class*='lightcase-icon-']:focus,
            a[class*='lightcase-icon-']:hover{
                color:<?php echo esc_attr(get_theme_mod('plugin_primary_color', '#51BBE5')); ?>;
            }

            .portfolio-filter li a.active,
            .portfolio-filter li a:hover{
                 background: <?php echo esc_attr(get_theme_mod('plugin_primary_color', '#51BBE5')); ?> ;
            }
            .portfolio-filter li a{
                color: <?php echo esc_attr(get_theme_mod('filter_color', '#747474')); ?> ;
            }
            .portfolio-filter li a:hover{
            	color: <?php echo esc_attr(get_theme_mod('filter_hover_color', '#fff')); ?> ;
            }

            #portfolio #da-thumbs .item .portfolio-buttons a{
            	background-color: <?php echo esc_attr(get_theme_mod('filter_hover_color', '#fff')); ?> ;
            }
			.contact .contact-form{
				background-color: <?php echo esc_attr(get_theme_mod('contact_bg_color', '#333')); ?> ;
			}
            .contact .contact-title{
            	color: <?php echo esc_attr(get_theme_mod('contact_title_color', '#fff')); ?> ;
            	text-transform:<?php echo esc_attr(get_theme_mod('contact_section_transform', 'capitalize')); ?>;
            }
             

            .contact .contact-info span{
            	background-color: <?php echo esc_attr(get_theme_mod('contact_info_bg_color', '#fff')); ?> ;
            	color: <?php echo esc_attr(get_theme_mod('contact_info_color', '#333')); ?> ;

            }

            .contact .contact-info i{
            	color: <?php echo esc_attr(get_theme_mod('contact_info_bg_color', '#fff')); ?> ;
            }

        </style>
    <?php
}
add_action( 'wp_head', 'switch_core_customize_css');