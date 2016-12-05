<!-- Displays all the restaurants in '$restaurants' -->

<?php
    if (session_status() == PHP_SESSION_NONE) { session_start(); }
?>

<section id="restaurants">
    <?php foreach($_SESSION['restaurants'] as $restaurant) { ?>
    <article>
        <h2><?= $restaurant['name'] ?></h2>
        <a href="../templates/restaurant.php?idRestaurant=<?=$restaurant['idRestaurant']?>">Restaurant page</a>
        <a href="write_review?idRestaurant=<?=$restaurant['idRestaurant']?>">Write a Review</a>
    </article>
    <?php } ?>
</section>