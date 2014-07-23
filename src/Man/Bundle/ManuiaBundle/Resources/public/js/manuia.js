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
/*    // Init Skrollr
    var s = skrollr.init({
        render: function(data){
            $(".debug span").text(data.curTop);
            console.debug(data);
        },
        smoothScrolling: false,
        mobileDeceleration: 0.004
    });*/

    /*$sections.each(function(){
        var $this = $(this);
        var $sectionBackground = $this.find('.section-bg');
        var bgHeight = $this.height() + parseInt($this.css('padding-bottom'));
        bgHeight += bgHeight*0.2;
        $sectionBackground.css("height", bgHeight );
    });*/
}

$(document).ready(function() {
    var delay = 200;
    // Adjust header and content if fixed header
    manuia_adjustHeaderContent();
    
    // runs headshot animation
    manuia_headshot();

    // listen on viewport resize
    $( window ).resize(function() {
    	manuia_adjustHeaderContent();
        if( $('#menu-dropdown').length ) {
            $('#menu-dropdown').remove()
        }
    });

    $('#header-top-toggle').click(function(){
        var $this   = $(this), href
        var $target = $('#header-top-data');
        $this.addClass('visible');
        $target.slideToggle({
            duration: delay,
            step: function(){
                manuia_adjustHeaderContent();
            },
            complete: function(){
                manuia_adjustHeaderContent();
                if(! $target.is(':visible') ){
                    $this.removeClass('visible');
                }
            }
        });
    });

    $('.navbar-toggle').click(function(){
        var $this   = $(this), href
        var $container = $this.closest('.header-main');
        // get class of target menu
        var target  = $this.attr('data-target')
            || e.preventDefault()
            || (href = $this.attr('href')) && href.replace(/.*(?=#[^\s]+$)/, '') //strip for ie7

        var $row = $('#menu-dropdown')
        var $target = null;
        if( $row.find(target).length ) {
            $target = $row.find(target)
        } else {
            $target = $this.parent().next(target)
            $target = $target.clone();
            $row = $target.wrap("<div id='menu-dropdown' class='row menu-dropdown'></div>").parent();
            $container.append($row);
        }
        $row.addClass('visible');
        $this.attr('data-toggle', 'collapse');
        $target.slideToggle(delay, function(){
            if(! $target.is(':visible') ){
                $row.removeClass('visible');
                $this.attr('data-toggle', 'collapsed');
            }
        });

    });


});
