<?php
/**
* Functions to support the Course type in MACS Students WP site.
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
      	'supports' => array('title', 'revisions', 'page-attributes' ),
	'menu_position' => 20,
	'capability_type' => 'page',
	'hierachical' => true,
	'taxonomies'=> array('post_tag', 'category'),
	'menu_position' => 20,
	'menu_icon' => 'dashicons-admin-page'
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


add_filter( 'rwmb_meta_boxes', 'macs_courses_meta_boxes' );
function macs_courses_meta_boxes( $meta_boxes ) {
    $meta_boxes[] = array(
        'title'	     => 'Course metadata',
        'post_types' => array('course'),
        'fields'     => array(
            array(
                'id'   => 'courseCode',
                'name' => 'Course Code',
                'type' => 'text',
                'size' => '5',
                'desc' => 'The course code, e.g. F29EG'
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
/*			array(
                'id'   => 'courseSCQFlevel',
                'name' => 'Course SCQF Level',
                'type' => 'text',
				'size' => '2',
                'desc' => 'The SCQF Level, e.g. 10'
            ),
*/
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
                'type' => 'radio',
				'options' => array('true' => 'yes', 'false' => 'no'),
                'desc' => 'Is this an Elective Course, Yes or No'
            ),
			array(
                'id'   => 'coursePrerequisiteCourses',
                'name' => 'Prerequisite Courses',
                'type' => 'post',
				'post_type' => 'course',
				'field_type'  => 'select_advanced',
				'placeholder' => __( 'Select a course'),
				'query_args'  => array(
					'post_status'    => 'publish',
					'posts_per_page' => - 1,
				),	
				'clone' => 'true',
                'desc' => 'Course Pre-requisites, e.g F27EG'
            ),
			array(
                'id'   => 'coursePrerequisitesText',
                'name' => 'Other Course Prerequisites',
                'type' => 'text',
                'desc' => 'Or equivalent for F27EG'
            ),
			array(
                'id'   => 'courseLinkedCourses',
                'name' => 'Course Linked Courses',
                'type' => 'text',
                'type' => 'post',
				'post_type' => 'course',
				'field_type'  => 'select_advanced',
				'placeholder' => __( 'Select a course'),
				'query_args'  => array(
					'post_status'    => 'publish',
					'posts_per_page' => - 1,
				),	
				'clone' => 'true',
                'desc' => 'Linked Course e.g F27EF'
            ),
			array(
                'id'   => 'courseLinkedCoursesText',
                'name' => 'Linked Courses notes',
                'type' => 'text',
                'desc' => 'e.g. synoptic courses'
            ),
/*			array(
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
*/
			array(
                'id'   => 'courseAims',
                'name' => 'Course Aims',
                'type' => 'wysiwyg',
                'desc' => 'The course Aims',
				'options' => array(
					'media_buttons' => false,
					'textarea_rows' => 6
				)
            ),
			array(
                'id'   => 'courseSyllabus',
                'name' => 'Course Syllabus',
                'type' => 'wysiwyg',
                'desc' => 'The course Syllabus',
				'options' => array(
					'media_buttons' => false,
					'textarea_rows' => 6
				)
            ),
			array(
                'id'   => 'courseLOSM',
                'name' => 'Course Learning Outcomes: Subject Mastery',
                'type' => 'wysiwyg',
                'desc' => 'The course Learning Outcomes: Subject Mastery',
				'options' => array(
					'media_buttons' => false,
					'textarea_rows' => 6
				)
            ),
			array(
                'id'   => 'courseLOPA',
                'name' => 'Course Learning Outcomes: Personal Abilities',
                'type' => 'wysiwyg',
                'desc' => 'The course Learning Outcomes: Personal Abilities',
				'options' => array(
					'media_buttons' => false,
					'textarea_rows' => 6
				)
            ),
			array(
                'id'   => 'courseAssessmentMethods',
                'name' => 'Course Assessment Methods',
                'type' => 'wysiwyg',
                'desc' => 'The course Assessment (and Reassessment Methods), e.g Assessment: Examination: (weighting 70%) Coursework (weighting 30%); Re-assessment: Examination: (weighting 100%)',
				'options' => array(
					'media_buttons' => false,
					'textarea_rows' => 6
				)
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

function macs_print_course_link( $course_id )
{
    $name = get_the_title( $course_id );
	$url  = esc_url( get_permalink( $course_id ) ); 
	echo sprintf( '<a href="%s">%s</a>', $url, $name );
}


function macs_print_course_leader( )
{
	if ( implode( '', rwmb_meta( 'courseLeader' ) ) )
	{
		echo '<p><strong>Course co-ordinator(s):</strong> ';
        $people = rwmb_meta( 'courseLeader' );
        foreach ( $people as $person )
		{
			macs_print_person_link( $person );
			if ($person === end( $people) )
			{ 
			echo '. '; 
			} else {
		  	echo ' &amp; ';  
			}
		}
		echo '</p>';
	}

}

function macs_print_course_leader_img( )
{
	if ( implode( '', rwmb_meta( 'courseLeader' ) ) )
	{
		echo '<p class="alignright" >';
        $people = rwmb_meta( 'courseLeader' );
        foreach ( $people as $person )
		{
			macs_print_person_img( $person );
		}
		echo '</p>';
	}

}

function macs_print_course_prereqs( )
{
	if ( implode( '', rwmb_meta( 'coursePrerequisiteCourses' ) ) )
	{
		echo '<p><strong>Pre-requisite course(s):</strong> ';
        $prereq_courses = rwmb_meta( 'coursePrerequisiteCourses' );
        foreach ( $prereq_courses as $prereq )
		{
			macs_print_course_link( $prereq );
			if ($prereq === end( $prereq_courses ) )
			{ 
			echo '. '; 
			} else {
		  	echo ' &amp; ';  
			}
		}
		if ( rwmb_meta( 'coursePrerequisitesText' ) )
		{
			echo ' '.rwmb_meta( 'coursePrerequisitesText' );
		}
		echo '</p>';
	}
	elseif ( rwmb_meta( 'coursePrerequisitesText' ) )
	{
		echo '<p><strong>Pre-requisites:</strong> './/
			rwmb_meta( 'coursePrerequisitesText' ).'</p>';
	}
	else 
	{
		echo '<p><strong>Pre-requisites:</strong>: None.</p>';
		
	}
}

function macs_print_linked_courses( )
{
	if ( implode( '', rwmb_meta( 'courseLinkedCourses' ) ) )
	{
		echo '<p><strong>Linked course(s):</strong> ';
        $linked_courses = rwmb_meta( 'courseLinkedCourses' );
        foreach ( $linked_courses as $linked_course )
		{
			macs_print_course_link( $linked_course );
			if ($linked_course === end( $linked_courses ) )
			{ 
			echo '. '; 
			} else {
		  	echo ' &amp; ';  
			}
		}
		if ( rwmb_meta( 'courseLinkedCoursesText' ) )
		{
			echo ' '.rwmb_meta( 'courseLinkedCoursesText' );
		}
		echo '</p>';
	}
	elseif ( rwmb_meta( 'courseLinkedCoursesText' ) )
	{
		echo '<p><strong>Linked course(s):</strong> './/
			rwmb_meta( 'courseLinkedCoursesText' ).'</p>';
	}
}

function macs_print_course_aims_objectives( )
{
 	macs_print_html_metadata('courseAims', 'Aims:');
 	macs_print_html_metadata('courseSyllabus', 'Syllabus:');
 	macs_print_html_metadata('courseLOSM', 'Learning Oucomes: Subject Mastery');
 	macs_print_html_metadata('courseLOPA', 'Learning Oucomes: Personal Abilities');
 	macs_print_html_metadata('courseAssessmentMethods', 'Assessment Methods:');
}


