<?php 
/**
 * List View Single Event
 * This file contains one event in the list view
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/list/single-event.php
 *
 * @package TribeEventsCalendar
 * @since  3.0
 * @author Modern Tribe Inc.
 *
 */

if ( !defined('ABSPATH') ) { die('-1'); } ?>

<?php 

// Setup an array of venue details for use later in the template
$venue_details = array();

if ($venue_name = tribe_get_meta( 'tribe_event_venue_name' ) ) {
	$venue_details[] = $venue_name;	
}

if ($venue_address = tribe_get_meta( 'tribe_event_venue_address' ) ) {
	$venue_details[] = $venue_address;	
}
// Venue microformats
$has_venue = ( $venue_details ) ? ' vcard': '';
$has_venue_address = ( $venue_address ) ? ' location': '';

$event_taxonomy = tribe_get_event_taxonomy(); ?>

<!-- MY TEMPLATE -->

		<div class="tribe-events-list-date event-date">
			<span class="month">
				<?php echo tribe_get_start_date( $event = null, $displayTime = false, $dateFormat = 'M' ); ?>
			</span>
			<span class="day">
				<?php echo tribe_get_start_date( $event = null, $displayTime = false, $dateFormat = 'd' ); ?>
			</span>
		</div>
		
		<?php do_action( 'tribe_events_before_the_event_title' ) ?>
		<h2 class="tribe-events-list-event-title summary">
			<a class="url" href="<?php echo tribe_get_event_link() ?>" title="<?php the_title() ?>" rel="bookmark">
				<?php the_title() ?>
			</a>
		</h2>
		<?php do_action( 'tribe_events_after_the_event_title' ) ?>
		
		<?php if ( tribe_has_venue() ) { ?> 
			<p class="venue"><span class="label">Location: </span><?php echo tribe_get_meta('tribe_event_venue_name'); ?></p>
		<?php } ?> 
		
		<ul class="categories">
			<li class="label">categories:</li>
			<?php echo $event_taxonomy; ?>
		</ul>
		
		<div id="frame">
		<?php echo tribe_event_featured_image( null, 'medium' ) ?>
			<?php the_excerpt(); ?>
			<div class="text-center">
				<a href="<?php echo tribe_get_event_link() ?>" class="button tribe-events-read-more" rel="bookmark"><?php _e( 'more info', 'tribe-events-calendar' ) ?></a>
			</div>
		</div>
<!-- END MY TEMPLATE -->

