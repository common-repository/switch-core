<?php 
    $team_repeater = get_theme_mod(
        'team_repeater', json_encode( array()) 
    );
    $team_repeaters = json_decode($team_repeater);


    // Team Enable/Disable
    $switch_team = get_theme_mod( 'team_enable', 'enable');

    // Team title
    $team_title  = get_theme_mod( 'team_title', 'Our Team');

    // Team Description
    $team_desc   = get_theme_mod( 'team_desc', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci facilis nemo quae, alias, aspernatur placeat.');

    if ( $switch_team ):
?>

        <section id="team" class="team tx-section">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="section-top text-center wow bounceIn" data-wow-delay=".2s">
                           <?php if ($team_title):?>
                                <h1 class="section-title"><?php echo esc_html($team_title); ?></h1>
                            <?php endif; ?>

                             <?php if ($team_desc):?>
                                <p class="section-desc"><?php echo esc_html($team_desc); ?></p>
                            <?php endif; ?>
                        </div> <!-- /.Section-title -->
                    </div> <!-- /.Section Title -->
                <?php if($team_repeaters): ?>
                <?php foreach($team_repeaters as $repeater_item):?>
                    <div class="col-md-4 wow zoomIn" data-wow-delay=".6s">
                        <div class="team-block text-center">
                            <div class="ih-item circle effect1">
                                    <div class="spin"></div>
                                    <?php if($repeater_item->image_url): ?>
                                        <div class="img">
                                            <img src="<?php echo esc_attr($repeater_item->image_url); ?>" alt="Team Image">
                                        </div>
                                    <?php endif; ?>

                            </div> <!-- /.ih-item -->

                            <div class="caption">
                                <?php if($repeater_item->title): ?>
                                    <h4 class="name"><?php echo esc_html($repeater_item->title); ?></h4>
                                <?php endif ?>

                                <?php if($repeater_item->subtitle): ?>
                                    <p class="designation"><?php echo esc_html($repeater_item->subtitle);?></p>
                                <?php endif; ?>

                                 <?php if($repeater_item->text): ?>
                                    <p class="desc">
                                        <?php echo esc_html($repeater_item->text);?>
                                    </p>         
                                <?php endif ?>               
                            </div> <!-- /.caption -->
                        </div> <!-- /.thumbnail -->
                    </div> <!-- /.col-md-4 -->

                 <?php endforeach; endif;?>
                </div> <!--/row -->
            </div> <!-- /.container -->
        </section>
    <?php endif; ?>
<?php 
