<?php
/**
 * Sending Mail After Publishing Post
 */

// function mailSendingAfterPublishPost(){
//     global $post;
//     $author = $post->post_author; //Post author id
//     $name = get_the_author_meta( 'display_name', $author );
//     $email = get_the_author_meta( 'user_email', $author );
//     $title = $post->post_title;
//     $permalink = get_permalink($ID);
//     $edit = get_edit_post_link($ID, '');

//     $to[] = sprintf('%s <%s>',$name,$email);
//     $subject = sprintf('Published: %s',$title);
//     $message = sprintf("Congratulations , %s! Your article '%s' has been published." ."\n\n", $name,$title);
//     $message .= sprintf('View: %s',$permalink);
//     $headers[] = '';
//     wp_mail($to , $subject, $message, $headers);
// }
// add_action('publish_post','mailSendingAfterPublishPost');


// Multidimensional array
// $superheroes = array(
//     "spider-man" => array(
//         "name" => "Peter Parker",
//         "email" => "peterparker@mail.com",
//     ),
//     "super-man" => array(
//         "name" => "Clark Kent",
//         "email" => "clarkkent@mail.com",
//     ),
//     "iron-man" => array(
//         "name" => "Harry Potter",
//         "email" => "harrypotter@mail.com",
//     )
// );
 
// // Printing all the keys and values one by one
// $keys = array_keys($superheroes);
// for($i = 0; $i < count($superheroes); $i++) {
//     echo $keys[$i] . "{<br>";
//     foreach($superheroes[$keys[$i]] as $key => $value) {
//         echo $key . " : " . $value . "<br>";
//     }
//     echo "}<br>";
// }
