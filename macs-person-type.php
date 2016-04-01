<?php
/**
* Custom field functionality for student site
* Requires metabox plugin https://metabox.io
*/


/**
* Create custom post type for storing (links to) people's details
*/
add_action( 'init', 'macs_create_person_type' );
function macs_create_person_type() {
  register_post_type( 'person',
    array(
        'labels' => array(
        'name' => __( 'People' ),
        'singular_name' => __( 'Person' ),
		'add_new' => __( 'New person' ),
		'add_new_item' => __( 'Add new person' ),
		'edit_item' => __( 'Edit person' ),
		'view_item' => __( 'View person' )
      ),
      'public' => true,
      'has_archive' => false,
      'rewrite' => array('slug' => 'person'),
      'supports' => array('title', 'revisions' ),
	  'menu_position' => 22,
	  'menu_icon' => 'dashicons-admin-users'
    )
  );
}

function wpb_change_person_title_text( $title ){
     $screen = get_current_screen();
     if  ( 'person' == $screen->post_type ) {
          $title = 'Name';
     }
     return $title;
}
add_filter( 'enter_title_here', 'wpb_change_person_title_text' );


/**
* Register meta box for person metadata
*/
add_filter( 'rwmb_meta_boxes', 'macs_person_meta_boxes' );
function macs_person_meta_boxes( $meta_boxes ) {
    $meta_boxes[] = array(
        'title'	     => 'Person metadata',
        'post_types' => 'person',
        'fields'     => array(
			array(
                'id'   => 'staffDirURL',
                'name' => 'Staff directory URL',
                'type' => 'url',
                'desc' => 'The URL for this person\'s page in the staff directory.'
            ),
			array(
                'id'   => 'photoURL',
                'name' => 'Photo URL',
                'type' => 'url',
                'desc' => 'The URL of the Profile Picture in the staff directory.'
            ),
/*			array(
                'id'   => 'location',
                'name' => 'Location',
                'type' => 'checkbox_list',
				'options' => array(
					'Dubai' => 'Dubai',
					'Edinburgh' => 'Edinburgh',
					'Malaysia' => 'Malaysia'
				),
                'desc' => 'Course Co-ordinators location, e.g. Edinburgh'
            )
*/
		)
	);
    return $meta_boxes;
}


/**
* Helper functions for printing out metadata fields
*
**/

function macs_print_person_link( $person_id ) {
    $name = get_the_title( $person_id );
	$url  = esc_url( rwmb_meta( 'staffDirURL', array(), $person_id ) );
	$location =  implode(', ', wp_get_post_terms( $person_id, 
												'location', 
												array('fields' => 'names' ) 
												) );
	echo sprintf( '<a href="%s">%s</a>(%s)', $url, $name, $location);

}

function macs_print_person_img( $person_id ) {
    $imgref = esc_url( rwmb_meta( 'photoURL', array(), $person_id ) );
	if ($imgref != '') {
	    $name = get_the_title( $person_id );
		$url  = esc_url( rwmb_meta( 'staffDirURL', array(), $person_id ) ); 
		echo sprintf( '<a href="%s"><img src="%s" alt="%s" /></a>', 
					$url, $imgref, $name );
	}
}
