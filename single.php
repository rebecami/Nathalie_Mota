<?php
/**
 * The template for displaying all single posts
 */
?>

<?php
    get_header();
?>

<?php if( have_posts()) {
    while ( have_posts()) {
        the_post();
    }
}
?>
    
<?php get_template_part('templates_part/photo-detail'); ?>

<?php get_footer(); ?>