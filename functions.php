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
    wp_enqueue_script ('script', get_stylesheet_directory_uri() . '/script.js', array(), '1.0', true);
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

add_action('after_setup_theme', 'montheme_supports');
add_action('wp_enqueue_scripts', 'montheme_register_assets');
add_filter('nav_menu_css_class', 'montheme_menu_class');
add_filter('nav_menu_link_attributes', 'montheme_menu_link_class');