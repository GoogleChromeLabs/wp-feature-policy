<?php
/**
 * Class Google\WP_Feature_Policy\Plugin
 *
 * @package   Google\WP_Feature_Policy
 * @copyright 2019 Google LLC
 * @license   GNU General Public License, version 2
 * @link      https://wordpress.org/plugins/feature-policy/
 */

namespace Google\WP_Feature_Policy;

/**
 * Main class for the plugin.
 *
 * @since 0.1.0
 */
class Plugin {

	/**
	 * Absolute path to the plugin main file.
	 *
	 * @since 0.1.0
	 * @var string
	 */
	protected $main_file;

	/**
	 * The feature policies controller instance.
	 *
	 * @since 0.1.0
	 * @var Policies
	 */
	protected $policies;

	/**
	 * The feature policies setting instance.
	 *
	 * @since 0.1.0
	 * @var Policies_Setting
	 */
	protected $policies_setting;

	/**
	 * Main instance of the plugin.
	 *
	 * @since 0.1.0
	 * @var Plugin|null
	 */
	protected static $instance = null;

	/**
	 * Sets the plugin main file.
	 *
	 * @since 0.1.0
	 *
	 * @param string $main_file Absolute path to the plugin main file.
	 */
	public function __construct( $main_file ) {
		$this->main_file = $main_file;

		$this->policies         = new Policies();
		$this->policies_setting = new Policies_Setting();
	}

	/**
	 * Registers the plugin with WordPress.
	 *
	 * @since 0.1.0
	 */
	public function register() {
		$this->policies_setting->register();

		add_filter(
			'user_has_cap',
			array( $this, 'grant_feature_policy_cap' )
		);

		add_action(
			'send_headers',
			function() {
				$policy_headers = new Policy_Headers( $this->policies, $this->policies_setting );
				$policy_headers->send_headers();
			}
		);

		add_action(
			'admin_menu',
			function() {
				$admin_screen = new Admin\Settings_Screen( $this->policies, $this->policies_setting );
				$admin_screen->register_menu();
			}
		);
	}

	/**
	 * Gets the plugin basename, which consists of the plugin directory name and main file name.
	 *
	 * @since 0.1.0
	 *
	 * @return string Plugin basename.
	 */
	public function basename() {
		return plugin_basename( $this->main_file );
	}

	/**
	 * Gets the absolute path for a path relative to the plugin directory.
	 *
	 * @since 0.1.0
	 *
	 * @param string $relative_path Optional. Relative path. Default '/'.
	 * @return string Absolute path.
	 */
	public function path( $relative_path = '/' ) {
		return plugin_dir_path( $this->main_file ) . ltrim( $relative_path, '/' );
	}

	/**
	 * Gets the full URL for a path relative to the plugin directory.
	 *
	 * @since 0.1.0
	 *
	 * @param string $relative_path Optional. Relative path. Default '/'.
	 * @return string Full URL.
	 */
	public function url( $relative_path = '/' ) {
		return plugin_dir_url( $this->main_file ) . ltrim( $relative_path, '/' );
	}

	/**
	 * Gets the URL to the plugin's settings screen.
	 *
	 * @since 0.1.0
	 *
	 * @return string Settings screen URL.
	 */
	public function settings_screen_url() {
		return add_query_arg( 'page', Admin\Settings_Screen::SLUG, admin_url( Admin\Settings_Screen::PARENT_SLUG ) );
	}

	/**
	 * Dynamically grants the 'manage_feature_policy' capability based on 'manage_options'.
	 *
	 * This method is hooked into the `user_has_cap` filter and can be unhooked and replaced with custom functionality
	 * if needed.
	 *
	 * @since 0.1.0
	 *
	 * @param array $allcaps Associative array of $cap => $grant pairs.
	 * @return array Filtered $allcaps array.
	 */
	public function grant_feature_policy_cap( array $allcaps ) {
		if ( isset( $allcaps['manage_options'] ) ) {
			$allcaps[ Admin\Settings_Screen::CAPABILITY ] = $allcaps['manage_options'];
		}

		return $allcaps;
	}

	/**
	 * Retrieves the main instance of the plugin.
	 *
	 * @since 0.1.0
	 *
	 * @return Plugin Plugin main instance.
	 */
	public static function instance() {
		return static::$instance;
	}

	/**
	 * Loads the plugin main instance and initializes it.
	 *
	 * @since 0.1.0
	 *
	 * @param string $main_file Absolute path to the plugin main file.
	 * @return bool True if the plugin main instance could be loaded, false otherwise.
	 */
	public static function load( $main_file ) {
		if ( null !== static::$instance ) {
			return false;
		}

		static::$instance = new static( $main_file );
		static::$instance->register();

		return true;
	}
}
