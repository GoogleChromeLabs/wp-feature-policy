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

	const OPTION_NAME = 'feature_policies';

	/**
	 * Internal storage for lazy-loaded policies, also to prevent double initialization.
	 *
	 * @since 0.1.0
	 * @var array
	 */
	protected $policies = array();

	/**
	 * Registers feature policies integration with WordPress.
	 *
	 * @since 0.1.0
	 */
	public function register() {
		add_action(
			'send_headers',
			function() {
				$headers = $this->get_policy_headers();
				foreach ( $headers as $header ) {
					$header->send();
				}
			}
		);
	}

	/**
	 * Gets the available feature policies definitions.
	 *
	 * @since 0.1.0
	 *
	 * @return array Associative array of $policy_name => $policy_instance pairs.
	 */
	public function get_policies() {
		if ( ! empty( $this->policies ) ) {
			return $this->policies;
		}

		$this->policies = array(
			// TODO: Add all feature policies with their definitions.
			'usb'           => new Policy(
				'usb',
				array(
					'title'          => __( 'USB', 'feature-policy' ),
					'default_origin' => Policy::ORIGIN_SELF,
				)
			),
			'unsized-media' => new Policy(
				'unsized-media',
				array(
					'title'          => __( 'Unsized Media', 'feature-policy' ),
					'default_origin' => Policy::ORIGIN_ANY,
				)
			),
		);

		return $this->policies;
	}

	/**
	 * Gets the headers for all enabled feature policies.
	 *
	 * @since 0.1.0
	 *
	 * @return array List of policy headers.
	 */
	protected function get_policy_headers() {
		$options  = get_option( self::OPTION_NAME );
		$policies = $this->get_policies();

		$headers = array();
		foreach ( $options as $policy_slug => $policy_origins ) {
			if ( ! isset( $policies[ $policy_slug ] ) ) {
				continue;
			}

			$headers[] = new Policy_Header( $policies[ $policy_slug ], $policy_origins );
		}

		return $headers;
	}
}
