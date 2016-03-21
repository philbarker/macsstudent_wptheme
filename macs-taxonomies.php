<?php
/**
 * Taxonmies used for the MACS students pages
 *
 */

function delivery_level_init() 
{
	$name ='deliveryLevels';
	$object_type = 'course';
	$args = array(
		'label'=> 'Delivery Levels',
		'hierarchical' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'show_in_nav_menus' => true		
	);
	register_taxonomy( $name, $object_type, $args);
}
add_action( 'init', 'delivery_level_init' );

function location_init() 
{
	$name ='location';
	$object_type = 'course';
	$args = array(
		'label'=> 'Locations',
		'hierarchical' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'show_in_nav_menus' => true		
	);
	register_taxonomy( $name, $object_type, $args);
}
add_action( 'init', 'location_init' );

function department_init() 
{
	$name ='department';
	$object_type = 'course';
	$args = array(
		'label'=> 'Department',
		'hierarchical' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'show_in_nav_menus' => true		
	);
	register_taxonomy( $name, $object_type, $args);
}
add_action( 'init', 'department_init' );

function semester_init() 
{
	$name ='semester';
	$object_type = 'course';
	$args = array(
		'label'=> 'Semester',
		'hierarchical' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'show_in_nav_menus' => true		
	);
	register_taxonomy( $name, $object_type, $args);
}
add_action( 'init', 'semester_init' );

function level_init() 
{
	$name ='level';
	$object_type = 'course';
	$args = array(
		'label'=> 'SCQA Level',
		'hierarchical' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'show_in_nav_menus' => true		
	);
	register_taxonomy( $name, $object_type, $args);
}
add_action( 'init', 'level_init' );
