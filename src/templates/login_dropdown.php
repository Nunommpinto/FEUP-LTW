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
            <form action="../database/action_register.php" method="post">
                <div class="container">
                    <label class="login-label"><b>Email</b></label>
                    <input type="text" placeholder="Enter Email" name="email" required>

                    <label class="login-label"><b>Username</b></label>
                    <input type="text" placeholder="Enter Username" name="username" required>
                    
                    <label class="login-label"><b>Password</b></label>
                    <input type="password" placeholder="Enter Password" name="password" pattern="[0-9a-zA-Z]{6,}" required oninvalid="setCustomValidity('Only letters and numbers. At least 6 characters.')">

                    <label class="login-label"><b>Confirm Password</b></label>
                    <input type="password" placeholder="Re-enter Password" name="confirm" required>

                    <div class="login-switch-container">
                        <label class="login-label">Reviewer</label>
                        <label class="login-switch">
                            <input type="checkbox" name="owner">
                            <div class="login-switch-slider"></div>
                        </label>
                        <label class="login-label">Owner</label>
                    </div>
                    <button type="submit">Register</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div id="profile-snackbar" class="snackbar">Error msg</div>