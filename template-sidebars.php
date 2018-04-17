<?php 
/*
Template Name: Sidebars - Both
*/

get_header(); ?>

<?php get_template_part('section', 'callout'); ?>

<div id="content">
<section class="wrap">
	<div class="three-columns">
		<div class="main-column">
			<h1 class="underline"><?php the_title(); ?></h1>
			
			<?php get_template_part('section', 'main-content'); ?>
			
		</div>
		<div class="left-column">
			
			<?php get_template_part('section', 'sidebar-content'); ?>
			
		</div>
		<div class="right-column">
			
			<?php get_template_part('section', 'sidebar-content-2'); ?>
		</div>
	</div>
</section>
</div>

<?php get_footer(); ?>