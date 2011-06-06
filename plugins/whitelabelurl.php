<?php
/*
Plugin Name: WhiteLabel URL filter
Plugin URI: http://blog.janoszen.hu
Description: Filters admin URLs to hide Wordpress presence
Version: 0.1.0
Author: János Pásztor
Author URI: http://blog.janoszen.hu
*/

function get_admin_domain() {
	if (isset($GLOBALS['WHITELABEL']['admindomain'])) {
		return $GLOBALS['WHITELABEL']['admindomain'];
	} else {
		return $_SERVER['HTTP_HOST'];
	}
}

function filter_admin_url($content) {
	return "http://" . get_admin_domain() . "/wp-admin/wp-admin.php";
}

function filter_login_url($content) {
	return "/login";
}

function filter_siteurl() {
	return "http://" . get_admin_domain();
}

function filter_scripts() {
	wp_deregister_script("comment-reply");
}

function remove_generator() {
	return '';
}

if ($_SERVER['HTTP_HOST'] == get_admin_domain()) {
        add_filter("pre_option_siteurl", "filter_siteurl", 10, 0);
} else {
        add_filter("admin_url", "filter_admin_url", 10, 1);
        add_filter("login_url", "filter_login_url", 10, 1);
        add_filter("logout_url", "filter_login_url", 10, 1);
}

add_action('wp_print_scripts', 'filter_scripts');
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');

add_filter('the_generator', 'remove_generator');

