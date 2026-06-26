<?php
/**
 * gui·olsen — Hello Elementor Child Theme
 * functions.php
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/* ── Enqueue parent theme styles ── */
function guiolsen_child_enqueue_styles() {
    wp_enqueue_style(
        'hello-elementor-style',
        get_template_directory_uri() . '/style.css',
        [],
        wp_get_theme( 'hello-elementor' )->get( 'Version' )
    );
}
add_action( 'wp_enqueue_scripts', 'guiolsen_child_enqueue_styles' );

/* ── Enqueue fonts ── */
function guiolsen_enqueue_fonts() {
    wp_enqueue_style(
        'guiolsen-fonts',
        'https://fonts.googleapis.com/css2?family=Syne:wght@400;500;600;700;800&family=Inter:wght@400;500;600;700&display=swap',
        [],
        null
    );
}
add_action( 'wp_enqueue_scripts', 'guiolsen_enqueue_fonts' );

/* ── Maintenance mode ── */
function guiolsen_maintenance_mode() {
    if ( ! current_user_can( 'administrator' ) && ! is_admin() ) {
        wp_die(
            '<h1 style="font-family: Syne, sans-serif; font-size: 32px; color: #111;">We\'re updating our website.</h1>
            <p style="font-family: Inter, sans-serif; color: #555; font-size: 16px;">Something better is coming soon.</p>',
            'Maintenance',
            [ 'response' => 503 ]
        );
    }
}
add_action( 'wp', 'guiolsen_maintenance_mode' );
