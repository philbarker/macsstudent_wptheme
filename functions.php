<?php
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . 
'/style.css' );
}


@ini_set( 'upload_max_size' , '64M' );
@ini_set( 'post_max_size', '64M' );
@ini_set( 'max_execution_time', '300' );


add_action( 'widgets_init', 'my_register_sidebars' );

function macs_print_html_metadata($field_id, $lead_text)
{

	if ( rwmb_meta( $field_id ) )
	{
// to do: write style to support:
//	echo '<h3 class="subhead">'.$lead_text.'</h3> '.rwmb_meta( $field_id );
		echo '<p><strong>'.$lead_text.'</strong></p>'.rwmb_meta( $field_id );
	}
}

include 'macs-course-type.php';
include 'macs-person-type.php';
include 'macs-taxonomies.php';

function my_register_sidebars() {
 
    register_sidebar(array(
        'id' => 'ams',
        'name' => __('AMS_Sidebar'),
        'description' => __('Sidebar used on AMS pages'),
		'before_widget' 	=> '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  	=> '</aside>',
		'before_title'  	=> '<h3 class="widget-title"><span>',
		'after_title'   	=> '</span></h3>'
    ));
    register_sidebar(array(
        'id' => 'maths',
        'name' => __('Maths_Sidebar'),
        'description' => __('Sidebar used on Maths pages'),
		'before_widget' 	=> '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  	=> '</aside>',
		'before_title'  	=> '<h3 class="widget-title"><span>',
		'after_title'   	=> '</span></h3>'
    ));
    register_sidebar(array(
        'id' => 'cs',
        'name' => __('CS_Sidebar'),
        'description' => __('Sidebar used on CS Pages'),
		'before_widget' 	=> '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  	=> '</aside>',
		'before_title'  	=> '<h3 class="widget-title"><span>',
		'after_title'   	=> '</span></h3>'
    ));
	register_sidebar(array(
        'id' => 'edinburgh',
        'name' => __('Edinburgh_Sidebar'),
        'description' => __('Sidebar used on Edinburgh Pages'),
		'before_widget' 	=> '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  	=> '</aside>',
		'before_title'  	=> '<h3 class="widget-title"><span>',
		'after_title'   	=> '</span></h3>'
    ));
	register_sidebar(array(
        'id' => 'dubai',
        'name' => __('Dubai_Sidebar'),
        'description' => __('Sidebar used on Dubai Pages'),
		'before_widget' 	=> '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  	=> '</aside>',
		'before_title'  	=> '<h3 class="widget-title"><span>',
		'after_title'   	=> '</span></h3>'
    ));
	register_sidebar(array(
        'id' => 'malaysia',
        'name' => __('Malaysia_Sidebar'),
        'description' => __('Sidebar used on Malaysia Pages'),
		'before_widget' 	=> '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  	=> '</aside>',
		'before_title'  	=> '<h3 class="widget-title"><span>',
		'after_title'   	=> '</span></h3>'
    ));
	register_sidebar(array(
        'id' => 'alp',
        'name' => __('ALP_Sidebar'),
        'description' => __('Sidebar used on ALP Pages'),
		'before_widget' 	=> '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  	=> '</aside>',
		'before_title'  	=> '<h3 class="widget-title"><span>',
		'after_title'   	=> '</span></h3>'
    ));
	register_sidebar(array(
        'id' => 'pgr',
        'name' => __('PGR_Sidebar'),
        'description' => __('Sidebar used on PGR Pages'),
		'before_widget' 	=> '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  	=> '</aside>',
		'before_title'  	=> '<h3 class="widget-title"><span>',
		'after_title'   	=> '</span></h3>'
    ));
}


?>
