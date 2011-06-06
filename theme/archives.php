<?php
/**
 * @package WordPress
 * @subpackage ME_Theme
 */
/*
Template Name: Archives
*/

$description = "Archives";

//get_header();
include(dirname(__FILE__) . "/header.php");
?>
	<section id="content" class="main">
		<?php get_search_form(); ?>
		<section>
			<h2>By months:</h2>
			<ul>
				<?php wp_get_archives('type=monthly'); ?>
			</ul>
		</section>
		<section>
			<h2>By topic:</h2>
			<ul>
				 <?php wp_list_categories(); ?>
			</ul>
		</section>
	</section>
<?php get_footer(); ?>
