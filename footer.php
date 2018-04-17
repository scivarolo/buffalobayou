<footer class="footer" role="contentinfo">

     <div class="text-center"><?php edit_post_link(__('Edit this Page')); ?></div> 
<?php if( is_front_page() && get_field('extra_section_toggle') ): /* don't show */ else : ?>
	<section id="get-involved" class="aqua-section">
		<div class="wrap text-center">
			<header>
				<h2><?php the_field('getinvolved_heading', 'option'); ?></h2>
			</header>
			<article>
				<p class="callout"><?php the_field('getinvolved_description', 'option'); ?></p>
				<div class="text-center">
					<?php if ( have_rows('getinvolved_button', 'option') ) :
							while ( have_rows('getinvolved_button', 'option' ) ) : the_row(); ?>
							
							<?php $link_type = get_sub_field('link_type');
										$label = get_sub_field('label');
										$internal_link = get_sub_field('internal_link');
										$external_link = get_sub_field('external_link'); ?>
							
							<?php if ( $link_type == "internal" ) : ?>
												
								<a class="button clear xlarge" href="<?php echo $internal_link; ?>"><?php echo $label; ?></a>
								
							<?php elseif ( $link_type == "external" ) : ?>
							
								<a class="button clear xlarge" href="<?php echo $external_link; ?>"><?php echo $label; ?></a>
							
							<?php endif; //test for link_type ?>
						<?php endwhile; endif; ?>
				</div>
			</article>
		</div>
	</section>

<?php endif; // !front_page ?>

	<section class="black-section">
		<div class="wrap">
			<div id="footer-mobile" class="one-third">
				<h3><?php the_field('apps_heading', 'option'); ?></h3>
				<p><?php the_field('apps_description', 'option'); ?></p>
				<div class="app-buttons">
				  <a href="https://itunes.apple.com/us/app/buffalo-bayou-guide/id674606052?mt=8" id="appstore" target="_blank">
				    <img src="<?php echo get_template_directory_uri(); ?>/library/images/appleappstore.svg">
				  </a>
				  <a href="https://play.google.com/store/apps/details?id=org.buffalobayou.guide" id="googleplay" target="_blank">
				    <img src="<?php echo get_template_directory_uri(); ?>/library/images/googleplay.png">
				  </a>
				</div>
      </div>
			<div id="footer-newsletter" class="one-third">
				<?php if( get_field('newsletter_heading', 'option' ) ) : ?>
				<h3><?php the_field('newsletter_heading', 'option' ); ?></h3>
				<?php endif; ?>
				<?php if( get_field('newsletter_signup', 'option' ) ) : ?>
				  <?php the_field('newsletter_signup', 'option' ); ?>
				<?php endif; ?>
			</div>
			<div id="footer-boutique" class="one-third">
			  <?php if( get_field('boutique_heading', 'option' ) ) : ?>
			  <h3><?php the_field('boutique_heading', 'option' ); ?></h3>
			  <?php endif; ?>
			  <?php if(get_field('boutique_description', 'option' ) ) : ?> 
			  <?php the_field('boutique_description', 'option' ); ?>
			  <?php endif; ?>
			  
			  
			  <div class="text-center">
					<?php if ( have_rows('boutique_button', 'option') ) :
							while ( have_rows('boutique_button', 'option' ) ) : the_row(); ?>
							
							<?php $link_type = get_sub_field('link_type');
										$label = get_sub_field('label');
										$internal_link = get_sub_field('internal_link');
										$external_link = get_sub_field('external_link'); ?>
							
							<?php if ( $link_type == "internal" ) : ?>
												
								<a class="button clear xlarge" href="<?php echo $internal_link; ?>"><?php echo $label; ?></a>
								
							<?php elseif ( $link_type == "external" ) : ?>
							
								<a class="button clear" href="<?php echo $external_link; ?>"><?php echo $label; ?></a>
							
							<?php endif; //test for link_type ?>
						<?php endwhile; endif; ?>
				</div>
			
			
			</div>
		</div>
	</section>
	<nav role="navigation" id="footer-menu">	
		<?php bones_footer_links(); ?>
	</nav>
	<section id="final-footer" class="clearfix">
		<div class="wrap">
			<section class="social-footer">
			  <?php $facebook = get_field('facebook', 'option');
			  $twitter = get_field('twitter', 'option'); 
			  $instagram = get_field('instagram', 'option');
			  $flickr = get_field('flickr', 'option');?>
			  
			  <?php if ( $facebook ) : ?>
			  
  				<a href="<?php echo $facebook; ?>" target="_blank"><i class="icon-facebook"></i></a>
				
				<?php endif; if ( $twitter ) : ?>
				
  				<a href="<?php echo $twitter; ?>" target="_blank"><i class="icon-twitter"></i></a>
				
				<?php endif; if ( $instagram ) : ?>
				
  				<a href="<?php echo $instagram; ?>" target="_blank"><i class="icon-instagram"></i></a>
				
				<?php endif; if ( $flickr ) : ?>
				
  				<a href="<?php echo $flickr; ?>" target="_blank"><i class="icon-flickr"></i></a>
				
				<?php endif; ?>
			</section>
			<section class="contact-info">
				<?php
					$footer_address = get_field('footer_address', 'option');
					$footer_telephone = get_field('footer_telephone', 'option');
					$footer_fax = get_field('footer_fax', 'option');
					$footer_email = get_field('footer_email', 'option');
				?>
				
				<p><?php echo $footer_address; ?></p>
				<p>t : <?php echo $footer_telephone; ?> &nbsp;&nbsp; f : <?php echo $footer_fax; ?><br /><a href="mailto:<?php echo $footer_email; ?>"><?php echo $footer_email; ?></a>
				</p>
			</section>
			<section class="footer-logo">
				<div id="footer-logo"></div>
				<p class="source-org copyright">&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>.<br> website by <a href="http://coredesignstudio.com" target="_blank">CORE Design Studio</a>. <?php wp_loginout(); ?> </p>
			</section>
		</div>
	</section>
</footer>
		<?php // all js scripts are loaded in library/bones.php ?>
		

<a href="#" class="back-to-top">Back to Top</a>
		<?php wp_footer(); ?>
	</body>

</html>
