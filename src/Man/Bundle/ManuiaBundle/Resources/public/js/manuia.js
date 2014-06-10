/**
 * 
 */

$(document).ready(function() {
	
	$( window ).resize(function() {
		console.debug('Resize' );
	});

    $('.navbar-toggle').click(function(){
        var $this   = $(this), href
        var target  = $this.attr('data-target')
            || e.preventDefault()
            || (href = $this.attr('href')) && href.replace(/.*(?=#[^\s]+$)/, '') //strip for ie7
        var $target = $(target)
        var toggle = $(this).attr('data-toggle')
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
