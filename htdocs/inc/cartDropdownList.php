<?php
// Include database connection
include( $_SERVER[ 'DOCUMENT_ROOT' ] . '/inc/dbconnect.inc.php' );


    session_start();

    $cartArray = array();

    $cartList = "";
    $cartPrice = "";

    $total = 0;
    if(isset($_SESSION['cart'])){
    $cart = $_SESSION[ 'cart' ]; //get chart session contnets 

    if ( $cart ) { //if there is any items 

        $items = explode( ',', $cart );
        $content = array();

        foreach ( $items as $item ) {

            if ( isset( $content[ $item ] ) ) {
                $content[ $item ] += 1;

            } else {

                $content[ $item ] = 1;
                
            }; //End if 
        }; //End Foreach 

       
        foreach ( $content as $id => $qty ) {
            $sql = "SELECT * 
                    FROM `product`
                    WHERE `product_id`='{$id}'";
            if ( is_numeric( $id ) ) {
                $cartresult = mysqli_query( $dbconnect, $sql );
                if($cartresult->num_rows > 0){

            
                    while ( $row = mysqli_fetch_array( $cartresult ) ) {

                        $name = $row['p_name'];
                        $price = $row['p_price'];

                        $cartList .= <<<END

                        <div class="header-cart-item">
                             <div class="header-cart-item-name">$qty x $name </div>
                            <div class="header-cart-item-price">£$price</div>
                            <div style="clear:both"></div>
                        </div>
END;


                        $total += $row['p_price'] * $qty;
                        

                    }; //END WHILE
                    $cartPrice = $total;

                    

                }else{
                    $cartArray['price'] = "0";
                    $cartArray['list'] = "No items in cart.";
                    
                    //echo json_encode($cartArray);
                };

            }; //End IF
        }; //End Foreach 
        $cartArray['price'] = $cartPrice;
        $cartArray['list'] = $cartList;

        echo json_encode($cartArray);
    }else{
        $cartArray['price'] = "0";
        $cartArray['list'] = "No items in cart.";
                    
       // echo json_encode($cartArray);
    };

};
  


?>