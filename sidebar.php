<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package ThemeGrill
 * @subpackage Accelerate
 * @since Accelerate 1.0
 */
?>

<div id="secondary">
	<?php do_action( 'accelerate_before_sidebar' ); ?>
		<?php 
			if( is_page_template( 'page-templates/contact.php' ) ) {
				$sidebar = 'accelerate_contact_page_sidebar';
				}
				elseif( is_page_template( 'page-templates/ams.php' ) ) {
				$sidebar = 'ams';
				}
				elseif( is_page_template( 'page-templates/maths.php' ) ) {
				$sidebar = 'maths';
				}
				elseif( is_page_template( 'page-templates/cs.php' ) ) {
				$sidebar = 'cs';
				}
				elseif( is_page_template( 'page-templates/edinburgh.php' ) ) {
				$sidebar = 'edinburgh';
				}
				elseif( is_page_template( 'page-templates/dubai.php' ) ) {
				$sidebar = 'dubai';
				}
				elseif( is_page_template( 'page-templates/malaysia.php' ) ) {
				$sidebar = 'malaysia';
				}
				elseif( is_page_template( 'page-templates/alp.php' ) ) {
				$sidebar = 'alp';
				}
				elseif( is_page_template( 'page-templates/pgr.php' ) ) {
				$sidebar = 'pgr';
				}
			else {
				$sidebar = 'accelerate_right_sidebar';
			}
		?>

		<?php if ( ! dynamic_sidebar( $sidebar ) ) : ?>

			<aside id="search" class="widget widget_search">
				<?php get_search_form(); ?>
			</aside>

			<aside id="archives" class="widget">
				<h3 class="widget-title"><span><?php _e( 'Archives', 'accelerate' ); ?></span></h3>
				<ul>
					<?php wp_get_archives( array( 'type' => 'monthly' ) ); ?>
				</ul>
			</aside>

			<aside id="meta" class="widget">
				<h3 class="widget-title"><span><?php _e( 'Meta', 'accelerate' ); ?></span></h3>
				<ul>
					<?php wp_register(); ?>
					<li><?php wp_loginout(); ?></li>
					<?php wp_meta(); ?>
				</ul>
			</aside>

		<?php endif; ?>
	<?php do_action( 'accelerate_after_sidebar' ); ?>
</div>