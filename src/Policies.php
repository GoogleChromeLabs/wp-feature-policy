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

		$policies = array(
			'accelerometer'        =>
			array(
				'title'          => __( 'Accelerometer', 'feature-policy' ),
				'default_origin' => Policy::ORIGIN_SELF,
			),
			'ambient-light-sensor' =>
			array(
				'title'          => __( 'Ambient Light Sensor', 'feature-policy' ),
				'default_origin' => Policy::ORIGIN_SELF,
			),
			'autoplay'             =>
			array(
				'title'          => __( 'Autoplay', 'feature-policy' ),
				'default_origin' => Policy::ORIGIN_SELF,
			),
			'camera'               =>
			array(
				'title'          => __( 'Camera', 'feature-policy' ),
				'default_origin' => Policy::ORIGIN_SELF,
			),
			'document-domain'      =>
			array(
				'title'          => __( 'document.domain', 'feature-policy' ),
				'default_origin' => Policy::ORIGIN_ANY,
			),
			'document-write'       =>
			array(
				'title'          => __( 'document.write()', 'feature-policy' ),
				'default_origin' => Policy::ORIGIN_ANY,
			),
			'encrypted-media'      =>
			array(
				'title'          => __( 'Encrypted Media', 'feature-policy' ),
				'default_origin' => Policy::ORIGIN_SELF,
			),
			'fullscreen'           =>
			array(
				'title'          => __( 'Fullscreen', 'feature-policy' ),
				'default_origin' => Policy::ORIGIN_SELF,
			),
			'geolocation'          =>
			array(
				'title'          => __( 'Geolocation', 'feature-policy' ),
				'default_origin' => Policy::ORIGIN_SELF,
			),
			'gyroscope'            =>
			array(
				'title'          => __( 'Gyroscope', 'feature-policy' ),
				'default_origin' => Policy::ORIGIN_SELF,
			),
			'layout-animations'    =>
			array(
				'title'          => __( 'Layout Animations', 'feature-policy' ),
				'default_origin' => Policy::ORIGIN_ANY,
			),
			'lazyload'             =>
			array(
				'title'          => __( 'Lazy Loading', 'feature-policy' ),
				'default_origin' => Policy::ORIGIN_ANY,
			),
			'legacy-image-formats' =>
			array(
				'title'          => __( 'Legacy Image Formats', 'feature-policy' ),
				'default_origin' => Policy::ORIGIN_ANY,
			),
			'magnetometer'         =>
			array(
				'title'          => __( 'Magnetometer', 'feature-policy' ),
				'default_origin' => Policy::ORIGIN_SELF,
			),
			'microphone'           =>
			array(
				'title'          => __( 'Microphone', 'feature-policy' ),
				'default_origin' => Policy::ORIGIN_SELF,
			),
			'midi'                 =>
			array(
				'title'          => __( 'Midi', 'feature-policy' ),
				'default_origin' => Policy::ORIGIN_SELF,
			),
			'oversized-images'     =>
			array(
				'title'          => __( 'Oversized Images', 'feature-policy' ),
				'default_origin' => Policy::ORIGIN_ANY,
			),
			'payment'              =>
			array(
				'title'          => __( 'Payment', 'feature-policy' ),
				'default_origin' => Policy::ORIGIN_SELF,
			),
			'picture-in-picture'   =>
			array(
				'title'          => __( 'Picture-in-Picture', 'feature-policy' ),
				'default_origin' => Policy::ORIGIN_ANY,
			),
			'speaker'              =>
			array(
				'title'          => __( 'Speaker', 'feature-policy' ),
				'default_origin' => Policy::ORIGIN_SELF,
			),
			'sync-script'          =>
			array(
				'title'          => __( 'Synchronous Scripts', 'feature-policy' ),
				'default_origin' => Policy::ORIGIN_ANY,
			),
			'sync-xhr'             =>
			array(
				'title'          => __( 'Synchronous XHR', 'feature-policy' ),
				'default_origin' => Policy::ORIGIN_ANY,
			),
			'unoptimized-images'   =>
			array(
				'title'          => __( 'Unoptimized Images', 'feature-policy' ),
				'default_origin' => Policy::ORIGIN_ANY,
			),
			'usb'                  =>
			array(
				'title'          => __( 'USB', 'feature-policy' ),
				'default_origin' => Policy::ORIGIN_ANY,
			),
			'vertical-scroll'      =>
			array(
				'title'          => __( 'Vertical Scroll', 'feature-policy' ),
				'default_origin' => Policy::ORIGIN_ANY,
			),
			'vr'                   =>
			array(
				'title'          => __( 'VR', 'feature-policy' ),
				'default_origin' => Policy::ORIGIN_SELF,
			),
		);

		$this->policies = array();
		foreach ( $policies as $feature => $feature_info ) {
			$this->policies[ $feature ] = new Policy(
				$feature,
				$feature_info
			);
		}

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
		$options  = array_filter( (array) get_option( self::OPTION_NAME, array() ) );
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
