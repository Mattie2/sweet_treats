<?php


session_start();
// include database connection
include('inc/dbconnect.inc.php');
// include the header file
include('inc/header.php');
// include the Breadcrumbs file
include('inc/dynamicBreadcrumbs.php');
// include the login Script
include('inc/inc_loginform.php');

?>
	<div class="container" align="center">
		<div class="header-slider">
			<div class="header-slider-image">
				<img class="d-block img-fluid" src="img/Banner1.png" alt="Smarties">
			</div>
			<div class="header-slider-image">
				<img class="d-block img-fluid" src="img/Banner2.png" alt="Jelly Bean">
			</div>
			<div class="header-slider-image">
				<img class="d-block img-fluid" src="img/Banner3.png" alt="Heart">
			</div>
	        <div class="header-slider-image">
				<img class="d-block img-fluid" src="img/Banner4.png" alt="Wow!">
			</div>
	       <div class="header-slider-image">
				<img class="d-block img-fluid" src="img/Banner5.png" alt="Yummy!">
			</div>
	         <div class="header-slider-image">
				<img class="d-block img-fluid" src="img/Banner6.png" alt="Yummy!">
			</div>


			
		</div>
	</div>

	<?php


// Display All Products
$general_result = mysqli_query( $dbconnect, "SELECT * FROM `product` ORDER BY RAND() LIMIT 3" );

//this is where the featured sweets are written
$boiledSweets_result = mysqli_query( $dbconnect, "SELECT * FROM `product` WHERE `p_category`='Boiled Sweets' LIMIT 3" );
$ToffeeandFudge_result = mysqli_query( $dbconnect, "SELECT * FROM `product` WHERE `p_category`='Toffee and Fudge' LIMIT 3" );
$JellySweets_result = mysqli_query( $dbconnect, "SELECT * FROM `product` WHERE `p_category`='Jelly Sweets' LIMIT 3" );
$JarsOfJoy_result = mysqli_query($dbconnect, "SELECT * FROM `product` WHERE `p_category`='Jars of Joy' LIMIT 3");
?>

		<!-- Display the product detail in the container -->
		<div class="container">
			<div class="search-container">
			
				<div class="card">
					<h5 class="card-header card text-white bg-primary mb-3">Featured Products</h5>
					<div class="row pl-3 pr-3">
<?php
			// Loop through each row from results
			while ( $row = mysqli_fetch_array( $general_result ) ) {
				?>
						<div class="col-lg-4 col-md-6 mb-4">
							<div class="card h-100 border-primary mb-3">
                                
								<div class="image-container">
									<a href="/detail.php?id=<?php echo $row['product_id'] ?>"><img class="card-img-top" src="<?php echo $row['p_image'] ?>" alt=""></a>
								</div>
								<div class="card-body">
									<h4 class="card-title">
										<a href="/detail.php?id=<?php echo $row['product_id'] ?>">
											<?php echo $row['p_name']; ?>
										</a>
									</h4>
<h5>£
										<?php echo $row['p_price']; ?>
									</h5>
									<h5>
										<?php echo $row['p_category']; ?>
									</h5>
									<p class="card-text">
										<?php echo $row['p_detail-thumb'] ?>
									</p>
								
								</div>
								<div class="card-footer bg-transparent border-primary">
									<div class="btn btn-success quickAdd" data="<?php echo $row['product_id'] ?>">Add <i class="fa fa-shopping-basket"></i></div>
									<!--This is the see product button-->
									<a href="/detail.php?id=<?php echo $row['product_id'] ?>" class="btn btn-primary float-right">See Product</a>
								</div>
							</div>
						</div>
						<?php }; ?>
						<!--Close while loop-->
					</div>
				</div>
		
		
                
				<div class="home-title-container"> 
				<div class="home-featured-title">Featured Jars Of Joy</div>
				<a class="float-right" href="/listings.php?cat=Jars Of Joy"><small>VIEW ALL</small></a>
					<div style="clear:both"></div>
				</div>
					<div class="row">
					<?php
			// Loop through each row from results
			while ( $row = mysqli_fetch_array( $JarsOfJoy_result ) ) {
				?>
						<div class="col-lg-4 col-md-6 mb-4">
							<div class="card h-100">
								<div class="image-container">
									<a href="/detail.php?id=<?php echo $row['product_id'] ?>"><img class="card-img-top" src="<?php echo $row['p_image'] ?>" alt=""></a>
								</div>
								<div class="card-body">
									<h4 class="card-title">
										<a href="/detail.php?id=<?php echo $row['product_id'] ?>">
											<?php echo $row['p_name']; ?>
										</a>
									</h4>

									<h5>£
										<?php echo $row['p_price']; ?>
									</h5>
									<h5>
										<?php echo $row['p_category']; ?>
									</h5>
									<p class="card-text">
										<?php echo $row['p_detail-thumb'] ?>
									</p>
								</div>
								<div class="card-footer">
									<div class="btn btn-success quickAdd" data="<?php echo $row['product_id'] ?>">Add <i class="fa fa-shopping-basket"></i></div>
									<!--This is the see product button-->
									<a href="/detail.php?id=<?php echo $row['product_id'] ?>" class="btn btn-primary float-right">See Product</a>
								</div>
							</div>
						</div>
						<?php }; ?>
						<!--Close while loop-->
				</div>


				<div class="home-title-container"> 
				<div class="home-featured-title">Featured Boiled Sweets</div>
				<a class="float-right" href="/listings.php?cat=Boiled Sweets"><small>VIEW ALL</small></a>
					<div style="clear:both"></div>
				</div>
					<div class="row">
					<?php
			// Loop through each row from results
			while ( $row = mysqli_fetch_array( $boiledSweets_result ) ) {
				?>
						<div class="col-lg-4 col-md-6 mb-4">
							<div class="card h-100">
								<div class="image-container">
									<a href="/detail.php?id=<?php echo $row['product_id'] ?>"><img class="card-img-top" src="<?php echo $row['p_image'] ?>" alt=""></a>
								</div>
								<div class="card-body">
									<h4 class="card-title">
										<a href="/detail.php?id=<?php echo $row['product_id'] ?>">
											<?php echo $row['p_name']; ?>
										</a>
									</h4>

									<h5>£
										<?php echo $row['p_price']; ?>
									</h5>
									<h5>
										<?php echo $row['p_category']; ?>
									</h5>
									<p class="card-text">
										<?php echo $row['p_detail-thumb'] ?>
									</p>
								</div>
								<div class="card-footer">
									<div class="btn btn-success quickAdd" data="<?php echo $row['product_id'] ?>">Add <i class="fa fa-shopping-basket"></i></div>
									<!--This is the see product button-->
									<a href="/detail.php?id=<?php echo $row['product_id'] ?>" class="btn btn-primary float-right">See Product</a>
								</div>
							</div>
						</div>
						<?php }; ?>
						<!--Close while loop-->
				</div>





			<div class="home-title-container"> 
				<div class="home-featured-title">Featured Toffee and Fudge</div>
				<a class="float-right" href="/listings.php?cat=Toffee and Fudge"><small>VIEW ALL</small></a>
					<div style="clear:both"></div>
				</div>
				<div class="row">
					<?php
			// Loop through each row from results
			while ( $row = mysqli_fetch_array( $ToffeeandFudge_result ) ) {
				?>
						<div class="col-lg-4 col-md-6 mb-4">
							<div class="card h-100">
								<div class="image-container">
									<a href="/detail.php?id=<?php echo $row['product_id'] ?>"><img class="card-img-top" src="<?php echo $row['p_image'] ?>" alt=""></a>
								</div>
								<div class="card-body">
									<h4 class="card-title">
										<a href="/detail.php?id=<?php echo $row['product_id'] ?>">
											<?php echo $row['p_name']; ?>
										</a>
									</h4>

									<h5>£
										<?php echo $row['p_price']; ?>
									</h5>
									<h5>
										<?php echo $row['p_category']; ?>
									</h5>
									<p class="card-text">
										<?php echo $row['p_detail-thumb'] ?>
									</p>
								</div>
								<div class="card-footer">
									<div class="btn btn-success quickAdd" data="<?php echo $row['product_id'] ?>">Add <i class="fa fa-shopping-basket"></i></div>
									<!--This is the see product button-->
									<a href="/detail.php?id=<?php echo $row['product_id'] ?>" class="btn btn-primary float-right">See Product</a>
								</div>
							</div>
						</div>
						<?php }; ?>
						<!--Close while loop-->
				</div>





			<div class="home-title-container"> 
				<div class="home-featured-title">Featured Jelly Sweets</div>
				<a class="float-right" href="/listings.php?cat=Jelly Sweets"><small>VIEW ALL</small></a>
					<div style="clear:both"></div>
				</div>
				<div class="row">
					<?php
			// Loop through each row from results
			while ( $row = mysqli_fetch_array( $JellySweets_result ) ) {
				?>
						<div class="col-lg-4 col-md-6 mb-4">
							<div class="card h-100">
								<div class="image-container">
									<a href="/detail.php?id=<?php echo $row['product_id'] ?>"><img class="card-img-top" src="<?php echo $row['p_image'] ?>" alt=""></a>
								</div>
								<div class="card-body">
									<h4 class="card-title">
										<a href="/detail.php?id=<?php echo $row['product_id'] ?>">
											<?php echo $row['p_name']; ?>
										</a>
									</h4>

									<h5>£
										<?php echo $row['p_price']; ?>
									</h5>
									<h5>
										<?php echo $row['p_category']; ?>
									</h5>
									<p class="card-text">
										<?php echo $row['p_detail-thumb'] ?>
									</p>
								</div>
								<div class="card-footer">
									<div class="btn btn-success quickAdd" data="<?php echo $row['product_id'] ?>">Add <i class="fa fa-shopping-basket"></i></div>
									<!--This is the see product button-->
									<a href="/detail.php?id=<?php echo $row['product_id'] ?>" class="btn btn-primary float-right">See Product</a>
								</div>
							</div>
						</div>
						<?php }; ?>
						<!--Close while loop-->
				</div>





				<!--Close Container-->
			</div>
			<!--Close search-container-->
		</div>
		<!--Close Row-->
		<!-- include the Footer File -->
		<?php include( 'footer.php' );?>
