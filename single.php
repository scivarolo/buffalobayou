<?php get_header(); ?>

<?php $background_image = get_field('background_image', 'option'); ?>

<?php if( $background_image ) : ?>

<section data-type="parallax" data-speed=".75" style="background-image: url(<?php echo $background_image['sizes']['large']; ?>);">
	<?php if( get_field('callout_text', 'option') ) : ?>
	  <div class="navy">
		  <div class="wrap text-center">
		    <h1><?php echo apply_filters( 'the_title', get_the_title( get_option('page_for_posts') ) ); ?></h1>
				<p id="mission" class="main-callout"><?php the_field('callout_text', 'option'); ?></p>
  		</div>
  	</div>
  <?php else : ?><div><br><br><br><br><br><br></div><?php endif; ?>
</section>

<?php endif; ?>

			<div id="content">

				<section class="wrap clearfix">

					<div id="main" class="has-sidebar right-sidebar clearfix" role="main">
            <div class="main-column">
						<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

							<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">

								<header class="article-header clearfix">
                  <div class="event-date">
                    <span class="month"><?php the_time('M'); ?></span>
                    <span class="day"><?php the_time('d'); ?></span>
                  </div>
      						<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
      					</header>

								<section class="entry-content clearfix" itemprop="articleBody">
									<?php the_content(); ?>
								</section>

								<footer class="article-footer">
									<?php the_tags( '<p class="tags"><span class="tags-title">' . __( 'Tags:', 'bonestheme' ) . '</span> ', ', ', '</p>' ); ?>

								</footer>

							</article>

						<?php endwhile; ?>

						<?php else : ?>

							<article id="post-not-found" class="hentry clearfix">
									<header class="article-header">
										<h1><?php _e( 'Oops, Post Not Found!', 'bonestheme' ); ?></h1>
									</header>
									<section class="entry-content">
										<p><?php _e( 'Uh Oh. Something is missing. Try double checking things.', 'bonestheme' ); ?></p>
									</section>
									<footer class="article-footer">
											<p><?php _e( 'This is the error message in the single.php template.', 'bonestheme' ); ?></p>
									</footer>
							</article>

						<?php endif; ?>

					</div>

					<?php get_template_part('section', 'news-sidebar'); ?>

				</section>

			</div>

<?php get_footer(); ?>
