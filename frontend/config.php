<?php
/**
 * The domain for your public path.
 */
$domain = 'blog.example.com';
/**
 * Path to the real Wordpress installation.
 */
$wppath = dirname(dirname(__FILE__)) . '/admin.' . $domain;
/**
 * The path to wp-content. This only matters, if you don't use the custom template.
 */
$contenturl = 'http://content.' . $domain;
/**
 * Path to the wp-content directory
 */
$contentpath = $wppath . '/wp-content';
