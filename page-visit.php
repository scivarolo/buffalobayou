<?php get_header(); ?>


<?php /* get_template_part('section', 'callout'); */ ?>

<nav role="navigation" class="sub-nav single-page">
	
	<ul class="sub-nav">
		<li class="heading">Parks &amp; Destinations</li>
		<?php $page_link = get_permalink(); ?>
		<?php if (have_rows('visit_destination')): ?>
			<?php while ( have_rows( 'visit_destination' ) ) : the_row(); ?>
			<?php /* load the destination */ 
				$destination = get_sub_field('destination_selection'); 
				if( $destination ) : ?>
					<?php $post = $destination; 
					setup_postdata($post); ?>
						<li><a href="#<?php echo the_slug(); ?>"><?php the_title(); ?></a></li>									
					<?php wp_reset_postdata(); ?>
				<?php endif; /* if $destination */ ?> 
			<?php endwhile; 
		endif; ?>
		<li class="heading">Other</li>
		<?php if( have_rows('other_section') ) : 
			while( have_rows('other_section') ) : the_row(); 
				$heading = get_sub_field('heading'); ?>
				<li><a href="#<?php echo sanitize_title_with_dashes($heading); ?>"><?php echo $heading; ?></a></li>
			<?php endwhile;
		endif; ?>	
	</ul>
</nav>

<div id="map-canvas"></div>

<div id="content">

<div id="map-legend" class="wrap">
      <span class="label">LEGEND:</span>
      <span class="icon-map-park" title="Park"></span>
      <span class="icon-map-discgolf" title="Disc Golf"></span>
      <span class="icon-map-skate" title="Skatepark"></span>
      <span class="icon-map-tennis" title="Tennis Court"></span>
      <span class="icon-map-fitness" title="Fitness Area"></span>
      <span class="icon-map-boatlaunch" title="Boat Launch"></span>
      <span class="icon-map-recreation" title="Recreation"></span>
      <span class="icon-map-landmark" title="Landmark"></span>
      <span class="icon-map-art" title="Art"></span>
      <span class="icon-map-building" title="Building"></span>
      <span class="icon-map-cemetery" title="Cemetery"></span>
      <span class="icon-map-bridge" title="Bridge"></span>
      <span class="icon-map-stairs" title="Stair Access"></span>
      <span class="icon-map-parking" title="Parking"></span>
      <span class="icon-map-handicap" title="Handicap Access"></span>
      <span class="icon-map-bathroom" title="Bathroom"></span>
      <span class="icon-map-water" title="Drinking Fountain"></span>
      <span class="icon-map-future" title="Coming Soon"></span>
</div>

	<!-- Destination Begins here -->
	
	<?php if ( have_rows( 'visit_destination' ) ) : ?>
		
		<?php while ( have_rows( 'visit_destination' ) ) : the_row(); ?>
		
			
		
		
				<?php /* load the destination */ 
			$destination = get_sub_field('destination_selection'); 
			if( $destination ) : ?>
				
				<?php $post = $destination; 
				setup_postdata($post); ?>
					<?php $destination_url = get_permalink(); ?>
					<?php $location = get_field('location'); ?>
					
					<?php if ($location == 'west' ) {
						$location_text = "West of Downtown";
					} elseif ($location == 'downtown') { 
						$location_text = "Downtown";
					} elseif ($location == 'east') {
						$location_text = "East of Downtown"; 
					} else { 
  					$location_text = null;
					};
					?>
						
					<section <?php post_class('gray-section'); ?> id="<?php echo the_slug(); ?>">
						<div class="wrap">
						<header class="section-header">
							<span class="location"><?php echo $location_text; ?></span>
							<h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
								<?php $map = get_field('map_toggle');
									if ( $map ) : ?>
									  <?php $map_link = get_field('map_link'); ?>
									  
									  <div class="map">
  										<a class="button green">MAP</a>
  										<div class="google-map">
  										  <a href="//maps.google.com/maps?z=12&t=m&q=loc:<?php echo $map_link['lat']?>+<?php echo $map_link['lng']; ?>" target="_blank">
    											<img src="http://maps.google.com/maps/api/staticmap?zoom=14&markers=color:green|<?php echo $map_link['lat'];?>,<?php echo $map_link['lng']; ?>&size=300x300&sensor=false" alt="Map of <?php the_title(); ?>">
  										  </a>
  										</div>
									  </div>
								<?php endif; ?>
						</header>
						
						<div class="intro clearfix">
							<?php $image = get_field('image_thumbnail'); ?>
							<?php if($image) : ?>
							<div class="intro-image" style="background-image:url(<?php echo $image['sizes']['large']; ?>);"></div>
							<?php endif; /* $image */ ?>
							<div class="intro-text"><?php the_field('excerpt'); ?></div>
							<?php $amenities_object = get_field_object('amenities'); ?>
              <?php $amenities = get_field('amenities'); ?>
              <?php if ($amenities) : ?>
                <div class="amenities">
                <?php foreach ($amenities as $amenity) { ?>
                  <?php $label = $amenities_object['choices'][$amenity]; ?>
                
                  <span class="icon-map-<?php echo $amenity; ?>" title="<?php echo $label; ?>"></span>
                  
                <?php } ?>
                </div>
              <?php endif; ?>
						</div>		
						
						<?php wp_reset_postdata(); ?>
									
						<?php endif; /* if $destination */ ?> 
            <?php edit_post_link(__('Edit this section'), '<div class="text-center">', '</div>', $destination->ID ); ?>
						</div>
					</section>
			
			<?php /* Begin displaying this Destination's Featured Features */ 
				
				$features = get_sub_field('featured_features');
				
				if( $features ) : ?>
				<section class="wrap">
					<ul class="features-list">
					
					<?php foreach( $features as $ff ) : ?>
					
						<?php $image = get_field('image_thumbnail', $ff->ID); ?>
					
						<li class="feature clearfix">
						  <?php if( $image ) : ?>
							<img src="<?php echo $image['sizes']['thumbnail']; ?>" alt="<?php echo $image['alt']; ?>">
							<?php endif; /* image */ ?>
							<div class="feature-content <?php if ( !$image ) : ?>no-image<?php endif; ?>">
								<h3><a href="<?php echo $destination_url; ?>#<?php echo get_the_slug($ff->ID); ?>"><?php echo get_the_title($ff->ID); ?></a></h3>
								<?php the_field('excerpt', $ff->ID ); ?>
								<a class="aqua button" href="<?php echo $destination_url; ?>#<?php echo get_the_slug($ff->ID); ?>">more info</a>
							</div>
							
						</li>
					<?php endforeach; ?>

					</ul>
			</section>
			<?php endif; /* features */
			?>			
					
			<?php endwhile; /* while visit_destination */ endif; /* if visit_destination */ ?>
			
			<?php if( have_rows('other_section') ) :
				while( have_rows('other_section') ) : the_row();
					
					$color = get_sub_field('background_color');
					$heading = get_sub_field('heading'); ?>
						
					
					<?php if( $color != 'white' ) : ?>

						<?php $class = $color . "-section"; ?>
						
					<?php else : ?>
		
						<?php $class = "section"; ?>
		
					<?php endif; ?>

					<section id="<?php echo sanitize_title_with_dashes($heading); ?>" class="<?php echo $class; ?>">
						<div class="wrap header-left">
							<header>
								<h1><?php the_sub_field('heading'); ?></h1>
							</header>
							<article>
								<?php //check if flexible content field has rows of data
								if( have_rows('content') ) :
									while ( have_rows('content') ) : the_row();
										
										//heading
										if( get_row_layout() == 'heading') : ?>
										
											<h2 class="underline"><?php the_sub_field('text'); ?></h2>
										
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
										endif;
									endwhile;
									
								else : ?>
							
								<p>There is no content right now.</p>
							
								<?php	endif;	?>
							</article>
						</div>
					</section> 
				
				<?php endwhile; endif; ?>
			
</div><!-- #content -->



<?php get_footer();