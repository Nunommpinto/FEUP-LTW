$(document).ready(function() {
    //console.info($('#restaurant-label-score').text());

    $('#restaurant-label-score').html($('<span />').width(Math.max(0, (Math.min(5, parseFloat($('#restaurant-label-score').html())))) * 16));

});