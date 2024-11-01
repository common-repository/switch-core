<?php 

    $slider_repeater = get_theme_mod(
        'slider_repeater', json_encode( array()) 
    );
    $slider_repeaters = json_decode($slider_repeater);

    // Slider enabe/disable
    $switch_slider = get_theme_mod( 'slider_enable', 'enable');

     // Slider Conunt
    $slider_count = count($slider_repeaters);



    if ( $switch_slider ):
?>

<section id="hero-unit" class="slider clearfix">
    <div id="carousel" class="carousel slide" data-ride="carousel" data-interval="19000">
        <!-- Indicators -->
       <ol class="carousel-indicators">
            <?php for($i = 0; $i < $slider_count; $i++):
                $active = $i == 0 ? 'active' : '';?>
            <li data-target="#carousel" data-slide-to="<?php echo $i;?>" class="<?php echo $active;?>"></li>
            <?php endfor; ?>
        </ol>


        <!-- Wrapper for slides -->
        <div class="carousel-inner ">
            <?php  $i = 0;?>

            <?php if($slider_repeaters): ?>
            <?php foreach($slider_repeaters as $slider_item):?>
                 <?php $active = $i == 0 ? 'active' : ''; ?>
                <div class="item <?php echo $active;?> slider-<?php echo $i;?>" 
                    style="
                        <?php if($slider_item->image_url): ?>

                            background-image:url('<?php echo esc_url($slider_item->image_url); ?>');
                            background-size: cover;
                            background-repeat: no-repeat;
                            background-attachment: fixed;
                        <?php endif; ?>
    
                    ">
                    <div class="carousel-caption ">
                        <?php if($slider_item->title): ?>
                            <h1 class="slider-title animated animate-delay-1 slideInRight">
                                <?php echo esc_html($slider_item->title); ?>
                           </h1>
                        <?php endif; ?>

                        <?php if(!empty($slider_item->subtitle)): ?>
                            <p class="slider-desc animated animate-delay-2  zoomIn">
                              <?php echo esc_html($slider_item->subtitle); ?>
                            </p>
                        <?php endif; ?>
                        <div class="animated fadeInUp animate-delay-3">
                            <div class="btn-line">
                                <a target="_blank" href="<?php echo esc_url($slider_item->link); ?>">
                                    <p><?php echo esc_html($slider_item->text); ?></p>
                                    <span class="top"></span>
                                    <span class="right"></span>
                                    <span class="bottom"></span>
                                    <span class="left"></span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php $i++; endforeach; endif;?>
            
        </div>

        <a class="left hidden-xs carousel-control" href="#carousel" data-slide="prev">
            <i class="fa fa-angle-left"></i>
        </a>
        <a class="right hidden-xs carousel-control" href="#carousel" data-slide="next">
            <i class="fa fa-angle-right "></i>
        </a>

    </div> <!-- /#Carousel -->
</section> 
<?php endif; ?>