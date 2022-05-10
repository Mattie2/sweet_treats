<?php
    //search the db for query string and return results in JSON format

    include('../inc/dbconnect.inc.php');
    include('../inc/header.php');

    //remove special chars to aviod swl injection
    $search = htmlspecialchars($_GET['term']);

    //get all prooducts where product name is similar to search string
    $result = mysqli_query($dbname,"SELECT * FROM `PRODUCT` WHERE `p_name` LIKE %{$search}");

    //check if anything was returned
    if($result->num_rows > 0){
        //create an array to load the results into
        $mainarray = array();
f
        //loop through each result
        while($row - mysqli_fetch_array($result)){
            $rowarray - array(
                "id" => $row['product_id'],
                "label" => $row['p_name']
            );

            array_push($mainarray,$rowarray);
        };
        echo json_encode($mainarray);
    }else{
        echo json_encode($mainarray);
    };
?>