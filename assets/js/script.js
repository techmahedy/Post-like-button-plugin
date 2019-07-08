function wpld_like_btn_ajax(postId,userId){
  var post_id = postId;
  var user_id = userId;
  
  jQuery.ajax({
     url: wpld_ajax_object.ajax_url,
     type: 'post',
     data: {
         action: 'wpld_like_btn_ajax_action',
         pid: post_id,
         uid: user_id
     },
     success: function(response){
         jQuery("#response span").html(response);
     }
  });
}