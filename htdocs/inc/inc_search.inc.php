<script type="text/javascript">
	$( document ).ready( function ) {

		$( "#searchterm" ).autocomplete( {
			source: "mng_search.php",
			minLengh: 2;
			select: function ( event, ui ) {
				window.location = "detail.php?id=+ui.id.item.id;"
			}

		} )
	}
</script>
<div class="header-search">
	<form action="../listings.php" method="get">
		<div class="input-group mb-3">
			<input type="text" class="form-control" placeholder="Search" name="searchterm" id="searchterm">
			<div class="input-group-append">
				<button class="btn btn-outline-secondary header-search-btn" type="submit"><i class="fas fa-search"></i></button>
			</div>
		</div>
	</form>
</div>