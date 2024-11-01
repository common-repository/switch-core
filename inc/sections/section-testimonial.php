<?php  

    $testimonial_repeater = get_theme_mod(
        'testimonial_repeater', json_encode( array()) 
    );
    $testimonial_repeaters = json_decode($testimonial_repeater);


    // Testimonial Enable/Disable
    $switch_testimonial = get_theme_mod( 'testimonial_enable', 'enable');

    // Testimonial title
    $testimonial_title  = get_theme_mod( 'testimonial_title', 'Clients Testimonials');

    // Testimonial Description
    $testimonial_desc   = get_theme_mod( 'testimonial_desc');

    if ( $switch_testimonial ):
?>

        <section id="testimonial" class="testimonial tx-section text-center">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="section-top wow bounceIn" data-wow-delay=".2s">
                           <?php if ($testimonial_title):?>
                                <h1 class="section-title"><?php echo esc_html($testimonial_title); ?></h1>
                            <?php endif; ?>

                             <?php if ($testimonial_desc):?>
                                <p class="section-desc"><?php echo esc_html($testimonial_desc); ?></p>
                            <?php endif; ?>
                        </div> <!-- /.Section-title -->
                            <div id="testimonial-slider" class="testimonial-slider wow fadeInUp" data-wow-delay=".7s">
                            <?php if($testimonial_repeaters): ?>
                            <?php foreach($testimonial_repeaters as $testimoni_item):?>
                                <div class="testimonial-details">
                                    <?php if($testimoni_item->text): ?>
                                        <p class="desc">
                                            <?php echo esc_html($testimoni_item->text);?>
                                        </p>         
                                    <?php endif; ?>

                                    <div class="user">
                                        <?php if($testimoni_item->image_url): ?>
                                             <img src="<?php echo esc_attr($testimoni_item->image_url); ?>" alt="Testimonial Image">
                                        <?php endif; ?>

                                        <?php if($testimoni_item->title): ?>
                                            <h4 class="name"><?php echo esc_html($testimoni_item->title); ?></h4>
                                        <?php endif; ?>


                                        <?php if($testimoni_item->subtitle): ?>
                                            <p class="designation"><?php echo esc_html($testimoni_item->subtitle);?></p>
                                        <?php endif; ?>
                                    </div> <!-- /.user -->
                                </div>
                            <?php endforeach; endif;?>
                        </div> <!-- /.testimonial-slider -->
                    </div> <!-- /.col-md-12 -->
                </div> <!--/row -->
            </div> <!-- /.container -->
        </section>
    <?php endif; ?>

         
