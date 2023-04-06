<?php
/**
 * Ecommerce Plugin
 * 
 * @package Ecommerce Plugin
 * @author Shane Stevens
 * @copyright 2023 Shane Stevens
 * 
 * @wordpress-plugin
 * Plugin Name: Ecommerce Plugin
 * Description: Hi there If your reading this you probably installed my wordpress Plugin/Theme for an Ecommerce Website. This plugin creates a fully functional ecommerce website.(* Under construction *)
 * Version: 0.1
 * Author: Shane Stevens
 * License: Free
 */

// ________________
// This File acts as a form communication between all files which connects them along with all their functions 

// ________________
// call Files & Functions

// ________________
// Create Page Function
function create_page($title_of_the_page, $content, $parent_id = NULL)
{
	$objPage = get_page_by_title($title_of_the_page, 'OBJECT', 'page');
	if (!empty($objPage)) {
		// echo "Page already exists:" . $title_of_the_page . "<br/>";
		return $objPage->ID;
	}

	$page_id = wp_insert_post(
		array(
			'comment_status' => 'close',
			'ping_status' => 'close',
			'post_author' => 1,
			'post_title' => ucwords($title_of_the_page),
			'post_name' => strtolower(str_replace(' ', '-', trim($title_of_the_page))),
			'post_status' => 'publish',
			'post_content' => $content,
			'post_type' => 'page',
			'post_parent' => $parent_id //'id_of_the_parent_page_if_it_available'
		)
	);
	echo "Created page_id=" . $page_id . " for page '" . $title_of_the_page . "'<br/>";
	return $page_id;
}


// ________________
// Create Table Function
function create_table_on_activate()
{
	// connect to wordpress database
	global $wpdb;

	require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

	$result = dbDelta($sql);


	if (is_wp_error($result)) {
		echo 'There was an error creating the tables';
		return;
	}

}
register_activation_hook(__FILE__, 'create_table_on_activate');


// ________________
// ONACTIVATING PLUGIN FUNCTION(Create pages along with content from short code)
function on_activating_your_plugin()
{

}
register_activation_hook(__FILE__, 'on_activating_your_plugin');


// ________________
// ONDEACTIVATING PLUGIN FUNCTION(delete pages creates from onactivating the plugin)
function on_deactivating_your_plugin()
{

}
register_deactivation_hook(__FILE__, 'on_deactivating_your_plugin');
?>