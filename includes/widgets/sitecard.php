<div id="ubiq_sitecard" class="clearfix">
  <?php if(get_option('ubiq_fb_fanpageurl')) { ?>
  <div id="facebook_like">
    <iframe src="http://www.facebook.com/plugins/likebox.php?href=<?php echo urlencode(get_option('ubiq_fb_fanpageurl')) ?>&amp;width=195&amp;colorscheme=light&amp;connections=0&amp;stream=false&amp;header=false&amp;height=85" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:195px; height:85px;" allowTransparency="true"></iframe>
  </div>
  <?php } ?>
  <div id="social_buttons">
    <ul>
      <?php if (get_option('ubiq_twtr_sitehandle')) { ?>
      <li><a href="http://twitter.com/<?php echo get_option('ubiq_twtr_sitehandle') ?>" class="twtr_32" title="@<?php echo get_option('ubiq_twtr_sitehandle') ?>">@<?php echo get_option('ubiq_twtr_sitehandle') ?></a></li>
      <?php } ?>
      <li><a href="<?php bloginfo('rss2_url') ?>" class="rss_32" title="RSS">RSS</a></li>
    </ul>
  </div>
</div>