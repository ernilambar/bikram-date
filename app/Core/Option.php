<?php
/**
 * Option
 *
 * @package Nilambar\BikramDate
 */

namespace Nilambar\BikramDate\Core;

use Nilambar\Optiz\Manager;

/**
 * Option class.
 *
 * @since 1.0.0
 */
class Option {

	/**
	 * Return plugin option.
	 *
	 * @since 1.0.0
	 *
	 * @param string $key Option key.
	 * @return mixed Option value.
	 */
	public static function get( $key ) {
		return Manager::instance( 'bikmt_options' )->get( $key );
	}
}
