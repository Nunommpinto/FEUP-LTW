<!-- Displays a restaurant individual page -->

<?php
    include_once('../database/connection.php');
    include_once('../database/db_restaurants.php');
    include_once('../database/db_restaurants_info.php');
    include_once('../database/db_photo.php');
    include_once('../database/db_localization.php');
    include_once('../database/db_review.php');

    $restaurant;

    if(isset($_GET['idRestaurant'])) {
        $restaurant = getRestaurantById($_GET['idRestaurant']);
        if($restaurant == false)
            die('There was no restaurant with the specified id');
    } else {
        session_start();
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
        <?php if($localization['country']) { ?>
            <p>Country: <?=$localization['country']?></p>
        <?php } else { ?>
            <p>No country available</p>
        <?php } ?>

        <?php if($localization['city']) { ?>
            <p>City: <?=$localization['city']?></p>
        <?php } else { ?>
            <p>No city available</p>
        <?php } ?>

        <?php if($localization['road']) { ?>
            <p>Road: <?=$localization['road']?></p>
        <?php } else { ?>
            <p>No road available</p>
        <?php } ?>

        <?php if($localization['postalCode']) { ?>
            <p>Postal Code: <?=$localization['postalCode']?></p>
        <?php } else { ?>
            <p>No posta code available</p>
        <?php } ?>
    </div>
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
                <br><br>
            <?php } ?>
    </div>
    <?php include_once('write_review.php'); ?>
</section>