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
 *
 */
function manuia_headshot(){
    var $headshotTop = $('.block-selfi-slider .list-selfi-top .list-items');
    var $headshotBottom = $('.block-selfi-slider .list-selfi-bottom .list-items');
    setInterval(function(){
       manuia_animateHeadShotTop($headshotTop);
    }, 2000);

    setInterval(function(){
        manuia_animateHeadShotTop($headshotBottom);
    }, 2500);
}

$(document).ready(function() {
    // runs headshot animation
    manuia_headshot();
});
