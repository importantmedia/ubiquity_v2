(function($)
{	
	$.ubiquity = function(node, settings) {
		var bNode = $(node);
		if (!bNode.data('udownM'))
			bNode.data('udownM', new udownM(node, settings));
			
		return bNode.data('udownM');
	}
		
	$.fn.ubiquity = function( action, opt_value ) {
		var returnVal, args = arguments; 
		this.each(function() {
			var self = $.ubiquity( this, action );
			
			if ( typeof action == 'string' ) {
				switch (action) {
					case 'reset':
						
						break;
				}
			} 
			
			else if (!action && !opt_value) {
				returnVal = [];
				returnVal.push(self);
			}
			
		});
		
		return returnVal || this;		 
	};
	
	var DEFAULTS = {
	}
		
	var OPTIONS = {

	};  
	
	this.udownM = function(){
		return this.init.apply( this, arguments );
	};
	
	udownM.prototype = {
		init: function(node, settings) {
			this.settings = $.extend(true, {}, OPTIONS, settings ? settings : {});
			this.defaults = DEFAULTS;
			this.inputNode = $(node);
			this.openPalette = null;
			this.defaultTab = null;
			this.activeTab = null;
			this.controls = null;
			this.objs = {};
			this.is = {
				init: false
			};
			this.syncronize();
		},
		
		syncronize: function() {
			var self = this;
			
			self.objs.$imageManager = $('#udm_images',self.inputNode);
			self.objs.$images = $('#udm_images .panel',self.inputNode);
			self.objs.$tabs = $('#udm_tabs .panel',self.inputNode);
			
			self.objs.$images.each(function(index) {
				$(this).data('tab', $('#' + $(this).attr('id'), self.objs.$tabs.parent()));
				$(this).bind('click', function() {
					mpmetrics.track('Select Category',{
					   'current domain':document.domain,
					   'panel': $('.label .lt', $(this)).html()
					});
					self.switchSlate($(this));
				});
				$(this).bind('mouseenter', function() {
					if ($(this).attr('id') != self.objs.$images.data('active-image').attr('id')) {
						$(this).stop().animate({
								opacity: 0.8
							}, 300);
					} else {
						$(this).stop().animate({
								opacity: 1
							}, 300);
					}
				});
				
				$(this).bind('mouseleave', function() {
					if ($(this).attr('id') != self.objs.$images.data('active-image').attr('id')) {
						$(this).stop().animate({
								opacity: 0.6
							}, 300);
					} else {
						$(this).stop().animate({
								opacity: 1
							}, 300);
					}
				});
			});
			
			self.objs.$tabs.each(function(index) {
				$(this).data('image', $('#' + $(this).attr('id'), self.objs.$images.parent()));
				if ($(this).hasClass('active')) {
					self.objs.$tabs.data('active-tab', $(this));
					self.objs.$images.data('active-image', $(this));
				}
				$('a', $(this)).click(function(){
					mpmetrics.track('Visit Site',{
					   'domain':document.domain,
					   'panel': self.objs.$images.data('active-image', $(this)).find('.label .lt').html(),
					   'destination': $(this).attr('title')
					});
					return true;
				})
			});
			
			self.objs.$imageManager.bind('mouseenter', function() {
				//debug([$(this),self.objs.$images.data('active-image')]);
				self.objs.$images.each(function(index) {
					if ($(this).attr('id') != self.objs.$images.data('active-image').attr('id')) {
						$(this).stop().animate({
								opacity: 0.6
							}, 300);
					} 
				});
			})
			
			self.objs.$imageManager.bind('mouseleave', function() {
				
				self.objs.$images.each(function(index) {
				
					if ($(this).attr('id') != self.objs.$images.data('active-image').attr('id')) {
						if (self.objs.$images.data('active-image').attr('id') != 'panel_0') {
							$(this).stop().animate({
									opacity: 0.8
								}, 300);
						} else {
							$(this).stop().animate({
									opacity: 1
								}, 300);
						}
					} else {
						$(this).stop().animate({
								opacity: 1
							}, 300);
					}
				});
			})
			self.is.init = true;
			
		},
		
		switchSlate: function(which) {
			var self = this,
				$going = self.objs.$tabs.data('active-tab'),
				$going_image = $going.data('image');
				$coming_image = which,
				$coming = $coming_image.data('tab');
			
			if ($coming == $going) {
				return false;
			}
			
			if ($going_image.attr('id') != 'panel_0') {
				$going_image.stop().animate({
						opacity: 0.8
					}, 300);
			}
			
			//$going_tab.removeClass('active');
			//$coming_tab.addClass('active');
			
			$coming.stop();
			$going.stop();
			
			self.objs.$tabs.data('active-tab', $coming);
			self.objs.$images.data('active-image', $coming_image);
			
			$coming.css({
				'display':'block',
				'opacity':0,
				'position':'absolute',
				'top': 0,
				'left': 0
			});
			
			$going.css({
				'display':'block',
				'opacity':1,
				'position':'absolute',
				'top': 0,
				'left': 0
			}).removeClass('active');
			
			$coming_image.stop().animate({
					opacity: 1
				}, 300);
			
			$coming.stop().animate({
					opacity: 1
				}, 300);
				
			$going.stop().animate({
					opacity: 0
				}, 300, function() {
					$(this).hide();
				});
			//debug([$going,$coming]);
		}
		
			
	};
	

	function debug($obj)
	{
		if (window.console && window.console.log)
			window.console.log($obj);
	};

	
})(jQuery);

(function($)
{	
	$(document).ready(function() {
	
		$('#important_media_network').click(function() {
			if (UbiquitySettings.username) {
				mpmetrics.register({
					'username': UbiquitySettings.username
				});
			}
			
			$('#im-navbar-slider').stop();
			$('#im-navbar-slidebox').stop();
			if($('#im-navbar-slider').height()>0){ // close it
				mpmetrics.track('Close Toolbar', {'current domain':document.domain});
				$('#im-navbar-slidebox').stop().animate({
					opacity: 0
				}, 500, function() {
					$('#im-navbar-slider').stop().animate({
						height: '0px'	
					}, 500);
				});
				$(this).removeClass('active');
			}else {  // open it
				mpmetrics.track('Open Toolbar', {'current domain':document.domain});
				$('#im-navbar-slider').stop().animate({
					height: '350px'	
				}, 500, function() {
					$('#im-navbar-slidebox').stop().animate({
						opacity: 1
					}, 500);
				});
				$(this).addClass('active');
			}
			return false;
			
		});
	
		$('#im-sociallinks a').each(function(index) {
			$(this).bind('click', function() {
				mpmetrics.track('ubiquity icon click', {
						'current domain':document.domain,
						'icon click':$(this).attr('title')
					});
				return true;
			});
		});
	
		$('.dropdown').each(function(index) {
			$(this).bind('mouseenter', function() {
				$(this).addClass('active');
			});
			
			$(this).bind('mouseleave', function() {
				$(this).removeClass('active');
			});
		});
		
		$('#udm').ubiquity();
		 
	});

})(jQuery);