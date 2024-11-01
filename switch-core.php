<?php

/**
 * @link              http://themesgrove.com/
 * @since             1.0
 * @package           Switch-Core
 *
 * @wordpress-plugin
 * Plugin Name:       Switch Core
 * Plugin URI:        http://themesgrove.com/plugins/switch-core
 * Description:       Huge collection of pro quality sections for crate a nice design. Contact form 7 Or Weform and Wp Google Maps (wp-google-maps) plugins must be installed and activated for contact section.
 * Version:           2.1
 * Author:            Themesgrove
 * Author URI:        http://themesgrove.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       switch-core
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

    // Define file
    define('SWITCH_CORE_FILE', __FILE__);
    // Define url
    define('SWITCH_CORE_FILE_URL', plugins_url('/', __FILE__ ) );
    // Define path
    define('SWITCH_CORE_FILE_PATH', plugin_dir_path( __FILE__ ) );

/**
 * Customizer repeater functions.
 */
require_once SWITCH_CORE_FILE_PATH .  '/customizer-repeater/functions.php';

/**
 * page template.
 */
require_once SWITCH_CORE_FILE_PATH .  '/inc/page-template.php';
/**
 * plugin activation.
 */

require_once SWITCH_CORE_FILE_PATH .  '/inc/plugin-activation.php';

/**
 * tgmap activation.
 */
require_once SWITCH_CORE_FILE_PATH .  '/inc/class-tgm-plugin-activation.php';




/**
 * Plugin Page template.
 */
function switch_core_page_template( $page_template ){
    if ( is_page( 'switch-core-custom-page-slug' ) ) {
        $page_template = dirname( __FILE__ ) . '/inc/page-template.php';
    }
    return $page_template;
}
add_filter( 'page_template', 'switch_core_page_template' );

function switch_lite_menu_setup() {
  register_nav_menus( array(
      'onepage' => esc_html__( 'Onepage', 'switch-lite' ),
    ) );
}
add_action( 'after_setup_theme', 'switch_lite_menu_setup' );

  /*Enqueue resources for css*/
 function switch_core_enqueue_css() {
      // Base css
      wp_enqueue_style( 'bootstrap', plugins_url('/assets/css/bootstrap.css',__FILE__ ));
      // Animate css
      wp_enqueue_style( 'animate', plugins_url('/assets/css/animate.css',__FILE__ ));
      // Font-awesone css
      wp_enqueue_style( 'font-awesome', plugins_url('/assets/css/font-awesome.css',  __FILE__ ));
      //Owl carousel
      wp_enqueue_style( 'owl.carousel', plugins_url('/assets/css/owl.carousel.css',  __FILE__ ));
      // Plugin css
      wp_enqueue_style( 'plugin', plugins_url('/assets/css/plugin.css',  __FILE__ ));
  }

  add_action('wp_head', 'switch_core_enqueue_css', 0);




  // Script include
  function switch_core_script(){
    // Modanizer js
    wp_enqueue_script( 'modernizr-js', plugins_url('/assets/js/modernizr.js',  __FILE__ ), array('jquery'), '', true );

    // Mixitup Script
    wp_enqueue_script( 'mixitup-js', plugins_url('/assets/js/mixitup.js',  __FILE__ ), array('jquery'), '20151215', true );

    // Bootstarp Script
    wp_enqueue_script( 'bootstrap', plugins_url('/assets/js/bootstrap.js',  __FILE__ ), array('jquery'), '20151211', true );

    // Light case Script
    wp_enqueue_script( 'lightcase', plugins_url('/assets/js/lightcase.js',  __FILE__ ), array('jquery'), '20151213', true );

    // Owl carousel Script
    wp_enqueue_script( 'owl.js', plugins_url('/assets/js/owl.carousel.js',  __FILE__ ), array('jquery'), '20151218', true );

    // Wow Script
    wp_enqueue_script( 'wow', plugins_url('/assets/js/wow.js',  __FILE__ ), array('jquery'), '20151220', true );

    // Hoverdir js
    wp_enqueue_script( 'hoverdir', plugins_url('/assets/js/jquery.hoverdir.js',  __FILE__ ), array('jquery'), '20151225', true );

    // Main script js
    wp_enqueue_script( 'switch-core-js', plugins_url('/assets/js/plugin.js',  __FILE__ ), array('jquery'), '', true );

  }

  add_action( 'wp_enqueue_scripts', 'switch_core_script' );


/**
 * Customizer repeater functions.
 */
require_once SWITCH_CORE_FILE_PATH .  '/inc/sections-customizer.php';
