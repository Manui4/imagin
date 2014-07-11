/**
 * 
 */

function manuia_getRandomInt(min, max) {
	return Math.floor(Math.random() * (max - min + 1)) + min;
}

function manuia_animateHeadShotTop($element){
	var index =  manuia_getRandomInt(0, 10) * 125;
	var duration = manuia_getRandomInt(100, 300);
	$element.animate({ left: '-' + index + 'px' }, duration, 'easeOutBounce', function () {});
}

$(document).ready(function() {
	var delay = 200;
    var $headshotTop = $('.headshots .list-headshots-top .list-items');
    var $headshotBottom = $('.headshots .list-headshots-bottom .list-items');
    var headshotLenght = $('.headshots .list-headshots-bottom .list-items items').lenght;
    
    setInterval(function(){
       manuia_animateHeadShotTop($headshotTop);
    }, 2000);
    setInterval(function(){
        manuia_animateHeadShotTop($headshotBottom);
     }, 2500);
    
    
    $( window ).resize(function() {
        if( $('#menu-dropdown').length ) {
            $('#menu-dropdown').remove()
        }
    });

    $('#header-top-toggle').click(function(){
        var $this   = $(this), href
        var $target = $('#header-top-data');
        $this.addClass('visible');
        $target.slideToggle(delay, function(){
            if(! $target.is(':visible') ){
                $this.removeClass('visible');
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
