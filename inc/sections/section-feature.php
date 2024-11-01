<?php 

    $feature_repeater = get_theme_mod(
        'feature_repeater', json_encode( array()) 
    );
    $feature_repeaters = json_decode($feature_repeater);

    // Feature Enable/Disable
    $switch_feature = get_theme_mod( 'feature_enable', 'enable');

    // Feature title
    $feature_title  = get_theme_mod( 'feature_title', 'Our Front End Feature');

    // Feature Description
    $feature_desc   = get_theme_mod( 'feature_desc', 'Our first step is targeted towards understanding. We must understand what your needs are in order to offer.');

    if ( $switch_feature ):
?>

        <section id="feature" class="feature tx-section cleafix">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="section-top text-center wow bounceIn" data-wow-delay=".2s" >
                            <?php if ($feature_title):?>
                                <h1 class="section-title"><?php echo esc_html($feature_title); ?></h1>
                            <?php endif; ?>

                             <?php if ($feature_desc):?>
                                <p class="section-desc"><?php echo esc_html($feature_desc); ?></p>
                            <?php endif; ?>
                         </div> <!-- /.section-title -->
                    </div> <!-- /.col-md-12 -->

                <?php if($feature_repeaters): ?>
                <?php foreach($feature_repeaters as $feature_item):?>
                    
                    <!-- feature Start
                    ================================================== -->
                    <div class="col-md-4 wow zoomIn" data-wow-delay=".3s">
                        <div class="block drop-shadow text-center">

                            <?php if($feature_item->image_url): ?>
                                <div class="custom-icon">
                                    <img src="<?php echo esc_attr($feature_item->image_url); ?>" alt="Feature Image">
                                 </div>                           
                            <?php endif; ?>
                               

                            <?php if($feature_item->title): ?>
                                <h4 class="feature-title">
                                    <?php echo esc_html($feature_item->title); ?>  
                                </h4>
                            <?php endif; ?>

                            <?php if($feature_item->text): ?>
                                <p class="feature-desc"><?php echo esc_html($feature_item->text); ?></p>
                            <?php endif; ?>
                        </div>
                    </div> <!-- /.col-md-4 -->
                <?php endforeach; endif;?>
                </div> <!--/row -->
            </div> <!-- /.container -->
        </section>
    <?php endif; ?>