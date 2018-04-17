<?php 

/*
Template Name: Event Categories
*/

get_header(); ?>

<?php get_template_part('section', 'callout'); ?>

<div id="content">

<?php 

	if( have_rows('event_section') ) :
		while( have_rows('event_section') ) : the_row(); 
		
			//variables
			
			$section_heading = get_sub_field('section_heading');
			$event_details = get_sub_field('event_details');
			$event_category = get_sub_field('event_category');
			$event_slug = get_term($event_category, 'tribe_events_cat')->slug;
			//var_dump($event_slug);
			?>
			<section class="wrap event-category" id="<?php echo $event_slug; ?>">
				<header class="section-header">
					<h1><?php echo $section_heading; ?></h1>
				</header>
				<div class="has-sidebar right-sidebar clearfix">
    			<div class="main-column">	
    				<?php echo $event_details; ?>
    			</div>
    			
    			<div class="sidebar-column">
    				
    				<h4><?php the_sub_field('dates_heading'); ?></h4>
    				<?php if( get_sub_field( 'show_dates' ) ) : ?>
      				
      				<ul class="list-of-dates">     				
      					<?php
      					$args = array (
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
      						<?php else : ?><p>Sorry, there are currently no upcoming events of this type. Check back soon!</p>
      						
      						<?php endif; ?>
      					
      					</ul>
      					<?php wp_reset_query(); ?>
                
              <?php endif; /*show dates*/ ?>
              
              <?php if( get_sub_field( 'dates_sidebar_text' ) ) : the_sub_field( 'dates_sidebar_text' ); endif; ?>

            </div>
  				</div>
        </section>

			<?php endwhile; ?>
			
			<?php else : ?> No rows
			
			<?php endif; ?> 

</div><!--content-->
<?php get_footer(); ?>
