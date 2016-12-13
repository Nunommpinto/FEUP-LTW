<?php
    include_once('../database/connection.php');
    include_once('../database/db_photo.php');

    $photos = getAllUserPhotos(intval($_SESSION['idUser']));

    foreach($photos as $photo) {
?>

<img src="../images/originals/<?=$photo['idPhoto']?>.<?=$photo['type']?>" alt="<?=$photo['title']?>">
<a href="../database/action_delete_photo.php?idPhoto=<?=$photo['idPhoto']?>">Delete Photo</a>
<?php } ?>