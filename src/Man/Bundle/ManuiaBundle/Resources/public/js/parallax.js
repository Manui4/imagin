/**
 *
 */
function manuia_adjustSkrollr(){
    // Init Skrollr
    var s = skrollr.init({
        render: function(data){},
        smoothScrolling: false,
        mobileDeceleration: 0.004
    });

    $sections.each(function(){
        var $this = $(this);
        var $sectionBackground = $this.find('.parallax-section-bg');
        var bgHeight = $this.height() + parseInt($this.css('padding-bottom'));
        var windowHeight = $(window).height();
        var windowWidth = $(window).width();

       /* if( bgHeight < windowHeight ){
            bgHeight = windowHeight;
        }*/
        
        bgHeight += bgHeight*0.2;
        
        $sectionBackground.css("height", bgHeight );
        /*$sectionBackground.css("width", windowWidth );*/
    });
}

function manuia_adjustBodyHeight(){
	var $header = $('.l-header');
    var $content = $('.l-content');
    if($header.length && $content.length ) {
        headerHeight = $header.height();
        $body.css("height", $body.height() - headerHeight);
    }
}



$(document).ready(function() {
    // Setup variables
    $window = $(window);
    $sections = $('.parallax-sections .parallax-section');
    $body = $('body');
    
    //FadeIn all sections   
    $body.imagesLoaded( function() {
        setTimeout(function() {
            // Resize sections
            manuia_adjustSkrollr();
            // Fade in sections
            $body.removeClass('loading').addClass('loaded');
            manuia_adjustBodyHeight();
        }, 200);
    });
    
    // listen on viewport resize
    $( window ).resize(function() {
        manuia_adjustSkrollr();
        manuia_adjustBodyHeight();
    });

    
});
