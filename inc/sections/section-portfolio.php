<?php 

    // Portfolio Repeater
    $portfolio_repeater = get_theme_mod(
        'portfolio_repeater', json_encode( array()) 
    );
    $portfolio_repeaters = json_decode($portfolio_repeater);

    // Portfolio title
    $portfolio_title  = get_theme_mod( 'portfolio_title', 'Our Portfolio');

    // portfilio Description
    $portfolio_desc   = get_theme_mod( 'portfolio_desc', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci facilis nemo quae, alias, aspernatur placeat.');

    // Portfolio section enabe/disable
    $switch_portfolio = get_theme_mod( 'portfolio_enable', 'enable');

    // Portfolio Switch condition
    if ( $switch_portfolio ):
?>



    <section id="portfolio" class="portfolio tx-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-top text-center wow bounceIn" data-wow-delay=".2s" >
                        <?php if ($portfolio_title):?>
                            <h1 class="section-title">
                                <?php echo esc_html($portfolio_title); ?>
                            </h1> 
                        <?php endif; ?>

                         <?php if ($portfolio_desc):?>
                            <p class="section-desc">
                                <?php echo esc_html($portfolio_desc); ?>
                            </p>
                        <?php endif; ?>

                     </div> <!-- /.section-title -->
                </div> <!-- /.col-md-12 -->


                <div id="portfolio-body">
                    <ul class="portfolio-filter wow fadeInLeft" data-wow-delay=".6s">
                        <li>
                            <a  class="active" href="#" data-filter="*">
                                <?php esc_html_e('Show All', 'switch-lite');?>
                            </a>
                        </li>
                        <?php if($portfolio_repeaters): ?>
                        <?php
                            $data = array();
                            foreach($portfolio_repeaters as $portfolio_item) {

                                $termname = strtolower($portfolio_item->text);  
                                $termname = str_replace("", "", $termname);
                                if(!in_array($termname, $data)){
                                        $data[] = $termname;
                                    }
                                ?>  
                                <li>
                                    <a href="#" data-filter=".<?php echo esc_html($termname);?>">
                                        <?php echo esc_html($portfolio_item->text); ?>
                                        
                                    </a>
                                </li>
                            <?php
                            }
                        ?>
                    <?php endif; ?>
                    </ul>
                </div>

                <div id="da-thumbs" class="da-thumbs " >
                <?php if($portfolio_repeaters): ?>
                    <?php foreach($portfolio_repeaters as $portfolio_item):?>
                        <?php 
                            $tag = $portfolio_item->subtitle; 
                            $tag_arr = explode(',' , $tag);

                        ?>

                        <div class="col-md-4 mix item <?php foreach ($tag_arr as $key ) {
                            echo esc_attr(strtolower($key));
                        } ?> wow fadeInUp" data-wow-delay=".6s">

                            <?php if($portfolio_item->image_url): ?>
                                <a href="#">
                                    <img src="<?php echo esc_url($portfolio_item->image_url); ?>" alt="Portfolio Image">
                                    <div></div>    
                                </a>
                            <?php endif; ?>

                            <span class="portfolio-buttons">

                                <?php if($portfolio_item->image_url): ?>
                                    <a  data-rel="lightcase:slideshow" class="test-popup-link" href="<?php echo esc_url($portfolio_item->image_url); ?>" >
                                        <i class="fa fa-search"></i>
                                    </a>
                                <?php endif; ?>

                                <?php if($portfolio_item->link): ?>
                                    <a href="<?php echo esc_url($portfolio_item->link); ?>" target="_blank">
                                        <i class="fa fa fa-link"></i>
                                    </a>
                                <?php endif; ?>

                            </span><!-- /.portfolio buttons -->
                        </div><!-- /.col-md-4 -->

                    <?php endforeach; endif;?>
                </div>  <!-- /.da-thumbs -->
            </div> <!--/row -->
        </div> <!-- /.container -->
    </section>
<?php endif; ?>