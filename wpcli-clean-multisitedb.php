<?php
/**
 * Plugin Name: Delete Orphaned Multisite Tables (WP-CLI Command)
 * Version: 1.0
 * Description: Finds and delete orphaned tables in a WordPress Multisite network.
 * Author: Shawn Hooper
 * Author URI: http://www.shawnhooper.ca/
 * Plugin URI: PLUGIN SITE HERE
 * @package Cleanup Multisite DB Tables (WP-CLI Custom Command)
 */

if ( defined('WP_CLI') && WP_CLI ) {
	include __DIR__ . '/wp-cli.php';
}
