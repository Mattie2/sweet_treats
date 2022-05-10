<?php

// Start the PHP session
session_start();

// Check if the user level session _DOES NOT_ eaqul 'admin'
if($_SESSION['u_level']!='admin'){
    // Redirect the user to the root directory
    header('location: /');
    // Exit the script and stop executing code
    exit();
} // End if session _not_ admin

// include database connection
include('inc/dbconnect.inc.php');

// include the header file
include('inc/header.php');

// include the Breadcrumbs file
include('inc/dynamicBreadcrumbs.php');	


?>


<div class="container">
    <div class="admin">


    <?php
        // If the message PHP session exists
        if(isset($_SESSION['message'])){
            // Echo the start of an alert tag
            echo "<div class='alert alert-warning mt-3'>";

            //Echo the message PHP session contents
            echo $_SESSION['message'];

            // Echo the end of the alert div
            echo "</div>";

        }// End of if message session exists

    ?>

        <br>
        <h1> Insert Product </h1>
        <form method="post" action="/mng/mng_content.php" enctype="multipart/form-data">
            <input type="hidden" name="action" value="insert" /><br>
            <p><input type="text" name="p_name" placeholder="Name" /></p>
            <p><input type="text" name="p_category" placeholder="Category" /></p>
            <p><input type="text" name="p_price" placeholder="Price" /></p>
            
            Thumbnail Image
            <p><input type="file" name="p_detail-thumb" placeholder="Thumbnail Image" /></p>
            Main Image
            <p><input type="file" name="p_image" placeholder="Image" /></p>
            <div class="float-right"><span id="details-counter">0</span>/255</div>
            <p><textarea id="item-details" name="p_detail" placeholder="Detail" maxlength="255"></textarea></p>
            <div class="float-right"><span id="details-counter-short">0</span>/100</div>
            <p><textarea id="item-details-short" name="p_detail_teaser" placeholder="shorter details"  maxlength="100"></textarea></p>
            <p><input type="submit" value="Insert Product" /></p>
            
        </form>
    </div>
</div>