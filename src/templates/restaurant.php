<!-- Displays a restaurant individual page -->
<html>
<head>
<link rel="stylesheet" href="../css/restaurant.css">
</head>
</html>

<?php
    if (session_status() == PHP_SESSION_NONE) 
        session_start();

    include_once('../database/connection.php');
    include_once('../database/db_restaurants.php');
    include_once('../database/db_restaurants_info.php');
    include_once('../database/db_photo.php');
    include_once('../database/db_localization.php');
    include_once('../database/db_review.php');
	include_once('../database/db_user.php');
        
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
    $photos = getAllPhotosFromRestaurant($info['idRestaurantInfo']);
    $reviews = getAllReviews($_GET['idRestaurant']);

    include_once('header.php');
?>

<section id="pageres">
    <div id='restaurant'>
        <h2><?=$restaurant['name']?></h2>
        <h3><?=$restaurant['description']?></h3>
        <?php if($restaurant['score']) { ?>
            <h4>Average Score: <?=$restaurant['score']?></h4>
        <?php } ?>
    </div>
	
	<div class="localization">
        <?php if(isset($localization['country']) || isset($localization['city']) || isset($localization['road'])) { ?>
            <div id="map" style="width:200px; height:300px"></div>
			<label>Address: </label>
        <?php } else { ?>
            <label>No address available</label>
        <?php } ?>
        <div id="road"><?=$localization['road']?></div>
		<div id="postalCode"><?=$localization['postalCode']?></div>
		<div id="city"><?=$localization['city']?></div>
		<div id="country"><?=$localization['country']?></div>
    </div>
	
    <div id='restaurantInfo'>
        <div id="price"> 
		<?php if($info['price']) { ?>
			<p>Price: <?=$info['price']?> €</p>
        <?php } else { ?>
            <p>No prices available</p>
        <?php } ?>
		 </div>
		 
		<div id="cat"> 
        <?php if($info['category']) { ?>
			<p>Categories: <?=$info['category']?></p>
        <?php } else { ?>
            <p>No categories available</p>
        <?php } ?>
		 </div>
		
		<div id="open">
        <?php if($info['openHours']) { ?>
            <p>Open Hours: <?=$info['openHours']?></p>
        <?php } else { ?>
            <p>No open hours available</p>
        <?php } ?>
		</div>
		
        <?php if($info['closeHours']) { ?>
            <p>Close hours: <?=$info['closeHours']?></p>
        <?php } else { ?>
            <p>No close hours available</p>
        <?php } ?>
    </div>
	
    <script type="text/javascript">
        function initMap() {
            var restaurantName = document.getElementById("restaurant").firstChild;
            while(restaurantName.nodeType != 1)
                restaurantName = restaurantName.nextSibling;
            restaurantName = restaurantName.innerHTML;
            
            var country = document.getElementById("country").innerHTML;
            var city = document.getElementById("city").innerHTML;
            var road = document.getElementById("road").innerHTML;
            var postalCode = document.getElementById("postalCode").innerHTML;
            var address;
            var concatenate = false;

            if(country) {
                address = country;
                concatenate = true;
            }
            if(city) {
                if(concatenate)
                    address += ', ' + city;
                else
                    address = city;
                concatenate = true;
            }
            if(road) {
                if(concatenate)
                    address += ', ' + road;
                else
                    address = road;
                concatenate = true;
            }
            if(postalCode) {
                if(concatenate)
                    address += ', ' + postalCode;
                else
                    address = postalCode;
            }
            
            var geocoder = new google.maps.Geocoder();
            var myOptions;
            var map;

            if(geocoder) {
                geocoder.geocode( { 'address': address }, function(results, status) {
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
                                title: restaurantName
                            }); 
                            
                            google.maps.event.addListener(marker, 'click', function() {
                                infowindow.open(map,marker);
                            });
                        } else
                            document.getElementById("map").remove();
                    } else
                        document.getElementById("map").remove();
                });
            }
        }
    </script>

    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCE0pHcgGYzuvMNnK6LccmizdbYlnvezAk&callback=initMap"></script>
	
	<div id="ptit">
	<label> Photos: </label>
	</div>
	
    <div id="photos">
        <?php foreach($photos as $photo) { ?>
            <div id="photo">
			<img src="../images/originals/<?=$photo['idPhoto']?>.<?=$photo['type']?> " width="200" height="200">
			</div>
        <?php } ?>
    </div>
	
	<div id="add">
    <a href="../pages/add_photos.php?idRestaurant=<?=$_GET['idRestaurant']?>&idRestaurantInfo=<?=$info['idRestaurantInfo']?>">Add a Photo</a>
	</div> 

    <div id='reviews'>
        <?php if($reviews)
            foreach($reviews as $review) { ?>
			<div class="review">
				<?php echo "<a href='#' onclick='loadProfile(\"" . getUsernameById($review['idUser']) . "\")'>" . getUsernameById($review['idUser']) . "</a>"?>
                <label>'s review: </label> <br><br>
			<div class="rev2">
			   <label>Score: </label><?=$review['score']?>
			   <br>
			   <label>Comment: </label><?=$review['comment']?>
               <br>
			</div>
                <?php 
					$idUserReview = getUserIdFromReview($review['idReview']);
                    $idUserReview = intval($idUserReview[0]);
                    
                    $idUserSESSION = intval(isset($_SESSION['idUser'][0]) ? $_SESSION['idUser'] : -1);
                    if(isset($_SESSION['idUser']) && $idUserReview == $idUserSESSION) {
                ?>
                    <a href="edit_review.php?idReview=<?=$review['idReview']?>">Edit</a>
                    <a href="../database/action_delete_review.php?idReview=<?=$review['idReview']?>&idRestaurant=<?=$_GET['idRestaurant']?>">Remove</a>
                <?php } if(isset($_SESSION['idUser']) && ($idUserSESSION == $idUserReview || $idUserSESSION == $restaurant['idOwner'])) { ?>
                    <a href="reply_review.php?idReview=<?=$review['idReview']?>">Reply</a>
                <?php }
                    $replies = getRepliesFromReview($review['idReview']);
                    foreach($replies as $reply) {
                ?>
				<div class="response">
                    <?php echo "<a href='#' onclick='loadProfile(\"" . getUsernameById($reply['idReplier']) . "\")'>" . getUsernameById($reply['idReplier']) . "</a>"?><label>'s reply: </label> <?=$reply['comment']?> 
				</div>
                <?php } ?>
				</div>
            <?php } ?>
    </div>

    <?php
        if(isset($_SESSION['idUser']) && $restaurant['idOwner'] != intval($_SESSION['idUser'][0]) && !checkUserAlreadyReviewedRest($_GET['idRestaurant'], intval($_SESSION['idUser'][0])))
            include_once('write_review.php'); 
    ?>
</section>