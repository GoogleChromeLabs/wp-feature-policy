<?php
/**
 * Class Google\WP_Feature_Policy\Policy_Header
 *
 * @package Google\WP_Feature_Policy
 * @license GNU General Public License, version 2
 * @link    https://wordpress.org/plugins/feature-policy/
 */

namespace Google\WP_Feature_Policy;

/**
 * Class representing an HTTP header for a feature policy.
 *
 * @since 0.1.0
 */
class Policy_Header {

	/**
	 * Policy that the header represents.
	 *
	 * @since 0.1.0
	 * @var Policy
	 */
	protected $policy;

	/**
	 * Origins for the header.
	 *
	 * @since 0.1.0
	 * @var array
	 */
	protected $origins = array();

	/**
	 * Constructor.
	 *
	 * @since 0.1.0
	 *
	 * @param Policy $policy  Policy that the header represents.
	 * @param array  $origins Origins for the header.
	 */
	public function __construct( Policy $policy, array $origins ) {
		$this->policy  = $policy;
		$this->origins = $origins;
	}
}
