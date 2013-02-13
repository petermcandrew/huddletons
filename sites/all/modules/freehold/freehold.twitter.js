(function ($) {
  Drupal.behaviors.freeholdtwitter =  {
    attach: function(context, settings) {
	 		
	    var username = Drupal.settings.freehold.twitterusername;
	      
    	$('.tweets-widget1').jtwt({image_size :25, count : 2, username: username, convert_links : 1, loader_text : 'Loading new tweets...'});   
        
    }    
  };
  
})(jQuery);
