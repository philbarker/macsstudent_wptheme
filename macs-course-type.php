<?php
/**
* Functions to support the Course type in MACS Students WP site.
* Requires metabox plugin https://metabox.io
*/

/**
* Create custom post types for courses per discipline
*/
add_action( 'init', 'macs_create_course_type' );
function macs_create_course_type() {
  register_post_type( 'cs-course',
    array(
        'labels' => array(
        	'name' => __( 'CS Courses' ),
        	'singular_name' => __( 'CS Course' ),
		'add_new' => __( 'New CS course' ),
		'add_new_item' => __( 'Add new CS course' ),
		'edit_item' => __( 'Edit CS course data' ),
		'view_item' => __( 'View CS course data' )
      		),
      	'public' => true,
      	'has_archive' => false,
      	'rewrite' => array('slug' => 'cs/courses', 'with_front' => false),
      	'supports' => array('title', 'revisions' ),
	'menu_position' => 20,
	'capability_type' => 'page',
	'hierachical' => true,
	'taxonomies'=> array(),
	'menu_position' => 20,
	'menu_icon' => 'dashicons-admin-page'
    )
  );
  register_post_type( 'maths-course',
    array(
        'labels' => array(
        	'name' => __( 'Maths Courses' ),
        	'singular_name' => __( 'Maths Course' ),
		'add_new' => __( 'New Maths course' ),
		'add_new_item' => __( 'Add new Maths course' ),
		'edit_item' => __( 'Edit Maths course data' ),
		'view_item' => __( 'View Maths course data' )
      		),
      	'public' => true,
      	'has_archive' => false,
      	'rewrite' => array('slug' => 'maths/courses'),
      	'supports' => array('title', 'revisions' ),
	'menu_position' => 20,
	'capability_type' => 'page',
	'hierachical' => true,
	'taxonomies'=> array(),
	'menu_position' => 20,
	'menu_icon' => 'dashicons-admin-page'
    )
  );
  register_post_type( 'ams-course',
    array(
        'labels' => array(
        	'name' => __( 'AMS Courses' ),
        	'singular_name' => __( 'AMS Course' ),
		'add_new' => __( 'New AMS course' ),
		'add_new_item' => __( 'Add new AMS course' ),
		'edit_item' => __( 'Edit AMS course data' ),
		'view_item' => __( 'View AMS course data' )
      		),
      	'public' => true,
      	'has_archive' => false,
      	'rewrite' => array('slug' => 'ams/courses'),
      	'supports' => array('title', 'revisions' ),
	'menu_position' => 20,
	'capability_type' => 'page',
	'hierachical' => true,
	'taxonomies'=> array(),
	'menu_position' => 20,
	'menu_icon' => 'dashicons-admin-page'
    )
  );
}

function macs_rewrite_flush() {
	macs_create_course_type();
	flush_rewrite_rules();
}
add_action('after_switch_theme', 'macs_rewrite_flush');

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
        'title'	     => 'Basic course metadata',
        'post_types' => array('cs-course', 'ams-course', 'maths-course'),
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
		        'post_type' => array('cs-course', 'ams-course', 'maths-course'),
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
                'type' => 'post',
		        'post_type' => array('cs-course', 'ams-course', 'maths-course'),
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
        ),
    );

    $meta_boxes[] = array(
        'title'	     => 'Extended course metadata (Maths & AMS)',
        'post_types' => array('ams-course', 'maths-course'),
        'fields'     => array(
			array(
                'id'   => 'courseSummary',
                'name' => 'Course Summary',
                'type' => 'wysiwyg',
                'desc' => 'Provides a summary field (used by Maths and AMS)',
				'options' => array(
					'media_buttons' => false,
					'textarea_rows' => 6
				)
            ),
			array(
                'id'   => 'courseDetailedAims',
                'name' => 'Course Detailed Aims',
                'type' => 'wysiwyg',
                'desc' => 'Provides a more detailed aims field (used by Maths and AMS)',
				'options' => array(
					'media_buttons' => false,
					'textarea_rows' => 6
				)
            ),
			array(
                'id'   => 'courseDetailedSyllabus',
                'name' => 'Course Detailed Syllabus',
                'type' => 'wysiwyg',
                'desc' => 'Provides a more detailed syllabus field (used by Maths and AMS)',
				'options' => array(
					'media_buttons' => false,
					'textarea_rows' => 6
				)
            ),
			array(
                'id'   => 'courseReadingList',
                'name' => 'Course Reading List',
                'type' => 'wysiwyg',
                'desc' => 'Provides a reading list field (used by Maths and AMS)',
				'options' => array(
					'media_buttons' => false,
					'textarea_rows' => 6
				)
            ),
			array(
                'id'   => 'courseDetailedLOs',
                'name' => 'Course Detailed Learning Outcomes',
                'type' => 'wysiwyg',
                'desc' => 'Provides a more detailed Learning Outcomes field 
				           (used by Maths and AMS)',
				'options' => array(
					'media_buttons' => false,
					'textarea_rows' => 6
				)
            ),
			array(
                'id'   => 'courseContactHours',
                'name' => 'Course Contact Hours',
                'type' => 'text',
                'desc' => 'The contact Hours for the course, (used by Maths)'
            ),
			array(
                'id'   => 'suppressPDFLink',
                'name' => 'Suppres pdf link',
                'type' => 'checkbox',
                'desc' => 'Do not automatically generate a link to a pdf with 
				           more information about course (check this only if 
				           you know such a file does not exist).',
				'std'  => 0
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
		  	echo ', ';  
			}
		}
		echo '</p>';
	}

}

function macs_print_course_leader_img( )
{
	if ( implode( '', rwmb_meta( 'courseLeader' ) ) )
	{
		echo '<div class="alignright" >';
        $people = rwmb_meta( 'courseLeader' );
        foreach ( $people as $person )
		{
			macs_print_person_img( $person );
		}
		echo '</div>';
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
			echo ' '; 
			} else {
		  	echo ' &amp; ';  
			}
		}
		if ( rwmb_meta( 'coursePrerequisitesText' ) )
		{
			echo ' '.rwmb_meta( 'coursePrerequisitesText' );
		}
		echo '.</p>';
	}
	elseif ( rwmb_meta( 'coursePrerequisitesText' ) )
	{
		echo '<p><strong>Pre-requisites:</strong> './/
			rwmb_meta( 'coursePrerequisitesText' ).'.</p>';
	}
	else 
	{
		echo '<p><strong>Pre-requisites:</strong> none.</p>';
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
			echo ' ';
			} else {
		  	echo ' &amp; ';  
			}
		}
		if ( rwmb_meta( 'courseLinkedCoursesText' ) )
		{
			echo ' '.rwmb_meta( 'courseLinkedCoursesText' );
		}
		echo '.</p>';
	}
	elseif ( rwmb_meta( 'courseLinkedCoursesText' ) )
	{
		echo '<p><strong>Linked course(s):</strong> './/
			rwmb_meta( 'courseLinkedCoursesText' ).'.</p>';
	}
}

function macs_print_course_summary( )
{
	if ( rwmb_meta( 'courseSummary' ) != '' ) {
	 	macs_print_html_metadata('courseSummary', 'Summary:');
	}
}

function macs_print_course_aims( )
{
	if ( rwmb_meta( 'courseDetailedAims' ) != '' ) {
	 	macs_print_html_metadata('courseDetailedAims', 'Aims:');
	} else {
	 	macs_print_html_metadata('courseAims', 'Aims:');
	}

}

function print_html_course_info( )
{
	if ( rwmb_meta( 'courseDetailedSyllabus' ) != '' ) {
	 	macs_print_html_metadata('courseDetailedSyllabus', 'Syllabus:');
	} else {
	 	macs_print_html_metadata('courseSyllabus', 'Syllabus:');
	}
	if ( rwmb_meta( 'courseDetailedLOs' ) != '' ) {
	 	macs_print_html_metadata('courseDetailedLOs', 'Learning Outcomes:');
	} else {
	 	macs_print_html_metadata('courseLOSM', 'Learning Outcomes: Subject Mastery');
	 	macs_print_html_metadata('courseLOPA', 'Learning Outcomes: Personal Abilities');	
	}
	if ( rwmb_meta( 'courseReadingList' ) != '' ) {
	 	macs_print_html_metadata('courseReadingList', 'Reading list:');
	}

 	macs_print_html_metadata('courseAssessmentMethods', 'Assessment Methods:');
}

function print_link_to_course_info_pdf( )
{
	$base_url = 'http://www.ma.hw.ac.uk/maths/courseinfo/';
	$course_code = rwmb_meta( 'courseCode' );
	$semester = wp_get_post_terms( get_the_ID(),
								    'semester', 
								    array('fields'=>'names') );
	echo '<p><strong>Further information:</strong> ';
	foreach ( $semester as $s ) 
	{
		$pdf_url = $base_url.$course_code.$s.'.pdf';
		echo '<a href="'.$pdf_url.'">';
		echo 'Syllabus, Number of lectures, Assessment, Learning Outcomes';
		echo '</a>.<br />';
	}
	echo '</p>';
}


function macs_print_course_details( )
{
	$post_type = get_post_type();
	if  ( 'maths-course' == $post_type )
	{ 
		if (   (0 == rwmb_meta( 'suppressPDFLink') )
            && ('' ==  rwmb_meta( 'courseDetailedSyllabus' ) ) 
            && ('' ==  rwmb_meta( 'courseDetailedLOs' ) )
			)
		{
			print_link_to_course_info_pdf( ); 
		} else {
			print_html_course_info( );
		}
	} else {
		print_html_course_info( );
	}
}

function macs_print_course_contact_hours( )
{
	if ( rwmb_meta( 'courseContactHours' ) != '' ) {
		echo '<p><strong>Contact Hours:</strong> './/
			rwmb_meta( 'courseContactHours' ).'.</p>';
	}
}

function macs_print_course_scqf_credits( )
{
	if ( rwmb_meta( 'courseSCQFcredits' ) != '' ) {
		echo '<p><strong>Credits:</strong> './/
			rwmb_meta( 'courseSCQFcredits' ).'.</p>';
	}
}

function macs_print_boiler_text( )
{
	if ('ams-course' == get_post_type() )
	{
		echo '<h2>Other Information</h2>';
		echo '<p><strong>Help:</strong> If you have any problems or questions
              regarding the course, you are encouraged to contact the lecturer</p>';
		echo '<p><strong>VISION:</strong> further information and course materials
              are available on <a href="http://vision.hw.ac.uk">VISION</a></p>';
	} 
}
