<div class="login-box">
    <a href="#" class="login-link">Login</a>
    <a href="#" class="register-link">Register</a>
    <div class="login-component">
        <?php 
            include_once("login_component.php");
        ?>
    </div>
    <div class="register-component">
        <?php 
            include_once("register_component.php");
        ?>
    </div>
</div>
<script type="text/javascript" src=<?php echo (strpos(getcwd(), '/templates') !== false ? '"login_box.js"' : '"templates/login_box.js"') ?>></script>