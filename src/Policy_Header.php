<?php
/**
 * Class Google\WP_Feature_Policy\Policy_Header
 *
 * @package   Google\WP_Feature_Policy
 * @copyright 2019 Google LLC
 * @license   GNU General Public License, version 2
 * @link      https://wordpress.org/plugins/feature-policy/
 */

namespace Google\WP_Feature_Policy;

/**
 * Class representing an HTTP header for a feature policy.
 *
 * @since 0.1.0
 */
class Policy_Header {

	/**
	 * Feature that the header represents.
	 *
	 * @since 0.1.0
	 * @var Feature
	 */
	protected $feature;

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
	 * @param Feature $feature Feature that the header represents.
	 * @param array   $origins Origins for the header.
	 */
	public function __construct( Feature $feature, array $origins ) {
		$this->feature = $feature;
		$this->origins = $origins;
	}

	/**
	 * Sends the header.
	 *
	 * @since 0.1.0
	 *
	 * @return bool True on success, false on failure.
	 */
	public function send() {
		if ( headers_sent() ) {
			return false;
		}

		$value = $this->get_value();
		if ( empty( $this->origins ) || array( $this->feature->default_origin ) === $this->origins ) {
			return false;
		}

		header( "Feature-Policy: {$value}", false );

		return true;
	}

	/**
	 * Gets the value for the header.
	 *
	 * @since 0.1.0
	 *
	 * @return string Value for the HTTP header.
	 */
	protected function get_value() {
		$value = $this->feature->name;

		foreach ( $this->origins as $origin ) {
			if ( Feature::ORIGIN_SELF === $origin || Feature::ORIGIN_NONE === $origin ) {
				$value .= " '{$origin}'";
				continue;
			}

			$value .= " {$origin}";
		}

		return $value;
	}
}
