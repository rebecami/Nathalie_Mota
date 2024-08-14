<?php

function montheme_supports()
{
    add_theme_support('title-tag');
    add_theme_support('menus');
    add_theme_support( 'post-thumbnails');
    register_nav_menu('header', 'En tête du menu');
    register_nav_menu('footer', 'Pied de page');
}

function montheme_register_assets () {
    wp_register_style('bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css');
    wp_enqueue_style('bootstrap');
    wp_enqueue_style('theme-style', get_stylesheet_directory_uri() . '/style.css');
    wp_enqueue_style('fancybox-css', 'https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css');
    wp_enqueue_script('fancybox-js', 'https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js', array(), null, true);
    wp_enqueue_script ('script', get_stylesheet_directory_uri() . '/script.js', array(), '1.0', true);
    wp_localize_script('script', 'load_photo',[
        'ajaxUrl' => admin_url('admin-ajax.php'),
    ]);
}

function montheme_menu_class($classes)
{
    $classes[] = 'nav-item';
    return $classes;
}

function montheme_menu_link_class($attrs)
{
    $attrs['class'] = 'nav-link';
    return $attrs;
}

function contact_btn($items, $args){
    $items .= '
    <li class="menu-item menu-item-type-post_type menu-item-object-page nav-item">
    <a class="nav-link modal-js" id="myCTA" href="#" data-toggle="modal" role="button">CONTACT</a>
    </li>';
    return $items;
}

add_filter('wp_nav_menu_items', 'contact_btn', 10, 2);

add_action('after_setup_theme', 'montheme_supports');
add_action('wp_enqueue_scripts', 'montheme_register_assets');
add_filter('nav_menu_css_class', 'montheme_menu_class');
add_filter('nav_menu_link_attributes', 'montheme_menu_link_class');

function load_photo() {

    $args = [
        'post_type' => 'photo',
        'posts_per_page' => $_POST['nbPagePerPage'],
        'offset' => $_POST['offset'],
    ];

    if ( !empty ($_POST['categorie'])){
        $args['tax_query'][] = [    
                'taxonomy' => 'categorie',
                'field' => 'slug',
                'terms' => $_POST['categorie'],
        ];
    }
    if (!empty ($_POST['format'])){
        $args['tax_query'][] = [
                'taxonomy' => 'format',
                'field' => 'slug',
                'terms' => $_POST['format'],
        ];
    }
    if (!empty ($_POST['order'])){
        $args['orderby'] = 'date';
        $args['order'] = $_POST['order'];
    }

    $query = new WP_Query($args);
    if($query->have_posts()){
        while($query->have_posts()){ 
            $query->the_post();
            $thumbnail_id = get_post_thumbnail_id();
            $thumbnail_url = wp_get_attachment_image_src($thumbnail_id, 'medium-large');?>
            
         <div class="overlay__pic">
                <img src="<?php echo esc_url($thumbnail_url[0]); ?>" alt="<?php the_title(); ?>" data-src-full="<?php the_post_thumbnail_url() ?>">
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
            $photo_ref = get_field('reference'); 
            $caption = '<p>' . $photo_ref . '</p><p>' . implode(', ', $category_names) . '</p>';
            ?>            
                <a data-caption="<?php echo esc_attr($caption); ?>" href="<?php echo esc_url($thumbnail_url[0]); ?>" class="fancybox" data-fancybox="gallery">
                    <img class="thumbnail__expand" src="<?php echo get_template_directory_uri(); ?>/assets/icon_fullscreen.png" alt="Icône plein écran" />
                </a>
                <div class="thumbnail__info">
                    <p> <?php echo get_field('reference'); ?> </p>            
                    <p> <?php echo get_the_term_list($post->ID, 'categorie'); ?> </p>
                </div>
            </div>       
        </div>
            <?php
        }
    }
    else {
        echo "Aucune image à afficher";
    }
    exit;
}

add_action('wp_ajax_load_photo', 'load_photo');
add_action('wp_ajax_nopriv_load_photo', 'load_photo');
?>
