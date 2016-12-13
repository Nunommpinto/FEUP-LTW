<!-- Displays all the restaurants in '$restaurants' -->

<?php
    if (session_status() == PHP_SESSION_NONE) { session_start(); }
?>

<section id="restaurants">
    <?php foreach($_SESSION['restaurants'] as $restaurant) { ?>
    <article>
        <a href="../templates/restaurant.php?idRestaurant=<?=$restaurant['idRestaurant']?>"><h2><?= $restaurant['name'] ?></h2></a>
    </article>
    <?php } ?>
</section>