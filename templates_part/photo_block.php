<?php 
//Photos apparentées 
?>
<h3> Vous aimerez aussi </h3>
<div class="related_picture">
    
    <?php
        $category = strip_tags(get_the_term_list($post->ID, 'categorie'));
        $morePictures = new WP_Query([
            'post__not_in' => [get_the_ID()],
            'post_type' => 'photo',
            'posts_per_page' => 2,
            'tax_query' => [
                [
                'taxonomy' => 'categorie',
                'field' => 'slug',
                'terms' => $category
                ]
            ]
        ]);
         
        while($morePictures->have_posts()){ 
           //var_dump($morePictures->get_the_post()); exit;
            $morePictures->the_post();
            $thumbnail_id = get_post_thumbnail_id();
            $thumbnail_url = wp_get_attachment_image_src($thumbnail_id, "large");
            ?>

                <img src="<?php echo esc_url($thumbnail_url[0]); ?>" alt="<?php the_title(); ?>">

        <?php
        } 
    ?>    
</div>
<hr/>