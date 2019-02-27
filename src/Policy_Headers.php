<?php
/**
 * Class Google\WP_Feature_Policy\Policy_Headers
 *
 * @package   Google\WP_Feature_Policy
 * @copyright 2019 Google LLC
 * @license   GNU General Public License, version 2
 * @link      https://wordpress.org/plugins/feature-policy/
 */

namespace Google\WP_Feature_Policy;

/**
 * Class for controlling feature policy headers.
 *
 * @since 0.1.0
 */
class Policy_Headers {

	/**
	 * Policies controller instance.
	 *
	 * @since 0.1.0
	 * @var Policies
	 */
	protected $policies;

	/**
	 * Constructor.
	 *
	 * @since 0.1.0
	 *
	 * @param Policies $policies Policies controller instance.
	 */
	public function __construct( Policies $policies ) {
		$this->policies = $policies;
	}

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
	 * Gets the headers for all enabled feature policies.
	 *
	 * @since 0.1.0
	 *
	 * @return array List of policy headers.
	 */
	protected function get_policy_headers() {
		$options  = array_filter( (array) get_option( Policies::OPTION_NAME, array() ) );
		$policies = $this->policies->get_all();

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
