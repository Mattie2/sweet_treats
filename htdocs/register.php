<?php

session_start();

// include database connection
include('inc/dbconnect.inc.php');
// include the header file
include('inc/header.php');
// include the Breadcrumbs file
include('inc/dynamicBreadcrumbs.php');

?>
<div id="reg_container">
	<h1>Register</h1>
				<form action="mng/mng_user.php" method="POST">
						<input type="text" name="r_uname" placeholder="Username" required="true" />
						<br>
						<input type="password" name="r_pword1" placeholder="Password" required="true" />
						<br>
						<input type="password" name="r_pword2" placeholder="Password again" required="true" />
						<br>
						<input type="submit" name="Register now!"/>
						<input type="hidden" name="mode" value="register"/>
					</form>
					<?php if (isset($_SESSION['message'])) { ?>
				<div class="message"><?php	echo $_SESSION['message'];?></div>
		<?php }; ?>
</div>