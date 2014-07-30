/**
 * Photography photography-app.js
 * @version 2.0.0
 * @author Michael Antoine
 * 
 * @todo stagePadding calculate wrong active classes
 */

$(document).ready(function() {

    var $portfolio = $('#portfolio');
    $portfolio.masonry({
        isAnimated: true,
        itemSelector: '.flickr-item:not(.hidden)',
        columnWidth: 20,
    });

    $('.block-flickr h2 a').click(function(e){
        var cls = $(this).attr('href').replace("#", "");
        $portfolio.find(".flickr-item").removeClass('hidden');
        $portfolio.find(".flickr-item:not(."+cls+")").addClass('hidden');
        $portfolio.masonry('reload');
        $portfolio.find(".hidden").fadeIn();
        $portfolio.find("."+cls).show(500);
        $portfolio.find(".flickr-item:not(."+cls+")").hide(500);
        location.hash = cls;
        e.preventDefault();
    });
    
    $portfolio.find('a.thumb').click(function(e){
        var $this = $(this);
        var cls = $this.attr('href').replace("#", "");
        $portfolio.find(".unfold").removeClass('unfold');
        $this.parent().addClass('unfold');
        $portfolio.masonry('reload');
        location.hash = cls;
        e.preventDefault();
    });
    
    if(location.hash != ""){
        $('a[href=#'+ location.hash +']').trigger('click');
    };

});
