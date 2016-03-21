<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package ThemeGrill
 * @subpackage Accelerate
 * @since Accelerate 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php do_action( 'accelerate_before_post_content' ); ?>

	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header>

	<div class="entry-content clearfix">
		<?php macs_print_course_code(); ?>
		<?php macs_print_course_leader(); ?>
		<?php macs_print_course_leader_img(); ?>
		<?php macs_print_course_prereqs(); ?>
		<?php macs_print_linked_courses(); ?>
		<?php macs_print_course_aims_objectives(); ?>




	</div>

	<?php do_action( 'accelerate_after_post_content' ); ?>
</article>
