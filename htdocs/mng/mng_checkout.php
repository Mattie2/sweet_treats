<?php

//start php session to track session tokens and variables
session_start();

//include db connections
include $_SERVER['DOCUMENT_ROOT'].'/inc/dbconnect.inc.php';


/***************************
    Add item to the cart
****************************/

if($_POST['stage']=="1"){
    //this adds items to the cart when posted

    //create a flag to indicate any failures during code execution
    $valid=true;
    //forr each of the items in the cart
    foreach($_POST as $key=>$value){
        echo "$key
        $value";
        // echo $value;
        //check if value is null/empty
        if($value==""){
            //if any values are invalid, update the valid flags to false
            $valid=false;
            //set the session message to an error message
            $_SESSION['message']="Please enter all details";

            //redirect the user back to the original checkout, so they can re-renter valid details
            header("location: /checkout1.php");

            //exit the script
            exit();
        } else{
            //all data is valid
            echo $_POST['fname'];
            //add the user's details into the customer table
            $sql = "INSERT INTO `customer` 
            (`user_id`,
            `c_fname`,
            `c_sname`,
            `c_phonenum`,
            `c_email`)
            VALUES
            ('{$_SESSION['user_id']}',
            '{$_POST['fname']}',
            '{$_POST['sname']}',
            '{$_POST['phone']}',
            '{$_POST['email']}'";

            //performs action
            $customerInsert = mysqli_query($dbconnect, $sql);

            //checking if the customer was successfully added to the db
            if(!$customerInsert){
                //redirect them back to the first checkout page
                $_SESSION['message']="Problem adding the customer";
                header("location: /checkout1.php");

                exit();
            }else{
                //load the customer's id into the session data
                $_SESSION['customer_id']=mysqli_insert_id($dbconnect);
                //constructing query
                $sql = "INSERT INTO `address`
                (`customer_id`,
                `ad_line1`,
                `ad_line2`,
                `ad_town`,
                `ad_country`,
                `ad_postcode`)
                VALUES
                ('{$_SESSION['customer_id']},
                '{$_POST['ad_line1']}',
                '{$_POST['ad_line2']}',
                '{$_POST['ad_town']}',
                '{$_POST['ad_country']}',
                '{$_POST['ad_postcode']}'";

                //inserts to db
                $addressInsert = mysqli_query($dbconnect,$sql);

                //check if the address is already there
                if(!$addressInsert){
                    //set session message to error message
                    $_SESSION['message']="Error adding address info";

                    //redirect the user to checkout1
                    header("location: /checkout1.php");
                    exit();
                }else{
                    $_SESSION['message']="Details have been successfully added";
                    //update session variable for address
                    $_SESSION['address_id']=mysqli_insert_id($dbconnect);

                    header("location: /checkout2.php");
                    exit();
                }
            }
        }
    }
} else if($_POST['stage']=="3"){
    /*setup a none autocommit transation to the database, to ensure ACID is being followed
    as all queries are prepared and done at once, so if any errors occur the transaction can be undone */
    mysqli_query($dbconnect, "SET autocommit=0");
    mysqli_query($dbconnect, "START TRANSACTION");

    //insert sale query
    $query = "INSERT INTO `sale`
    (`customer_id`,
    `s_date`,
    `s_total`)
    VALUES
    ({$_SESSION['customer_id']},
    NOW(),
    {$_POST['total']})";

    $saleInsert = @mysqli_query($dbconnect, $query);

    if($saleInsert){
        $saleid = mysqli_insert_id($dbconnect);
            $productid = "";
            $qty="";
            $net="";
        //loop through post array (sales row)
        foreach($_POST as $key=>$value){
            if (stristr($key,'pid')){
                //get product id
                $productid = $value;
            };

            if (stristr($key,'qty')){
                //get quantity
                $qty = $value;
            };

            if (stristr($key,'net')){
                //get net total
                $net = $value;
            };            

            if ($productid && $qty && $net){
                //insert the sale row
                $sql = "INSERT INTO `sale_row`
                (`sale_id`, 
                `product_id`, 
                `sr_qty`, 
                `sr_net`)
                VALUES 
                ({$saleid},{$productid},{$qty},{$net})";
                $rowInsert = @mysqli_query($dbconnect,$sql);
                $productid="";
                $qty="";
                $net="";
                if(!$rowInsert){
                    $rowRollback=true; //set rollback flag
                }
            }
        }
    }
    if(!$rowRollback){
        mysqli_query($dbconnect,"COMMIT");
        $_SESSION['message']="Your order has been confirmed";
        header("location: /orderconfirm.php");
    }
}