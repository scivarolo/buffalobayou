<?php 
/**
 * Month View Nav Template
 * This file loads the month view navigation.
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/month/nav.php
 *
 * @package TribeEventsCalendar
 * @since  3.0
 * @author Modern Tribe Inc.
 *
 */

if ( !defined('ABSPATH') ) { die('-1'); } ?>

<?php do_action( 'tribe_events_before_nav' ) ?>

<h3 class="tribe-events-visuallyhidden"><?php _e( 'Calendar Month Navigation', 'tribe-events-calendar' ) ?></h3>

<ul class="tribe-events-sub-nav">
	<li class="tribe-events-nav-previous">
		<?php $url = tribe_get_previous_month_link();
		      $date = Tribe__Events__Main::instance()->previousMonth( tribe_get_month_view_date() );
		      $text = tribe_get_previous_month_text(); ?> 
		      
      <a class="gray clear button left" data-month="<?php echo $date; ?>" href="<?php echo $url; ?>">
        <span>&laquo; <?php echo $text; ?></span>
      </a>
			
	</li><!-- .tribe-events-nav-previous -->
	<li class="tribe-events-nav-next">
		<?php $url = tribe_get_next_month_link();
		      $date = Tribe__Events__Main::instance()->nextMonth( tribe_get_month_view_date() );
		      $text = tribe_get_next_month_text(); ?> 
		      
      <a class="gray clear button right" data-month="<?php echo $date; ?>" href="<?php echo $url; ?>">
        <span><?php echo $text; ?> &raquo;</span>
      </a>
			
		
	</li><!-- .tribe-events-nav-next -->
</ul><!-- .tribe-events-sub-nav -->

<?php do_action( 'tribe_events_after_nav' ) ?>
