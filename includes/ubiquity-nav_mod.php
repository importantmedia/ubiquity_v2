<div id="im_outer_nav_wrap">
	<div id="im_navbar">
		<div id="inner_nav_wrap">
		<!-- begin network menu items -->
		<ul id="network_nav" class="im_navitems">
            <li class="nav_text">
                Explore The Network
            </li>
        
            <li>
                <a href="#">Nature</a>
                <ul>
                    <li class="site"><a class="psave" href="http://planetsave.com" title="Planetsave (Earth is big and wonderful.)">Planetsave</a></li>
                    <li class="site"><a class="" href="#" title="">Site Name</a></li>
                </ul>
            </li>
        
            <li>
                <a href="#">Civilization</a>
                <ul>
                    <li class="site"><a class="" href="#" title="">Site Name</a></li>
                    <li class="site"><a class="" href="#" title="">Site Name</a></li>
                    <li class="site"><a class="" href="#" title="">Site Name</a></li>
                    <li class="site"><a class="" href="#" title="">Site Name</a></li>
                </ul>
            </li>
        
            <li>
                <a href="#">Daily Life</a>
                <ul>
                    <li class="site"><a class="" href="#" title="">Site Name</a></li>
                    <li class="site"><a class="" href="#" title="">Site Name</a></li>
                    <li class="site"><a class="" href="#" title="">Site Name</a></li>
                    <li class="site"><a class="" href="#" title="">Site Name</a></li>
                    <li class="site"><a class="" href="#" title="">Site Name</a></li>                                    
                </ul>
            </li>
            <li>
                <a href="#">Society</a>
                <ul>
                    <li class="site"><a class="" href="#" title="">Site Name</a></li>
                    <li class="site"><a class="" href="#" title="">Site Name</a></li>
                </ul>
            </li>

            <li>
                <a href="#">Creativity</a>
                <ul>
                    <li class="site"><a class="" href="#" title="">Site Name</a></li>
                    <li class="site"><a class="" href="#" title="">Site Name</a></li>
                </ul>
            </li>
        
		</ul>
		<!-- end network items -->

		<!-- begin social links -->


				<ul id="social_nav" class="im_navitems">
					<li><a href="<?php echo  get_permalink(ubiq_get_ID_by_slug('feeds')) ?>" class="icon icn16-rss" title="RSS">RSS</a></li>
					<li><a href="http://twitter.com/importantmedia" class="icon icn16-twitter" name="@importantmedia" title="Twitter" target="_blank">@importantmedia</a></li>
					<li><a href="http://www.facebook.com/importantmedia" class="icon icn16-fb" title="Facebook" target="_blank">Facebook</a></li>
					
				</ul>

        <!-- end social links -->

		<!-- begin general links -->

		<ul id="general_nav" class="im_navitems">
       
			<li>
				<a href="http://importantmedia.org/about/" class="menu-title">About</a>
					<ul>
					<li><a href="http://importantmedia.org/about/">Learn about IM</a></li>
					<li class="page_item page-item-623"><a href="http://importantmedia.org/about/faq/" title="FAQ">FAQ</a></li>
					<li class="page_item page-item-300"><a href="http://importantmedia.org/about/people/" title="People">People</a></li>
					<li class="page_item page-item-99"><a href="http://importantmedia.org/about/legal/" title="Legal">Legal</a></li>
					<li class="page_item page-item-463"><a href="http://importantmedia.org/about/contact/" title="Contact">Contact</a></li>
					</ul>
			</li>
        
        	<li>
				<a href="http://importantmedia.org/write/" class="menu-title">Join Us</a>
					<ul>
					<li><a href="http://importantmedia.org/about/hiring/" title="We're Hiring!">Central Team</a></li>
					<li><a href="http://importantmedia.org/write/">Write with IM</a></li>
					<li class="page_item page-item-393"><a href="http://importantmedia.org/write/contributors/" title="Guest Contributors">Guest Contributors</a></li>
					<li class="page_item page-item-386"><a href="http://importantmedia.org/write/authors/" title="Freelance Authors">Freelance Authors</a></li>
					<li class="page_item page-item-406"><a href="http://importantmedia.org/write/apply/" title="Apply">Apply Now!</a></li>
					</ul>
			</li>        

			<li>
				<a href="http://importantmedia.org/advertise/" class="menu-title">Advertise</a>
					<ul>
					<li class="page_item page-item-322"><a href="http://buyads.com/group/important-media" title="Self-service!">Self-service via BuyAds.com</a></li>
					<li class="page_item page-item-511"><a href="http://importantmedia.org/advertise/quote/" title="Get a Quote">Get a Quote</a></li>
					<li class="page_item page-item-314"><a href="http://importantmedia.org/advertise/specs/" title="Advertising Specs">Advertising Specs</a></li>
					</ul>
			</li>

			<li>
			<?php if(is_user_logged_in()): ?>
			<?php global $current_user;
			      get_currentuserinfo();
			      $img = ubiq_custom_avatar($current_user->ID);
				?>

				<a href="<?php echo admin_url()?>">
				<?php echo $current_user->user_login; ?>
				<?php if ($img): ?><span  class="user_avatar"><img src="<?php echo $img?>" width="20" height="20"><?php endif; ?></span></a>
					<ul class="dd-menu">
						<li><a href="<?php echo admin_url()?>" title="Dashboard">Dashboard</a></li>
						<li><a href="<?php echo admin_url()?>profile.php" title="My Profile">My Profile</a></li>
						<li><a href="<?php echo wp_logout_url( get_permalink() ); ?>" title="Logout">Logout</a></li>
					</ul>

			<?php else: ?>

				<a href="<?php echo admin_url()?>" class="menu-title">Login</a>
			<?php endif; ?>
            </li>

		</ul>
       
        <!-- end general links -->

		</div>
	</div>
</div>