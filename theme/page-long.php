			<?php include(dirname(__FILE__) . "/navigation.php"); ?>

			<?php while (have_posts()) : the_post(); ?>
				<article>
					<header>
						<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permalink: <?php the_title_attribute(); ?>"><?php the_title(); 
?></a></h2>
						<!--div class="time"><?php the_time('Y. F d., l H:i') ?></div-->
					</header>
					<section>
						<?php the_content(); ?>
					</section>
					<footer>
						Author: <?php the_author_posts_link(); ?>
					</footer>
				</article>
			<?php endwhile; ?>

			<?php include(dirname(__FILE__) . "/navigation.php"); ?>
