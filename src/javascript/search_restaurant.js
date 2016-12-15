$(document).ready(function() {
    var name = $('#search-input-name');
    var minScore = $('#search-input-min');
    var maxScore = $('#search-input-max');
    var price = $('#search-input-price');
    var country = $('#search-input-country');
    var city = $('#search-input-city');

    name.on('keyup', function() {
        sendRequest(name.val(), minScore.val(), maxScore.val(), price.val(), country.val(), city.val());
    });

    minScore.on('keyup', function() {
        sendRequest(name.val(), minScore.val(), maxScore.val(), price.val(), country.val(), city.val());
    });
    
    maxScore.on('keyup', function() {
        sendRequest(name.val(), minScore.val(), maxScore.val(), price.val(), country.val(), city.val());
    });

    price.on('keyup', function() {
        sendRequest(name.val(), minScore.val(), maxScore.val(), price.val(), country.val(), city.val());
    });
    
    country.on('keyup', function() {
        sendRequest(name.val(), minScore.val(), maxScore.val(), price.val(), country.val(), city.val());
    });

    city.on('keyup', function() {
        sendRequest(name.val(), minScore.val(), maxScore.val(), price.val(), country.val(), city.val());
    });
    
});

/* AJAX Request */
sendRequest = function(name, minScore, maxScore, price, country, city) {
    if(!name && !minScore && !maxScore && !price && !country && !city)
        $('#search-output-restaurant').empty();
    else {
        $.ajax({
            type: "GET",
            url: "../database/action_search_restaurant.php",
            data: {name: name, "min-score": minScore, "max-score": maxScore, "price": price, "country": country, "city": city},
            success: function(result) {
                $('#search-output-restaurant').empty();
                //console.warn(result);
                var index = result.indexOf('success=');
                index += 8;
                var msg = result.substring(index);
                //console.warn(msg);

                var messages = msg.split(',');
                //console.info(messages);

                for(var i = 0; i < messages.length - 1; i += 2)
                    $('#search-output-restaurant').append('<a href="../templates/restaurant.php?idRestaurant='+messages[i]+'"><h2>'+messages[i+1]+'</h2></a>');
            }
        });
    }
}