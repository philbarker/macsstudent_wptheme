<?php
/**
* Custom field functionality for student site
* Requires metabox plugin https://metabox.io
*/


/**
* Create custom post type for courses
*/
add_action( 'init', 'macs_create_course_type' );
function macs_create_course_type() {
  register_post_type( 'course',
    array(
        'labels' => array(
        	'name' => __( 'Courses' ),
        	'singular_name' => __( 'Course' ),
		'add_new' => __( 'New course' ),
		'add_new_item' => __( 'Add new course' ),
		'edit_item' => __( 'Edit course data' ),
		'view_item' => __( 'View course data' )
      		),
      	'public' => true,
      	'has_archive' => true,
      	'rewrite' => array('slug' => 'course'),
      	'supports' => array('title', 'editor', 'revisions', 'page-attributes' ),
	'menu_position' => 20,
	'capability_type' => 'page',
	'hierachical' => true,
	'taxonomies'=> array('post_tag', 'category')
    )
  );
}

function wpb_change_course_title_text( $title ){
     $screen = get_current_screen();
     if  ( 'course' == $screen->post_type ) {
          $title = 'Course code and title';
     }
     return $title;
}
add_filter( 'enter_title_here', 'wpb_change_course_title_text' );


add_filter( 'rwmb_meta_boxes', 'macs_students_meta_boxes' );
function macs_students_meta_boxes( $meta_boxes ) {
    $meta_boxes[] = array(
        'title'	     => 'Course metadata',
        'post_types' => array('page', 'course'),
        'fields'     => array(
            array(
                'id'   => 'courseCode',
                'name' => 'Course Code',
                'type' => 'text',
                'size' => '5',
                'desc' => 'The course code, e.g. F29EG'
            ),
			array(
                'id'   => 'courseTitle',
                'name' => 'Course Title',
                'type' => 'text',
                'desc' => 'The course title, e.g. Software Development 1'
            ),
			array(
                'id'   => 'courseLeader',
                'name' => 'Course co-ordinator',
                'type' => 'post',
				'post_type' => 'person',
				'field_type'  => 'select_advanced',
				'placeholder' => __( 'Select a person'),
				'query_args'  => array(
					'post_status'    => 'publish',
					'posts_per_page' => - 1,
				),	
				'clone' => 'true',
                'desc' => 'Link to the entry for the course coordinator'
            ),
			array(
                'id'   => 'courseSCQFlevel',
                'name' => 'Course SCQF Level',
                'type' => 'text',
				'size' => '2',
                'desc' => 'The SCQF Level, e.g. 10'
            ),
			array(
                'id'   => 'courseSCQFcredits',
                'name' => 'Course SCQF Credits',
                'type' => 'text',
				'size' => '3',
                'desc' => 'The SCQF Level, e.g. 15'
            ),
			array(
                'id'   => 'courseElective',
                'name' => 'Course Elective',
                'type' => 'text',
				'size' => '3',
                'desc' => 'Is this an Elective Course, Yes or No'
            ),
			array(
                'id'   => 'coursePrerequisites',
                'name' => 'Course Prerequisites',
                'type' => 'text',
				'clone' => 'true',
                'desc' => 'Course Pre-requisites, e.g F27EG'
            ),
			array(
                'id'   => 'courseLinkedCourses',
                'name' => 'Course Linked Courses',
                'type' => 'text',
				'clone' => 'true',
                'desc' => 'Linked Cousrse i.e synoptoc courses, e.g F27EF'
            ),
				array(
                'id'   => 'courseSemester',
                'name' => 'Course Semester',
				'type' => 'text',
				'clone' => 'true',
				'size' => '2',				
                'desc' => 'Semester(s) this course is taught in, e.g S1'
            ),
			array(
                'id'   => 'courseDeliveryLevel',
                'name' => 'Course Delivery Level',
				'type' => 'text',
				'clone' => 'true',
				'size' => '3',				
                'desc' => 'Delivery Level(s), e.g PGT'
            ),
			array(
                'id'   => 'courseLocation',
                'name' => 'Course Location',
				'type' => 'text',
				'clone' => 'true',				
                'desc' => 'Campus(es) this course is taught in, e.g Dubai'
            ),
			array(
                'id'   => 'courseAims',
                'name' => 'Course Aims',
                'type' => 'wysiwyg',
                'desc' => 'The course Aims'
            ),
			array(
                'id'   => 'courseSyllabus',
                'name' => 'Course Syllabus',
                'type' => 'wysiwyg',
                'desc' => 'The course Syllabus'
            ),
			array(
                'id'   => 'courseLOSM',
                'name' => 'Course Learning Outcomes: Subject Mastery',
                'type' => 'wysiwyg',
                'desc' => 'The course Learning Outcomes: Subject Mastery'
            ),
			array(
                'id'   => 'courseLOPA',
                'name' => 'Course Learning Outcomes: Personal Abilities',
                'type' => 'wysiwyg',
                'desc' => 'The course Learning Outcomes: Personal Abilities'
            ),
			array(
                'id'   => 'courseAssessmentMethods',
                'name' => 'Course Assessment Methods',
                'type' => 'wysiwyg',
                'desc' => 'The course Assessment (and Reassessment Methods), e.g Assessment: Examination: (weighting – 70%) Coursework (weighting – 30%); Re-assessment: Examination: (weighting – 100%)'
            ),
			array(
                'id'   => 'courseDetailedSyllabus',
                'name' => 'Course Detailed Syllabus',
                'type' => 'wysiwyg',
                'desc' => 'Provides a more detailed syllabus field (used by Maths and AMS)'
            ),
			array(
                'id'   => 'courseDetailedLOs',
                'name' => 'Course Detailed Learning Outcomes',
                'type' => 'wysiwyg',
                'desc' => 'Provides a more detailed Learning Outcomes field (used by Maths and AMS)'
            ),
			array(
                'id'   => 'courseContactHours',
                'name' => 'Course Contact Hours',
                'type' => 'text',
                'desc' => 'The contact Hours for the course, (used by Maths)'
            )
        ),
    );
    return $meta_boxes;
}

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
	  'menu_position' => 20,
	  'menu_icon' => 'dashicons-admin-users'
    )
  );
}

function wpb_change_title_text( $title ){
     $screen = get_current_screen();
     if  ( 'person' == $screen->post_type ) {
          $title = 'Name';
     }
     return $title;
}
add_filter( 'enter_title_here', 'wpb_change_title_text' );


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
			array(
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
		)
	);
    return $meta_boxes;
}



/**
* Helper functions for printing out metadata fields
*
**/
function macs_print_course_code( )
{
	if ( rwmb_meta( 'courseCode' ) )
	{
		echo '<p><strong>Course code:</strong> '.rwmb_meta( 'courseCode' ).'</p>';
	}
}
