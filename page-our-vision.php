<?php get_header(); ?>

<?php $timeline_heading = get_field('timeline_heading'); 
      $awards_heading = get_field('awards_heading'); ?>



<nav role="navigation" class="sub-nav single-page">
	
	<ul class="sub-nav">
	 <?php if (have_rows('our_vision_section')): ?>
			<?php while ( have_rows( 'our_vision_section' ) ) : the_row(); ?>
			<?php /* load the destination */ 
				$heading = get_sub_field('section_heading'); ?> 
				
						<li><a href="#<?php echo sanitize_title_with_dashes($heading); ?>"><?php echo $heading; ?></a></li>	
			<?php endwhile;	endif; ?>
    <?php if ( $timeline_heading ) : ?>
      <li><a href="#<?php echo sanitize_title_with_dashes($timeline_heading); ?>"><?php echo $timeline_heading; ?></a></li>
    <?php endif; ?>
    <?php if ( $awards_heading ) : ?>
      <li><a href="#<?php echo sanitize_title_with_dashes($awards_heading); ?>"><?php echo $awards_heading; ?></a></li>
    <?php endif; ?>
	</ul>
</nav>


<?php get_template_part('section', 'callout'); ?>
	
<div id="content">	
	<section class="section">
  	<section class="wrap">
  	<h1 class="underline"><?php the_title(); ?></h1>
  	
  	<?php $callout = get_field('callout');
  	$introduction = get_field('introduction');
  	$master_plan_button_text = get_field('master_plan_button_text'); 
    $master_plan_button_url = get_field('master_plan_button_url'); ?>
    
  	<?php if ( $callout ) : ?>
  		<p class="callout"><?php echo $callout; ?></p>
  	<?php endif; ?>
  	<?php if ( $introduction ) : ?>
  		<p><?php echo $introduction; ?></p>
    <?php endif; ?>
  	<?php if ( $master_plan_button_text && $master_plan_button_url ) : ?>
  	  <div class="text-center">
        <a class="button aqua" target="_blank" href="<?php echo $master_plan_button_url; ?>"><?php echo $master_plan_button_text; ?></a>		
  	  </div>
  	<?php endif; ?>
  	</section>
	</section>
	
	<?php
	
		if ( have_rows( 'our_vision_section' ) ) : while ( have_rows( 'our_vision_section' ) ) : the_row(); ?>
			
			<?php //variables for our_vision_section
				$section_heading = get_sub_field('section_heading');
				$section_text = get_sub_field('section_text');
				$listing = get_sub_field('listing'); ?>
		
		<section class="section" id="<?php echo sanitize_title_with_dashes($section_heading); ?>">
		  <section class="wrap frame clearfix">
			
			<h1 class="underline"><?php echo $section_heading; ?></h1>
			<?php if ($section_text) : echo $section_text; endif; ?> 
			
			<?php if ( have_rows( 'listing' ) ) : ?>
				
				<ul class="features-list">
					
					<?php while ( have_rows( 'listing' ) ) : the_row(); ?>
						
						<li class="feature clearfix">
							<?php //variables for listing
							$title = get_sub_field('title');
							$blurb = get_sub_field('blurb');
							$image = get_sub_field('image');
							$link_type = get_sub_field('link_type');
							$button_text = get_sub_field('button_text');
							$internal_link = get_sub_field('internal_link');
							$external_link = get_sub_field('external_link');
							$no_link = get_sub_field('no_link');
							
							
							
							?>
							<?php if ( $image ) : ?>
							  <img src="<?php echo $image['sizes']['thumbnail']; ?>" alt="<?php echo $image['alt']; ?>" />
							<?php endif; ?>
							<div class="feature-content <?php if ( !$image ) : ?>no-image<?php endif; ?>">
								
									
									<?php if ( $link_type == "internal" ) : ?>
										
										<h3><a href="<?php echo $internal_link; ?>"><?php echo $title;?></a></h3>
										<p><?php echo $blurb; ?></p>
										<a class="button aqua" href="<?php echo $internal_link; ?>"><?php echo $button_text; ?></a>
										
									<?php elseif ( $link_type == "external" ) : ?>
									
										<h3><a href="<?php echo $external_link; ?>" target="_blank"><?php echo $title;?></a></h3>
										<p><?php echo $blurb; ?></p>
										<a class="button aqua" href="<?php echo $external_link; ?>"><?php echo $button_text; ?></a>
										
									<?php elseif ( $link_type == "no_link" ) : ?>
									
										<h3><?php echo $title; ?></h3>
										<p><?php echo $blurb; ?></p>
																			
									<?php endif; //test for link_type ?>
									
							</div>
						</li>
				
				<?php endwhile; //end of listing row ?>				
				</ul> <?php endif; //end of $listing ?>
				
			
		</section>
		</section>
		
		<?php endwhile; endif; //end of our_vision_section ?>


<section class="section">
<section class="wrap clearfix" id="<?php echo sanitize_title_with_dashes( $timeline_heading ); ?>">
	
	<h1 class="underline"><?php echo $timeline_heading; ?></h1>
	<?php if( have_rows('year') ) : ?>
	
		<ul class="timeline">

			
			<?php while( have_rows( 'year' ) ) : the_row(); ?>
				
				<?php $year = get_sub_field('year_text'); //the actual year text ?>
				
				<li>
					<time class="timeline-time"><?php echo $year; ?></time>
					<div class="group">
						<div class="year">
							<?php if ( have_rows('accomplishment') ) : 
							while ( have_rows ('accomplishment') ) : the_row(); 
								//variables
								$text = get_sub_field('text');
								$link_to_page = get_sub_field('link_to_page');
								$page_link = get_sub_field('page_link');
								$button_text = get_sub_field('button_text');
								 ?>
								<span class="bullet"></span>
								<div class="box">
								<?php if ($link_to_page) : ?>
								  <p>
  									<a href="<?php echo $page_link; ?>">
  									  <?php echo $text; ?>
                    </a>
                  </p>
                  <?php else : ?>
                  <p><?php echo $text; ?></p>
                  
                  <?php endif; ?>
								</div>
								
								
								<?php endwhile; else : endif; //end of single accomplishment ?>
						</div>
					</div>
				</li>
				
			<?php endwhile;?> 
			</ul>
			<?php else : endif; //end year group ?>
</section>
</section>

<section class="section">
<section class="wrap clearfix" id="awards">
	
	<h1 class="underline"><?php the_field('awards_heading'); ?></h1>
	<?php if( have_rows('awards_year') ) : ?>
	
		<ul class="timeline">

			
			<?php while( have_rows( 'awards_year' ) ) : the_row(); ?>
				
				<?php $year = get_sub_field('year_text'); //the actual year text ?>
				
				<li>
					<time class="timeline-time"><?php echo $year; ?></time>
					<div class="group">
						<div class="year">
							<?php if ( have_rows('award') ) : 
							while ( have_rows ('award') ) : the_row(); 
								//variables
								$award_title = get_sub_field('award_title');
								$awarder = get_sub_field('awarder');
								 ?>
								<span class="bullet"></span>
								<div class="box">
								  <span class="award-title"><?php echo $award_title; ?></span><span class="awarder">, <?php echo $awarder; ?></span></p>
								</div>
								
								
								<?php endwhile; else : endif; //end of single award ?>
						</div>
					</div>
				</li>
				
			<?php endwhile;?> 
			</ul>
			<?php else : endif; //end year group ?>
</section>
</section>
	
</div><!--#content-->


<?php get_footer(); ?>
