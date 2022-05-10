<?php 
session_start();
if(isset($_SESSION['cart'])) {//if there is a cart	

    $cart= $_SESSION['cart']; //Set cart Value

} else {
    $_SESSION['cart']="";
    $cart= $_SESSION['cart']; //Set cart Value

} //End cart Check 

if(!isset($_SESSION['user_id'])) {

?>

<div class="containerWelcome">
    <div id="holdcart">
        <div id="cartmessage">
            <div class="alert alert-warning p-4">

                <div class="warning-text-fix"> You have no items in your <a href="../cart.php">shopping cart</a></div>

                <button class="btn btn-outline-secondary ml-3 float-right" data-toggle="modal" data-target="#login-modal"><i title="logout"></i>Login</button>

                <span id="cartload"></span>
                <div style="clear:both"></div>
            </div>
        </div>
    </div>
</div>


<?php

} else {

    //Pass the cart variable 
    //stores in array based on delimita/ seporator 
    $items = explode(',',$cart);
    $s = (count($items)>1)? 's':'';
    $count = count($items);

?>
    <div class="containerWelcome">
        <div id="holdcart">
            <p id="cartmessage">
                <div class="alert alert-warning p-4">
                    <div class="warning-text-fix">
                        <p>Welcome  <strong><?php echo $_SESSION ['u_username']; ?></strong>!

                            <p>
                                <?php
                                    if($count == 1){
                                ?>
                                        You have no items in your <a href="../cart.php">shopping cart</a>
                                <?php
                                    }else{
                                ?>
                                        You have
                                        <?php echo $count; ?> item<?php echo $s; ?>
                                         in your <a href="../cart.php"> shopping cart</a>
                                        <?php
                                    };

                                ?>

                            </p>
                    </div>
                    <button class="btn btn-outline-secondary sml ml-3 float-right" onclick="window.location = 'logout.php';"><i title="logout"></i>logout <i class="fa fa-arrow-circle-right"></i></button>

                    <span id="cartload"></span>
                    <div style="clear:both"></div>
                </div>
        </div>
    </div>
    <?php
} //End else 

?>
