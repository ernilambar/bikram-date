<?php
/**
 * Plugin Name: Bikram Date
 * Plugin URI: https://github.com/ernilambar/bikram-date/
 * Description: Displays post dates in Nepali.
 * Version: 1.0.0
 * Requires at least: 6.9
 * Requires PHP: 8.0
 * Author: Nilambar Sharma
 * Author URI: https://www.nilambar.net/
 * License: GPLv2 or later
 * License URI: https://www.gnu.org/licenses/old-licenses/gpl-2.0.txt
 * Text Domain: bikram-date
 * Domain Path: /languages
 *
 * @package Nilambar\BikramDate
 */

namespace Nilambar\BikramDate;

use Nilambar\BikramDate\Core\Bootstrap;

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

define( 'BIKRAM_DATE_VERSION', '1.0.0' );
define( 'BIKRAM_DATE_SLUG', 'bikram-date' );
define( 'BIKRAM_DATE_BASENAME', basename( __DIR__ ) );
define( 'BIKRAM_DATE_BASE_FILENAME', plugin_basename( __FILE__ ) );
define( 'BIKRAM_DATE_DIR', rtrim( plugin_dir_path( __FILE__ ), '/' ) );
define( 'BIKRAM_DATE_URL', rtrim( plugin_dir_url( __FILE__ ), '/' ) );

// Include autoload.
if ( file_exists( BIKRAM_DATE_DIR . '/vendor/autoload.php' ) ) {
	require_once BIKRAM_DATE_DIR . '/vendor/autoload.php';
	require_once BIKRAM_DATE_DIR . '/vendor/ernilambar/optiz/init.php';
}

Bootstrap::run();
