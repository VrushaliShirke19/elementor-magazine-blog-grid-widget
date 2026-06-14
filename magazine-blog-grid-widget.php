<?php
/**
 * Plugin Name: Magazine Blog Grid Widget
 * Description: Custom Elementor Magazine Grid Widget
 * Version: 1.0.0
 * Author: Vrushali Shirke
 */

if (!defined('ABSPATH')) {
    exit;
}

/*
|--------------------------------------------------------------------------
| Load CSS
|--------------------------------------------------------------------------
*/

function mbgw_enqueue_styles() {

    wp_enqueue_style(
        'mbgw-style',
        plugin_dir_url(__FILE__) . 'assets/css/magazine-grid.css',
        [],
        '1.0.0'
    );
}

add_action(
    'wp_enqueue_scripts',
    'mbgw_enqueue_styles'
);

/*
|--------------------------------------------------------------------------
| Register Elementor Widget
|--------------------------------------------------------------------------
*/

function mbgw_register_widget($widgets_manager) {

    require_once(
        __DIR__ . '/widgets/magazine-grid-widget.php'
    );

    $widgets_manager->register(
        new \MBGW_Magazine_Grid_Widget()
    );
}

add_action(
    'elementor/widgets/register',
    'mbgw_register_widget'
);