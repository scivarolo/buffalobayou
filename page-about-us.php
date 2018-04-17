<?php get_header(); ?>

<nav role="navigation" class="sub-nav single-page">
	
	<ul class="sub-nav">
		<li><a href="#about">About Us</a></li>
		<li><a href="#board-and-staff">Staff</a></li>
		<li><a href="#board-and-staff">Board</a></li>	
		<?php if( have_rows('section') ) : ?>
		<?php while( have_rows('section') ) : the_row(); 
			$section_heading = get_sub_field('heading'); ?>
			<li><a href="#<?php echo sanitize_title_with_dashes($section_heading); ?>"><?php echo $section_heading; ?></a></li>
		<?php endwhile; endif; ?>
	</ul>
	
</nav>

<?php $mission_background = get_field('mission_background'); ?>



<section id="mission" data-type="parallax" data-speed="10" style="background-image: url(<?php echo $mission_background['sizes']['large']; ?>);">
	<div class="navy">
		<div class="wrap text-center">
				<p id="mission" class="main-callout"><?php the_field('mission'); ?></p>
		</div>
	</div>
</section>


<div id="content">
	<section id="about" class="gray-section">
		<div class="wrap header-left">
			<header>
				<img src="<?php echo get_template_directory_uri(); ?>/library/images/bbplogo.png" alt="BBP Logo">
				<!-- <h1><?php the_field('about_heading'); ?></h1> -->
      </header>
			<article>
				<?php the_field('about_text'); ?>
			</article>
		</div>
	</section>
	
	<section id="board-and-staff" class="section">
		<div class="wrap thirty-seventy">
			<div class="bit-33">
				<h2 class="underline"><?php the_field('staff_heading'); ?></h2>
				<?php if( have_rows('staff') ) : ?>
					<ul class="staff">
						<?php while( have_rows('staff') ) : the_row();
							//variables
							$name = get_sub_field('name');
							$position = get_sub_field('position');
							$email = get_sub_field('email');
							?>
						<li>
					
						<?php if( $email ) : ?>
					
							<a href="mailto:<?php echo $email; ?>"><?php echo $name; ?></a>
						
						
						<?php else : ?>
						
							<?php echo $name; ?>
						
						<?php endif; ?>
						
							<span class="position"><?php echo $position; ?></span>
						</li>
					
					<?php endwhile; ?>
					</ul>
				<?php endif; ?>
				
				<?php if( have_rows('staff_section') ) : ?>
				  
				<?php while( have_rows('staff_section') ) : the_row(); ?>
				  
				  <ul class="staff">
				    <li><h4><?php the_sub_field('sub_heading'); ?></h4></li>
            <?php if( have_rows('sub_staff') ) :
              while( have_rows('sub_staff') ) : the_row();
              
              //variables for sub_staff
              $name = get_sub_field('name');
  						$position = get_sub_field('position');
  						$email = get_sub_field('email');
  						?>
  						
  						<li>
				
      					<?php if( $email ) : ?>
				
      						<a href="mailto:<?php echo $email; ?>"><?php echo $name; ?></a>
					
					
      					<?php else : ?>
					
      						<?php echo $name; ?>
					
      					<?php endif; ?>
					
      						<span class="position"><?php echo $position; ?></span>
    					</li>
				
      				<?php endwhile; /* sub_staff */ ?>
    				<?php endif; /* sub_staff */ ?>
				
				
				  </ul>
				<?php endwhile; /* staff_section */ ?> 
				
				<?php endif; /* staff_section */ ?>
				
				
			</div>
			<div class="bit-66">
				<h2 class="underline"><?php the_field('board_heading'); ?></h2>
				<?php if( have_rows('board_section') ) : ?>
					<?php while( have_rows('board_section') ) : the_row(); ?>
						<div class="board-section">
							<h4><?php the_sub_field('heading'); ?></h4>
							<p><?php the_sub_field('list'); ?></p>
						</div>	
					<?php endwhile; endif; ?>
			</div>
			
		</div>
	</section>
	
	<?php if( have_rows('section') ) : ?>
		<?php while( have_rows('section') ) : the_row();

			$color = get_sub_field('color'); 
			$heading = get_sub_field('heading'); ?>
	
			<?php if( $color != 'white' ) : ?>

				<?php $class = $color . "-section"; ?>
				
			<?php else : ?>

				<?php $class = "section"; ?>

			<?php endif; ?>
			
			<section id="<?php echo sanitize_title_with_dashes($heading); ?>" class="<?php echo $class; ?>">
				<div class="wrap header-left clearfix">
					<header>
						<h1><?php echo $heading; ?></h1>
					</header>
					<article>
						<?php the_sub_field('text'); ?>
					</article>
				</div>
			</section>
			
		<?php endwhile; endif; ?> 
			
</div><!--#content-->
<?php get_footer(); ?>