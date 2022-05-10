<?php

session_start();
if($_SESSION['u_level']!='admin'){
    header('location: /');
    exit();
}
// include database connection
include('inc/dbconnect.inc.php');
// include the header file
include('inc/header.php');
// include the Breadcrumbs file
include('inc/dynamicBreadcrumbs.php');	


$updateQuery = mysqli_query($dbconnect,"SELECT * FROM `product` WHERE `product_id`={$_GET['id']}"
                           
);

while ($row=mysqli_fetch_array($updateQuery)){
    $p_name = $row['p_name'];
    $p_category = $row['p_category'];
    $p_price = $row['p_price'];
    $p_detail = $row['p_detail'];
    $p_detail_thumb = $row['p_detail-thumb'];

}
echo $dbconnect->error;
?>
<div class="container">
    <div class="admin">
<?php

if(isset($_SESSION['message'])){
    echo "<div class='alert alert-warning mt-3'>";
    echo "Error: ".$_SESSION['message'];
    echo "</div>";
}

?>

        <br>
        <h1> Update Product </h1>
        <form method="post" action="/mng/mng_content.php" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $_GET['id'];?>"/>
            <input type="hidden" name="action" value="update" /><br>
            
            <p><input type="text" name="p_name" placeholder="Name" value="<?php echo $p_name;?>"/></p>
            
            <p><input type="text" name="p_category" placeholder="Category" value="<?php echo $p_category;?>"/></p>
            <p><input type="text" name="p_price" placeholder="Price"  value="<?php echo $p_price;?>" /></p>
            
            Thumbnail Image
            <p><input type="file" name="p_detail-thumb" placeholder="Thumbnail Image" /></p>
            Main Image
            <p><input type="file" name="p_image" placeholder="Image" /></p>
            
            <div class="float-right"><span id="details-counter">0</span>/255</div>
            
            <p><textarea id="item-details" name="p_detail" placeholder="Detail" maxlength="255"><?php echo $p_detail ?></textarea></p>
            <div class="float-right"><span id="details-counter-short">0</span>/100</div>
            <p><textarea id="item-details-short" name="p_detail_teaser" placeholder="shorter details"  maxlength="100"><?php echo $p_detail_thumb; ?></textarea></p>
            
            
            
            
            <p><input type="submit" value="update Product" /></p>
            <div style="clear:both"></div>
            
            
        </form>

    </div>
</div>