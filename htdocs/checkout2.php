<?php

session_start();

// include database connection
include('inc/dbconnect.inc.php');
// include the header file
include('inc/header.php');
// include the Breadcrumbs file
include('inc/dynamicBreadcrumbs.php');

?>

  <?php if($_SESSION['message']!=="") {
    $message = $_SESSION['message'];
					echo <<<END
      <div class="alert alert-success p-4">
                    $message
                    </div>
END;
                    $_SESSION['message']="";
 			}	?>
<div class="container">
<h1> Checkout 2 </h1>


<br>
<H2>Insert paymant gateway here!</H2>

<!--Paypal , Nochex API -->
<br/>



	<p><a href="checkout3.php" >Next Stage </a></p>
</div>

<?php include( 'footer.php' );?>