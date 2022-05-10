<?php

// include database connection
include('dbconnect.inc.php');

// Search Element (Product or Category)
if (isset($_GET[ 'bathroom'] )) {
    $result = mysqli_query($dbconnect, "SELECT * FROM `product` WHERE `p_name` LIKE '%{$_GET['bathroom']}%' or `p_category` LIKE '%{$_GET['bathroom']}%'" );

} else if(isset($_GET['cat'])) {

    // Display the Category
    $result = mysqli_query($dbconnect, "SELECT * FROM `product` WHERE `p_category`='{$_GET['cat']}'");

} else {

    // Display All Products
    $result=mysqli_query($dbconnect,"SELECT * FROM `product`");
};

?>
    <!DOCTYPE html>
    <html>

    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta charset="utf-8">
        <title>Tutto | Amore </title>
        <!-- Favicon -->
        <link rel="icon" type="icon/png" href="/images/logo.png">

        <!--JQuery CSS-->
        <link rel="stylesheet" type="text/css" href="../js/jquery-ui.css" />

        <!-- JQuery -->
        <script src="/js/jquery.js"></script>
        <script type="text/javascript" src="../js/jquery-ui.js"></script>

        <!-- Font Awsome -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">

        <!-- bootstrap -->
        <script src="/js/bootstrap.bundle.min.js"></script>
        <script src="/js/bootstrap.min.js"></script>
        <link rel="stylesheet" type="text/css" href="/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="/css/bootstrap-grid.min.css">
        <link rel="stylesheet" type="text/css" href="/css/bootstrap-reboot.min.css">

        <!-- google fonts -->
        <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">

        <!-- Slick.js -->
        <link type="text/css" rel="stylesheet" href="/css/slick.css">
        <link type="text/css" rel="stylesheet" href="/css/slick-theme.css">
        <script src="/js/slick.min.js"></script>
        
        <!-- Overrides -->
        <link rel="stylesheet" type="text/css" href="/css/core.css">
        <script src="/js/core.js"></script>
    </head>

    <body>


<div class="mobile-nav-container">
                    <ul class="navbar-nav mr-auto">
                        <div id="mobile-header-user-control">
                            <?php
                                include $_SERVER['DOCUMENT_ROOT'].'/inc/userHeader.inc.php';
                            ?>
                        </div>
                        <li class="nav-item active">
                            <a class="nav-link" href="/">Home<span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/listings.php">All Sweets</a>
                        </li>
                    
                        <li class="nav-item ">
                            <a class="nav-link " href="#" id="navbarDropdown" >Catagories</a>
                            <div class="" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="/listings.php?cat=Boiled Sweets">Boiled Sweets</a>
                                <a class="dropdown-item" href="/listings.php?cat=Jelly Sweets">Jelly Sweets</a>
                                <a class="dropdown-item" href="/listings.php?cat=Toffee and Fudge">Toffee and Fudge</a>
                                <a class="dropdown-item" href="/listings.php?cat=Bon Bons">Bon Bons</a>
                                <a class="dropdown-item" href="/listings.php?cat=Chocolate">Chocolate</a>
                                <a class="dropdown-item" href="/listings.php?cat=Jars Of Joy">Jars Of Joy</a>
                                <a class="dropdown-item" href="/listings.php?cat=Lollipop">Lollipops</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">Special Offers</a>
                            </div>
                        </li>
                        
                    </ul>
                </div>

        <!-- pls dont delete me! -->
        <div class="global-container">
            <div class="sticky-footer">
            <!-- Navigation -->
            <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
                <div class="container">
                    <a class="navbar-brand" href="../index.php"><h1>Tutto</h1></a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item active">
                                <a class="nav-link" href="../listings.php">All Sweets<span class="sr-only">(current)</span></a>
                            </li>
                        
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Sweet Shop</a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="../listings.php?cat=Boiled Sweets">Boiled Sweets</a>
                                    <a class="dropdown-item" href="../listings.php?cat=Jelly Sweets">Jelly Sweets</a>
                                    <a class="dropdown-item" href="../listings.php?cat=Toffee and Fudge">Toffee and Fudge</a>
                                    <a class="dropdown-item" href="../listings.php?cat=Bon Bons">Bon Bons</a>
                                    <a class="dropdown-item" href="../listings.php?cat=Chocolate">Chocolate</a>
                                    <a class="dropdown-item" href="../listings.php?cat=Jars Of Joy">Jars Of Joy</a>
                                    <a class="dropdown-item" href="/listings.php?cat=Lollipop">Lollipops</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#">Special Offers</a>
                                </div>
                            </li>
                            
                        </ul>
                        <!--login & signup buttons-->
                        <div id="header-user-control">
                            <?php
                                include $_SERVER['DOCUMENT_ROOT'].'/inc/userHeader.inc.php';
                            ?>
                        </div>
                    </div>
                     
                            
                    <div class="nav-item mr-auto">
                       <div class="basket-container">

                            <div class="btn btn-success ml-2" id="header-cart-btn"><i class="fas fa-shopping-basket"></i> <div class="basket-number"><span id="headercart">-</span></div></div>

                            <div class="basket-drop">
                                <div class="basket-title">
                                    My Basket
                                </div>
                                <hr />
                                <div class="basket-list">

                                </div>
                                <div class="basket-price">
                                   
                                </div>
                                <div class="basket-checkout">
                                    <a href="/cart.php" class="btn  btn-primary">View</a>
                                    <a href="/checkout1.php" class="btn btn-success">Checkout</a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </nav>


            <!-- Mobile header -->
            <header class="mobile-header">
                <div class="mobile-header-title">Tutto</div>

                <div id="mobile-nav-open">
                    <i class="fas fa-bars"></i>
                </div>
            </header>

            <!-- End of mobile header -->

            <div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                <div class="modal-dialog login-pop-container">
                    <!-- form card login -->
                    <div class="card rounded-0">
                        <div class="card-header">
                            <h3 class="mb-0">Login</h3>
                        </div>
                        <div class="card-body" id="login-body-container">
                            <div class="alert alert-danger" id="login-error">
                                <strong>Error!</strong> Username or password not found.
                            </div>
                            <div class="alert alert-warning" id="loginload">
                                Loading....
                            </div>
                            <form action="../mng/mng_user.php" method="POST" id="loginform">
                                <div class="form-group">
                                    <label for="uname1">Username</label>
                                    <input type="text" class="form-control form-control-lg rounded-0" name="l_uname" id="l_uname" required="">
                                    <div class="invalid-feedback">Oops, you missed this one.</div>
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" class="form-control form-control-lg rounded-0" id="l_pword" name="l_pword" required="" autocomplete="new-password">
                                    <div class="invalid-feedback">Enter your password too!</div>
                                </div>
                                <div>
                                </div>
                                <input type="hidden" name="mode" value="login" />
                                <input type="submit" class="btn btn-primary" name="login" />
                                <p class="float-right login-register" data-toggle="modal" data-target="#reg-modal" onclick="$('#login-modal').modal('hide');"> Need an account? </p>
                            </form>
                        </div>
                        <!--/card-block-->
                    </div>
                    <!-- /form card login -->
                </div>
            </div>
            <!-- Register form-->
            <div class="modal fade" id="reg-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                <div class="modal-dialog login-pop-container">
                    <!-- form card login -->
                    <div class="card rounded-0">
                        <div class="card-header ">
                            <h3 class="mb-0">Register</h3></div>
                        <div class="card-body">
                            <form action="../mng/mng_user.php" method="POST" id="registerForm">
                                <div class="form-group">
                                    <label for="uname1">Username</label>
                                    <input type="text" class="form-control form-control-lg rounded-0" name="r_uname" id="r_uname" required="">
                                    <div class="invalid-feedback">Oops, you missed this one.</div>
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" class="form-control form-control-lg rounded-0" id="r_pword1" name="r_pword1" required="" autocomplete="new-password">
                                    <div class="invalid-feedback">Enter your password too!</div>
                                </div>
                                <div class="form-group">
                                    <label>Confirm Password</label>
                                    <input type="password" class="form-control form-control-lg rounded-0" id="r_pword2" name="r_pword2" required="" autocomplete="new-password">
                                    <div class="invalid-feedback">Enter your password too!</div>
                                </div>
                                <input type="hidden" name="mode" value="register" />
                                <input type="submit" class="btn btn-primary" name="login" />
                            </form>
                        </div>
                        <!--/card-block-->
                    </div>
                    <!-- /form card login -->
                </div>
            </div>
            <div class="header-search">
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <form action="../listings.php" method="get" class="form">
                                <div class="input-group ">
                                    <input type="text" class="form-control" placeholder="Search" name="searchterm" id="searchterm">
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-secondary header-search-btn" type="submit"><i class="fas fa-search-plus" title="My Basket"></i></button>
                                    </div>
                                </div>
                            </form>
                            <!-- 
                           <div class="col mt-5">
                        <!-- This tag will inject the cart display 
                        <div class="cartdisplaydiv"></div></br>
                    </div>-->
                        </div>
                    </div>
                </div>
            </div>
            <?php
             if (isset($_GET['registerSuccess']) || isset($_GET['registerError'])){
            ?>

            <div class="container">
            <div class="alert alert-warning">
                <?= $_SESSION['message']; ?> </div></div>
            <?php
             };
            ?> 

            <div class="mobile-basket-widget">
                <?php include $_SERVER['DOCUMENT_ROOT'].'/inc/mobile_basket_widget.inc.php'; ?>
            </div>