<?php
    if (session_status() == PHP_SESSION_NONE) 
       session_start();
    if (!isset($_SESSION['username'])) {
        header('Location: ../index.php');
        exit();
    }
        
    include_once('../database/connection.php');
    include_once('../database/db_user.php');
    include_once('../database/db_user_info.php');
    include_once('../templates/header.php');
?>
<script type="text/javascript" src="../javascript/profile.js"></script>

<div id="profile-form" class="profile modal">
    <form class="profile modal-content animate" action="javascript:void(0);">
        <i id="profile-close" class="profile fa fa-times" aria-hidden="true"></i>
        <div class="imgcontainer profile">
            <img src="../images/avatar/man.png" alt="Avatar" class="profile avatar">
        </div>

        <div class="container profile">
            <label><b>Username: </b></label>
            <label id="profile-label-username">
                <?php echo $_SESSION['username']; ?>
                (<?php echo (isOwner($_SESSION['username']) ? "Owner" : "Reviewer"); ?>)
            </label>

            <br><br>
            <label><b>Email:</b></label>
            <label id="profile-label-email"><?php echo getEmail($_SESSION['username']); ?></label>
            <i id="profile-edit-email" class="profile fa fa-pencil-square-o"></i>
            <input id="profile-input-email" class="profile" type="text" placeholder="Enter Email" name="email">
            <button id="profile-save-email" class="profile editsave">Save</button>
            <button id="profile-cancel-email" class="profile editcancel">Discard</button>

            <br><br>
            <label id="profile-label-pw"><b>Change Password</b></label>
            <i id="profile-edit-pw" class="profile fa fa-pencil-square-o"></i>
            <input id="profile-input-pw" class="profile" type="password" name="pw">
            <input id="profile-input-pw-confirm" class="profile" type="password" name="pw">
            <button id="profile-save-pw" class="profile editsave">Save</button>
            <button id="profile-cancel-pw" class="profile editcancel">Discard</button>

            <br><br>
            <label><b>Name:</b></label>
            <label id="profile-label-name"><?php echo getUserinfoName($_SESSION['username']); ?></label>
            <i id="profile-edit-name" class="profile fa fa-pencil-square-o"></i>
            <input id="profile-input-name" class="profile" type="text" placeholder="Enter Name" name="name">
            <button id="profile-save-name" class="profile editsave">Save</button>
            <button id="profile-cancel-name" class="profile editcancel">Discard</button>

            <br><br>
            <label><b>Biography:</b></label>
            <i id="profile-edit-bio" class="profile fa fa-pencil-square-o"></i>
            <textarea id="profile-label-bio" class="profile" rows="8" readonly><?php echo getUserinfoBio($_SESSION['username']); ?></textarea>
            <textarea id="profile-input-bio" class="profile" rows="8" name="biography"></textarea>
            <button id="profile-save-bio" class="profile editsave">Save</button>
            <button id="profile-cancel-bio" class="profile editcancel">Discard</button>
        </div>
    </form>
</div>

<div id="profile-snackbar" class="snackbar">Error msg</div>
