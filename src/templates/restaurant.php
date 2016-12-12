<!-- Displays a restaurant individual page -->

<?php
    include_once('../database/connection.php');
    include_once('../database/db_restaurants.php');
    include_once('../database/db_restaurants_info.php');
    include_once('../database/db_photo.php');
    include_once('../database/db_localization.php');
    include_once('../database/db_review.php');

    if (session_status() == PHP_SESSION_NONE) 
        session_start();
        
    $restaurant;

    if(isset($_GET['idRestaurant'])) {
        $_SESSION['idRestaurant'] = $_GET['idRestaurant'];
        $restaurant = getRestaurantById($_GET['idRestaurant']);
        if($restaurant == false)
            die('There was no restaurant with the specified id');
    } else {
        $_SESSION['idRestaurant'] = $_SESSION['restaurant'];
        $restaurant = $_SESSION['restaurant'];
        if($restaurant == false)
            die('There was no restaurant with the specified id');
    }

    $info = getInfoById($restaurant['idRestaurantInfo']);
    $localization = getLocalizationById($info['idLocalization']);
    $photo = getPhotoById($info['idRestaurantInfo']);
    $reviews = getAllReviews($_GET['idRestaurant']);

    include_once('header.php');
?>

<section>
    <div id='restaurant'>
        <h2><?=$restaurant['name']?></h2>
        <h3><?=$restaurant['description']?></h3>
        <h4>Average Score: <?=$restaurant['score']?></h3>
    </article>
    <div id='restaurantInfo'>
        <?php if($info['price']) { ?>
            <p>Price: <?=$info['price']?></p>
        <?php } else { ?>
            <p>No prices available</p>
        <?php } ?>

        <?php if($info['category']) { ?>
            <p>Categories: <?=$info['category']?></p>
        <?php } else { ?>
            <p>No categories available</p>
        <?php } ?>

        <?php if($info['openHours']) { ?>
            <p>Open Hours: <?=$info['openHours']?></p>
        <?php } else { ?>
            <p>No open hours available</p>
        <?php } ?>

        <?php if($info['closeHours']) { ?>
            <p>Close hours: <?=$info['closeHours']?></p>
        <?php } else { ?>
            <p>No close hours available</p>
        <?php } ?>
    </div>
    <div id="localization">
        <label>Adress: </label>
        <?php if($localization['country']) { ?>
            <div id="country"><?=$localization['country']?></div>
        <?php } ?>

        <?php if($localization['city']) { ?>
            <div id="city"><?=$localization['city']?></div>
        <?php } ?>

        <?php if($localization['road']) { ?>
            <div id="road"><?=$localization['road']?></div>
        <?php } ?>

        <?php if($localization['postalCode']) { ?>
            <div id="postalCode"><?=$localization['postalCode']?></div>
        <?php } ?>

        <div id="map" style="width:100%; height:400px"></div>
    </div>

    <script type="text/javascript">
        function initMap() {
            var country = document.getElementById("country").innerHTML;
            var city = document.getElementById("city").innerHTML;
            var road = document.getElementById("road").innerHTML;

            var address = country + ', ' + city + ', ' + road;
            
            var geocoder = new google.maps.Geocoder();
            var latLng = new google.maps.LatLng(-34.397, 150.644);
            var myOptions;
            var map;

            if(geocoder) {
                geocoder.geocode( { 'address': address}, function(results, status) {
                    if(status == google.maps.GeocoderStatus.OK) {
                        if(status != google.maps.GeocoderStatus.ZERO_RESULTS) {
                            myOptions = {
                                zoom: 20,
                                center: results[0].geometry.location,
                                mapTypeControl: true,
                                mapTypeControlOptions: {style: google.maps.MapTypeControlStyle.DROPDOWN_MENU},
                                navigationControl: true,
                                mapTypeId: google.maps.MapTypeId.ROADMAP  
                            };

                            map = new google.maps.Map(document.getElementById('map'), myOptions);

                            var infowindow = new google.maps.InfoWindow(
                                { content: '<b>'+address+'</b>',
                                size: new google.maps.Size(1000, 500)
                                });

                            var marker = new google.maps.Marker({
                                position: results[0].geometry.location,
                                map: map, 
                                title: address
                            }); 
                            
                            google.maps.event.addListener(marker, 'click', function() {
                                infowindow.open(map,marker);
                            });
                        } else
                            alert('No results found!');
                    } else
                        alert("Geocode was not initialized due to: " + status);
                });
            }
        }
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCE0pHcgGYzuvMNnK6LccmizdbYlnvezAk&callback=initMap">
    </script>

    <div id="photos">
        <?php if($photo) ?>
            <img src="../images/originals/<?=$photo['idPhoto']?>.jpg">
    </div>
    <div id='reviews'>
        <?php if($reviews)
            foreach($reviews as $review) { ?>
                <label>Review: </label><?=$review['comment']?>
                <br>
                <label>Score: </label><?=$review['score']?>
                <br>
                <a href="edit_review.php?idReview=<?=$review['idReview']?>">Edit</a>
                <a href="../database/action_delete_review.php?idReview=<?=$review['idReview']?>">Remove</a>
                <a href="reply_review.php?idReview=<?=$review['idReview']?>">Reply</a>
                <br><br>
                <?php
                    $replies = getRepliesFromReview($review['idReview']);
                    foreach($replies as $reply) {
                ?>
                    <label>Reply: </label> <?=$reply['comment']?> <br>
                <?php } ?>
            <br> <br>
            <?php } ?>
    </div>
    <?php include_once('write_review.php'); ?>
</section>