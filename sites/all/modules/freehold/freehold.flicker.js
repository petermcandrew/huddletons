(function ($) {
  Drupal.behaviors.freeholdflicker =  {
    attach: function(context, settings) {
    
      var authorid = Drupal.settings.freehold.authorid;
		   
    	$.getJSON("http://api.flickr.com/services/feeds/photos_public.gne?id="+authorid+"&lang=en-us&format=json&jsoncallback=?", displayImages);  //YOUR IDGETTR GOES HERE
    	function displayImages(data){																															   
    		// Randomly choose where to start. A random number between 0 and the number of photos we grabbed (20) minus  7 (we are displaying 7 photos).
    		var iStart = Math.floor(Math.random()*(0));	
    
    		// Reset our counter to 0
    		var iCount = 1;								
    
    		// Start putting together the HTML string
    		var htmlString = "<ul>";					
    
    		// Now start cycling through our array of Flickr photo details
    		$.each(data.items, function(i,item){
    
    			// Let's only display 6 photos (a 2x3 grid), starting from a the first point in the feed				
    			if (iCount > iStart && iCount < (iStart + 7)) {
    
    				// I only want the ickle square thumbnails
    				var sourceSquare = (item.media.m).replace("_m.jpg", "_s.jpg");		
    
    				// Here's where we piece together the HTML
    				htmlString += '<li><a href="' + item.link + '" target="_blank">';
    				htmlString += '<img src="' + sourceSquare + '" alt="' + item.title + '" title="' + item.title + '"/>';
    				htmlString += '</a></li>';
    			}
    			// Increase our counter by 1
    			iCount++;
    		});		
    
    	// Pop our HTML in the #images DIV	
    	$('.flickr-widget-1').html(htmlString + "</ul>");
    
    	// Close down the JSON function call
    	}

        
    }    
  };
  
})(jQuery);
