<?php
/**
 * Class Google\WP_Feature_Policy\Feature
 *
 * @package   Google\WP_Feature_Policy
 * @copyright 2019 Google LLC
 * @license   GNU General Public License, version 2
 * @link      https://wordpress.org/plugins/feature-policy/
 */

namespace Google\WP_Feature_Policy;

/**
 * Class representing a feature.
 *
 * @since 0.1.0
 */
class Feature {

	const ORIGIN_ANY  = '*';
	const ORIGIN_SELF = 'self';
	const ORIGIN_NONE = 'none';

	/**
	 * Feature name.
	 *
	 * @since 0.1.0
	 * @var string
	 */
	protected $name = '';

	/**
	 * Feature policy arguments.
	 *
	 * @since 0.1.0
	 * @var array
	 */
	protected $args = array();

	/**
	 * Constructor.
	 *
	 * Sets the feature name and arguments.
	 *
	 * @since 0.1.0
	 *
	 * @param string $name Feature name.
	 * @param array  $args {
	 *     Feature policy arguments.
	 *
	 *     @type string $title          User-facing feature title.
	 *     @type string $default_origin Default origin for the feature policy. Must be either "*" or "self".
	 *                                  Default is "*".
	 * }
	 */
	public function __construct( $name, array $args ) {
		$this->name = $name;
		$this->set_args( $args );
	}

	/**
	 * Magic isset-er.
	 *
	 * @since 0.1.0
	 *
	 * @param string $prop Property to check for.
	 * @return bool True if the property is set, false otherwise.
	 */
	public function __isset( $prop ) {
		if ( 'name' === $prop ) {
			return true;
		}

		return isset( $this->args[ $prop ] );
	}

	/**
	 * Magic getter.
	 *
	 * @since 0.1.0
	 *
	 * @param string $prop Property to get.
	 * @return mixed The property value, or null if property not set.
	 */
	public function __get( $prop ) {
		if ( 'name' === $prop ) {
			return $this->name;
		}

		if ( isset( $this->args[ $prop ] ) ) {
			return $this->args[ $prop ];
		}

		return null;
	}

	/**
	 * Sets the feature arguments.
	 *
	 * @since 0.1.0
	 *
	 * @param array $args List of feature arguments. See {@see Feature::__construct()} for a list of supported
	 *                    arguments.
	 */
	protected function set_args( array $args ) {
		$this->args = wp_parse_args(
			$args,
			array(
				'title'          => '',
				'default_origin' => self::ORIGIN_ANY,
			)
		);
	}
}
