<?php get_header(); ?>

<?php get_template_part('section', 'callout'); ?>

<nav role="navigation" class="sub-nav single-page">
  
  <?php $page_link = get_permalink();
  $featuresSubnav = get_field('features_subnav');
  $features = get_field('features'); ?>
  
  <?php if( $features && $featuresSubnav ) : ?>
  
    <ul class="sub-nav">
<!--       <li class="heading">Test</li> -->
      
      <?php foreach($featuresSubnav as $f) : ?>
        <?php if (get_field('features_shorter_label', $f->ID)) : 
          $title = get_field('features_shorter_label', $f->ID);
          else : 
          $title = get_the_title($f->ID);
          endif;
        ?>
        <li><a href="#<?php echo get_the_slug( $f->ID );  ?>"><?php echo $title; ?></a></li>
      <?php endforeach; ?>
    </ul>
  <?php endif; //$features ?>

</nav>

<div id="content">
	
	<?php edit_post_link(__('Edit this page'), '<div class="text-center">', '</div>'); ?>
	
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
      <section class="section wrap">
	<?php the_content(); ?>
      </section>
	  <?php endwhile; endif; ?>
	<?php $features = get_field('features'); 
	
	if( $features ) : ?>
	
		<?php foreach($features as $f) : ?>
			
			  
			  <section class="section wrap single-feature">
			   <a name="<?php echo get_the_slug( $f->ID ); ?>" id="<?php echo get_the_slug( $f->ID ); ?>" class="anchor" ></a>
         <?php $image = get_field('image_thumbnail', $f->ID); ?>
  			  <?php if( $image ) : ?>
  			    <div class="feature-image">
    					<img src="<?php echo $image['sizes']['bones-thumb-300']; ?>" alt="<?php echo $image['alt']; ?>">
  			    </div>
					<?php endif; /* image */ ?>        
			    <article class="feature-content">
			     <header class="feature-title underline">
			      <h2><?php echo get_the_title( $f->ID ); ?></h2>
            <?php $map = get_field('map_toggle', $f->ID );
							if ( $map ) :	?>
							  <?php $map_link = get_field('map_link', $f->ID); ?>
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
  			    <?php echo apply_filters('the_content', get_post_field('post_content', $f->ID)); ?>
            
            <?php $amenities_object = get_field_object('amenities', $f->ID); ?>
              <?php $amenities = get_field('amenities', $f->ID); ?>
              <?php if ($amenities) : ?>
                <div class="amenities">
                <?php foreach ($amenities as $amenity) { ?>
                  <?php $label = $amenities_object['choices'][$amenity]; ?>
                
                  <span class="icon-map-<?php echo $amenity; ?>" title="<?php echo $label; ?>"></span>
                  
                <?php } ?>
                </div>
              <?php endif; ?>
					
					<?php $art_test = get_field( 'is_art', $f->ID ); ?>
					<?php if( $art_test ) : ?>
			    		    
						<?php $arts = get_field( 'art_selection', $f->ID ); ?>

						<?php if( $arts ) : ?>
						
							<ul class="sub-features">								
						
								<?php foreach($arts as $art) : ?>
								
									<li class="sub-feature clearfix">
  									<a name="<?php echo get_the_slug( $art->ID ); ?>" id="<?php echo get_the_slug( $art->ID ); ?>" class="anchor" ></a>					
										<?php $art_image = get_field( 'art_image', $art->ID ); ?>
                    <?php if( $art_image ) : ?>
  										<img class="sub-feature-image" src="<?php echo $art_image['sizes']['thumbnail']; ?>" alt="<?php echo $art_image['alt']; ?>">
                    <?php endif; /* $art_image */ ?> 
										<div class="sub-feature-content">
											<h3 class="h4"><?php echo get_the_title( $art->ID ); ?></h3>
											 <?php $map = get_field('map_toggle', $art->ID );
          							if ( $map ) :	?>
          							  <?php $map_link = get_field('map_link', $art->ID ); ?>
                          <div class="map">
                            <a class="button green">MAP</a>
              							<div class="google-map">
              								<a href="//maps.google.com/maps?z=12&t=m&q=loc:<?php echo $map_link['lat']?>+<?php echo $map_link['lng']; ?>" target="_blank">
                								<img src="http://maps.google.com/maps/api/staticmap?zoom=14&markers=color:green|<?php echo $map_link['lat'];?>,<?php echo $map_link['lng']; ?>&size=300x300&sensor=false" alt="Map of <?php the_title(); ?>">
              								</a>
              							</div>
                          </div>
            						<?php endif; ?>
                        
                        <?php $artist = get_field('artist', $art->ID);
                          $year = get_field('year', $art->ID); ?>
                        
                        <?php if ( !empty($artist) || !empty($year) ) : ?>                  						
                					<div class="art-info">	
                  					<span class="artist-name"><?php echo $artist; if ( !empty($artist) && !empty($year) ) { ?>, <?php } ?></span>
                  					
                  					<span class="art-year"><?php echo $year; ?></span>	
                					</div>	
                          
                        <?php endif; ?>


											<?php echo apply_filters('the_content', get_post_field('post_content', $art->ID)); ?>
											<?php edit_post_link(__('Edit this subfeature'), '<div class="text-right">', '</div>', $art->ID ); ?>
										</div>		
									</li>
						
									<?php endforeach; /* endforeach Art Post */ ?>
									
								</ul>
								
							<?php endif; /* endif Art $arts */ ?> 
              
            		
					 <?php endif; /* endif Art */ ?> 
			    
			    <?php edit_post_link(__('Edit this section'), '<div class="text-right">', '</div>', $f->ID ); ?>
					
			    
			    </article>
			  </section>
			  
		<?php endforeach; /* end foreach Features */ ?> 
			
	<?php endif; /* endif has Features */ ?> 
	
		<div class="text-center">
		<a class="button" href="<?php echo get_page_link(102); ?>">Back to All Destinations</a>
	</div>

</div><!--#content-->

<?php get_footer(); ?>
