<?
/**
 * Summary.
 *
 * Description.
 *
 * @link URL
 *
 * @package WordPress
 * @subpackage Component
 * @since Version
 */


function wpld_plugin_settings_page(){
    // register_setting( $option_group:string, $option_name:string, $args:array )
    register_setting( 'wpld_options_settings', 'wpld_like_btn_label'); //Same options group 
    register_setting( 'wpld_options_settings', 'wpld_dislike_btn_label'); //Same options group 

    add_settings_section( 'wpld_plugin_section', 'WPLD LIEK DISLIKE SYSTEM', 'wpld_callback_section_button_label', 'wpld-settings');
    
    // add_settings_section( $id:string, $title:string, $callback:callable, $page:string )
    add_settings_field( 'wpld_plugin_like_field', 'Like Button Label', 'wpld_callback_like_button_field', 'wpld-settings', 'wpld_plugin_section');

    // add_settings_field( $id:string, $title:string, $callback:callable, $page:string, $section:string, $args:array )
    add_settings_field( 'wpld_plugin_dislike_field', 'Dislike Button Label', 'wpld_callback_dislike_button_field', 'wpld-settings', 'wpld_plugin_section');
}

add_action('admin_init','wpld_plugin_settings_page');


function wpld_callback_section_button_label(){

}

function wpld_callback_like_button_field(){
    $settings = get_option('wpld_like_btn_label'); //parameter option name
    ?>

    <input type="text" name="wpld_like_btn_label" value="<?php echo isset($settings) ? esc_attr($settings) : ''; ?>">

    <?php
}

function wpld_callback_dislike_button_field(){
    $settings = get_option('wpld_dislike_btn_label');
    ?>

    <input type="text" name="wpld_dislike_btn_label" value="<?php echo isset($settings) ? esc_attr($settings) : ''; ?>">

    <?php
}
