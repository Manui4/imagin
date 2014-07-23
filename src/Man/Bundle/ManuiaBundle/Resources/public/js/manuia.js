
/**
 * Resize margin-top of content depending of header
 */
function manuia_adjustHeaderContent(){
    var $header = $('.l-header.fixed');
    var $content = $('.l-content');
    if($header.length && $content.length ) {
        headerHeight = $header.height();
        $content.css("margin-top", headerHeight );
    }
}

$(document).ready(function() {
    var delay = 200;
    // Adjust header and content if fixed header
    manuia_adjustHeaderContent();

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
