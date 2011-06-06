			<?php include(dirname(__FILE__) . "/navigation.php"); ?>

			<?php while (have_posts()) : the_post(); ?>
				<article>
					<header>
						<h3><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h3>
						<div class="time"><?php the_time('Y. F d., l H:i') ?></div>
					</header>
					<section>
						<?php the_excerpt('More &raquo;'); ?>
						<p><a href="<?php the_permalink() ?>">Read the full story &raquo;</a></p>
					</section>
					<footer>
						Author: <?php the_author_posts_link(); ?> |
						<?php the_tags('Tags: ', ', ', ' | '); ?>
						<?php printf('Categories: %s', get_the_category_list(', ')); ?>
						<?php /* if (comments_open()) { echo(" | "); comments_popup_link('No comments yet &#187;', '1 comment &#187;', '% comments &#187;', '', '' ); } */ ?>
					</footer>
				</article>
			<?php endwhile; ?>

			<?php include(dirname(__FILE__) . "/navigation.php"); ?>
