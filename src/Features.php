<?php
/**
 * Class Google\WP_Feature_Policy\Features
 *
 * @package   Google\WP_Feature_Policy
 * @copyright 2019 Google LLC
 * @license   GNU General Public License, version 2
 * @link      https://wordpress.org/plugins/feature-policy/
 */

namespace Google\WP_Feature_Policy;

/**
 * Class for controlling features.
 *
 * @since 0.1.0
 */
class Features {

	/**
	 * Internal storage for lazy-loaded features, also to prevent double initialization.
	 *
	 * @since 0.1.0
	 * @var array
	 */
	protected $features = array();

	/**
	 * Gets all the available features.
	 *
	 * @since 0.1.0
	 *
	 * @return array Associative array of $feature_name => $feature_instance pairs.
	 */
	public function get_all() {
		if ( ! empty( $this->features ) ) {
			return $this->features;
		}

		$features = array(
			'accelerometer'        => array(
				'title'          => __( 'Accelerometer', 'feature-policy' ),
				'default_origin' => Feature::ORIGIN_SELF,
			),
			'ambient-light-sensor' => array(
				'title'          => __( 'Ambient Light Sensor', 'feature-policy' ),
				'default_origin' => Feature::ORIGIN_SELF,
			),
			'autoplay'             => array(
				'title'          => __( 'Autoplay', 'feature-policy' ),
				'default_origin' => Feature::ORIGIN_SELF,
			),
			'camera'               => array(
				'title'          => __( 'Camera', 'feature-policy' ),
				'default_origin' => Feature::ORIGIN_SELF,
			),
			'document-domain'      => array(
				'title'          => __( 'document.domain', 'feature-policy' ),
				'default_origin' => Feature::ORIGIN_ANY,
			),
			'document-write'       => array(
				'title'          => __( 'document.write()', 'feature-policy' ),
				'default_origin' => Feature::ORIGIN_ANY,
			),
			'encrypted-media'      => array(
				'title'          => __( 'Encrypted Media', 'feature-policy' ),
				'default_origin' => Feature::ORIGIN_SELF,
			),
			'fullscreen'           => array(
				'title'          => __( 'Fullscreen', 'feature-policy' ),
				'default_origin' => Feature::ORIGIN_SELF,
			),
			'geolocation'          => array(
				'title'          => __( 'Geolocation', 'feature-policy' ),
				'default_origin' => Feature::ORIGIN_SELF,
			),
			'gyroscope'            => array(
				'title'          => __( 'Gyroscope', 'feature-policy' ),
				'default_origin' => Feature::ORIGIN_SELF,
			),
			'layout-animations'    => array(
				'title'          => __( 'Layout Animations', 'feature-policy' ),
				'default_origin' => Feature::ORIGIN_ANY,
			),
			'lazyload'             => array(
				'title'          => __( 'Lazy Loading', 'feature-policy' ),
				'default_origin' => Feature::ORIGIN_ANY,
			),
			'legacy-image-formats' => array(
				'title'          => __( 'Legacy Image Formats', 'feature-policy' ),
				'default_origin' => Feature::ORIGIN_ANY,
			),
			'magnetometer'         => array(
				'title'          => __( 'Magnetometer', 'feature-policy' ),
				'default_origin' => Feature::ORIGIN_SELF,
			),
			'microphone'           => array(
				'title'          => __( 'Microphone', 'feature-policy' ),
				'default_origin' => Feature::ORIGIN_SELF,
			),
			'midi'                 => array(
				'title'          => __( 'Midi', 'feature-policy' ),
				'default_origin' => Feature::ORIGIN_SELF,
			),
			'oversized-images'     => array(
				'title'          => __( 'Oversized Images', 'feature-policy' ),
				'default_origin' => Feature::ORIGIN_ANY,
			),
			'payment'              => array(
				'title'          => __( 'Payment', 'feature-policy' ),
				'default_origin' => Feature::ORIGIN_SELF,
			),
			'picture-in-picture'   => array(
				'title'          => __( 'Picture-in-Picture', 'feature-policy' ),
				'default_origin' => Feature::ORIGIN_ANY,
			),
			'speaker'              => array(
				'title'          => __( 'Speaker', 'feature-policy' ),
				'default_origin' => Feature::ORIGIN_SELF,
			),
			'sync-script'          => array(
				'title'          => __( 'Synchronous Scripts', 'feature-policy' ),
				'default_origin' => Feature::ORIGIN_ANY,
			),
			'sync-xhr'             => array(
				'title'          => __( 'Synchronous XHR', 'feature-policy' ),
				'default_origin' => Feature::ORIGIN_ANY,
			),
			'unoptimized-images'   => array(
				'title'          => __( 'Unoptimized Images', 'feature-policy' ),
				'default_origin' => Feature::ORIGIN_ANY,
			),
			'unsized-media'        => array(
				'title'          => __( 'Unsized Media', 'feature-policy' ),
				'default_origin' => Feature::ORIGIN_ANY,
			),
			'usb'                  => array(
				'title'          => __( 'USB', 'feature-policy' ),
				'default_origin' => Feature::ORIGIN_ANY,
			),
			'vertical-scroll'      => array(
				'title'          => __( 'Vertical Scroll', 'feature-policy' ),
				'default_origin' => Feature::ORIGIN_ANY,
			),
			'vr'                   => array(
				'title'          => __( 'VR', 'feature-policy' ),
				'default_origin' => Feature::ORIGIN_SELF,
			),
		);

		$this->features = array();
		foreach ( $features as $feature => $feature_info ) {
			$this->features[ $feature ] = new Feature(
				$feature,
				$feature_info
			);
		}

		return $this->features;
	}
}
