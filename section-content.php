<?php //check if flexible content field has rows of data
	if( have_rows('flexible_content_area') ) :
		while ( have_rows('flexible_content_area') ) : the_row();
			
			//heading
			if( get_row_layout() == 'heading') : ?>
			
				<h4><?php the_sub_field('text'); ?></h4>
			
			<?php
			//text
			elseif( get_row_layout() == 'text' ) :
				
				the_sub_field('text');
				
			//image
			elseif( get_row_layout() == 'image' ) :
			
				//alignment full left right center
				
				$image = get_sub_field('image');
				$alignment = get_sub_field('alignment');
				
				if( $alignment == 'full' ) : ?>
					
					<img src="<?php echo $image['sizes']['800-wide']; ?>" alt="<?php echo $image['alt']; ?>" class="fullwidth">
				
				<?php elseif( $alignment == 'left' ) : ?>
					
					<img src="<?php echo $image['sizes']['medium']; ?>" alt="<?php echo $image['alt']; ?>" class="alignleft">
				
				<?php elseif( $alignment == 'right' ) : ?>
				
					<img src="<?php echo $image['sizes']['medium']; ?>" alt="<?php echo $image['alt']; ?>" class="alignright">
				
				<?php elseif( $alignment == 'center' ) : ?>
				
					<img src="<?php echo $image['sizes']['medium']; ?>" alt="<?php echo $image['alt']; ?>" class="aligncenter">
				
				<?php endif; 
				
			//button
			elseif( get_row_layout() == 'button' ) :
			
				$button_text = get_sub_field('button_text');
				$button_color = get_sub_field('button_color');
				$link_type = get_sub_field('link_type');
				
				if( $link_type == 'internal' ) : 
					$url = get_sub_field('page_link');				
				elseif( $link_type == 'external' ) :
					$url = get_sub_field('url');				
				endif; ?>
				
				<div class="text-center">
					<a class="button <?php echo $button_color; ?>" href="<?php echo $url; ?>"><?php echo $button_text; ?></a>
				</div>
				<?php
	
			//callout
			
			elseif( get_row_layout() == 'callout' ) : ?>
				<p class="callout"><?php the_sub_field('text'); ?></p>
				<?php
				
			// event listing
			
			elseif( get_row_layout() == 'event_listing' ) : 
		    
		    $event_listing_heading = get_sub_field('event_listing_heading');
        $event_listing_category = get_sub_field('event_listing_category'); 
        $number_of_events = get_sub_field('number_of_events_to_show');
        $event_slug = get_term($event_listing_category, 'tribe_events_cat')->slug;
        
        ?> <h4><?php echo $event_listing_heading; ?></h4>
        
        <ul>
					<!-- <li>Upcoming Tours:</li> -->
				
					<?php
					$args = array (
						'post_status' => 'publish',
						'post_type' => array(Tribe__Events__Main::POSTTYPE),
						'posts_per_page' => $number_of_events,
						'meta_key' => '_EventStartDate',
						'orderby' => '_EventStartDate',
						'order' => 'ASC',
						'eventDisplay' => 'list',
						'tax_query' => array(
							array(
								'taxonomy' => 'tribe_events_cat',
								'field' => 'slug',
								'terms' => $event_slug,
								'operator' => 'IN'
								),
							)
						);
						$get_posts = null;
						$get_posts = new WP_Query($args);
					
						if( $get_posts->have_posts() ) : while( $get_posts->have_posts() ) : $get_posts->the_post(); ?>
					
							<li>
								<a class="url" href="<?php echo tribe_get_event_link() ?>" title="<?php the_title() ?>" rel="bookmark">
									<?php echo tribe_get_start_date( $event = null, $displayTime = false, $dateFormat = 'F j' ); ?>
								</a>
							</li>
					
						<?php endwhile; ?>					
						<?php endif; ?>
					
					</ul>
					<?php wp_reset_query(); ?>
        
			  <?php
				
			endif;
		endwhile;
		
	else : ?>

	<p>There is no content right now</p>

	<?php	endif;	?>
