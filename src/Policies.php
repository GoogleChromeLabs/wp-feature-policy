<?php
/**
 * Class Google\WP_Feature_Policy\Policies
 *
 * @package Google\WP_Feature_Policy
 * @license GNU General Public License, version 2
 * @link    https://wordpress.org/plugins/feature-policy/
 */

namespace Google\WP_Feature_Policy;

/**
 * Class for controlling feature policies.
 *
 * @since 0.1.0
 */
class Policies {

	/**
	 * Registers feature policies integration with WordPress.
	 *
	 * @since 0.1.0
	 */
	public function register() {
		// TODO: Add hooks to integrate with WordPress.
	}

	public function get_policy_headers() {
		$options = get_option( 'TODO' );
		$policies = $this->get_policies();

		$headers = array();
		foreach ( $options as $policy_slug => $policy_origins ) {
			$headers[] = new Policy_Header( $policies[ $policy_slug ], $policy_origins );
		}

		return $headers;
	}

	public function get_policies() {
		$policies = array(
			'usb' => new Policy(
				'usb',
				array(
					'title'          => __( 'USB', 'feature-policy' ),
					'default_origin' => 'self',
				)
			),
		);

		return $policies;
	}
}
