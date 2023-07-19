<form role="search" method="get" id="search" action="<?php echo home_url('/'); ?>">
	<div>
		<label class="searchlabel" for="s">Search:</label>
		<input type="text" value="<?php the_search_query(); ?>" name="s" id="s" />
		<input type="submit" id="searchsubmit" value="Search" />
	</div>
</form>