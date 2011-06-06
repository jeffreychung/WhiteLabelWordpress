<?php
/**
 * @package WordPress
 * @subpackage ME_Theme
 */

if (!have_posts()) {
	header("HTTP/1.1 404 Not Found", true, 404);
}

$meta = true;
$listing = true;
$description = "Personal blog of Janos Pasztor";
//This is removed, so we can pass variables.
//get_header();
include(dirname(__FILE__) . "/header.php");
?>
	<h2 class="braille-only">Latest entries</h2>
	<?php if (have_posts()) : ?>
		<?php $post = $posts[0]; ?>
		<?php include(dirname(__FILE__) . "/posts-short.php"); ?>
	<?php else : ?>
		<p>There is nothing here.</p>
	<?php
		get_search_form();
	endif; ?>
<?php get_footer(); ?>
