<div id="news-sidebar" class="sidebar-column last clearfix" role="complementary">

	<div id="sidebar-text">
	  <?php the_field('sidebar_note', 'option'); ?>
	</div>

	<?php $number_of_links_to_show = get_field('number_of_links_to_show', 'option'); ?>
  <?php if( have_rows('news_link', 'option') ) : ?>
	  <div id="news-coverage" class="list-of-items">
	    <h4 class="underline">News Coverage</h4>
      <ul>
      <?php $i=0; ?>
      <?php while( have_rows('news_link', 'option') ) : the_row(); ?>

        <?php
          if( $i < $number_of_links_to_show ) :


        $title = get_sub_field('title');
        $url = get_sub_field('url');
        $extra_info = get_sub_field('extra_info'); ?>

        <li>
          <a href="<?php echo $url; ?>" target="_blank"><?php echo $title; ?></a>
          <span class="extra-info"><?php echo $extra_info;?></span>
        </li>

        <?php $i++; endif; ?>

      <?php endwhile; ?>

      </ul>
      <div class="text-right">
        <a class="button small right top gray clear" href="<?php echo esc_url( get_permalink( get_page_by_title( 'Press and Releases' ) ) ); ?>">more</a>
      </div>
  	</div>

	<?php endif; ?>


  <?php if( have_rows('press_release', 'option') ) : ?>
	  <div id="press-releases" class="list-of-items">
      <h4 class="underline">Press Releases</h4>
      <ul>
      <?php $i = 0; ?>
      <?php while( have_rows('press_release', 'option') ) : the_row();
        if( $i < $number_of_links_to_show ) :

          $title = get_sub_field('title');
          $url = get_sub_field('url');
          $extra_info = get_sub_field('extra_info'); ?>

        <li>
          <a href="<?php echo $url; ?>" target="_blank"><?php echo $title; ?></a>
          <span class="extra-info"><?php echo $extra_info; ?></span>
        </li>

        <?php $i++; endif; ?>

      <?php endwhile; ?>

      </ul>
      <div class="text-right">
        <a class="button small right top gray clear" href="<?php echo esc_url( get_permalink( get_page_by_title( 'Press and Releases' ) ) ); ?>">more</a>
      </div>
  	</div>

	<?php endif; ?>

  <?php if( have_rows('newsletter', 'option') ) : ?>
	  <div id="newsletters" class="list-of-items">
      <h4 class="underline">Monthly Newsletters</h4>
      <ul>

      <?php $i = 0; ?>

      <?php while( have_rows('newsletter', 'option') ) : the_row();

        if( $i < $number_of_links_to_show ) :

         $title = get_sub_field('title');
         $url = get_sub_field('url');
         $extra_info = get_sub_field('extra_info'); ?>

        <li>
          <a href="<?php echo $url; ?>" target="_blank"><?php echo $title; ?></a>
          <span class="extra-info"><?php echo $extra_info; ?>
        </li>

        <?php $i++; endif; ?>
      <?php endwhile; ?>

      </ul>
      <div class="text-right">
        <a class="button small right top gray clear" href="<?php echo esc_url( get_permalink( get_page_by_title( 'Newsletters' ) ) ); ?>">more</a>
      </div>
  	</div>

	<?php endif; ?>


<?php if( have_rows('newsletter', 'option') ) : ?>
	  <div id="newsletters" class="list-of-items">
      <h4 class="underline">Banking on Buffalo Bayou</h4>
      <ul>

      <?php $i = 0; ?>

      <?php while( have_rows('banking', 'option') ) : the_row();

        if( $i < $number_of_links_to_show ) :

         $title = get_sub_field('title');
         $url = get_sub_field('url');
         $extra_info = get_sub_field('extra_info'); ?>

        <li>
          <a href="<?php echo $url; ?>" target="_blank"><?php echo $title; ?></a>
          <span class="extra-info"><?php echo $extra_info; ?>
        </li>

        <?php $i++; endif; ?>
      <?php endwhile; ?>

      </ul>
      <div class="text-right">
        <a class="button small right top gray clear" href="<?php echo esc_url( get_permalink( get_page_by_title( 'Newsletters' ) ) ); ?>">more</a>
      </div>
  	</div>

	<?php endif; ?>


	<?php if ( is_active_sidebar( 'sidebar1' ) ) : ?>

		<?php dynamic_sidebar( 'sidebar1' ); ?>

	<?php else : ?>

		<?php // This content shows up if there are no widgets defined in the backend. ?>

		<div class="alert alert-help">
			<p><?php _e( 'Please activate some Widgets.', 'bonestheme' );  ?></p>
		</div>

	<?php endif; ?>

</div>
