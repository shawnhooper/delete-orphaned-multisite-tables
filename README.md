# Cleanup Multisite DB Tables (WP-CLI Custom Command) #
**Contributors:** [shooper](https://profiles.wordpress.org/shooper/)  
**Donate link:** http://shawnhooper.ca/  
**Tags:** multisite, wpcli, database  
**Requires at least:** 4.0  
**Tested up to:** 6.0  
**Stable tag:** trunk  
**License:** GPLv2 or later  
**License URI:** http://www.gnu.org/licenses/gpl-2.0.html  

Finds and delete orphaned tables in a WordPress Multisite network using WP-CLI.

## Description ##

*NOTE:*  This plugin requires you to be running the [WP-CLI](http://wp-cli.org/) command line
library.

Finds and delete orphaned tables in a WordPress Multisite network using WP-CLI.  Useful
when plugins don't properly clean up their tables after deletion in a multisite network.

## Installation ##

1. Upload this plugin's to the `/wp-content/plugins/delete-orphaned-multisite-tables/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress or by using the WP-CLI command: `wp plugin activate delete-orphaned-multisite-tables`

## Usage ##

### How can I find orphaned Multisite tables ###

1. Run `wp multisite-db list` from the command-line

### How can I delete orphaned Multisite tables ###

1. Run `wp multisite-db delete --force` from the command-line

## Changelog ##

### 1.0.1 ###
* Updated build dependencies to fix critical vulnerability in Grunt

### 1.0 ###
* First release. Allows listing & deleting of orphaned tables.
