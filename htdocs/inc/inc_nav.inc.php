<?php

//include database connection 
include( 'dbconnect.inc.php' );

$navResult = mysqli_query( $dbconnect, "SELECT DISTINCT `p_category` FROM `product`" );
?>

<ul>
	<li>Home</li>
	<?php
	while ( $navRow = mysqli_fetch_array( $navResult ) ) {
		?>

	<li>
		<a href="../listings.php?cat=<?php echo $navRow ['p_category'];?>">
			<?php echo $navRow ['p_category']; ?>
		</a>
	</li>

	<?php
	} //End While loop 
	?>
</ul>