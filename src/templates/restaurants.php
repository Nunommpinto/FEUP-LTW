<!-- Displays all the restaurants in '$restaurants' -->

<section id="restaurants">
    <?php foreach($restaurants as $restaurant) { ?>
    <article>
        <h2><?= $restaurant['title'] ?></h2>
        <!--a href="view_restaurant.php?id=<?=$restaurant['idRestaurant']?>">Restaurant page</a-->
        <a href="view_restaurant.php?id=<?=$restaurant['id']?>">Restaurant page</a>
    </article>
    <?php } ?>
</section>