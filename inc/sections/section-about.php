<?php 

     // About Enable/Disable
    $switch_about = get_theme_mod( 'about_enable', 'enable');

    // About us image
    $about_img    = get_theme_mod( 'about_image');

     // About us title
    $about_title  = get_theme_mod( 'about_title', 'About Us');

    // About us Description
    $about_desc   = get_theme_mod( 'about_desc', 'We must understand what your needs are in order to offer.');

    // About sub title
    $sub_title    = get_theme_mod( 'about_sub_title', 'Little more about us');

    // About sub Description
    $sub_desc     = get_theme_mod( 'about_sub_desc', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Laborum, obcaecati, veritatis, voluptatem perferendis ipsum optio mollitia culpa excepturi necessitatibus eveniet ad asperiores inventore aliquid. Velit.Lorem ipsum dolor sit amet,Voluptatem perferendis ipsum optio mollitia culpa excepturi necessitatibus eveniet ad asperiores inventore aliquid. Velit.Lorem ipsum dolor sit amet, consectetur adipisicing elit. Laborum, obcaecati, veritatis, voluptatem perferendis ipsum optio mollitia culpa excepturi necessitatibus eveniet ad asperiores inventore aliquid. Velit. ad asperiores inventore aliquid. Velit.Lorem ipsum dolor sit amet, consectetur adipisicing elit.');

    if ( $switch_about ):
?>

        <section id="about" class="about tx-section">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="section-top text-center wow bounceIn" data-wow-delay=".2s">
                           <?php if ($about_title):?>
                                <h1 class="section-title"><?php echo esc_html($about_title); ?></h1>
                            <?php endif; ?>

                             <?php if ($about_desc):?>
                                <p class="section-desc"><?php echo esc_html($about_desc); ?></p>
                            <?php endif; ?>
                        </div> <!-- /.Section-title -->
                    </div> <!-- /.col-md-12 -->


                    <div class="col-md-6 wow fadeInLeft" data-wow-delay=".5s">
                        <div class="block">
                            <?php if ($sub_title):?>
                               <h3 class="sub-title"><?php echo esc_html($sub_title);?></h3>
                            <?php endif; ?>

                            <?php if ($sub_desc):?>
                               <p class="sub-desc"><?php echo esc_html($sub_desc);?></p>
                            <?php endif; ?>
                        </div> <!-- /.block -->
                    </div> <!-- /.col-md-6 -->


                    <div class="col-md-6 wow fadeInRight" data-wow-delay=".7s">
                        <div class="block">
                            <?php if ($about_img):?>
                                <img src="<?php echo esc_url($about_img);?>" alt="About Image">
                            <?php endif; ?>
                        </div><!-- /.block -->
                    </div> <!-- /.col-md-6 -->
                </div> <!--/row -->
            </div><!--/.container -->
       </section>
   <?php endif; ?>
