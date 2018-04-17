<?php get_header(); ?>

<div id="content">

	<section class="wrap clearfix">

		<div id="main" class="two-equal-columns clearfix" role="main">


			<div class="column">
        <?php if( have_rows('newsletter', 'option') ) : ?>
      	  <div id="newsletters" class="list-of-items">
            <h2 class="h3 underline">Monthly Newsletters</h4>
            <ul>

            <?php while( have_rows('newsletter', 'option') ) : the_row();

               $title = get_sub_field('title');
               $url = get_sub_field('url');
               $extra_info = get_sub_field('extra_info'); ?>

              <li>
                <a href="<?php echo $url; ?>" target="_blank"><h2 class="h4"><?php echo $title; ?></h2></a>
                <span class="extra-info"><?php echo $extra_info; ?>
              </li>

            <?php endwhile; ?>

            </ul>

        	</div>

        <?php endif; ?>
        </div>


        <div class="column">
          <?php if( have_rows('banking', 'option') ) : ?>
        	  <div id="newsletters" class="list-of-items">
              <h2 class="h3 underline">Banking on the Bayou Newsletters</h4>
              <ul>

              <?php while( have_rows('banking', 'option') ) : the_row();

                 $title = get_sub_field('title');
                 $url = get_sub_field('url');
                 $extra_info = get_sub_field('extra_info'); ?>

                <li>
                  <a href="<?php echo $url; ?>" target="_blank"><h2 class="h4"><?php echo $title; ?></h2></a>
                  <span class="extra-info"><?php echo $extra_info; ?>
                </li>

              <?php endwhile; ?>

              </ul>

          	</div>

          <?php endif; ?>
          </div>

		</div>

		<div class="text-center"><a class="button green" href="<?php echo esc_url( get_permalink( get_page_by_title( 'News' ) ) ); ?>">Back to News</a></div>

  </section>

</div>

<?php get_footer(); ?>
