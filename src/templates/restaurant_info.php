<div id="restaurantInfo">
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