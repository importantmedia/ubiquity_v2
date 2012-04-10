(function($){	

  function debug($obj)
  {
  	if (window.console && window.console.log)
  		window.console.log($obj);
  };
  
  function FB_share(url) {
    var share = {
      method: 'stream.share',
      u: url,
      display: 'popup'
    };
    
    FB.ui(share, function(response) { console.log(response); });
  }

  $(document).ready(function() {
    /*
    $('.ubiq_button_fb').each(function(index) {
      var $this = $(this);
      url = $(this).attr('href');
      fbquery = FB.Data.query('SELECT share_count FROM link_stat WHERE url="{0}"', url);
      
      fbquery.wait(function(rows){
        //debug($this);
        if(rows) {
          $('.count',$this).text(rows[0].share_count);
        }
      });
    });
    */
   
    $('.ubiq_button_fb').bind('click',function() {
      var hasSession;
        hasSession = FB.getSession();
      
      FB_share($(this).attr('href'));
      return false;
      /*
      if(!hasSession) {
        FB.login(function(response) {
          if (response.session) {
            FB_share($(this).attr('href'));
          } else {
            FB_share($(this).attr('href'));
          }
        }, {perms:'read_stream,publish_stream,read_friendlists'});
      } else {
        FB_share($(this).attr('href'));
      }
      return false;
      */
    });
    
  });

})(jQuery);