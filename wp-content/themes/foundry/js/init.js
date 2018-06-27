jQuery(document).ready(function(){
   // cache the window object
   $window = jQuery(window);
 
   jQuery('section[data-type="background"]').each(function(){
     // declare the variable to affect the defined data-type
     var $scroll = jQuery(this);
                     
      jQuery(window).scroll(function() {
        // HTML5 proves useful for helping with creating JS functions!
        // also, negative value because we're scrolling upwards                            
        var yPos = -($window.scrollTop() / $scroll.data('speed'));
         
        // background position
        var coords = '50% '+ yPos + 'px';
 
        // move the background
        $scroll.css({ backgroundPosition: coords });   
      }); // end window scroll
   });  // end section function
   
   var activityHash = location.hash;   
   var activity = activityHash.split("/");
   if(typeof(activity[0]) != "undefined" && typeof(activity[1]) != "undefined"){
        jQuery(activity[0]+'-'+activity[1]).click();
        setTimeout(function(){
            window.location = '#'+activity[2];
        },500);
        
   }
   
   jQuery('.navbar-nav').find('a').click(function(){
       return false;
   });
   
}); // close out script

/* Create HTML5 element for IE */
document.createElement("section");