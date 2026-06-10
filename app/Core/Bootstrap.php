<?php
/**
 * Bootstrap
 *
 * @package Nilambar\BikramDate
 */

declare(strict_types=1);

namespace Nilambar\BikramDate\Core;

use Nilambar\BikramDate\Admin\Admin;
use Nilambar\BikramDate\Hooks\Hooks;
use Nilambar\BikramDate\Options\Options;

/**
 * Bootstrap class.
 *
 * @since 1.0.0
 */
final class Bootstrap {

	/**
	 * Run the plugin.
	 *
	 * @since 1.0.0
	 */
	public static function run(): void {
		add_action(
			'plugins_loaded',
			static function () {
				load_plugin_textdomain( 'bikram-date', false, dirname( BIKRAM_DATE_BASE_FILENAME ) . '/languages' );
			}
		);

		( new Options() )->register();
		( new Admin() )->register();
		( new Hooks() )->register();
	}
}
