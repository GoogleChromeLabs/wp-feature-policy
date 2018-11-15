<?php
/**
 * Class Google\WP_Feature_Policy\Policy
 *
 * @package Google\WP_Feature_Policy
 * @license GNU General Public License, version 2
 * @link    https://wordpress.org/plugins/feature-policy/
 */

namespace Google\WP_Feature_Policy;

/**
 * Class representing a feature policy.
 *
 * @since 0.1.0
 */
class Policy {

	/**
	 * Feature policy name.
	 *
	 * @since 0.1.0
	 * @var string
	 */
	public $name = '';

	/**
	 * User-facing feature policy title.
	 *
	 * @since 0.1.0
	 * @var string
	 */
	public $title = '';

	/**
	 * Default origin for the feature policy.
	 *
	 * @since 0.1.0
	 * @var string
	 */
	public $default_origin = '*';

	/**
	 * Constructor.
	 *
	 * Sets the feature policy name and arguments.
	 *
	 * @since 0.1.0
	 *
	 * @param string $name Feature policy name.
	 * @param array  $args {
	 *     Feature policy arguments.
	 *
	 *     @type string $title          User-facing feature policy title.
	 *     @type string $default_origin Default origin for the feature policy. Must be either "*" or "self".
	 *                                  Default is "*".
	 * }
	 */
	public function __construct( $name, array $args ) {
		$this->name = $name;
		$this->set_args( $args );
	}

	/**
	 * Sets the feature policy arguments.
	 *
	 * @since 0.1.0
	 *
	 * @param array $args List of feature policy arguments. See {@see Policy::__construct()} for a list of supported
	 *                    arguments.
	 */
	protected function set_args( array $args ) {
		foreach ( $args as $key => $value ) {
			if ( ! property_exists( $this, $key ) ) {
				continue;
			}

			$this->$key = $value;
		}
	}
}
