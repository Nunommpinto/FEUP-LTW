<?php
    $idRestaurant = $_GET['idRestaurant'];
    $idRestaurantInfo = $_GET['idRestaurantInfo'];
?>

<script src="http://code.jquery.com/jquery-3.1.1.min.js"></script>
<script type="text/javascript" src="../javascript/upload_image.js"></script>

<form id="form-component" action="../database/action_add_photos.php" method="post" enctype="multipart/form-data">
    <input type="hidden" name="idRestaurant" value=<?=$idRestaurant?>>
    <input type="hidden" name="idRestaurantInfo" value=<?=$idRestaurantInfo?>>
    
    <label>Upload Image</label>
    <div class="file_div1">
        <input type="text" name="title1">
        <input type="file" class="image1" name="image[]">
    </div>

    <input type="button" id="btn_add_more" value="Add more photos" />

    <br><br>
    <input type="submit" value="Upload">
</form>