<?php foreach($reviews as $review) { ?>
    <label>Review: </label><?=$review['comment']?>
    <br>
    <label>Score: </label><?=$review['score']?>
    <br><br>
<?php } ?>