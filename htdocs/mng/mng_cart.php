<?php


/*
█████████████████████████████████████████████████████

			Shopping cart manage script 

		@ The purpose of this script is to
		@ manage the shopping cart and the
		@ functions that the user will use
		@ when adding, changing and delete
		@ things in their carts. 

█████████████████████████████████████████████████████
*/


// Start the PHP session
session_start(); 





/*
█████████████████████████████████████████████████████

			Update cart quantities

█████████████████████████████████████████████████████
*/


if ($_GET[ 'action' ] == 'update') {

	// ╔═█████╗█████╗█████╗█████╗█████╗█████╗█████╗█████╗█████╗█████╗█████╗█████═╗
	// ║╔═════╝╚════╝╚════╝╚════╝╚════╝╚════╝╚════╝╚════╝╚════╝╚════╝╚════╝╚════╗║
	// ║║																		║║
	/*	
			@ This script will update the carts data 
			@ when the user decides to change the
			@ quantity and click the update cart button
	*/

	$newcart = ""; //create a new cart 
	
	foreach($_POST as $key => $qty) { 	//Loops through the data that was posted from the cart form
		
		if(stristr($key,'qty')) { //Chceck if the data key contains the 'qty' string

		 	//Select Qty text boxes 
			$id = substr($key, 4); 	//just get ID 
	
			if($qty !=0 && is_numeric($qty)) { //Check if the qut is not 0 and is a valid number

				for($i=0; $i < $qty; $i++) { //Look the qut ammount of times

					if ($newcart === "") { //If the new cart is empty

						$newcart = $id; //Add the item ID to the string

					} else { // Else if the cart is not empty

						$newcart.= ",".$id; //Add the item IF to the cart string with a comma

					}; //End of if
					
				}; //End of for loop

			}; //if qty a positive number 

		}; //End if Qty

	}; //End for each 

	//Set the new cart string to the cart session
	$_SESSION[ 'cart' ] = $newcart;

	//Redirect the user to the cart page
	header("location: /cart.php");
	
	//Exit the script and stop executing.
	exit();

	// ║║																	    ║║
	// ║╚█████╗█████╗█████╗█████╗█████╗█████╗█████╗█████╗█████╗█████╗█████╗█████╝║
    // ╚══════╝╚════╝╚════╝╚════╝╚════╝╚════╝╚════╝╚════╝╚════╝╚════╝╚════╝╚═════╝

};






/*
█████████████████████████████████████████████████████

			Delete item from cart

█████████████████████████████████████████████████████
*/


if ( $_GET[ 'action' ] === 'delete') {

	// ╔═█████╗█████╗█████╗█████╗█████╗█████╗█████╗█████╗█████╗█████╗█████╗█████═╗
	// ║╔═════╝╚════╝╚════╝╚════╝╚════╝╚════╝╚════╝╚════╝╚════╝╚════╝╚════╝╚════╗║
	// ║║																		║║
	/*	
			@ This script takes the items ID
			@ in the cart and remvoes it from 
			@ the cart.
	*/
	
	$cart = $_SESSION[ 'cart' ]; //get current cart from the PHP session
	
	$newcart=null; //Create a null variable for the new cart
	
	$items=explode(',', $cart); // 'explode' (split string) by the comma character
	
	if(count($items) == 1){ // If There is only one item in the cart
		$newcart = null; // To remove the one item, return a null variable. 
		
	}else{ // Else there are more than one item in the cart
		
		foreach ($items as $pos => $item) { //loop through items in the cart
			
			if ($_GET['id'] != $item ) { //If the current item ID IS NOT the item to remove
				
				if($newcart == ""){	// If the new cart is empty
				
					$newcart = $item; // Add the item into the empty cart string

				} else { // else the cart string is not empty
					
					$newcart .= "," . $item; // Add the item into the string with a comma
					
				}; //End if
			}; //End if 
		}; //End For each
	}; //End If

	//Set the new cart string as the cart session
	$_SESSION['cart'] = $newcart;
	
	// Redirect the user to the cart page
	header("location: /cart.php");
	
	//Exit the script and stop executing code.
	exit();


	// ║║																	    ║║
	// ║╚█████╗█████╗█████╗█████╗█████╗█████╗█████╗█████╗█████╗█████╗█████╗█████╝║
    // ╚══════╝╚════╝╚════╝╚════╝╚════╝╚════╝╚════╝╚════╝╚════╝╚════╝╚════╝╚═════╝

}; //End action delete 







/*
█████████████████████████████████████████████████████

				Add item to cart

█████████████████████████████████████████████████████
*/


// Only execute if the add action is requested. 
if ($_GET['action'] == 'add' ) {


	// ╔═█████╗█████╗█████╗█████╗█████╗█████╗█████╗█████╗█████╗█████╗█████╗█████═╗
	// ║╔═════╝╚════╝╚════╝╚════╝╚════╝╚════╝╚════╝╚════╝╚════╝╚════╝╚════╝╚════╗║
	// ║║																		║║
	/*	
			@ This block of code is responsible for adding 
			@ items to the cart when posted. 
	*/

	// Check if the user is logged in by checking 
	// if the user_id session is set ( Their user id )
	if (!isset($_SESSION['user_id'])) {

		// Not logged in and the user session is not set. 

		//Echo the word error onto the page
		echo('Error');

		//Stop executing code and exit the script.
		exit();

	}; //End if 


	// Check if the cart session already exists. 
	if(isset($_SESSION['cart'])){
		
		//Already items in the cart,
		
		// Check if the current cart is just an empry string
		if($_SESSION['cart'] == ""){
			// Repalce the current cart with the product ID
			$_SESSION['cart'] = $_POST['productid'];
		}else{
			// Add the new item on the end with a comma. 
			$_SESSION['cart'] = $_SESSION['cart'] . "," . $_POST['productid'];
		};
		
	}else{

		// Else, cart doesnt exit. 

		// create the cart and add the one item. 
		$_SESSION[ 'cart' ] = $_POST['productid'];

	}; // End of If the cart is set. 

	$cart = $_SESSION['cart']; // Set the cart variable to the current set cart

	if (!$cart) { // if the cart exists

	// Close the PHP tag and show the following HTML if the cart exists //
	?>

	
	<div id="holdcart">
		<p id="cartmessage">You have no items in your
			<a href="../cart.php">shopping cart</a>
		</p>
		<span id="cartload"></span>
	</div>


	<?php
	// Re-open the PHP tag //

	} else { // Else if the cart doesnt exist


			$items=explode(',', $cart); // "explode" (split array) by comma

			$s=(count($items)>1) ? 's' : ''; // If there is more than one item, ass an 's' to the s variable

			$count=count($items); // Count the number of items in the array 

			if($count >= 99){ // If there are more than 99 items

                echo("99+"); // Cap the counter output at 99

            }else{ // If there are not more than 99 items

                echo($count); // Output the ammount of items

            }; // End if

	} //End Else 


	// ║║																	    ║║
	// ║╚█████╗█████╗█████╗█████╗█████╗█████╗█████╗█████╗█████╗█████╗█████╗█████╝║
    // ╚══════╝╚════╝╚════╝╚════╝╚════╝╚════╝╚════╝╚════╝╚════╝╚════╝╚════╝╚═════╝

}; //End action Add 






/*
█████████████████████████████████████████████████████

      	Count and return ammount of items

█████████████████████████████████████████████████████
*/

if ($_GET['action'] == 'count' ) {

	// ╔═█████╗█████╗█████╗█████╗█████╗█████╗█████╗█████╗█████╗█████╗█████╗█████═╗
	// ║╔═════╝╚════╝╚════╝╚════╝╚════╝╚════╝╚════╝╚════╝╚════╝╚════╝╚════╝╚════╗║
	// ║║																		║║
	/*	
			@ This code counts the ammount of items 
			@ inside the cart and returns a capped
			@ number

	*/
		

	if(isset($_SESSION['cart'])){ //Check if the cart session exists

		if($_SESSION['cart'] == ""){ // If the cart is empty

			echo '0'; // Return 0

		}else{ // If the cart is not empty

			$cart = $_SESSION['cart']; // Set the cart session to the cart variable

			$items=explode(',', $cart); // "explode" (split array) by comma

			$count=count($items); // Count the ammount of items in the array
            
            if($count >= 99){ // If there are more than 99 items

                echo("99+"); // Cap the counter output at 99

            }else{ // If there are not more than 99 items

                echo($count); // Output the ammount of items

            }; // End if

			
		}; // End if

	}else{ // If the cart session is not set

		echo '0'; // Return 0

	};//End if


	// ║║																	    ║║
	// ║╚█████╗█████╗█████╗█████╗█████╗█████╗█████╗█████╗█████╗█████╗█████╗█████╝║
    // ╚══════╝╚════╝╚════╝╚════╝╚════╝╚════╝╚════╝╚════╝╚════╝╚════╝╚════╝╚═════╝

}; // End of count




?>