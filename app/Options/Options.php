<?php
/**
 * Options
 *
 * @package Nilambar\BikramDate
 */

namespace Nilambar\BikramDate\Options;

use Nilambar\Optiz\Manager;

/**
 * Options class.
 *
 * @since 1.0.0
 */
class Options {

	/**
	 * Register.
	 *
	 * @since 1.0.0
	 */
	public function register() {
		add_action( 'init', array( $this, 'register_plugin_options' ), 20 );
	}

	/**
	 * Register plugin options.
	 *
	 * @since 1.0.0
	 */
	public function register_plugin_options() {
		Manager::register(
			'bikmt_options',
			array(
				'option_key' => 'bikmt_plugin_options',
				'page'       => array(
					'title'       => esc_html_x( 'Bikram Date', 'page title', 'bikram-date' ),
					'menu_title'  => esc_html_x( 'Bikram Date', 'menu title', 'bikram-date' ),
					'menu_slug'   => 'bikram-date',
					'capability'  => 'manage_options',
					'parent_slug' => 'options-general.php',
				),
				'tabs'       => array(
					array(
						'id'     => 'bikmt_settings',
						'label'  => esc_html__( 'Settings', 'bikram-date' ),
						'fields' => array(
							array(
								'id'      => 'bikmt_language',
								'type'    => 'radio',
								'label'   => esc_html__( 'Display Language', 'bikram-date' ),
								'default' => 'np',
								'layout'  => 'horizontal',
								'choices' => array(
									'np' => esc_html__( 'Nepali', 'bikram-date' ),
									'en' => esc_html__( 'English', 'bikram-date' ),
								),
							),
							array(
								'id'      => 'bikmt_format',
								'type'    => 'text',
								'label'   => esc_html__( 'Date Format', 'bikram-date' ),
								'default' => 'd F Y',
								'class'   => 'field-bikmt_format',
							),
						),
					),
				),
			)
		);
	}
}
