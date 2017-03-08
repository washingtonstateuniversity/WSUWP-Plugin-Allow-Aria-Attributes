<?php

class WSUWP_Allow_Aria_Attributes {
	/**
	 * @var WSUWP_Allow_Aria_Attributes
	 */
	private static $instance;

	/**
	 * Maintain and return the one instance. Initiate hooks when
	 * called the first time.
	 *
	 * @since 0.0.1
	 *
	 * @return \WSUWP_Allow_Aria_Attributes
	 */
	public static function get_instance() {
		if ( ! isset( self::$instance ) ) {
			self::$instance = new WSUWP_Allow_Aria_Attributes();
			self::$instance->setup_hooks();
		}
		return self::$instance;
	}

	/**
	 * Setup hooks to include.
	 *
	 * @since 0.0.1
	 */
	public function setup_hooks() {
		add_filter( 'wp_kses_allowed_html', array( $this, 'allowed_aria_attributes' ), 10, 2 );
	}

	/**
	 * Filters the list of allowed elements and attributes when saving content.
	 *
	 * @since 0.0.1
	 *
	 * @param array  $allowedposttags
	 * @param string $context
	 *
	 * @return array
	 */
	public function allowed_aria_attributes( $allowedposttags, $context ) {
		if ( 'post' !== $context ) {
			return $allowedposttags;
		}

		$allowedposttags = array_map( 'WSUWP_Allow_Aria_Attributes::merge_allowed_aria_attributes', $allowedposttags );

		return $allowedposttags;
	}

	/**
	 * Merges a preset list of aria attributes into an allowed HTML element's array
	 * of allowed attributes.
	 *
	 * @since 0.0.1
	 *
	 * @param bool|array $value
	 *
	 * @return array
	 */
	public static function merge_allowed_aria_attributes( $value ) {
		$aria_attributes = array(
			'aria-label' => true,
			'aria-labelledby' => true,
			'aria-hidden' => true,
			'aria-describedby' => true,
		);

		if ( true === $value ) {
			$value = array();
		}

		if ( is_array( $value ) ) {
			return array_merge( $value, $aria_attributes );
		}

		return $value;
	}
}
