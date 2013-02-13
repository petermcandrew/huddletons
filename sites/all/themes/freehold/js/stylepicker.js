(function ($) {
  Drupal.behaviors.stylepicker =  {
    attach: function(context, settings) {
  
      /* path settings inherited from style switcher JS */    
      var base = Drupal.settings.stylepicker.base;

      /* minicolors init function -- use ID to change HEX */
  		function init() {
  			$('.color-picker').miniColors({
    			change: function(hex, rgb) {
      			var elementId = $(this).attr("id");
      			
      			if(elementId == "styleswitcher-header-bgcolor"){
        			$("header").css({backgroundColor:hex})
      			}
      			else if(elementId == "styleswitcher-navigation-color"){
        			$(".sf-menu a, .sf-menu a:visited").css({color:hex})
      			}
      			else if(elementId == "styleswitcher-input-color"){
        			$("input.submit, input.submit-advanced, .button, #webform-client-form-5 input.form-submit, #edit-submit").css({backgroundColor:hex})
      			}
      			else if(elementId == "styleswitcher-link-color"){
        			$("a.secondary-button, .notification-listing").css({backgroundColor:hex})
      			}      			      			      			
      			
				  },
  			});		
  		}				
  		init();
  		
      $("#nav-font-change .font-family").change(function(){
         var fam = $(this).val().split(';');
         fam = fam[0].split(':');
        $(".sf-menu a, .sf-menu a:visited").css('fontFamily', fam[1]);
      });
      $("#body-font-change .font-family").change(function(){
         var fam = $(this).val().split(';');
         fam = fam[0].split(':');
        $("body").css('fontFamily', fam[1]);
      });
      $("#headings-font-change .font-family").change(function(){
         var fam = $(this).val().split(';');
         fam = fam[0].split(':');
        $("h1,h2,h3,h4,h5,h6").css('fontFamily', fam[1]);
      });            
  		
  		/* animation pop out, slide back in settings */
      $("#stylepicker").animate({left:'-230px'});

      $("#stylepicker #gear").click(function(){
      	if($(this).hasClass('open')){
        	$(this).removeClass('open').addClass('closed').parent().animate({left:'-230px'})
      	}
      	else{
        	$(this).removeClass('closed').addClass('open').parent().animate({left:'0px'})
      	}
      });         	   	
      	   	
    }    
  };
  
})(jQuery);