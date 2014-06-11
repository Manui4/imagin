/**
 * 
 */

$(document).ready(function() {
    
    $( window ).resize(function() {
        if( $('#menu-dropdown').length ) {
            $('#menu-dropdown').remove()
        }
    });

    $('.navbar-toggle').click(function(){
        var $this   = $(this), href
        var $container = $this.closest('.l-container');
        // get class of target menu
        var target  = $this.attr('data-target')
            || e.preventDefault()
            || (href = $this.attr('href')) && href.replace(/.*(?=#[^\s]+$)/, '') //strip for ie7

        var $target = null;
        if( $('#menu-dropdown ' + target).length ) {
            $target = $('#menu-dropdown ' + target)
        } else {
            $target = $this.parent().next(target)
            var $clone = $target.clone();
            $row = $clone.wrap("<div id='menu-dropdown' class='row menu-dropdown'></div>").parent();
            $target = $row.find(target);
            $container.append($row);
        }

        $this.attr('data-toggle', '');
        if( $target.is( ":hidden" ) ){
            $target.slideDown();
            $this.attr('data-toggle', 'collapse');
        } else {
            $target.slideUp();
            $this.attr('data-toggle', 'collapsed');
        }
    });
});
