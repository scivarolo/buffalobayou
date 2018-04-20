<?php get_header(); ?>

<?php $background_image = get_field('blog_header_image', 'option'); ?>

<?php if( $background_image ) : ?>

<section data-type="parallax" data-speed=".75" style="background-image: url(<?php echo $background_image['sizes']['large']; ?>);">
  <?php if( get_field('blog_heading', 'option') ) : ?>
    <div class="navy">
      <div class="wrap text-center">
        <h1><?php the_field('blog_heading', 'option'); ?></h1>
        <?php if(get_field('blog_header_callout', 'option') ) : ?>
        <p id="mission" class="main-callout"><?php the_field('blog_header_callout', 'option'); ?></p>
        <?php endif; ?>
      </div>
    </div>
  <?php else : ?><div><br><br><br><br><br><br></div><?php endif; ?>
</section>

<?php endif; ?>

<div id="content">

	<section class="wrap clearfix">

		<div id="main" class="has-sidebar right-sidebar clearfix" role="main">
      <div class="main-column">
				<?php if (is_category()) { ?>
					<h1 class="archive-title h2">
						<span><?php _e( 'Posts Categorized:', 'bonestheme' ); ?></span> <?php single_cat_title(); ?>
					</h1>

				<?php } elseif (is_tag()) { ?>
					<h1 class="archive-title h2">
						<span><?php _e( 'Posts Tagged:', 'bonestheme' ); ?></span> <?php single_tag_title(); ?>
					</h1>

        <?php } elseif (is_tax('blog-tag')) { ?>
          <h1 class="archive-title h2">
            <span><?php _e( 'Posts Tagged:', 'bonestheme' ); ?></span> <?php single_term_title(); ?>
          </h1>

        <?php } elseif (is_tax('blog-category')) { ?>
          <h1 class="archive-title h2">
            <span><?php _e( 'Posts Categorized:', 'bonestheme' ); ?></span> <?php single_term_title(); ?>
          </h1>

				<?php } elseif (is_author()) {
					global $post;
					$author_id = $post->post_author;
				?>
					<h1 class="archive-title h2">

						<span><?php _e( 'Posts By:', 'bonestheme' ); ?></span> <?php the_author_meta('display_name', $author_id); ?>

					</h1>
				<?php } elseif (is_day()) { ?>
					<h1 class="archive-title h2">
						<span><?php _e( 'Daily Archives:', 'bonestheme' ); ?></span> <?php the_time('l, F j, Y'); ?>
					</h1>

				<?php } elseif (is_month()) { ?>
						<h1 class="archive-title h2">
							<span><?php _e( 'Monthly Archives:', 'bonestheme' ); ?></span> <?php the_time('F Y'); ?>
						</h1>

				<?php } elseif (is_year()) { ?>
						<h1 class="archive-title h2">
							<span><?php _e( 'Yearly Archives:', 'bonestheme' ); ?></span> <?php the_time('Y'); ?>
						</h1>
				<?php } ?>

				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class( 'clearfix' ); ?> role="article">

					<header class="article-header clearfix">
            <div class="event-date">
              <span class="month"><?php the_time('M'); ?></span>
              <span class="day"><?php the_time('d'); ?></span>
            </div>
						<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
					</header>

					<section class="entry-content clearfix">

						<?php the_post_thumbnail( 'bones-thumb-300' ); ?>

						<?php the_excerpt(); ?>

					</section>

				</article>

				<?php endwhile; ?>

						<?php if ( function_exists( 'bones_page_navi' ) ) { ?>
							<?php bones_page_navi(); ?>
						<?php } else { ?>
							<nav class="wp-prev-next">
								<ul class="clearfix">
									<li class="prev-link"><?php next_posts_link( __( '&laquo; Older Entries', 'bonestheme' )) ?></li>
									<li class="next-link"><?php previous_posts_link( __( 'Newer Entries &raquo;', 'bonestheme' )) ?></li>
								</ul>
							</nav>
						<?php } ?>

				<?php else : ?>

						<article id="post-not-found" class="hentry clearfix">
							<header class="article-header">
								<h1><?php _e( 'Oops, Post Not Found!', 'bonestheme' ); ?></h1>
							</header>
							<section class="entry-content">
								<p><?php _e( 'Uh Oh. Something is missing. Try double checking things.', 'bonestheme' ); ?></p>
							</section>
							<footer class="article-footer">
									<p><?php _e( 'This is the error message in the archive.php template.', 'bonestheme' ); ?></p>
							</footer>
						</article>

				<?php endif; ?>

			</div>


			<?php get_template_part('section', 'blog-sidebar'); ?>

					</section>

</div>

<?php get_footer(); ?>
