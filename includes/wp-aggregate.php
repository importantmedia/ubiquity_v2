<?php


add_action('edit_post', 'ubiq_agg_edit_post', 20, 2);
add_action('save_post', 'ubiq_agg_edit_post', 20, 2);


/*
 * Save the post in the wp_allposts table for any
 * changes including comment additions or moderation.
 */
function ubiq_agg_edit_post($post_id, $post) {
  global $wpdb, $wp_current_filter, $wp_actions;
  static $ran = false;

  $current_action = end($wp_current_filter);
  
  if (!get_option('ubiq_aggregate')) {
  	return;
  }

  if (is_object($post) && $post->post_type == 'post') {

    // Save post to global posts table
    $data = array(
      'post_author' => $post->post_author,
      'post_status' => $post->post_status,
      'post_date_gmt' => $post->post_date_gmt,
      'post_modified_gmt' => $post->post_modified_gmt,
      'comment_count' => $post->comment_count,
    );
    
    // Check if post is inserted yet
    $sql = 'SELECT post_status FROM wp_allposts
            WHERE blog_id="'.$wpdb->blogid.'" AND post_id="'.$post_id.'" ';
    $result = $wpdb->get_var($sql);
        
    if ($result) { // Update existing post
      $where = array(
        'blog_id' => $wpdb->blogid,
        'post_id' => $post->ID,
      );
      $result = $wpdb->update('wp_allposts', $data, $where);
    } else { // Insert new post
      $data['blog_id'] = $wpdb->blogid;
      $data['post_id'] = $post->ID;
      $data['post_type'] = $post->post_type;
      $result = $wpdb->insert('wp_allposts', $data);
    }
    
  }
  $ran = true;
}


function ubiq_agg_get_posts_for_author($authorid) {
	global $wpdb;
	
	$sql = 'SELECT post_id, blog_id FROM wp_allposts
			WHERE post_author="'.$authorid.'" AND post_type="post" AND post_status="publish" ';
			
	$result = $wpdb->get_var($sql);
	
	return $result;
}

?>