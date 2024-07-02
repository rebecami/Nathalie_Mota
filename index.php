<?php get_header() ?>

<!-- HERO -->
<div class="hero">
    <h1 class="site_title"> Photographe event</h1>
        <?php
        $query_hero = new WP_Query([
            'post_type' => 'photo',        
            'posts_per_page' => 1,
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

<?php get_footer() ?>