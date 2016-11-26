<!-- Displays all the restaurants in '$restaurants' -->

<section id="restaurants">
    <?php foreach($restaurants as $restaurant) { ?>
    <article>
        <h2><?= $restaurant['name'] ?></h2>
        <a href="view_restaurant.php?idRestaurant=<?=$restaurant['idRestaurant']?>">Restaurant page</a>
    </article>
    <?php } ?>
</section>