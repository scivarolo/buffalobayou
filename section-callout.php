<?php $background_image = get_field('background_image'); ?>

<?php if( $background_image ) : ?>

<section data-type="parallax" data-speed=".75" style="background-image: url(<?php echo $background_image['sizes']['large']; ?>);">
	<?php if( get_field('callout_text') ) : ?>
	  <div class="navy">
		  <div class="wrap text-center">
		      <?php if( is_singular('destination') ) : ?>
          <h1><?php the_title(); ?></h1>
  		      
  		    <?php endif; ?>
    				<p id="mission" class="main-callout"><?php the_field('callout_text'); ?></p>
  		</div>
  	</div>
  <?php else : ?><div><br><br><br><br><br><br><br><br><br></div><?php endif; ?>
</section>

<?php endif; ?>