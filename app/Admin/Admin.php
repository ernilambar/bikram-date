<?php
/**
 * Admin
 *
 * @package Nilambar\BikramDate
 */

namespace Nilambar\BikramDate\Admin;

use Nilambar\BikramDate\Common\Helper;

/**
 * Admin class.
 *
 * @since 1.0.0
 */
class Admin {

	/**
	 * Register.
	 *
	 * @since 1.0.0
	 */
	public function register() {
		add_filter( 'plugin_action_links_' . BIKRAM_DATE_BASE_FILENAME, array( $this, 'customize_plugin_action_links' ) );
		add_action( 'optiz_after_field_bikmt_plugin_options_bikmt_format', array( $this, 'customize_format' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'load_assets' ) );
	}

	/**
	 * Customize plugin action links.
	 *
	 * @since 1.0.0
	 *
	 * @param array $actions Action links.
	 * @return array Modified action links.
	 */
	public function customize_plugin_action_links( $actions ) {
		$url = add_query_arg(
			array(
				'page' => BIKRAM_DATE_SLUG,
			),
			admin_url( 'options-general.php' )
		);

		$actions = array_merge(
			array(
				'settings' => '<a href="' . esc_url( $url ) . '">' . esc_html__( 'Settings', 'bikram-date' ) . '</a>',
			),
			$actions
		);

		return $actions;
	}

	/**
	 * Customize format field.
	 *
	 * @since 1.0.0
	 */
	public function customize_format() {
		$format_list = Helper::get_example_formats();
		?>

		<?php if ( ! empty( $format_list ) ) : ?>
			<div class="example-formats">
				<div class="format-list">
					<span class="title"><?php esc_html_e( 'Examples:', 'bikram-date' ); ?></span>
					<?php foreach ( $format_list as $item ) : ?>
						<a href="#" data-format="<?php echo esc_attr( $item['format'] ); ?>" title="<?php echo esc_attr( $item['format'] ); ?>"><?php echo esc_html( $item['label'] ); ?></a>
					<?php endforeach; ?>
				</div><!-- .format-list -->
			</div><!-- .example-formats -->
		<?php endif; ?>

		<div class="format-reference">
			<a href="#" class="btn-toggle-reference"><?php esc_html_e( 'Format Codes', 'bikram-date' ); ?></a>
			<div class="format-reference-content">
				<table>
					<tr class="heading">
						<td><?php esc_html_e( 'Symbol', 'bikram-date' ); ?></td>
						<td><?php esc_html_e( 'Description', 'bikram-date' ); ?></td>
						<td><?php esc_html_e( 'Example', 'bikram-date' ); ?></td>
					</tr>
					<tr>
						<td>Y</td>
						<td><?php esc_html_e( '4-digit year', 'bikram-date' ); ?></td>
						<td>२०७७</td>
					</tr>
					<tr>
						<td>y</td>
						<td><?php esc_html_e( '2-digit year', 'bikram-date' ); ?></td>
						<td>७७</td>
					</tr>
					<tr>
						<td>j</td>
						<td><?php esc_html_e( 'Day of month', 'bikram-date' ); ?></td>
						<td>८</td>
					</tr>
					<tr>
						<td>d</td>
						<td><?php esc_html_e( 'Day of month (padded)', 'bikram-date' ); ?></td>
						<td>०८</td>
					</tr>
					<tr>
						<td>F</td>
						<td><?php esc_html_e( 'Month name', 'bikram-date' ); ?></td>
						<td>जेठ</td>
					</tr>
					<tr>
						<td>n</td>
						<td><?php esc_html_e( 'Month number', 'bikram-date' ); ?></td>
						<td>२</td>
					</tr>
					<tr>
						<td>m</td>
						<td><?php esc_html_e( 'Month number (padded)', 'bikram-date' ); ?></td>
						<td>०२</td>
					</tr>
					<tr>
						<td>l</td>
						<td><?php esc_html_e( 'Weekday (full)', 'bikram-date' ); ?></td>
						<td>आइतबार</td>
					</tr>
					<tr>
						<td>D</td>
						<td><?php esc_html_e( 'Weekday (short)', 'bikram-date' ); ?></td>
						<td>आइत</td>
					</tr>
				</table>
			</div><!-- .format-reference-content -->
		</div><!-- .format-reference -->
		<?php
	}

	/**
	 * Load assets.
	 *
	 * @since 1.0.0
	 *
	 * @param string $hook Hook name.
	 */
	public function load_assets( $hook ) {
		if ( 'settings_page_bikram-date' !== $hook ) {
			return;
		}

		wp_enqueue_script( 'bikram-date-admin', BIKRAM_DATE_URL . '/build/admin.js', array(), BIKRAM_DATE_VERSION, true );
		wp_enqueue_style( 'bikram-date-admin', BIKRAM_DATE_URL . '/build/admin.css', array(), BIKRAM_DATE_VERSION );
	}
}
