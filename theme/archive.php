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

if (is_category()) {
    $description = single_cat_title('', false) . ' category entries';
} elseif( is_tag() ) {
    $description = single_tag_title('', false) . ' tag entries';
} elseif (is_day()) {
    $description = get_the_time('Y. F d., l') . ' entries';
} elseif (is_month()) {
    $description = get_the_time('Y. F') . ' monthly archive';
} elseif (is_year()) {
    $description = get_the_time('Y.') . ' yearly archive';
} elseif (is_author()) {
    $userdata = get_userdatabylogin(get_query_var('author_name'));
    $description = $userdata->display_name . ' entries';
} elseif (isset($_GET['paged']) && !empty($_GET['paged'])) {
    $description = 'Blog archive';
}

//This is removed, so we can pass variables.
//get_header();
include(dirname(__FILE__) . "/header.php");
?>
	<section id="content" class="main">
		<?php if (is_category() || is_tag() || is_day() || is_month() || is_year() || is_author() || (isset($_GET['paged']) && !empty($_GET['paged']))) { ?>
                        <h2><?php echo(htmlspecialchars($description)); ?></h2>
                <?php } ?>
		<?php if (is_category() && category_description()) : ?>
			<section class="intro"><?php echo(category_description()); ?></section>
		<?php endif; ?>

		<?php if (have_posts()) : ?>
			<?php $post = $posts[0]; ?>
			<?php include(dirname(__FILE__) . "/posts-short.php"); ?>
		<?php else : ?>
			<p>There are no entries here. Try searching or <a href="/">return to the home page</a>.</p>
		<?php
			get_search_form();
		endif; ?>
	</section>
<?php get_footer(); ?>
