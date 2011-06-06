<?php
/**
 * @package WordPress
 * @subpackage ME_Theme
 */

if (!have_posts()) {
	header("HTTP/1.1 404 Not Found", true, 404);
}

$meta = true;
//This is removed, so we can pass variables.
//get_header();
include(dirname(__FILE__) . "/header.php");
?>
		<?php if (have_posts()) : ?>
			<?php $post = $posts[0]; ?>
			<?php include(dirname(__FILE__) . "/page-long.php"); ?>
			<?php wp_link_pages(array('before' => '<p><strong>' . __('Pages:', 'me') . '</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
		<?php else : ?>
			<p>Page not found</p>
		<?php
		endif; ?>
<?php get_footer(); ?>
