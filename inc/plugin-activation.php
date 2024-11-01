<?php

/**
 * Register the required plugins for this theme.
 *
 */
function switch_lite_tgm_init() {

    $template_directory = get_template_directory();

    /**
     * Array of plugin arrays. Required keys are name and slug.
     * If the source is NOT from the .org repo, then source is also required.
     */
    $plugins = array(

        // Contact form 7 activation
        array(
            'name'     => esc_html__('Contact Form 7', 'switch-core'),
            'slug'     => 'contact-form-7',
            'required' => false,
        ),

        // Google Maps activation
        array(
            'name'     => esc_html__('Google Maps', 'switch-core'),
            'slug'     => 'wp-google-maps',
            'required' => false,
        ),

        // Elementor Page Builder
        array(
            'name'     => esc_html__('Elementor', 'switch-core'),
            'slug'     => 'elementor',
            'required' => false,
        ),

        // WidgetKit for Elementor
        array(
            'name'     => esc_html__('WidgetKit for Elementor', 'switch-core'),
            'slug'     => 'widgetkit-for-elementor',
            'required' => false,
        ),

    );


    /**
     * Array of configuration settings. Amend each line as needed.
     * If you want the default strings to be available under your own theme domain,
     * leave the strings uncommented.
     * Some of the strings are added into a sprintf, so see the comments at the
     * end of each line for what each argument will be.
     */
    $config = array(
        'default_path' => '',
        'menu'         => 'tgmpa-install-plugins',
        'has_notices'  => true,
        'dismissable'  => true,
        'dismiss_msg'  => '',
        'is_automatic' => false,
        'message'      => '',
        'strings'      => array(
            'page_title'                      => esc_html__( 'Install Required Plugins', 'switch-core' ),
            'menu_title'                      => esc_html__( 'Install Plugins', 'switch-core' ),
            'installing'                      => esc_html__( 'Installing Plugin: %s', 'switch-core' ), // %s = plugin name.
            'oops'                            => esc_html__( 'Something went wrong with the plugin API.', 'switch-core' ),
            'notice_can_install_required'     => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.', 'switch-core' ), // %1$s = plugin name(s).
            'notice_can_install_recommended'  => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.', 'switch-core' ), // %1$s = plugin name(s).
            'notice_cannot_install'           => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.', 'switch-core' ), // %1$s = plugin name(s).
            'notice_can_activate_required'    => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.', 'switch-core' ), // %1$s = plugin name(s).
            'notice_can_activate_recommended' => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.', 'switch-core' ), // %1$s = plugin name(s).
            'notice_cannot_activate'          => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.', 'switch-core' ), // %1$s = plugin name(s).
            'notice_ask_to_update'            => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.', 'switch-core' ), // %1$s = plugin name(s).
            'notice_cannot_update'            => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.', 'switch-core' ), // %1$s = plugin name(s).
            'install_link'                    => _n_noop( 'Begin installing plugin', 'Begin installing plugins', 'switch-core' ),
            'activate_link'                   => _n_noop( 'Begin activating plugin', 'Begin activating plugins', 'switch-core' ),
            'return'                          => esc_html__( 'Return to Required Plugins Installer', 'switch-core' ),
            'plugin_activated'                => esc_html__( 'Plugin activated successfully.', 'switch-core' ),
            'complete'                        => esc_html__( 'All plugins installed and activated successfully. %s', 'switch-core' ), // %s = dashboard link.
            'nag_type'                        => 'updated' // Determines admin notice type - can only be 'updated', 'update-nag' or 'error'.
        )
    );

    tgmpa( $plugins, $config );
}

add_action( 'tgmpa_register', 'switch_lite_tgm_init' );