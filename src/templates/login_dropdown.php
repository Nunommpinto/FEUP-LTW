<div class="login-dropdown">
    <a href="#">Sign In</a>
    <div class="login-dropdown-content">
        <ul class="login-dropdown-tabs">
            <li><a href="#" id="login-tablink" class="login-dropdown-tablinks">Login</a></li>
            <li><a href="#" id="register-tablink" class="login-dropdown-tablinks">Register</a></li>
        </ul>
        <div id="login-tab" class="login-dropdown-tabcontent">
            <form action="../database/action_login.php" method="post">
                <div class="container">
                    <label class="login-label"><b>Username</b></label>
                    <input type="text" placeholder="Enter Username" name="username" required>
                    
                    <label class="login-label"><b>Password</b></label>
                    <input type="password" placeholder="Enter Password" name="password" required>

                    <button type="submit" value="Login">Login</button>
                </div>
            </form>
        </div>
        <div id="register-tab" class="login-dropdown-tabcontent">
            <form action="../database/action_regist.php" method="post">
                <div class="container">
                    <label class="login-label"><b>Email</b></label>
                    <input type="text" placeholder="Enter Email" name="email" required>

                    <label class="login-label"><b>Username</b></label>
                    <input type="text" placeholder="Enter Username" name="username" required>
                    
                    <label class="login-label"><b>Password</b></label>
                    <input type="password" placeholder="Enter Password" name="password" required>

                    <label class="login-label"><b>Confirm Password</b></label>
                    <input type="password" placeholder="Re-enter Password" name="confirm" required>

                    <div class="login-switch-container">
                        <label class="login-label">Reviewer</label>
                        <label class="login-switch">
                            <input type="checkbox" name="privileges">
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