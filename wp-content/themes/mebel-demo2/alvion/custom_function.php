<?php

function css() {
    wp_register_style('mebel-demo-css', get_template_directory_uri(). '/alvion/libs/css/custom.css');
    wp_enqueue_style( 'mebel-demo-css');

    wp_register_style('bootstrap4', get_template_directory_uri(). '/alvion/libs/css/bootstrap.css');
    wp_enqueue_style( 'bootstrap4');

    wp_register_script( 'bootstrap4', get_template_directory_uri() . '/alvion/libs/js/bootstrap.min.js', array(), '4', true );
    wp_enqueue_script('bootstrap4');
}

add_action( 'wp_enqueue_scripts', 'css' );