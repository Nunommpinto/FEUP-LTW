<script type="text/javascript" src="templates/register_component.js"></script>
<h1>Registration form</h1>
<h3>Read the instructions carefully before you fill the form.</h3>
<ul>
	<li>Enter a valid email.</li>
    <li>Username may contain only digits, upper and lowercase letters and underscores.</li>
    <li>Password must be at least 6 characters long.</li>
    <li>Passwords must match</li>
</ul>

<form action="action_regist.php" method="post">
	Email: <input type="text" name="email">
	<br>
	<br>
    Username: <input type="text" name="username">
    <br>
	<br>
    Password: <input type="password" name="password">
    <br>
	<br>
    Confirm password: <input type="password" name="confirm">
    <br>
	<br>
	User type: 
	<input type="radio" name="privileges" <?php if (isset($privileges) && $privileges=="owner") echo "checked";?> value="owner">Owner
	<input type="radio" name="privileges" <?php if (isset($privileges) && $privileges=="reviewer") echo "checked";?> value="reviewer">Reviewer
	<br>
	<br>
    <input type="button" value="Confirm"
           onclick="return regform(this.form,
					this.form.email,
                    this.form.username,
                    this.form.password,
					this.form.confirm,
					this.form.privileges);">
    <input type="submit" name="cancel_btn" value="Cancel">
</form>