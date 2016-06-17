<?php
/**
 * Initialise Taxonmies used for the MACS students pages
 * i.e.: location, department, semester, level, delivery level
 *
 * posts_by_taxon() : return list of posts as classified by these txnms
 */

function location_init() 
{
	$name ='location';
	$object_type = array('cs-course', 
						'maths-course', 
						'ams-course', 
						'person');
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
	$object_type = 'person';
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
	$object_type = array('cs-course', 
						'maths-course', 
						'ams-course', 
						);
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
	$object_type = array('cs-course', 
						'maths-course', 
						'ams-course', 
						);
	$args = array(
		'label'=> 'SCQF Level',
		'hierarchical' => true,
		'show_ui' => true,
		'show_in_menu' => false,
		'show_in_nav_menus' => true		
	);
	register_taxonomy( $name, $object_type, $args);
}
add_action( 'init', 'level_init' );

function delivery_level_init() 
{
	$name ='deliveryLevel';
	$object_type = array('cs-course', 
						'maths-course', 
						'ams-course', 
						);
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
	$results = '<p>';
	$query = array();
	$query['posts_per_page'] = -1;
	$query['tax_query'] = array();
	$taxonomies = get_taxonomies();
	
	if ( array_key_exists( 'debug', $atts ) )
	{
		$debug = ('true' === $atts['debug']);
	} else {
		$debug = false;
	}

	foreach ($taxonomies as $taxonomy) 
	{
		if ( array_key_exists( $taxonomy, $atts ) )
		{
			if ($debug)
			{
				$results = $results.'Posts by taxon: '.$taxonomy.' = '.$atts[$taxonomy];
			}
			$tax_query = array(
				'taxonomy' => $taxonomy,
				'field' => 'name',
				'terms' => $atts[$taxonomy]
			);
			$query['tax_query'][] = $tax_query;
		}
	}

	if ( array_key_exists( 'type', $atts ) )
	{
		$query['post_type'] = $atts['type'];
	} else {
		$query['post_type'] = get_post_types();
	}		

	if ( array_key_exists( 'orderby', $atts ) )
	{
		$query['orderby'] = $atts['orderby'];
		if ( array_key_exists( 'order', $atts ) )
		{
			$query['order'] = strtoupper( $atts['order'] );
		} else {
			$query['order'] = 'ASC';
		}
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

function macs_print_taxon( $taxonomy, $headword = NULL )
{
	$taxon = implode( ', ', wp_get_post_terms( get_the_ID(),
											$taxonomy, 
											array('fields'=>'names') )
					);
	if (NULL === $headword)
	{
		$headword = '<p><strong>'.ucfirst($taxonomy).': </strong>';
	} else {
		$headword = '<p><strong>'.$headword.': </strong>';
	}
	if ($taxon != '') 
	{
		echo $headword.$taxon.'.</p>';
	}
}
