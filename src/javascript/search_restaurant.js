$(document).ready(function() {
    var name = $('#search-input-name');
    var minScore = $('#search-input-min');
    var maxScore = $('#search-input-max');
    var price = $('#search-input-price');
    var country = $('#search-input-country');
    var city = $('#search-input-city');

    name.on('keyup', function() {
        console.info("cons");
        sendRequest();
    })
});

/* AJAX Request */
sendRequest = function() {
    $.ajax({
        type: "GET",
        url: "../database/action_search_restaurant.php",
        data: {name: "Rest"},//, "min-score": minScore, "max-score": maxScore, "price": price, "country": country, "city": city},
        success: function(result) {
            console.warn(result);
        }
    });
}