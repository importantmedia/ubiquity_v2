<?php
/*
Plugin Name: Ubiquity Toolbar v2
Plugin URI: http://p2.importantmedia.org
Description: The Everything Plugin for the Important Media Network
Version: 0.3
Author: Andrew Norcross
Author URI: http://andrewnorcross.com
License: MIT
*/

require_once('includes/wp-admin.php');
require_once('includes/wp-social.php');
require_once('includes/wp-widgets.php');
require_once('includes/wp-aggregate.php');

// nav bar
add_action('wp_print_scripts', 'ubiquity_scripts_action', 50);
add_action('ubiquity_body_scripts', 'ubiq_print_liftium_header', 75);
add_action('wp_print_styles', 'ubiquity_styles_action');
add_action('wp_footer','ubiquity_print_tracker_bodybottom');


// analytics
add_action('wp_head','ubiquity_print_ga_tracking_header');
add_action('wp_footer','ubiquity_print_ga_tracking_footer');

add_action('wp_head', 'ubiquity_print_customer_analytics_header');
add_action('wp_footer', 'ubiquity_print_customer_analytics_footer');

add_shortcode('field', 'ubiq_shortcode_field');

function ubiq_shortcode_field($atts) {
	extract(shortcode_atts(array(
			'name' => 'bar',
		), $atts));

	$return = get_post_meta(get_the_ID(), $name, true);

	return $return;
}


function ubiquity_print_customer_analytics_header() {
  if(!is_admin()) {
    echo get_option('ubiq_analytics_other');
  }
}

function ubiquity_print_customer_analytics_footer() {
  if(!is_admin()) {
    echo get_option('ubiq_analytics_footer');
  }
}

function ubiquity_print_ga_tracking_footer() {
  if (get_option('ubiq_ga_siteid')) {
  ?>
  <script type="text/javascript">  (function() {
      var ga = document.createElement('script');     ga.type = 'text/javascript'; ga.async = true;
      ga.src = ('https:'   == document.location.protocol ? 'https://ssl'   : 'http://www') + '.google-analytics.com/ga.js';
      var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
      })();
  </script>
  <?php
  }
}

function ubiquity_print_ga_tracking_header() {
  if (get_option('ubiq_ga_siteid')) {
    $blogurl = preg_replace("/^https?:\/\/(.+)$/i","\\1", get_bloginfo( 'url' ));
  ?>
  <script type="text/javascript">var _sf_startpt=(new Date()).getTime()</script>
  <script type="text/javascript">
    var _gaq = _gaq || [];
        _gaq.push(
          ['_setAccount', '<?php echo get_option('ubiq_ga_siteid') ?>'],
          ['_setAllowHash', false],
          ['_setDomainName', '.<?php echo $blogurl ?>'],
          ['_setAllowLinker',true],
          ['_trackPageview']
        <?php if(get_option('ubiq_ga_rollup')) { ?>
          , ['b._setAccount', 'UA-17151946-1'],
          ['b._setAllowHash', false],
          ['b._setDomainName', '.<?php echo $blogurl ?>'],
          ['b._setAllowLinker',true],
          ['b._trackPageview']
        <?php } ?>
        <?php if( is_single() ) {
          global $post;
          global $blog_id;
        ?>
          , ['c._setAccount', 'UA-19342255-1'],
          ['c._setAllowHash', false],
          ['c._setDomainName', '.<?php echo $blogurl ?>'],
          ['c._setAllowLinker',true],
          ['c._trackPageview', '/blog/<?php echo $blog_id; ?>/author/<?php echo $post->post_author; ?>/']
        <?php } else {
          global $blog_id;
        ?>
          , ['c._setAccount', 'UA-19342255-1'],
          ['c._setAllowHash', false],
          ['c._setDomainName', '.<?php echo $blogurl ?>'],
          ['c._setAllowLinker',true],
          ['c._trackPageview', '/blog/<?php echo $blog_id; ?>/other/']
        <?php } ?>
        );
  </script>
  <?php
  }
}

function ubiquity_print($function) {
  if (!get_option('ubiq_shownavbar') && !is_admin()) { return; }

	switch ($function) {
		case "navigation": //legacy
			ubiquity_print_navigation();
			break;
		case "tracker_bodytop": //legacy
			ubiquity_print_tracker_bodytop();
			break;
		case "tracker_bodybottom":
			//ubiquity_print_tracker_bodybottom();
			break;
		case "navbar_header":
		  ubiquity_print_tracker_bodytop();
		  ubiquity_print_navigation();
		  break;
	}
}


function ubiquity_print_navigation() {

include("includes/ubiquity-nav.php");

}

function ubiquity_print_tracker_bodytop() { ?>

<?php
}

function ubiquity_print_tracker_bodybottom() {
  if (!get_option('ubiq_shownavbar') && !is_admin()) { return; }
?>
	<script type='text/javascript'> var mp_protocol = (('https:' == document.location.protocol) ? 'https://' : 'http://'); document.write(unescape('%3Cscript src="' + mp_protocol + 'api.mixpanel.com/site_media/js/api/mixpanel.js" type="text/javascript"%3E%3C/script%3E')); </script> <script type='text/javascript'> try {  var mpmetrics = new MixpanelLib('a32eb79d576c46f49e555808f0e9bf7a'); } catch(err) { null_fn = function () {}; var mpmetrics = {  track: null_fn,  track_funnel: null_fn,  register: null_fn,  register_once: null_fn, register_funnel: null_fn }; } </script>
<?php
}

function ubiquity_scripts_action() {
  if (!is_admin()) {
    $ubiquity_plugin_url = trailingslashit( get_bloginfo('wpurl') ).PLUGINDIR.'/'. dirname( plugin_basename(__FILE__) );
    wp_enqueue_script('ubiquity_social_script', $ubiquity_plugin_url.'/scripts/ubiquity.social.js',array('jquery'));
  }


	if (!get_option('ubiq_shownavbar') && !is_admin()) { return; }
	global $user_login;

	$ubiquity_plugin_url = trailingslashit( get_bloginfo('wpurl') ).PLUGINDIR.'/'. dirname( plugin_basename(__FILE__) );

	$local_user = '';
	if(is_user_logged_in()) {
		get_currentuserinfo();
		$local_user = $user_login;
	}
	wp_enqueue_script('ubiquity_jplug', $ubiquity_plugin_url.'/scripts/ubiquity.jplug.1.0.js', array('jquery'));
	wp_localize_script( 'ubiquity_jplug', 'UbiquitySettings', array(
		  	'username' => $local_user
		));
}

function ubiquity_styles_action() {
  if (!is_admin()) {
    $ubiquity_plugin_url = trailingslashit( get_bloginfo('wpurl') ).PLUGINDIR.'/'. dirname( plugin_basename(__FILE__) );
    wp_register_style('ubiquity_widget_style', $ubiquity_plugin_url.'/css/ubiq_widgets.css');
    wp_enqueue_style('ubiquity_widget_style');
  }

	if (!get_option('ubiq_shownavbar') && !is_admin()) { return; }

	$ubiquity_plugin_url = trailingslashit( get_bloginfo('wpurl') ).PLUGINDIR.'/'. dirname( plugin_basename(__FILE__) );
	wp_register_style('ubiquity_style', $ubiquity_plugin_url.'/css/ubiquity_nav.css');
	wp_enqueue_style('ubiquity_style');
}

function ubiquity_print_init_script() { ?>

<?php
}

function ubiq_get_ID_by_slug($page_slug) {
    $page = get_page_by_path($page_slug);
    if ($page) {
        return $page->ID;
    } else {
        return null;
    }
}

function ubiq_custom_avatar($id) {
	if (function_exists('author_avatar_url')) return author_avatar_url($id);
}

function ubiq_print_liftium_header() {
  if (!is_admin() && get_option('ubiq_liftium_pubid')) {
    ?>
    <script>LiftiumOptions = {pubid: <?php echo get_option('ubiq_liftium_pubid') ?>, placement : "<?php echo get_option('ubiq_liftium_placement') ?>"}</script>
    <script src="http://delivery.importantmedia.org/js/Liftium.js"></script>

    <?php
  }
}

?>
