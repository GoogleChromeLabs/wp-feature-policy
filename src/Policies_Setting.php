<?php
/**
 * Class Google\WP_Feature_Policy\Policies_Setting
 *
 * @package   Google\WP_Feature_Policy
 * @copyright 2019 Google LLC
 * @license   GNU General Public License, version 2
 * @link      https://wordpress.org/plugins/feature-policy/
 */

namespace Google\WP_Feature_Policy;

/**
 * Class representing the setting for feature policies.
 *
 * @since 0.1.0
 */
class Policies_Setting {

	const OPTION_NAME = 'feature_policy_features';

	/**
	 * Registers the admin screen with WordPress.
	 *
	 * @since 0.1.0
	 */
	public function register() {
		add_action(
			'init',
			function() {
				register_setting(
					Admin\Settings_Screen::SLUG,
					self::OPTION_NAME,
					array(
						'type'              => 'object',
						'description'       => __( 'Feature Policy features and their origins.', 'feature-policy' ),
						'sanitize_callback' => array( $this, 'sanitize' ),
						'default'           => array(),
					)
				);
			}
		);
	}

	/**
	 * Gets the features list from the option.
	 *
	 * @since 0.1.0
	 *
	 * @return array Associative array of $policy_name => $policy_origins pairs.
	 */
	public function get() {
		return array_filter( (array) get_option( self::OPTION_NAME, array() ) );
	}

	/**
	 * Sanitizes the value for the setting.
	 *
	 * @since 0.1.0
	 *
	 * @param mixed $value Unsanitized setting value.
	 * @return array Associative array of $policy_name => $policy_origins pairs.
	 */
	public function sanitize( $value ) {
		// TODO: This is probably too basic.
		if ( ! is_array( $value ) ) {
			return array();
		}
		return $value;
	}
}
