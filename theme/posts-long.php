			<?php include(dirname(__FILE__) . "/navigation.php"); ?>

			<?php while (have_posts()) : the_post(); ?>
				<article>
<?php
$langs = jz_get_alternate_languages();
if (count($langs))
{
        $l = array();
        foreach ($langs as $lang => $data)
        {
                $l[] = "<a lang=\"" . htmlspecialchars($lang) . "\" hreflang=\"" . htmlspecialchars($lang) . "\" href=\"" . 
htmlspecialchars($data['link']) . "\">" . htmlspecialchars($data['text']) . "</a>";
        }
        ?>
        <nav class="langswitch"><p>Read this in a different language: <?php echo(implode(", ", $l)); ?></p></nav>
        <?php
}
?>
					<header>
						<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permalink: <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
						<div class="time"><?php the_time('Y. F d., l H:i') ?></div>
					</header>
					<section>
						<?php the_content(); ?>
<?php
	$related = jz_get_related_posts();
	if (count($related))
	{
?>
<section>
	<h3>Similar articles <span class="utils"><a class="permalink" href="#similar-articles" id="similar-articles" title="Permalink to this 
heading">#</a> <a href="#top" class="jumptop" title="Back to top">&uarr;</a></span></h3>
	<ul>
	<?php
		foreach ($related as $related_post)
		{
			echo('<li><a href="'.get_permalink($related_post->ID).'">'.wptexturize($related_post->post_title).'</a></li>');
		}
	?>
	</ul>
</section>
<?php
	}
?>
					</section>
					<footer>
						Author: <?php the_author_posts_link(); ?> |
						<?php the_tags('Tags: ', ', ', ' | '); ?>
						<?php printf('Categories: %s', get_the_category_list(', ')); ?>
						<?php /* if (comments_open()) { echo(" | "); comments_popup_link('No comments yet &#187;', '1 comment &#187;', '% comments &#187;', '', '' ); } */ ?>
						| Share: 
						<a href="http://www.facebook.com/sharer.php?u=<?php echo(htmlspecialchars(urlencode(get_permalink() . "?utm_source=facebook&utm_medium=social&utm_campaign=share"))); ?>"><img src="http://static.janoszen.com/images/share/facebook.gif" height="15" width="15" alt="Share on Facebook!" /></a>
						<a href="http://twitter.com/home/?status=<?php echo(htmlspecialchars(urlencode(the_title_attribute() . " " . get_permalink() . "?utm_source=twitter&utm_medium=social&utm_campaign=share"))); ?>"><img src="http://static.janoszen.com/images/share/twitter.gif" height="15" width="15" alt="Share on Twitter!" /></a>
						<a href="http://del.icio.us/post?url=<?php echo(htmlspecialchars(urlencode(get_permalink()))); ?>&amp;title=<?php echo(htmlspecialchars(urlencode(get_permalink() . "?utm_source=delicious&utm_medium=social&utm_campaign=share"))); ?>"><img src="http://static.janoszen.com/images/share/delicious.gif" height="15" width="15" alt="Share on Del.icio.us!" /></a>
						<a href="http://digg.com/submit?phase=2&amp;url=<?php echo(htmlspecialchars(urlencode(get_permalink() . "?utm_source=digg&utm_medium=social&utm_campaign=share"))); ?>&amp;title=<?php echo(htmlspecialchars(urlencode(the_title_attribute()))); ?>"><img src="http://static.janoszen.com/images/share/digg.gif" height="15" width="15" alt="Digg it!" /></a>
					</footer>
				</article>
			<?php endwhile; ?>

			<?php include(dirname(__FILE__) . "/navigation.php"); ?>
