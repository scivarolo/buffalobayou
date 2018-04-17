<?php //check if flexible content field has rows of data
	if( have_rows('sidebar_content_area') ) :
		while ( have_rows('sidebar_content_area') ) : the_row();
			
			//heading
			if( get_row_layout() == 'heading') : ?>
			
				<h4><?php the_sub_field('text'); ?></h4>
			
			<?php
			//text
			elseif( get_row_layout() == 'text' ) :
				
				the_sub_field('text');
				
			//image
			elseif( get_row_layout() == 'image' ) :
							
				$image = get_sub_field('image'); ?>
				
				<img src="<?php echo $image['sizes']['medium']; ?>" alt="<?php echo $image['alt']; ?>" class="aligncenter">
				
			<?php	
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

	<?php	endif;	?>