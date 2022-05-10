<?php




?>

<!--<div id="reg_container">
	<h1>Register</h1>
	<form action="mng_user.php" method="POST">
		<input type="text" name="r_uname" placeholder="Username" required="true" />
		<br>
		<input type="password" name="r_pword1" placeholder="Password" required="true" />
		<br>
		<input type="password" name="r_pword2" placeholder="Password again" required="true" />
		<br>
		<input type="submit" name="Register now!"/>
		<input type="hidden" name="mode" value="register"/>
		</form>-->
	
	
						<a class="btn btn-light ml-2" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Sign Up</a>
						<form action="mng_user.php" method="POST">
						<div class="dropdown-menu">
							<form class="px-4 py-3">
								<div class="form-group">
									<input type="text" name="r_uname" placeholder="Username" required="true" />
								</div>
								<div class="form-group">
									<input type="password" name="r_pword1" placeholder="Password" required="true" />
								</div>
								<div class="form-group">
									<input type="password" name="r_pword2" placeholder="Password again" required="true" />
								</div>
								<div class="form-check">
									<input type="checkbox" class="form-check-input" id="dropdownCheck">
									<label class="form-check-label" for="dropdownCheck">Remember me</label>
								</div>
								<button type="submit" class="btn btn-primary">Login</button>
							</form>
							<div class="dropdown-divider"></div>
							<a class="dropdown-item" href="#">New around here? Sign up</a>
						</div>
				
</form>

		
		<?php 
			if ( isset( $_SESSION[ 'message' ] ) ) {
				?>
				<div class="message"> 
					<?php
				echo $_SESSION[ 'message' ];
								?>
				</div>
		<?php }; ?>
		

</div>