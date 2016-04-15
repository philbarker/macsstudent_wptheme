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
		<h2 class="entry-title">
			<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute();?>"><?php the_title(); ?></a>
		</h2>
	</header>

	<div class="entry-content clearfix">
		<?php macs_print_course_leader(); ?>
		<?php macs_print_course_aims(); ?>
	</div>

	<?php do_action( 'accelerate_after_post_content' ); ?>
</article>
