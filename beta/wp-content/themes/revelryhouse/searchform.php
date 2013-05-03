<form method="get" action="<?php echo home_url( '/' ); ?>">
	<div class="input-prepend">
		<input type="text" id="prependedInput" name="s" size="100%" class="span4 magglass" placeholder="<?php echo __( '', 'reboot' ); ?>" value="<?php the_search_query(); ?>">
	</div>
</form>
