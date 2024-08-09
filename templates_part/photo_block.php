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
            $morePictures->the_post();
            $thumbnail_id = get_post_thumbnail_id();
            $thumbnail_url = wp_get_attachment_image_src($thumbnail_id, "large");?>
            <div class="overlay__pic">
                    <img src="<?php echo esc_url($thumbnail_url[0]); ?>" alt="<?php the_title(); ?>">
                <div class="thumbnail__overlay"> 
                    <div class="overlay"></div>  
                    <div class="thumbnail__eye">
                        <a href="<?php echo get_post_permalink(); ?>">
                            <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/Icon_eye.svg">
                        </a>
                    </div>
                    <?php
            $title = get_the_title();
            $categories = get_the_terms(get_the_ID(), 'categorie');
            $category_names = array();
            foreach ( (array) $categories as $category ) {
                $category_names[] = $category->name;
            }
            // contenu de l' affichage de la lightbox
            $photo_ref = get_field('reference'); 
            $caption = '<p>' . $photo_ref . '</p><p>' . implode(', ', $category_names) . '</p>';
            ?>  
                    <a data-caption="<?php echo esc_attr($caption); ?>" href="<?php echo esc_url($thumbnail_url[0]); ?>" class="fancybox" data-fancybox="gallery">
                        <img class="thumbnail__expand" 
                        src="<?php echo get_template_directory_uri(); ?>/assets/icon_fullscreen.png"
                        alt="Icône plein écran" />
                    </a>
                    <div class="thumbnail__info">
                        <p> <?php echo get_field('reference'); ?> </p>            
                        <p> <?php echo get_the_term_list($post->ID, 'categorie'); ?> </p>
                    </div>
                </div>       
            </div> <?php
        } 
    ?>    
</div>
<hr/>