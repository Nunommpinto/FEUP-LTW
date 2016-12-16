<?php include_once('../templates/constants.php'); ?>

<div class="login-dropdown">
    <a href="#">Sign In</a>
    <div class="login-dropdown-content">
        <ul class="login-dropdown-tabs">
            <li><a href="#" id="login-tablink" class="login-dropdown-tablinks header-elem-active">Login</a></li>
            <li><a href="#" id="register-tablink" class="login-dropdown-tablinks">Register</a></li>
        </ul>
        <div id="login-tab" class="login-dropdown-tabcontent">
            <form action="javascript:void(0)">
                <div class="container">
                    <label id="login-label-username" class="login-label"><b>Username</b></label>
                    <input id="login-input-username" type="text" placeholder="Enter Username" name="username" required>
                    <label id="login-label-password" class="login-label"><b>Password</b></label>
                    <input id="login-input-password" type="password" placeholder="Enter Password" name="password" required>
                    <button id="login-btn" type="submit" value="Login">Login</button>
                </div>
            </form>
        </div>
        <div id="register-tab" class="login-dropdown-tabcontent">
            <form action="javascript:void(0)">
                <div class="container">
                    <label id="register-label-email" class="login-label"><b>Email</b></label>
                    <input id="register-input-email" type="text" placeholder="Enter Email" name="email">

                    <label id="register-label-username" class="login-label"><b>Username</b></label>
                    <input id="register-input-username" type="text" placeholder="Enter Username" name="username">
                    
                    <label id="register-label-password" class="login-label"><b>Password</b></label>
                    <input id="register-input-password" type="password" placeholder="Enter Password" name="password">

                    <label id="register-label-password-confirm" class="login-label"><b>Confirm Password</b></label>
                    <input id="register-input-password-confirm" type="password" placeholder="Re-enter Password" name="confirm">

                    <div class="login-switch-container">
                        <label class="login-label">Reviewer</label>
                        <label class="login-switch">
                            <input id="login-checkbox-owner" type="checkbox" name="owner">
                            <div class="login-switch-slider"></div>
                        </label>
                        <label class="login-label">Owner</label>
                    </div>
                    <button id="register-btn" type="submit">Register</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div id="profile-snackbar" class="snackbar">Error msg</div>