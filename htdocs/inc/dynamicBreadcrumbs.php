<nav class="breadcrumb-cont" aria-label="breadcrumb">
	<div class="container">
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="/">Home</a>
		</li>
		<?php
		$crumbPath = $_SERVER[ 'REQUEST_URI' ];
		$crumbNewPath = substr( $crumbPath, 0, strpos( $crumbPath, "." ) );
		$crumbSplit = explode( "/", $crumbNewPath );
		array_shift( $crumbSplit );
		for ( $crumbCount = 0; $crumbCount < count( $crumbSplit ); $crumbCount++ ) {
            // Make sure the path is not the index...
            if($crumbSplit[$crumbCount] !== "index"){
                echo '<li class="breadcrumb-item">' . ucfirst( $crumbSplit[ $crumbCount ] ) . '</li>';
            };
		};
		?>
	</ol>
</div>
</nav>