<?php

session_start();

// include database connection
include( 'inc/dbconnect.inc.php' );
// include the header file
include( 'inc/header.php' );
// include the Breadcrumbs file
include( 'inc/dynamicBreadcrumbs.php' );
// include the Login Form 
include( 'inc/inc_loginform.php' );

global $dbconnect; //Conect to the database

?>



	<div class="container">
		<div class="cart-title">
			Please review your basket (<span id="cart-ammount"></span> items)
		</div>



		<?php



if (isset($_SESSION['cart']) && $_SESSION['cart'] !== "") { //if there is any items 
	?>
			<form action="/mng/mng_cart.php?action=update" method="POST" id="cart" class="mb-5">
				<div class="row">

					<div class="col-9 cart-list">


						<?php

	$cart = $_SESSION[ 'cart' ]; //get chart session contnets
	$items = explode( ',', $cart );
	$content = array();


	foreach ( $items as $item ) {
		if ( isset( $content[ $item ] ) ) {
			$content[ $item ] += 1;
		} else {
			$content[ $item ] = 1;
		}; //End if 
	} //End Foreach 


		//Update the Quanitiy!
		$total = 0;


		foreach ( $content as $id => $qty ) {
			if ( is_numeric( $id ) ) {

				$sql = "SELECT * FROM `product` WHERE `product_id`='{$id}'";
				$cartresult = mysqli_query( $dbconnect, $sql );

				while ( $cartRow = mysqli_fetch_array( $cartresult ) ) {

?>



							<div class="row cart-row">
								<div class="col-2">
									<img class="cart-image" src="<?= $cartRow['p_image'] ?>" alt="">
								</div>
								<div class="col-4">
									<div class="cart-product-name">
										<a href="/detail.php?id=<?= $id ?>" class="text-dark">
											<?= $cartRow['p_name'] ?>
										</a>
									</div>
									<div class="cart-product-cat">
										<?= $cartRow['p_detail-thumb'] ?>
									</div>
								</div>

								<div class="col-2">
									<div class="cart-qty">
										Qty: <input class="form-control cart-qty-input" type="number" name="qty <?= $id ?>" value="<?= $qty ?>" />
									</div>
								</div>
								<div class="col-2 cart-price">
									£
									<?= number_format(($cartRow['p_price'] * $qty),2, '.', ' ') ?>
								</div>
								<div class="col-2">

									<div class="cart-remove"><a href="/mng/mng_cart.php?action=delete&id=<?= $id ?>" class="text-dark"> <i class="fa fa-times"></i></a></div>
								</div>

							</div>
							<hr>



							<?php
					$total += $cartRow['p_price'] * $qty;
				} //END WHILE
			} //End IF
		} //End Foreach 
?>





					</div>
					<!-- End of col-9 -->
					<div class="col-3 cart-sum">
						<div class="cart-sidebar">
							<div class="cart-sum-title">
								Basket Summary
							</div>

							<hr>


							<?php
	
			foreach ( $content as $id => $qty ) {
				if ( is_numeric( $id ) ) {
					$sql = "SELECT * FROM `product` WHERE `product_id`='{$id}'";
					$cartresult = mysqli_query( $dbconnect, $sql );
					while ( $cartRow = mysqli_fetch_array( $cartresult ) ) {
						$name = $cartRow['p_name'];
						$price = number_format(($cartRow['p_price'] * $qty), 2, '.', ' ');

						echo <<<END

						<div class="cart-sum-li">
							<div class="float-left header-cart-item-name">$qty x $name</div><div class="float-right">£$price</div>
							<div style="clear:both"></div>
						</div>

END;
					};
				};
			};
	

?>

								<hr>

								<p class="CartGrandTotal">
									Grand Total: <strong>&pound; <?= number_format($total, 2, '.', ' ') ?></strong>
								</p>

								<a href="checkout1.php" class="btn btn-outline-success btn-lg active" role="button" aria-pressed="true">Proceed to Checkout</a>
								<button type="submit" class="btn btn-warning"> Update Cart </button>
						</div>
					</div>

				</div>
			</form>

			<?php
	} else {


		echo'<p>You have no items in your cart! </p>';


	}; //END ELSE IF 
?>



	</div>

	<!-- include the Footer File -->
	<?php include( 'footer.php' );?>
