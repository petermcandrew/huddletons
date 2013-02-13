(function ($) {
  Drupal.behaviors.freeholdadmin =  {
    attach: function(context, settings) {

      /* minicolors init function -- use ID to change HEX */
  		function init() {
  			$('.color-picker').miniColors({
    			change: function(hex, rgb) {
      			var elementId = $(this).attr("id");
      			
      			if(elementId == "edit-freehold-css-header-bgcolor"){
        			$("#freehold-header").css({backgroundColor:hex})
      			}
      			else if(elementId == "edit-freehold-css-navigation-bgcolor"){
        			$("#freehold-navigation").css({backgroundColor:hex})        			
      			}
      			else if(elementId == "edit-freehold-css-inputbuttons-bgcolor"){
        			$("#freehold-inputbuttons").css({backgroundColor:hex})        			
      			}
      			else if(elementId == "edit-freehold-css-linkbuttons-bgcolor"){
        			$("#freehold-linkbuttons").css({backgroundColor:hex})         			
      			}      			      			
      			
				  },
  			});		
  		}				
  		init();
		
    }    
  };
  
})(jQuery);