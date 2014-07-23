/**
 * Manuia javascript
 */

/**
 * Get a random integer between min en max values
 * 
 * @param min
 * @param max
 */
function manuia_getRandomInt(min, max) {
    return Math.floor(Math.random() * (max - min + 1)) + min;
}

/**
 *  Create animate headshot sliers
 * @param $element
 */
function manuia_animateHeadShotTop($element){
    var index =  manuia_getRandomInt(0, 10) * 125;
    var duration = manuia_getRandomInt(300, 500);
    $element.animate({ left: '-' + index + 'px' }, duration, 'easeOutBounce', function () {});
}

/**
 * Resize margin-top of content depending of header
 */
function manuia_adjustHeaderContent(){
    var $header = $('.l-header');
    var $content = $('.l-content');
    if($header.length && $content.length ) {
        headerHeight = $header.height();
        $content.css("margin-top", headerHeight );
    }
}

/**
 *
 */
function manuia_headshot(){
    var $headshotTop = $('.headshots .list-headshots-top .list-items');
    var $headshotBottom = $('.headshots .list-headshots-bottom .list-items');
    setInterval(function(){
       manuia_animateHeadShotTop($headshotTop);
    }, 2000);

    setInterval(function(){
        manuia_animateHeadShotTop($headshotBottom);
    }, 2500);
}

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
        bgHeight += bgHeight*0.2;
        $sectionBackground.css("height", bgHeight );
    });
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
        }, 200);
    });

    
});
