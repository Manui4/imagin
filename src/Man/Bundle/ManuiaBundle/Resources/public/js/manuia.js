/**
 * 
 */

$(document).ready(function() {
	var delay = 200;
    
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
        /*$row.show();*/
        $this.attr('data-toggle', 'collapse');
        $target.slideToggle(delay, function(){
            if(! $target.is(':visible') ){
                $row.removeClass('visible');
                $this.attr('data-toggle', 'collapsed');
                /*$row.hide();*/
            }
        });
        
    });
});
