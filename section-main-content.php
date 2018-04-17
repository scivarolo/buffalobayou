<?php //check if flexible content field has rows of data
	if( have_rows('main_content_area') ) :
		while ( have_rows('main_content_area') ) : the_row();
			
			//heading
			if( get_row_layout() == 'heading') : ?>
			
				<h3 class="underline"><?php the_sub_field('text'); ?></h3>
			
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
			  
			  if ( have_rows('button_options') ) : ?>
			    <div class="text-center">
			    <?php while ( have_rows('button_options') ) : the_row();
			
    				$button_text = get_sub_field('button_text');
    				$button_color = get_sub_field('button_color');
    				$link_type = get_sub_field('link_type');
				
    				if( $link_type == 'internal' ) : 
    					$url = get_sub_field('page_link');				
    				elseif( $link_type == 'external' ) :
    					$url = get_sub_field('url');				
    				endif; ?>
				
    				
    					<a class="button <?php echo $button_color; ?>" href="<?php echo $url; ?>"><?php echo $button_text; ?></a>
    				
    				
    				
				<?php endwhile; ?>
			    </div>
				<?php endif; ?> 
	
      <?php elseif( get_row_layout() == 'events' ) :
      
        $events_heading = get_sub_field('events_heading');
        $cat_or_custom = get_sub_field('category_or_custom_selection');
        
        if( $events_heading ) { ?>
          <h3 class="underline"><?php echo $events_heading; ?></h3>
        <?php } ?>
        
        <?php if( $cat_or_custom == 'category') : ?>
        
          <?php $event_categories = get_sub_field('choose_an_event_category'); ?>
          
          <ul class="event-list clearfix">				
					<?php $args = array (
						'post_status' => 'publish',
						'post_type' => array(Tribe__Events__Main::POSTTYPE),
						'posts_per_page' => -1,
						'meta_key' => '_EventStartDate',
						'orderby' => '_EventStartDate',
						'order' => 'ASC',
						'eventDisplay' => 'list',
						'tax_query' => array(
							array(
								'taxonomy' => 'tribe_events_cat',
								'field' => 'id',
								'terms' => $event_categories,
								'operator' => 'IN'
								),
							)
						);
						$get_posts = null;
						$get_posts = new WP_Query($args);
					
						if( $get_posts->have_posts() ) : while( $get_posts->have_posts() ) : $get_posts->the_post(); ?>
					
            <?php $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large' );
                  $image_url = $thumb['0']; ?>
                  
							<li class="event">
            			<div class="event-image" <?php if($image_url) : ?> style="background-image: url('<?php echo $image_url; ?>');" <?php endif; ?>> <!-- Might create an image size that is 600X450 -->
            				<div class="date">
            					<span class="month"><?php echo tribe_get_start_date( $event = null, $displayTime = false, $dateFormat = 'M' ); ?></span><br>
            					<span class="day"><?php echo tribe_get_start_date( $event = null, $displayTime = false, $dateFormat = 'd' ); ?></span>				
            				</div>
            			</div>
            			<div class="event-info">
            				<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
            				<!--<?php the_excerpt(); ?>-->
            				<!-- <div class="text-center"><a class="button clear" href="<?php the_permalink(); ?>">more info</a></div> -->
            			</div>
              </li>
					
						<?php endwhile; ?>					
						<?php endif; ?>
					
					</ul>
					<?php wp_reset_query(); ?>
          
          
        
        <?php elseif( $cat_or_custom == 'custom') : ?>
        
          <?php $event_choices = get_sub_field('choose_events'); ?>
       
          <ul class="event-list clearfix">
	  
        	 	<?php 
        			$wp_events_query_args = array(
        				'post__in' => $event_choices,
        				'orderby' => '_EventStartDate',
        				'order'=> 'ASC',
        				'post_type'=> array(Tribe__Events__Main::POSTTYPE),
        				'eventDisplay' => 'custom'
        			);
        			
        			$get_posts = null; 
        			$get_posts = new WP_Query($wp_events_query_args); //combined query			
        		
              if($get_posts->have_posts()) : while($get_posts->have_posts()) : $get_posts->the_post(); ?>
        		
            		<?php $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large' );
                  $image_url = $thumb['0']; ?>
              
        		
            		<li class="event" >
            			<div class="event-image" <?php if($image_url) : ?> style="background-image: url('<?php echo $image_url; ?>');" <?php endif; ?>> <!-- Might create an image size that is 600X450 -->
            				<div class="date">
            					<span class="month"><?php echo tribe_get_start_date( $event = null, $displayTime = false, $dateFormat = 'M' ); ?></span><br>
            					<span class="day"><?php echo tribe_get_start_date( $event = null, $displayTime = false, $dateFormat = 'd' ); ?></span>				
            				</div>
            			</div>
            			<div class="event-info">
            				<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
            				<!--<?php the_excerpt(); ?>-->
            				<!-- <div class="text-center"><a class="button clear" href="<?php the_permalink(); ?>">more info</a></div> -->
            			</div>
            		</li>
        	   
        	 	<?php endwhile; endif;
        	  wp_reset_query();	?>
        	  
        		</ul>

        
        
        
        
        
        <?php endif; /*cat_or_custom*/ ?>
        
 	
	
			<?php //callout
			
			elseif( get_row_layout() == 'callout' ) : ?>
				<p class="callout"><?php the_sub_field('text'); ?></p>
				<?php
			endif;
		endwhile;
		
	else : ?>

	<p>There is no content right now</p>

	<?php	endif;	?>
