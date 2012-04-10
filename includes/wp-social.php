<?php

add_action('wp_head','ubiq_add_socialgraph');
//add_action('wp_footer','ubiq_fb_javascriptapi');

//to avoid activating filters... get the excerpt manually

// make my own excerpt
function ubiq_showBrief($str, $length) {
  $str = strip_tags($str);
  $str = explode(" ", $str);
  return implode(" " , array_slice($str, 0, $length));
}

function ubiq_add_socialgraph() {
  if (!get_option('ubiq_fb_opengraph')) { return; }

  if (is_single()) {
    global $post;
    
    $image_id	= get_post_thumbnail_id($post->ID);
    $image_url	= wp_get_attachment_image_src( $image_id );
    
    // create my excerpt for facebook
    $content	= $post->post_content;
	$brief		= ubiq_showBrief ($content, 55);
	
	// get remaining variables
	$title		= get_the_title();
	$link		= get_permalink();
	$sitename	= get_bloginfo('name');
    ?>
      <meta property="og:title" content="<?php echo $title; ?>"/>
      <meta property="og:type" content="article"/>
      <meta property="og:url" content="<?php echo $link; ?>"/>
		<?php if ( has_post_thumbnail() ) { ?>
		<meta property="og:image" content="<?php echo $image_url[0]; ?>"/>
		<?php } else { ?>
		<meta property="og:image" content="<?php echo header_image(); ?>"/>
        <?php } ?>
      <meta property="og:site_name" content="<?php echo $sitename; ?>"/> 
      <meta property="og:description" content="<?php echo $brief; ?>"/>
      <?php if (get_option('ubiq_fb_appid')) { ?>
      <meta property="fb:app_id" content="<?php echo get_option('ubiq_fb_appid') ?>" />
      <?php } ?>
    <?php
/*
      if (function_exists('sharing_display')) {
        add_filter( 'excerpt_length', 'calculate_excerpt_length' ); 
        add_filter( 'the_excerpt', 'sharing_display', 19 );
      }
*/
  } else if(is_home()) {

    ?>
      <meta property="og:title" content="<?php echo get_bloginfo('name') ?>"/>
      <meta property="og:type" content="website"/>
      <meta property="og:url" content="<?php bloginfo('url') ?>"/>
      <meta property="og:image" content="<?php echo header_image(); ?>"/>
      <meta property="og:site_name" content="<?php echo get_bloginfo('name') ?>"/> 
      <meta property="og:description" content="<?php echo bloginfo('description') ?>"/>
      <?php if (get_option('ubiq_fb_appid')) { ?>
      <meta property="fb:app_id" content="<?php echo get_option('ubiq_fb_appid') ?>" />
      <?php } ?>
    <?php
  }
}

function ubiq_fb_javascriptapi() {
  if (!get_option('ubiq_fb_javascriptsdk') && !get_option('ubiq_fb_appid') && !is_admin()) { return; }
  
  $fbAppId = get_option('ubiq_fb_appid');
  ?>
  <div id="fb-root"></div>
  <script>
    window.fbAsyncInit = function() {
      FB.init({appId: '<?php echo $fbAppId ?>', status: true, cookie: true,
               xfbml: true});
    };
    (function() {
      var e = document.createElement('script'); e.async = true;
      e.src = document.location.protocol +
        '//connect.facebook.net/en_US/all.js';
      document.getElementById('fb-root').appendChild(e);
    }());
  </script>
  <?php
}

function ubiq_sitecard() {
  include('widgets/sitecard.php');
}

function ubiq_social_buttons() {
  include('widgets/social_buttons.php');
}