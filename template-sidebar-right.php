<?php 
/*
Template Name: Sidebar Right
*/

get_header(); ?>

<?php get_template_part('section', 'callout'); ?>

<div id="content">
<section class="wrap">
	<div class="has-sidebar right-sidebar">
		<div class="main-column">
			<h1 class="underline"><?php the_title(); ?></h1>
			
			<?php get_template_part('section', 'main-content'); ?>
			
		</div>
		<div class="sidebar-column">
			
			<?php get_template_part('section', 'sidebar-content'); ?>
			
		</div>
	</div>
</section>
</div>

<?php get_footer(); ?>