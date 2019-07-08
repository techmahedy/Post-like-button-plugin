<?php
/**
 * Plugin Name: Like Dislike System
 */


 /**
  * If this file is called directly , abort;
  */

 if(!defined('WPINC')){
     die();
 }

if(!defined('WPLD_PLUGIN_VERSION')){
    define('WPLD_PLUGIN_VERSION','1.0.0');
}

if(!defined('WPLD_PLUGIN_DIR')){
    define('WPLD_PLUGIN_DIR',plugin_dir_url( __FILE__ ));
}

 if(!function_exists('wpld_plugin_scripts')){
     function wpld_plugin_scripts(){
      wp_enqueue_style('wpld-css', WPLD_PLUGIN_DIR. 'assets/css/style.css');
      wp_enqueue_script('wpld-script', WPLD_PLUGIN_DIR. 'assets/js/script.js',array('jquery'),'1.0.0',true);
     

     wp_localize_script( 'wpld-script', 'wpld_ajax_object', [
         'ajax_url' => admin_url('admin-ajax.php')
     ]);
    }
     add_action('wp_enqueue_scripts','wpld_plugin_scripts');
}


/**
 * Add plugin menu page
 */

 function wpld_plugin_top_menu_page_html(){
    if(!is_admin()){
        return;
    }?>

    <div class="wrap">
       <form action="options.php" method="post">
          <?php
           
           settings_fields('wpld_options_settings');
        //    settings_fields( $option_group:string )
           do_settings_sections('wpld-settings');
        //    do_settings_sections( $page:string )
           submit_button('Save Changes');


          ?>
       </form>
    </div>

    <?php
 }

 function wpld_register_plugin_menu_page(){
    add_menu_page( 'WP Like System', 'WPLD Settings', 'manage_options', 'wpld-settings', 'wpld_plugin_top_menu_page_html', 'dashicons-thumbs-up', 300);

    // add_options_page( 'WP Like System', 'WPLD Settings', 'manage_options', 'wpld-settings', 'wpld_plugin_top_menu_page_html', 'dashicons-thumbs-up', 300);

    // add_theme_page( 'WP Like System', 'WPLD Settings', 'manage_options', 'wpld-settings', 'wpld_plugin_top_menu_page_html', 'dashicons-thumbs-up', 300);
 }

 add_action('admin_menu','wpld_register_plugin_menu_page');

 /**
  * Plugin settings page
  */
require plugin_dir_path( __FILE__ ). 'inc/Settings.php';

/**
 * Create custom database table
 */

require plugin_dir_path( __FILE__ ). 'inc/Activate.php';


/**
 * Create like and dislike button using filter
 */
require plugin_dir_path( __FILE__ ). 'inc/Button.php';

/**
 * Ajax Action
 */

 function wpld_like_btn_ajax_action(){

   global $wpdb;
   require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
   $table_name = $wpdb->prefix . "wpld_like"; 

   $post_id = $_POST['pid']; //pid coming from script file 
   $user_id = $_POST['uid']; //pid coming from script file 
   
   if(isset($post_id) && isset($user_id)){

      $check_user_like = $wpdb->get_var("SELECT COUNT(*) FROM $table_name WHERE user_id = $user_id AND post_id = $post_id ");
      

      if($check_user_like == true){
        echo 'You already liked this post';
      }else{
        $wpdb->insert(
            ''.$table_name.'',
              array(
                'post_id' => $post_id,
                'user_id' => $user_id,
                'like_count' => 1,
                'dislike_count' => 0
              ),
              array(
                  '%d',
                  '%d',
                  '%d'
              )
          );
    
          if($wpdb->insert_id){
              echo 'thanks for loving this post';
          }
      }
   }
   wp_die();
 }

 add_action('wp_ajax_wpld_like_btn_ajax_action','wpld_like_btn_ajax_action');
 add_action('wp_ajax_nopriv_wpld_like_btn_ajax_action','wpld_like_btn_ajax_action');

function show_like_count($content){
  global $wpdb;
  $table_name = $wpdb->prefix . "wpld_like"; 
  $post_id = get_the_ID();
  $like_count = $wpdb->get_var("SELECT COUNT(*) FROM $table_name WHERE post_id = $post_id AND like_count = 1");

  $content .= $like_count.' People liked this post';
  return $content;
}

add_filter('the_content','show_like_count');