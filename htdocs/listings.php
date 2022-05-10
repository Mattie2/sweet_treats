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


function pageLink($pageNum){
	$uri = basename($_SERVER['REQUEST_URI']);
	if (strpos($uri, '?') !== false) {

			$newuri = "?page=".$pageNum;
			foreach($_GET as $r => $item){
				if($r !== 'page'){
					$newuri .= "&".$r."=".$item;
				};
			};
		$link = $newuri;
		
	}else{
     
		$link = '?page='.$pageNum;
	};

	return $link;
}

//Number of items per page
if(isset($_GET['npp'])){
    // Allow the user to pick the ammount per page
    // but limit the max to 20.
    if($_GET['npp'] > 20){
          $numPP = 20;
    }else{
        $numPP = $_GET['npp'];
    };
}else{
    // If the user hasnt specified, just use 6.
    $numPP = 6;
};

if(isset($_GET['page'])){
    $page = $_GET['page'];
    $fetchOffset = $numPP * $page;
}else{
    $fetchOffset = 0;
    $page = 0;
}
//Connect to the database and get all of the products

if ( isset( $_GET[ 'searchterm' ] ) ) {
	$check = mysqli_query( $dbconnect, "SELECT * FROM `product` WHERE `p_name` LIKE '%{$_GET['searchterm']}%' or `p_category` LIKE '%{$_GET['searchterm']}%' " );

} else if ( isset( $_GET[ 'cat' ] ) ) {

	// Display the Category
	$check = mysqli_query( $dbconnect, "SELECT * FROM `product` WHERE `p_category`='{$_GET['cat']}'" );

} else {

	// Display All Products
	$check = mysqli_query( $dbconnect, "SELECT * FROM `product`");
}

//Count the number of products in the database
$ammount = $check->num_rows;

// Get the number of pages required
$numPages = ceil($ammount / $numPP);

if ( isset( $_GET[ 'searchterm' ] ) ) {
	$result = mysqli_query( $dbconnect, "SELECT * FROM `product` WHERE `p_name` LIKE '%{$_GET['searchterm']}%' or `p_category` LIKE '%{$_GET['searchterm']}%' LIMIT $numPP OFFSET $fetchOffset" );

} else if ( isset( $_GET[ 'cat' ] ) ) {

	// Display the Category
	$result = mysqli_query( $dbconnect, "SELECT * FROM `product` WHERE `p_category`='{$_GET['cat']}' LIMIT $numPP OFFSET $fetchOffset" );

} else {

	// Display All Products
	$result = mysqli_query( $dbconnect, "SELECT * FROM `product` LIMIT $numPP OFFSET $fetchOffset");
}


$general_result = mysqli_query( $dbconnect, "SELECT * FROM `product` ORDER BY RAND() LIMIT 3" );
?>
	<!-- Display the product detail in the container -->
	<div class="container mt-5">
	
				
        
        
    
		<div class="search-container">
			<div class="row">

				<!--Loop through each row from results-->
				<?php		while ( $row = mysqli_fetch_array( $result ) ) { ?>

					<!--col-lg-4 = columnLarge4 | ColumnMedium6 | Meduim4 -->
					<div class="col-lg-4 col-md-6 mb-4">

						<!--col-lg-4 = columnLarge4 | ColumnMedium6 | Meduim4 -->
						<div class="card h-100">

							<div class="image-container">

								<!--This pull the image on tpo the page from the database-->
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
								<!--This is the star ratings-->

								<!--This is the see product button-->

								<div class="btn btn-success quickAdd" data="<?php echo $row['product_id'] ?>">Add <i class="fa fa-shopping-basket"></i></div>
								<a href="/detail.php?id=<?php echo $row['product_id'] ?>" class="btn btn-primary float-right">See Product</a>


							</div>
							<!--Footer close-->
						</div>
					</div>
					<!-- col-lg-3 col-md-6 mb-4-->
					<?php }; ?>
					<!--Close while loop-->
			</div>
			<!--Close row-->

			<div class="listingsPages">
				<nav aria-label="...">
					<ul class="pagination justify-content-center">

						<?php
		  if($page != 0){
			  $prevPage = pageLink($page-1);

              $temp = ($page-1);
			  $prevPage = pageLink($temp);

			  echo <<<END

				<li class="page-item ">
					<a class="page-link" href="$prevPage" tabindex="-1">Previous</a>
				</li>

END;
		}else{
			  echo <<<END

				<li class="page-item disabled">
		  			<a class="page-link" href="#" tabindex="-1">Previous</a>
				</li>

END;
		};


			for($i = 0; $i < $numPages; $i++){
				$pn = ($i+1);
				$link = pageLink($i);
				if($page == $i){
					echo <<<END

						<li class="page-item active"><a class="page-link" href="$link">$pn</a></li>

END;
				}else{
					echo <<<END

						<li class="page-item"><a class="page-link" href="$link">$pn</a></li>

END;
				}

			}

		  // If its not the last page


		  if($page != ($numPages-1)){

			  	$nextPage = pageLink($page+1);

              $temp = ($page+1);
			  	$nextPage = pageLink($temp);

				echo <<<END

				<li class="page-item">
				  <a class="page-link" href="$nextPage">Next</a>
				</li>

END;
		  }else{
			  echo <<<END

				<li class="page-item disabled">
				  <a class="page-link" href="#">Next</a>
				</li>
END;
		};
		  ?>



					</ul>
				</nav>
			</div>

			<!--
    
      <a class="page-link" href="#">2</a>
    
-->


		</div>
		<!--Close search-container-->
	</div>
	<!--Close Container-->
	<!-- include the Footer File -->
	<?php include( 'footer.php' );
?>
