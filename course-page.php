<?php
/**
 * The template used for displaying course info for all course types
 * Called from single-*-course.php
 *
 * @package ThemeGrill
 * @subpackage Accelerate
 * @subpackage macs-student
 * @since macs-student 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php do_action( 'accelerate_before_post_content' ); ?>

	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header>

	<div class="entry-content clearfix">
		<?php macs_print_course_leader_img(); ?>
		<?php macs_print_course_leader(); ?>
		<?php macs_print_course_aims(); ?>
		<h2>Detailed Information</h2>
		<?php macs_print_taxon( 'level' ); ?>
		<?php macs_print_course_prereqs(); ?>
		<?php macs_print_linked_courses(); ?>
		<?php macs_print_course_details(); ?> 
		<?php macs_print_course_contact_hours(); ?>
		<?php macs_print_taxon( 'location' ); ?>
		<?php macs_print_taxon( 'semester' ); ?>
		<?php macs_print_course_scqf_credits(); ?>
	</div>

	<?php do_action( 'accelerate_after_post_content' ); ?>
</article>
