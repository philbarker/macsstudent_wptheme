<?php
/**
 * Taxonmies used for the MACS students pages
 * i.e.: location, department, level, delivery level
 * posts_by_taxon() : return list of posts as classified by these txnms
 */

function location_init() 
{
	$name ='location';
	$object_type = array('course', 'person');
	$args = array(
		'label'=> 'Locations',
		'hierarchical' => true,
		'show_ui' => true,
		'show_in_menu' => false,
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
		'show_in_menu' => false,
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
		'show_in_menu' => false,
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

function delivery_level_init() 
{
	$name ='deliveryLevel';
	$object_type = 'course';
	$args = array(
		'label'=> 'Delivery Levels',
		'hierarchical' => true,
		'show_ui' => true,
		'show_in_menu' => false,
		'show_in_nav_menus' => true		
	);
	register_taxonomy( $name, $object_type, $args);
}
add_action( 'init', 'delivery_level_init' );

function posts_by_taxon ( $atts ) 
{
	$results = '<p>Posts by taxon: ';
	$query = array();
	$query['posts_per_page'] = 5;
	$query['post_type'] = $atts['type'];
	$query['tax_query'] = array();

	if ( array_key_exists( 'level', $atts ) )
	{
		$results = $results.'level = '.$atts['level'];
		$level_tax_query = array(
			'taxonomy' => 'level',
			'field' => 'name',
			'terms' => $atts['level']
		);
		$query['tax_query'][] = $level_tax_query;
	}
	if ( array_key_exists( 'semester', $atts ) )
	{
		$results = $results.'semester = '.$atts['semester'];
		$semester_tax_query = array(
			'taxonomy' => 'semester',
			'field' => 'name',
			'terms' => $atts['semester']
		);
		$query['tax_query'][] = $semester_tax_query;
	}
	if ( array_key_exists( 'department', $atts ) )
	{
		$results = $results.' department = '.$atts['department'];
		$department_tax_query = array(
			'taxonomy' => 'department',
			'field' => 'name',
			'terms' => $atts['department']
		);
		$query['tax_query'][] = $department_tax_query;
	}
	if ( array_key_exists( 'delivery_level', $atts ) )
	{
		$results = $results.' department = '.$atts['department'];
		$department_tax_query = array(
			'taxonomy' => 'department',
			'field' => 'name',
			'terms' => $atts['department']
		);
		$query['tax_query'][] = $department_tax_query;
	}

	$posts_array = get_posts( $query );

	$results = $results.'</p><ul>';
	foreach ( $posts_array as $post ) 
	{
		$url = esc_url( get_permalink( $post->ID ) );
		$title = $post->post_title;
		$linkitem = '<li><a href="'.$url.'">'.$title.'</a></li>';
		$results = $results.$linkitem;
	}
	$results = $results.'</ul>';
	return $results;
}
add_shortcode( 'posts-by-taxon', 'posts_by_taxon' );
