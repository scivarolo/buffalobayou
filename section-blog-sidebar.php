<div id="news-sidebar" class="sidebar-column last clearfix" role="complementary">

	<div id="sidebar-text">
	  <?php the_field('sidebar_text', 'option'); ?>
	</div>

	<?php if ( is_active_sidebar( 'sidebar2' ) ) : ?>

		<?php dynamic_sidebar( 'sidebar2' ); ?>

	<?php else : ?>

		<?php // This content shows up if there are no widgets defined in the backend. ?>

		<div class="alert alert-help">
			<p><?php _e( 'Please activate some Widgets.', 'bonestheme' );  ?></p>
		</div>

	<?php endif; ?>

</div>
