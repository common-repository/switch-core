<?php
/*
 * Template Name: Switch Core Page
 * Description: A Page Template for collect of sections.
 */

		// Header
		get_header();

		   // Slider Section Start
		   require_once SWITCH_CORE_FILE_PATH . '/inc/sections/section-slider.php';

		   //Feature Section Start 
		   require_once SWITCH_CORE_FILE_PATH . '/inc/sections/section-feature.php';

		   //About us Section Start 
		   require_once SWITCH_CORE_FILE_PATH . '/inc//sections/section-about.php';

		    //Team Section Start
		    require_once SWITCH_CORE_FILE_PATH . '/inc/sections/section-team.php';

		    //Testimonial Section Start 
		   require_once SWITCH_CORE_FILE_PATH . '/inc/sections/section-testimonial.php' ;

		    //Portfolio Section Start
		    require_once SWITCH_CORE_FILE_PATH . '/inc/sections/section-portfolio.php';

		    // Contact Section Start
		    require_once SWITCH_CORE_FILE_PATH . '/inc/sections/section-contact.php';

		// Footer
		get_footer();
