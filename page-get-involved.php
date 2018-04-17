<?php get_header(); ?>

<?php get_template_part('section', 'callout'); ?>

<div id="content">

	<section class="intro wrap frame">
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			
			<div class="bit-33">
				<h1><?php the_title(); ?></h1>
			</div>
			<div class="bit-66">
				<?php the_content(); ?>
			</div>
		<?php endwhile; else: ?>
		<p><?php _e('sorry, no posts matched your criteria.'); ?></p>
		<?php endif; ?>
	</section>
	
	
	<section class="gray-section" id="volunteer-programs">
		<div class="wrap frame">
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
	</div>
	</section>
	
</div><!-- #content -->

<?php get_footer(); ?>

