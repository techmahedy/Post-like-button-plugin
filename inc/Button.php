<?php
function create_like_dislike_button($content){
  
    $like_btn_label = get_option('wpld_like_btn_label','Like'); //Last parameter default
    $dislike_btn_label = get_option('wpld_dislike_btn_label','Dislike');
    
    $user_id = get_current_user_id();
    $post_id = get_the_ID();

    $like_btn_wrap = '<div class="wpld-btn-container">';
    $like_btn = '<a hre="javascript:0;" onclick="wpld_like_btn_ajax('.$post_id.','.$user_id.');" class="wpld">'.$like_btn_label.'</>';
    $dislike_btn = '<a hre="javascript:;" class="wpld">'.$dislike_btn_label.'</>';
    $like_btn_wrap_end = '</div>';
    

    $ajax_response = "<div class='' id='response'><span></span></div>";

    $content .= $like_btn_wrap;
    $content .= $like_btn;
    $content .= $dislike_btn;
    $content .= $like_btn_wrap_end;
    $content .= $ajax_response;
  
    return $content;
  }
  add_filter('the_content','create_like_dislike_button');