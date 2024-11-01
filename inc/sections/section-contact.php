<?php  

    // Contact enabe/disable
    $switch_contact = get_theme_mod( 'contact_enable', 'enable');

    // Contact Map link
    $contact_map    = get_theme_mod( 'contact_map', '[wpgmza id="2"]');

    // Contact title
    $contact_title  = get_theme_mod( 'contact_title', 'Get In Tough');

     // Contact shorcode
    $contact_shotcode  = get_theme_mod( 'contact_shotcode', '[switch-contact]');

    // Contact address
    $contact_address   = get_theme_mod( 'contact_address', '211,Winslow Bainbridge,Australia');

    // Contact mail
    $contact_mail      = get_theme_mod( 'contact_mail', 'support@switch.com');

    // Contact phone
    $contact_phone     = get_theme_mod( 'contact_phone', '+0088 02 911 4147');


    if ( $switch_contact ):
?>

        <section id="contact"  class="contact">
            <!-- Map -->
            <div class="map wow slideInUp" data-wow-delay=".5s">
                <?php if ($contact_map): ?> 
                    <?php echo do_shortcode($contact_map); ?>
                <?php endif ?>
            </div> <!-- map -->

            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6 contact-form wow fadeInLeft" data-wow-delay=".8s">
                        <?php if ($contact_title): ?>
                            <h4 class="contact-title text-center">
                                <?php echo esc_html($contact_title); ?>
                            </h4>
                            <?php endif ?>

                            <!-- Contact-form -->
                            <?php if ($contact_shotcode):?>
                               <?php echo do_shortcode($contact_shotcode); ?>
                            <?php endif;?>
                        </div> <!-- /.col-md-6 -->

                    <div class="col-md-6">
                        <address class="contact-info text-center">
                            <ul>
                                <?php if ($contact_address): ?>
                                    <li class="wow fadeInRight" data-wow-delay=".8s">
                                            <i class="fa fa-building-o"></i>
                                            <span>
                                                    <?php echo esc_html($contact_address); ?>
                                            </span>
                                    </li>
                                <?php endif; ?>

                                <?php if ($contact_mail): ?>
                                    <li class="wow fadeInRight" data-wow-delay="1.1s">
                                            <i class="fa fa-envelope-o"></i>
                                            <span>
                                                    <?php echo esc_html($contact_mail); ?>
                                            </span>
                                    </li>
                                <?php endif; ?>

                                <?php if ($contact_phone): ?>
                                    <li class="wow fadeInRight" data-wow-delay="1.3s">
                                            <i class="fa fa-phone"></i>
                                            <span>
                                                <?php echo esc_html($contact_phone); ?>
                                            </span>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </address> <!--/address --> 
                    </div> <!-- /.col-md-6 -->
                </div> <!--/row -->
           </div> <!--/.container -->
        </section>
    <?php endif;  ?>