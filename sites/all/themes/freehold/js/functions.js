(function ($) {
  Drupal.behaviors.freehold =  {
    attach: function(context, settings) {

      $("nav ul li a.active").parents().addClass('active');

      $("ul.sf-menu").supersubs({ 
        minWidth:    4,   // minimum width of sub-menus in em units 
        maxWidth:    18,   // maximum width of sub-menus in em units 
        extraWidth:  1     // extra width can ensure lines don't sometimes turn over 
        // due to slight rounding differences and font-family 
        }).superfish({ 
        animation: {opacity:'show'},   // slide-down effect without fade-in 
        autoArrows:    false,               // if true, arrow mark-up generated automatically = cleaner source code at expense of initialisation performance 
        dropShadows:   false,               // completely disable drop shadows by setting this to false 
        delay:     450               // 1.2 second delay on mouseout 
      });
      
      $("a[rel^='prettyPhoto']").prettyPhoto({
        animation_speed: 'fast', /* fast/slow/normal */
        slideshow: 5000, /* false OR interval time in ms */
        autoplay_slideshow: false, /* true/false */
        opacity: 0.80, /* Value between 0 and 1 */
        show_title: false, /* true/false */
        allow_resize: true, /* Resize the photos bigger than viewport. true/false */
        default_width: 500,
        default_height: 344,
        counter_separator_label: '/', /* The separator for the gallery counter 1 "of" 2 */
        theme: 'pp_default', /* light_rounded / dark_rounded / light_square / dark_square / facebook */
        horizontal_padding: 20, /* The padding on each side of the picture */
        hideflash: false, /* Hides all the flash object on a page, set to TRUE if flash appears over prettyPhoto */
        wmode: 'opaque', /* Set the flash wmode attribute */
        autoplay: false, /* Automatically start videos: True/False */
        modal: false, /* If set to true, only the close button will close the window */
        deeplinking: false, /* Allow prettyPhoto to update the url to enable deeplinking. */
        overlay_gallery: false, /* If set to true, a gallery will overlay the fullscreen image on mouse over */
        keyboard_shortcuts: true, /* Set to false if you open forms inside prettyPhoto */
        ie6_fallback: true,
        social_tools: '' /* html or false to disable  <div class="pp_social"><div class="twitter"><a href="http://twitter.com/share" class="twitter-share-button" data-count="none">Tweet</a><script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script></div><div class="facebook"><iframe src="http://www.facebook.com/plugins/like.php?locale=en_US&href='+location.href+'&amp;layout=button_count&amp;show_faces=true&amp;width=500&amp;action=like&amp;font&amp;colorscheme=light&amp;height=23" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:500px; height:23px;" allowTransparency="true"></iframe></div></div> */
      });

      $('.sf-menu').not('.sf-menu .sf-menu').mobileMenu({
        defaultText: 'Navigate to...',
        className: 'select-menu',
        subMenuDash: '&ndash;&ndash;'
      });
      
      // Scroll page to the top
      $('a#scrollToTop').click(function(){
        $('html, body').animate({scrollTop:0}, 'normal');
        return false;
      });      
      
      $(".search-drop-down").click(function(){
        $("#panel-search").slideToggle("normal");
        $(this).toggleClass("active"); return false;
      });
      
      //fix ie 7 and less quirks issue
      if (($.browser.msie) && (parseInt($.browser.version, 10) <= 7)) {
        $(function() {
          var zIndexNumber = 1000;
          $('div').each(function() {
            $(this).css('zIndex', zIndexNumber);
            zIndexNumber -= 10;
          });
        });
      }
      
      $('input, textarea').placeholder();
      
      $('#homeslideshow').flexslider({
        animation: "fade",              //String: Select your animation type, "fade" or "slide"
        slideDirection: "horizontal",   //String: Select the sliding direction, "horizontal" or "vertical"
        slideshow: true,                //Boolean: Animate slider automatically
        slideshowSpeed: 7000,           //Integer: Set the speed of the slideshow cycling, in milliseconds
        animationDuration: 500,         //Integer: Set the speed of animations, in milliseconds
        directionNav: true,             //Boolean: Create navigation for previous/next navigation? (true/false)
        controlNav: true,               //Boolean: Create navigation for paging control of each clide? Note: Leave true for manualControls usage
        keyboardNav: true,              //Boolean: Allow slider navigating via keyboard left/right keys
        mousewheel: false,              //Boolean: Allow slider navigating via mousewheel
        prevText: "Previous",           //String: Set the text for the "previous" directionNav item
        nextText: "Next",               //String: Set the text for the "next" directionNav item
        pausePlay: false,               //Boolean: Create pause/play dynamic element
        pauseText: 'Pause',             //String: Set the text for the "pause" pausePlay item
        playText: 'Play',               //String: Set the text for the "play" pausePlay item
        randomize: false,               //Boolean: Randomize slide order
        slideToStart: 0,                //Integer: The slide that the slider should start on. Array notation (0 = first slide)
        useCSS: true,
        animationLoop: true,            //Boolean: Should the animation loop? If false, directionNav will received "disable" classes at either end
        pauseOnAction: true,            //Boolean: Pause the slideshow when interacting with control elements, highly recommended.
        pauseOnHover: false            //Boolean: Pause the slideshow when hovering over slider, then resume when no longer hovering
      });

      
      $('#carousel').flexslider({
        animation: "slide",
        controlNav: false,
        animationLoop: false,
        slideshow: false,
        itemWidth: 145,
        itemMargin: 15,
        asNavFor: '#slider'
      });
      
      $('#slider').flexslider({
        animation: "fade",
        controlNav: false,
        animationLoop: false,
        slideshow: false,
        sync: "#carousel",
        start: function(slider){
          $('body').removeClass('loading');
        }
      });      
      
      
     
      lbl2ph('.webform-component');
      
      
        
    }    
  };
  
})(jQuery);

function lbl2ph(l){ 

  var phForms = jQuery(l),
    phFields = 'input[type=text], input[type=email], textarea';
  
  phForms.find(phFields).each(function(){ // loop through each field in the specified form(s)
  
    var el = jQuery(this), // field that is next in line
    wrapper = el.parents('.form-item'), // parent .form-item div
    lbl = wrapper.find('label'), // label contained in the wrapper
    lblText = lbl.text(); // the label's text
    
    // add label text to field's placeholder attribute
    el.attr("placeholder",lblText);
    
    // hide original label
    lbl.hide();
  
  });

}