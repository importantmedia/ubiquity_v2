<?php
if(get_the_author_meta('twitter_handle')) {
  $data_related = get_the_author_meta('twitter_handle') . ":The author's account";
} else {
  $data_related = "importantmedia:This is the Important Media Network";
}

?>
<ul class="ubiq_social_buttons">
  <li class="twtr"><a href="http://twitter.com/share" class="twitter-share-button" data-url="<?php the_permalink() ?>" data-text="<?php the_title() ?>" data-count="horizontal" data-via="<?php echo get_option('ubiq_twtr_sitehandle') ?>" data-related="<?php echo $data_related ?>:The author's account.">Tweet</a><script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script></li>
  <li class="fblikesml"><iframe src="http://www.facebook.com/plugins/like.php?href=<?php urlencode(the_permalink()) ?>&amp;layout=button_count&amp;show_faces=false&amp;width=80&amp;action=like&amp;font=lucida+grande&amp;colorscheme=light&amp;height=21" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:85px; height:21px;" allowTransparency="true"></iframe></li>
</ul>