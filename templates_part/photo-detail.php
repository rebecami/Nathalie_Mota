<?php 

//Vérifier l'activation de ACF
if (!function_exists('get_field')) return;

$reference = get_field('reference');
$categorie = get_terms(array(
    'taxonomy' => 'categorie',
    'hide_empty' => false,
));
$type = get_field('type');

?>

<article class="post">
    <div class="post_content">
        <h2><?php the_title(); ?></h2>
        <ul class="info">
            <p>
                <li> Référence: <span id="reference"> <?php echo $reference; ?> </span></li>
                <li> Catégorie: <?php echo get_the_terms(get_the_ID(), 'categorie')[0]->name; ?> </li>
                <li> Format: <?php echo get_the_terms(get_the_ID(), 'format') [0]->name; ?> </li>
                <li> Type: <?php echo $type; ?> </li>
                <li> Année: <?php the_time('Y'); ?> </li>
            </p>
        </ul>
        <hr/>
    </div>
    <div class="gallery_img">
        <?php the_post_thumbnail(); ?> 
    </div>
</article>

<div class="interested_picture">   
    <div class="photo_contact">
        <p class="interested">Cette photo vous intéresse?</p>
        <button id="myBtn">Contact <?php get_template_part('templates_part/modal'); ?> </button>
    </div>
    <div id="photo_navigation">
     <?php 
    $previousPhoto = get_previous_post();
    $nextPhoto = get_next_post();
    if (!empty($previousPhoto)) {
        $previousThumbnail = get_the_post_thumbnail_url($previousPhoto->ID);
        $previousLink = get_permalink($previousPhoto); ?> 
        <a id="previous_link" href="<?php echo $previousLink; ?>"> 
        <img class="miniature previous_img" src="<?php echo $previousThumbnail; ?>" alt="afficher la photo précédente" />
        <img class="arrow" src="<?php echo get_template_directory_uri(); ?>/assets/arrow_left.png" alt="Flèche vers la gauche" />
        </a>
        <?php
    }
    if(!empty($nextPhoto)) {
        $nextThumbnail = get_the_post_thumbnail_url($nextPhoto->ID);
		$nextLink = get_permalink($nextPhoto); ?>
        <a id="next_link" href="<?php echo $nextLink; ?>">
        <img class="arrow" src="<?php echo get_template_directory_uri(); ?>/assets/arrow_right.png" alt="Flèche vers la droite" /> 
        <img class= "miniature next_img" src="<?php echo $nextThumbnail; ?>" alt="afficher la photo suivante" />        
        </a>         
        <?php
    } ?>
    </div>
</div>
<hr/>

<?php get_template_part('templates_part/photo_block'); ?>

<?php get_footer(); ?>