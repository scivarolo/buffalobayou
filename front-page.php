<?php get_header(); ?>

<!-- Homepage Carousel -->

<div id="home-owl-carousel" class="owl-carousel">
	
	<?php $images = get_field('home_page_slideshow');
					if($images):
					foreach($images as $image) : ?>
          <div class="item">
					<a href="<?php echo $image['alt']; ?>" target="_blank" style="background-image: url(<?php echo $image['sizes']['home-slider']; ?>);">
						<?php if($image['caption']) : ?>
						<div class="caption">
							<span><?php echo $image['caption']; ?></span>
						</div>
						<?php endif; ?>
					</a>
          </div>
				
				<?php endforeach; ?>
				<?php endif; ?>
</div>
<div class="owl-navigation">
		<i class="icon-arrow-left prev"></i>
		<i class="icon-arrow-right next"></i>
	</div>

<div id="content">
	
	<?php if( have_rows('home_page_alerts') ) : ?>
  	<section id="alerts" class="wrap frame">
      <?php while( have_rows('home_page_alerts') ) : the_row(); ?>
        <div class="bbp-alert <?php the_sub_field('alert_color'); ?>">
          <span class="bbp-alert-title"><?php the_sub_field('alert_title'); ?></span>
          <span class="bbp-alert-text"><?php the_sub_field('alert_text'); ?></span>
        </div>      
      <?php endwhile; ?>
  	</section>
	<?php endif; ?>
	
	<section id="upcoming-events" class="wrap frame">
	  <header class="section-header">
	    <h1><?php the_field('events_heading'); ?></h1>
	  </header>
	  
	  <div class="events">
	  
	  <?php 
	  
	  $selected_events = get_field('featured_events');
	  
	  if (empty($selected_events)) {
  	  $selected_count = 0;
  	  $selected_events = array(); 
	  } else {
	  
  	  $selected_count = count($selected_events); 
    
    }
    
    if ( $selected_count !== 3 ) {
    
      $need_this_many = 3 - $selected_count;
      
      $get_extra_events_args = array(
				'posts_per_page'=>$need_this_many,
			  'post__not_in'=>$selected_events,
			  //order by startdate from newest to oldest
			  'meta_key'=>'_EventStartDate',
			  'orderby'=>'_EventStartDate',
			  'order'=>'ASC',
			  //required in 3.x
			  'eventDisplay'=>'list'
			); 
		
			$extra_events = tribe_get_events( $get_extra_events_args );
			$extra_events_ids = wp_list_pluck( $extra_events, 'ID' );
			
			$these_events_please = array_merge( $selected_events, $extra_events_ids );
			
			} else {
			  $these_events_please = $selected_events;
			  } 
        ?>
			
			<?php 
			$wp_events_query_args = array(
				'post__in' => $these_events_please,
				'orderby' => '_EventStartDate',
				'order'=> 'ASC',
				'post_type'=> array(Tribe__Events__Main::POSTTYPE),
				'eventDisplay' => 'custom'
			);
			
			$get_posts = null; 
			$get_posts = new WP_Query($wp_events_query_args); //combined query			
		
      if($get_posts->have_posts()) : while($get_posts->have_posts()) : $get_posts->the_post(); ?>
		
    		<?php $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'medium' );
          $image_url = $thumb['0']; ?>
      
		
    		<div class="home-event bit-3" >
    			<div class="event-image" <?php if($image_url) : ?> style="background-image: url('<?php echo $image_url; ?>');" <?php endif; ?>> <!-- Might create an image size that is 600X450 -->
    				<div class="date">
    					<span class="month"><?php echo tribe_get_start_date( $event = null, $displayTime = false, $dateFormat = 'M' ); ?></span><br>
    					<span class="day"><?php echo tribe_get_start_date( $event = null, $displayTime = false, $dateFormat = 'd' ); ?></span>				
    				</div>
    			</div>
    			<div class="home-event-info">
    				<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
    				<?php the_excerpt(); ?> <!-- was the_field('excerpt'); -->
    				<div class="text-center"><a class="button clear" href="<?php the_permalink(); ?>">more info</a></div>
    			</div>
    		</div>
	   
	 	<?php endwhile; endif;
	  wp_reset_query();	?>
	  
		</div>
		
		<div class="text-center">
  		<a class="button green" href="<?php echo get_page_link(78); ?>">ALL EVENTS</a>
		</div>
		
	</section><!--#upcoming-events-->		
		
			
	
	<div class="frame">
		<section id="home-calendar" class="wrap bit-33">
			<!-- This Displays The Events Calendar Pro Calendar Widget on the Home Page -->
			<?php the_widget('Tribe__Events__Pro__Mini_Calendar_Widget', array('title' => __('Calendar'), 'count' => 2)); ?>
		</section><!--#home-calendar-->
	
	
		<section id="home-news" class="wrap bit-66">
			<header class="section-header">
				<h1>Recent News</h1><!-- make editable -->
			</header>
			
			<?php // WP_Query arguments
				$args = array (
					'posts_per_page'         => '5'
				);
				
				// The Query
				$news = new WP_Query( $args );
				
				// The Loop
				if ( $news->have_posts() ) : while ( $news->have_posts() ) : $news->the_post(); ?> 
						
					<div class="home-news-item">
						<span class="date"><?php the_time(get_option('date_format')); ?></span>
						<h3 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
					</div>
						
					<?php endwhile; else : ?> There is no news right now. <?php endif; ?>
					
				<?php				
				// Restore original Post Data
				wp_reset_postdata(); ?>
				
				<div class="text-right">
					<a class="button green" href="<?php echo esc_url( get_permalink( get_page_by_title( 'News' ) ) ); ?>">All News</a>
				</div>

		</section><!-- #home-news -->
	</div><!-- Calendar/News Frame -->
	
	
	<section id="home-destinations" class="wrap">
		<header class="section-header">
			<h1>Destinations</h1> <!-- Make this Editable -->
		</header>
		
		<?php $destinations = get_field('featured_destinations'); 
			
			if( $destinations ) : ?>
				
				<ul>
					<?php foreach( $destinations as $post ) : 
						setup_postdata($post); 
						$image = get_field('image_thumbnail');
						$permalink = get_permalink(); ?>
						
						<?php if(get_post_type() == "destination_feature"): ?>
						  <?php $slug = get_the_slug(); ?>
						  
						  <?php 
						  /* Querying for the destination that a feature is attached to, then building the url for a feature using that. */  
						  $feature_parents = get_posts(array(
						    'post_type' => 'destination',
						    'meta_query' => array(
						      array(
						        'key' => 'features',
						        'value' => '"' . get_the_ID() . '"',
						        'compare' => 'LIKE'
						        )
						      )
						      )); 
						  
                  foreach($feature_parents as $feature_parent) :
                    if( get_post_type($feature_parent->ID) == 'destination' ) : 
                      $feature_parent_link = get_permalink($feature_parent->ID);
                      
                    endif;
                  endforeach;
                
               $permalink = $feature_parent_link . "#" . $slug; ?>
						 <?php endif; ?>
             
						
					<li style="background-image: url(<?php echo $image['sizes']['home-destination'];?>);"> 
					
						<div><a href="<?php echo $permalink; ?>"><span><?php the_title(); ?></span></a></div>
					</li>
					
					<?php endforeach; ?>
				</ul>
				
				<?php endif; wp_reset_postdata(); ?>
				
				<div class="text-center">
					<a class="button green" href="">All Destinations</a>
				</div>
	</section>
	
	<?php $boat_tours_image = get_field('boat_tours_image'); ?>
	
	<div id="home-boattours" class="parallax-section" data-type="parallax" data-speed=".8" style="background-image: url(<?php echo $boat_tours_image['sizes']['large']; ?>);">
		<div class="navy">
			<div class="wrap text-center clearfix">
				<header>
					<h1><?php the_field('boat_heading'); ?></h1>
				</header>
				<article>
					<p class="callout"><?php the_field('boat_callout'); ?></p>
					
						<?php	$args = array(
						  'post_status'=>'publish',
						  'post_type'=>array(Tribe__Events__Main::POSTTYPE),
						  'posts_per_page'=>1,
						  //order by startdate from newest to oldest
						  'meta_key'=>'_EventStartDate',
						  'orderby'=>'_EventStartDate',
						  'order'=>'ASC',
						  //required in 3.x
						  'eventDisplay'=>'list',
						  //query events by category
						  'tax_query' => array(
						      array(
						          'taxonomy' => 'tribe_events_cat',
						          'field' => 'slug',
						          'terms' => 'boat-tours',
						          'operator' => 'IN'
						      ),
						  )
						);
						$get_posts = null;
						$get_posts = new WP_Query($args); 
						
						if($get_posts->have_posts()) : while($get_posts->have_posts()) : $get_posts->the_post(); ?>
					
						<p>A <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a> is coming up on <?php echo tribe_get_start_date( $event = null, $displayTime = false, $dateFormat = 'l, F j' ); ?></p>
						
						<?php endwhile; endif; wp_reset_query(); ?>
					<div class="text-center">
						<a class="button clear green xlarge" href="<?php the_field('boat_link'); ?>"><?php the_field('boat_link_text'); ?></a>
					</div>
				</article>
			</div>
		</div>
	</div>
	
	
	
	<?php if( get_field( 'extra_section_toggle' ) ) : //begin extra section ?>
	
	<?php $section_color = get_field('extra_section_color'); ?>
	
	<section id="extra-section" class="<?php echo $section_color; ?>-section">
		<div class="wrap text-center">
			<header>
				<h2><?php the_field('extra_section_heading'); ?></h2>
			</header>
			<article>
				<div class="callout"><?php the_field('extra_section_text'); ?></div>
				<div class="text-center">
          <a class="button clear xlarge" href="<?php the_field('extra_section_link'); ?>"><?php the_field('extra_section_link_text'); ?></a>
				</div>
			</article>
		</div>
	</section>
	<?php endif; //extra section ?>	
		
</div><!-- #content -->


<?php get_footer(); ?>
