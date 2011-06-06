<?php
/**
 * @package WordPress
 * @subpackage ME_Theme
 */

/*
Template Name: Links
*/
?>
<?php get_header(); ?>
<h2><?php _e('Links:', 'me'); ?></h2>
<ul>
<?php wp_list_bookmarks(); ?>
</ul>
<?php get_footer(); ?>
