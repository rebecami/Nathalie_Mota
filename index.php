<?php get_header() ?>

<!-- HERO -->
<div class="hero">
    <h1 class="site_title"> Photographe event</h1>
        <?php
        $query_hero = new WP_Query([
            'post_type' => 'photo',        
            'posts_per_page' => 1,
            'orderby'=> 'rand',
            'tax_query' =>[
                [
                    'taxonomy' => 'format',
                    'field' => 'slug',
                    'terms' => 'paysage'
                ]
            ]
        ]);
            while($query_hero->have_posts()){ 
                $query_hero->the_post();?>
                    <img src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>">
                    
            <?php
            } 
        ?>    
</div>

<div class="home_gallery">
    <?php 
    $gallery = new WP_Query([
        'post_type' => 'photo',
        'posts_per_page' => 8
    ]);
    while($gallery->have_posts()){ 
        $gallery->the_post();
        $thumbnail_id = get_post_thumbnail_id();
        $thumbnail_url = wp_get_attachment_image_src($thumbnail_id, 'medium-large');?>
            <img src="<?php echo esc_url($thumbnail_url[0]); ?>" alt="<?php the_title(); ?>"><?php
    }
    ?>
</div>

<div class="btn__wrapper">
  <button class="btn__primary" id="load-more">Charger plus</button>
</div> 
<hr/>

<?php get_footer() ?>