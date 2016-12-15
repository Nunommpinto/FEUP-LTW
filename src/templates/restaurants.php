<!-- Displays all the restaurants in '$restaurants' -->
<html>
<head>
<link rel="stylesheet" href="../css/top_rest.css">
</head>
</html>

<section id="restaurants">
	<ol>
    <?php foreach($restaurants as $restaurant) { ?>
    <article>
        <li> <a href="../templates/restaurant.php?idRestaurant=<?=$restaurant['idRestaurant']?>"><h2><?= $restaurant['name'] ?></h2></a> </li>
    </article>
    <?php } ?>
	<ol>
</section>