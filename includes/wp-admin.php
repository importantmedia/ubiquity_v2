<?php

add_action('admin_menu','ubiq_superadmin_menu');

function ubiq_superadmin_menu() {
	global $menu;

	if (version_compare(get_bloginfo('version'), '2.9', '>='))
	$menu[27] = array('', 'read', 'separator-dolores', '', 'wp-menu-separator');

	add_menu_page(__('Ubiquity Network Configuration', 'ubiquity-network-config'), __('Ubiquity', 'ubiquity-title'), 'update_core', 'ubiquity-network-config', 'ubiq_options_network', '',28); #wp

	add_submenu_page('ubiquity-network-config', __('Network Integration', 'ubiq-netopts'), __('Network Integration', 'ubiq-netopts'), 'update_core', 'ubiquity-network-config', 'ubiq_options_network'); #wp
	add_submenu_page('ubiquity-network-config', __('Analytics Options', 'ubiq-socialopts'), __('Analytics Options', 'ubiq-analyticsopts'), 'update_core', 'ubiquity-analytics-config', 'ubiq_options_analytics'); #wp
	add_submenu_page('ubiquity-network-config', __('Social Identities', 'ubiq-socialopts'), __('Social Identities', 'ubiq-socialopts'), 'update_core', 'ubiquity-social-config', 'ubiq_options_social'); #wp
	
	add_action('admin_init','ubiq_register_settings');
	
}

function ubiq_register_settings() {
  register_setting('ubiq-network-settings','ubiq_shownavbar');
  register_setting('ubiq-network-settings','ubiq_liftium_pubid');
  register_setting('ubiq-network-settings','ubiq_liftium_placement');
  register_setting('ubiq-network-settings','ubiq_scribol_tag');
  register_setting('ubiq-network-settings','ubiq_aggregate');
  register_setting('ubiq-network-settings','ubiq_crosspost');
  
  register_setting('ubiq-analytics-settings','ubiq_ga_siteid');
  register_setting('ubiq-analytics-settings','ubiq_ga_rollup');
  register_setting('ubiq-analytics-settings','ubiq_analytics_other'); //header
  register_setting('ubiq-analytics-settings','ubiq_analytics_footer'); //footer
  
  register_setting('ubiq-social-settings','ubiq_fb_appid');
  register_setting('ubiq-social-settings','ubiq_fb_fanpageid');
  register_setting('ubiq-social-settings','ubiq_fb_fanpageurl');
  
  register_setting('ubiq-social-settings','ubiq_fb_opengraph');
  register_setting('ubiq-social-settings','ubiq_fb_javascriptsdk');
  
  register_setting('ubiq-social-settings','ubiq_twtr_sitehandle');
  register_setting('ubiq-social-settings','ubiq_twtr_appid');
}

function ubiq_options_network() {
  if ( $_GET['updated'] == 'true' ) {
  	echo '<div class="updated">
  			<p><strong>' . __('Options saved.', 'blog_revenue'). '</strong></p>
  		</div>';
  }
  ?>
  
  
  <div class="wrap">
    <h2>Ubiquity Network Integration Options</h2>
    <form name="ubiq-net-options" method="post" action="options.php">
      <?php settings_fields('ubiq-network-settings') ?>
      
      <table class="form-table">
        <tbody>
          <tr valign="top">
            <th scope="row">
              <label for="ubiq_shownavbar">Network Navigation Bar</label>
            </th>
            <td>
              <label for"ubiq_shownavbar">
                <?php 
                  $check_shownavbar = '';
                  if (get_option('ubiq_shownavbar'))
                    $check_shownavbar = ' checked="checked" ';
                ?>
                <input type="checkbox" id="ubiq_shownavbar" name="ubiq_shownavbar" value="ubiq_shownavbar" <?php echo $check_shownavbar ?> /> Show NavBar
              </label>
            </td>
          </tr>
        </tbody>
      </table>
      
      <h3>Liftium</h3>
      <p>The Liftium tag will be added to a site when the Pub ID is defined.</p>
      <table class="form-table">
        <tbody>
          <tr valign="top">
            <th scope="row">
              <label for="ubiq_liftium_pubid">Publisher Id</label>
            </th>
            <td>
              <label for"ubiq_liftium_pubid">
                <input type="text" id="ubiq_liftium_pubid" name="ubiq_liftium_pubid" value="<?php echo get_option('ubiq_liftium_pubid') ?>" class="small-text" />
              </label>
            </td>
          </tr>
          
          <tr valign="top">
            <th scope="row">
              <label for="ubiq_liftium_placement">Placement</label>
            </th>
            <td>
              <label for"ubiq_liftium_placement">
                <input type="text" id="ubiq_liftium_placement" name="ubiq_liftium_placement" value="<?php echo get_option('ubiq_liftium_placement') ?>" class="medium-text" />
              </label>
            </td>
          </tr>
          
          
        </tbody>
      </table>
      
      <h3>Related Content</h3>
      <p>The related content tag is placed after the post; before the comments.</p>
      <table class="form-table">
        <tbody>
          <tr valign="top">
            <th scope="row">
              <label for="ubiq_scribol_tag">Script</label>
            </th>
            <td>
              <label for"ubiq_scribol_tag">
                <textarea id="ubiq_scribol_tag" name="ubiq_scribol_tag"><?php echo get_option('ubiq_scribol_tag') ?></textarea>
              </label>
            </td>
          </tr>
          
        </tbody>
      </table>
      
      <h3>Aggregation</h3>
      <p>The aggregation table provides advanced features that allow for content from one site to exist on another site.</p>
      <table class="form-table">
        <tbody>
          <tr valign="top">
            <th scope="row">
              <label for="ubiq_aggregate">Include in aggregation</label>
            </th>
            <td>
              <label for"ubiq_aggregate">
                <?php 
                  $check_ubiq_aggregate = '';
                  if (get_option('ubiq_aggregate'))
                    $check_ubiq_aggregate = ' checked="checked" ';
                ?>
                <input type="checkbox" id="ubiq_aggregate" name="ubiq_aggregate" value="ubiq_aggregate" <?php echo $check_ubiq_aggregate ?> /> Aggregate
              </label>
            </td>
          </tr>
          <tr valign="top">
            <th scope="row">
              <label for="ubiq_crosspost">Allow Crossposting</label>
            </th>
            <td>
              <label for"ubiq_crosspost">
                <?php 
                  $check_ubiq_crosspost = '';
                  if (get_option('ubiq_crosspost'))
                    $check_ubiq_crosspost = ' checked="checked" ';
                ?>
                <input type="checkbox" id="ubiq_crosspost" name="ubiq_crosspost" value="ubiq_crosspost" <?php echo $check_ubiq_crosspost ?> /> Crossposting (aggregation must be enabled, not yet functional)
              </label>
            </td>
          </tr>
        </tbody>
      </table>
      
      <p class="submit">
        <input class="button-primary" type="submit" value="Save Changes" name="Submit"/>
      </p>
    </form>
  
  </div>
  <?php
}

function ubiq_options_analytics() {
  if ( $_GET['updated'] == 'true' ) {
  	echo '<div class="updated">
  			<p><strong>' . __('Options saved.', 'blog_revenue'). '</strong></p>
  		</div>';
  }
  ?>
  
  
  <div class="wrap">
    <h2>Ubiquity Analytics Options</h2>
    
    <form name="ubiq-net-options" method="post" action="options.php">
      <?php settings_fields('ubiq-analytics-settings') ?>
      <h3>Google Analytics</h3>
      <table class="form-table">
        <tbody>
          <tr valign="top">
            <th scope="row">
              <label for="ubiq_ga_siteid">Site Profile ID</label>
            </th>
            <td>
              <label for"ubiq_ga_siteid">
                <input type="text" id="ubiq_ga_siteid" name="ubiq_ga_siteid" value="<?php echo get_option('ubiq_ga_siteid') ?>" class="medium-text" />
              </label>
              <p class="description">Format: UA-999999-1</p>
            </td>
          </tr>
          
          
          <tr valign="top">
            <th scope="row">
              <label for="ubiq_ga_rollup">Rollup Account</label>
            </th>
            <td>
              <label for"ubiq_ga_rollup">
                <?php 
                  $check_shownavbar = '';
                  if (get_option('ubiq_ga_rollup'))
                    $check_shownavbar = ' checked="checked" ';
                ?>
                <input type="checkbox" id="ubiq_ga_rollup" name="ubiq_ga_rollup" value="ubiq_ga_rollup" <?php echo $check_shownavbar ?> /> Include in Important Media rollup account?
              </label>
            </td>
          </tr>
        </tbody>
      </table>
      
      <h3>Other Analytics</h3>
      <table class="form-table">
        <tbody>
          <tr valign="top">
            <th scope="row">
              <label for="ubiq_analytics_other">Header Tags</label>
            </th>
            <td>
              <label for"ubiq_analytics_other">
                <textarea id="ubiq_analytics_other" name="ubiq_analytics_other"><?php echo get_option('ubiq_analytics_other') ?></textarea>
              </label>
            </td>
          </tr>
          <tr valign="top">
            <th scope="row">
              <label for="ubiq_analytics_footer">Footer tags</label>
            </th>
            <td>
              <label for"ubiq_analytics_footer">
                <textarea id="ubiq_analytics_footer" name="ubiq_analytics_footer"><?php echo get_option('ubiq_analytics_footer') ?></textarea>
              </label>
            </td>
          </tr>
        </tbody>
      </table>
      
      <p class="submit">
        <input class="button-primary" type="submit" value="Save Changes" name="Submit"/>
      </p>
    </form>
    
  </div>
  <?php
}

function ubiq_options_social() {
  if ( $_GET['updated'] == 'true' ) {
  	echo '<div class="updated">
  			<p><strong>' . __('Options saved.', 'blog_revenue'). '</strong></p>
  		</div>';
  }
  ?>
  
  
  <div class="wrap">
    <h2>Ubiquity Social Options</h2>
    
    <form name="ubiq-social-options" method="post" action="options.php">
      <?php settings_fields('ubiq-social-settings') ?>
      <h3>Facebook</h3>
      <table class="form-table">
        <tbody>
          <tr valign="top">
            <th scope="row">
              <label for="ubiq_fb_appid">Site Application ID</label>
            </th>
            <td>
              <label for"ubiq_fb_appid">
                <input type="text" id="ubiq_fb_appid" name="ubiq_fb_appid" value="<?php echo get_option('ubiq_fb_appid') ?>" class="medium-text" />
              </label>
              <p class="description">See: <a href="http://www.facebook.com/developers/apps.php" target="_blank">My FB Applications</a></p>
            </td>
          </tr>
          
          <tr valign="top">
            <th scope="row">
              <label for="ubiq_fb_fanpageid">Site Fan Page ID</label>
            </th>
            <td>
              <label for"ubiq_fb_fanpageid">
                <input type="text" id="ubiq_fb_fanpageid" name="ubiq_fb_fanpageid" value="<?php echo get_option('ubiq_fb_fanpageid') ?>" class="medium-text" />
              </label>
              <p class="description">Required for facebook widgets.</p>
            </td>
          </tr>
          
          <tr valign="top">
            <th scope="row">
              <label for="ubiq_fb_fanpageurl">Site Fan Page URL</label>
            </th>
            <td>
              <label for"ubiq_fb_fanpageurl">
                <input type="text" id="ubiq_fb_fanpageurl" name="ubiq_fb_fanpageurl" value="<?php echo get_option('ubiq_fb_fanpageurl') ?>" class="medium-text" />
              </label>
              <p class="description">Required for facebook widgets.</p>
            </td>
          </tr>
          
          <tr valign="top">
            <th scope="row">
              <label for="ubiq_fb_opengraph">Open Graph Protocol</label>
            </th>
            <td>
              <label for"ubiq_fb_opengraph">
                <?php 
                  $check_shownavbar = '';
                  if (get_option('ubiq_fb_opengraph'))
                    $check_shownavbar = ' checked="checked" ';
                ?>
                <input type="checkbox" id="ubiq_fb_opengraph" name="ubiq_fb_opengraph" value="ubiq_fb_opengraph" <?php echo $check_shownavbar ?> /> Enable Open Graph Protocol Tags
              </label>
            </td>
          </tr>
          
          <tr valign="top">
            <th scope="row">
              <label for="ubiq_fb_javascriptsdk">Javascript SDK</label>
            </th>
            <td>
              <label for"ubiq_fb_javascriptsdk">
                <?php 
                  $check_shownavbar = '';
                  if (get_option('ubiq_fb_javascriptsdk'))
                    $check_shownavbar = ' checked="checked" ';
                ?>
                <input type="checkbox" id="ubiq_fb_javascriptsdk" name="ubiq_fb_javascriptsdk" value="ubiq_fb_javascriptsdk" <?php echo $check_shownavbar ?> /> Enable FB Javascript SDK &amp; FBML (requires FB App ID)
              </label>
            </td>
          </tr>
          
        </tbody>
      </table>
      
      <h3>Twitter</h3>
      <table class="form-table">
        <tbody>
          <tr valign="top">
            <th scope="row">
              <label for="ubiq_twtr_sitehandle">Site Handle</label>
            </th>
            <td>
              <label for"ubiq_twtr_sitehandle">
                @<input type="text" id="ubiq_twtr_sitehandle" name="ubiq_twtr_sitehandle" value="<?php echo get_option('ubiq_twtr_sitehandle') ?>" class="medium-text" />
              </label>
            </td>
          </tr>
          
          <tr valign="top">
            <th scope="row">
              <label for="ubiq_twtr_appid">Site App ID</label>
            </th>
            <td>
              <label for"ubiq_twtr_appid">
                <input type="text" id="ubiq_twtr_appid" name="ubiq_twtr_appid" value="<?php echo get_option('ubiq_twtr_appid ') ?>" class="medium-text" />
              </label>
              <p class="description">Not currently in use.</p>
            </td>
          </tr>
          
          
        </tbody>
      </table>
      
      
      <p class="submit">
        <input class="button-primary" type="submit" value="Save Changes" name="Submit"/>
      </p>
    </form>
  
  </div>
  <?php
}