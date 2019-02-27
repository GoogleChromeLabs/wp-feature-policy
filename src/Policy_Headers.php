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
	 * Feature policies setting instance.
	 *
	 * @since 0.1.0
	 * @var Policies_Setting
	 */
	protected $policies_setting;

	/**
	 * Constructor.
	 *
	 * @since 0.1.0
	 *
	 * @param Policies         $policies         Feature policies controller instance.
	 * @param Policies_Setting $policies_setting Feature policies setting instance.
	 */
	public function __construct( Policies $policies, Policies_Setting $policies_setting ) {
		$this->policies         = $policies;
		$this->policies_setting = $policies_setting;
	}

	/**
	 * Sends feature policy headers.
	 *
	 * @since 0.1.0
	 */
	public function send_headers() {
		$headers = $this->get_policy_headers();
		foreach ( $headers as $header ) {
			$header->send();
		}
	}

	/**
	 * Gets the headers for all enabled feature policies.
	 *
	 * @since 0.1.0
	 *
	 * @return array List of policy headers.
	 */
	protected function get_policy_headers() {
		$policies = $this->policies->get_all();
		$option   = $this->policies_setting->get();

		$headers = array();
		foreach ( $option as $policy_slug => $policy_origins ) {
			if ( ! isset( $policies[ $policy_slug ] ) ) {
				continue;
			}

			$headers[] = new Policy_Header( $policies[ $policy_slug ], $policy_origins );
		}

		return $headers;
	}
}
