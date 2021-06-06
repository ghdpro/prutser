<form role="search" method="get" class="row g-3 search-form" action="<?php echo esc_url( home_url( '/' ) ) ?>">
	<div class="col-auto">
	    <label>
	        <span class="screen-reader-text"><?php echo esc_attr_x( 'Search for:', 'label' ) ?></span>
	        <input type="search" class="form-control search-field" placeholder="<?php echo esc_attr_x( 'Search &hellip;', 'placeholder' ) ?>" value="<?php echo get_search_query() ?>" name="s"/>
	    </label>
	</div>
	<div class="col-auto">
	    <input type="submit" class="search-submit" value="<?php echo esc_attr_x( 'Search', 'submit button' ) ?>"/>
	</div>
</form>