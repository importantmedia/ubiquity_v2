<?php if (!is_user_logged_in() ) : ?> 
<div id="im_outer_nav_wrap">
	<div id="im_navbar">
		<div id="inner_nav_wrap">
		<!-- begin network menu items -->
		<ul id="network_nav" class="im_navitems">
            <li class="nav_text">
                Explore The Network
            </li>
        
            <li>
                <a href="#" title="Air, water, planet, and its ecosystems">Nature</a>
                <ul>
                    <li class="site PScom"><a href="http://planetsave.com" title="Planetsave (Earth is big and wonderful.)">Planetsave</a></li>
                    <li class="site BLIcom"><a href="http://bluelivingideas.com" title="Blue Living Ideas (All Water, all the time.)">Blue Living Ideas</a></li>
                </ul>
            </li>
        
            <li>
                <a href="#" title="Business, economics, energy, infrastructure, transportation, industrial design">Civilization</a>
                <ul>
                    <li class="site CTcom"><a href="http://cleantechnica.com" title="CleanTechnica (Energy and Tech Breakthroughs)">CleanTechnica</a></li>
                    <li class="site G2org"><a href="http://gas2.org" title="Gas 2.0 (New options for Gearheads)">Gas 2.0</a></li>
                    <li class="site GBEcom"><a href="http://greenbuildingelements.com" title="Green Building Elements (High-performance, sustainable shelter)">Green Building Elements</a></li>
                    <li class="site EPcom"><a href="http://ecopreneurist.com" title="Ecopreneurist (Social Entrepreneurship galore)">Ecopreneurist</a></li>
					<li class="site IEcom"><a href="http://inspiredeconomist.com" title="The Inspired Economist (Macro-sustainability galore)">The Inspired Economist</a></li>
                </ul>
            </li>
        
            <li>
                <a href="#" title="Family, household, community, self-sufficiency">Daily Life</a>
                <ul>
                    <li class="site INScom"><a href="http://insteading.com" title="Insteading (Depend. Less. -- new!)">Insteading</a></li>
                    <li class="site EDBcom"><a href="http://eatdrinkbetter.com" title="Eat. Drink. Better. (Food, Drink, Policy)">Eat. Drink. Better.</a></li>
                    <li class="site GLIcom"><a href="http://greenlivingideas.com" title="Green Living Ideas (Going Green? Start here.)">Green Living Ideas</a></li>
                    <li class="site TGDcom"><a href="http://thegreendivas.com" title="The Green Divas Radio & Podcast (new!)">Green Divas Radio</a></li>                                  
                </ul>
            </li>
            <li>
                <a href="#" title="Civic affairs, politics, social justice, internet society, news, and opinion">Society</a>
                <ul>
                    <li class="site SBorg"><a href="http://blog.sustainablog.org" title="sustainablog (Blogging green since 2003)">sustainablog</a></li>
                    <li class="site ELcom"><a href="http://ecolocalizer.com" title="EcoLocalizer (Local issues matter, everywhere.)">EcoLocalizer</a></li>
                    <li class="site RGBorg"><a href="http://redgreenandblue.org" title="Red, Green & Blue (Environmental Politics)">Red, Green & Blue</a></li>
                    <li class="site OHorg"><a href="http://ozhouse.org" title="OzHouse (Alternative News)">OzHouse</a></li>
                </ul>
            </li>

            <li>
                <a href="#" title="Art, philosophy, culture, crafts, fashion">Creativity</a>
                <ul>
                    <li class="site CGWcom"><a href="http://craftingagreenworld.com" title="Crafting A Green World (Handmade can save the world.)">Crafting A Green World</a></li>
                    <li class="site FGScom"><a href="http://feelgoodstyle.com" title="FeelGood Style (Eco-fashion for all.)">FeelGood Style</a></li>
                </ul>
            </li>
        
		</ul>
		<!-- end network items -->

		<!-- begin social links -->


				<ul id="social_nav" class="im_navitems">
					<li><a href="http://importantmedia.org/connect/" class="icon icn16-gpls" title="Google Plus" target="_blank">Google Plus</a></li>
					<li><a href="http://twitter.com/importantmedia" class="icon icn16-twitter" name="@importantmedia" title="Twitter" target="_blank">@importantmedia</a></li>
					<li><a href="http://www.facebook.com/importantmedia" class="icon icn16-fb" title="Facebook" target="_blank">Facebook</a></li>
					
				</ul>

        <!-- end social links -->

		<!-- begin general links -->

		<ul id="general_nav" class="im_navitems">

		<!-- enter in reverse order for right alignment -->

			<?php /*
                $curr_user	= wp_get_current_user();
				$dash_url	= admin_url();
				$log_url	= wp_login_url( home_url() );
				if ( is_user_logged_in() ) { 
				      echo '<li class="current_user"><a href="'.$dash_url.'" class="menu-title" title="Dashboard">' . $curr_user->display_name . '</a></li>';
				} else {
                      echo '<li class="current_user"><a href="'.$log_url.'" class="menu-title" title="Login">Login</a></li>';
				} 
				*/ ?>
				<li class="current_user"><a href="<?php echo wp_login_url(); ?>" class="menu-title" title="Login">Login</a></li>
				<li><a href="http://importantmedia.org/advertise/" class="menu-title">Advertise</a></li>
				<li><a href="http://importantmedia.org/about/" class="menu-title">About</a></li>     

		</ul>
       
        <!-- end general links -->

		</div>
	</div>
</div>
<?php endif; ?>