<?php

/**
 *
 * Please see single-event.php in this directory for detailed instructions on how to use and modify these templates.
 *
 */

?>

<script type="text/html" id="tribe_tmpl_tooltip">

	<div id="tribe-events-tooltip-[[=eventId]]" class="tribe-events-tooltip">
		
		[[ if(imageTooltipSrc.length) { ]]
			
				<img src="[[=thumbUrl]]" alt="[[=title]]" class="clearfix" />
			
			[[ } ]]
		
		<div class="event-date">
		 <span class="month">
				[[=month]]
			</span>
			<span class="day">
				[[=day]]
			</span>
		</div>
		
		
		<h3 class="entry-title summary">[[=title]]</h3>
		<div class="tribe-events-event-body">
			<div class="duration">
				<abbr class="tribe-events-abbr updated published dtstart">[[=startTime]] </abbr>
				[[ if(endTime.length) { ]]
				-<abbr class="tribe-events-abbr dtend"> [[=endTime]]</abbr>
				[[ } ]]
			</div>

			[[ if(excerpt.length) { ]]
			<p class="entry-summary description">[[=raw excerpt]]</p>
			[[ } ]]
			<span class="tribe-events-arrow"></span>
		</div>
	</div>
</script>