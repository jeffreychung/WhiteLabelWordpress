<?php
/**
 * @package WordPress
 * @subpackage ME_Theme
 */

if (!have_posts()) {
	header("HTTP/1.1 404 Not Found", true, 404);
} else {
	header("HTTP/1.1 300 Multiple choices", true, 300);
}
$meta = true;
$listing = true;
//This is removed, so we can pass variables.
//get_header();
include(dirname(__FILE__) . "/header.php");
?>
	<h2>Search</h2>
	<?php get_search_form(); ?>
	<?php if (have_posts()) : ?>
		<?php $post = $posts[0]; ?>
		<?php include(dirname(__FILE__) . "/posts-short.php"); ?>
	<?php else : ?>
		<p>Sorry, but your search turned up no results. Try with a different keyword or <a href="/">home page</a>. <strong>If you feel I'm missing a topic, you may try to <a href="/contact">contact me</a> about it!</strong></p>
	<?php endif; ?>
<?php get_footer(); ?>
