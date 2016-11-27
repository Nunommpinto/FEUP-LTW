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