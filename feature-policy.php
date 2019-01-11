<?php
/**
 * Plugin initialization file
 *
 * @package Google\WP_Feature_Policy
 * @license GNU General Public License, version 2
 * @link    https://wordpress.org/plugins/feature-policy/
 *
 * @wordpress-plugin
 * Plugin Name: Feature Policy
 * Plugin URI:  https://wordpress.org/plugins/feature-policy/
 * Description: WordPress plugin for managing feature policy headers.
 * Version:     0.1.0
 * Author:      Google
 * Author URI:  https://opensource.google.com/
 * License:     GNU General Public License v2 (or later)
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: feature-policy
 * Tags:        feature, policy
 */

/* This file must be parseable by PHP 5.2. */

/**
 * Loads the plugin.
 *
 * @since 0.1.0
 */
function _wp_feature_policy_load() {
	if ( version_compare( phpversion(), '5.6', '<' ) ) {
		add_action( 'admin_notices', '_wp_feature_policy_display_php_version_notice' );
		return;
	}

	if ( version_compare( get_bloginfo( 'version' ), '4.7', '<' ) ) {
		add_action( 'admin_notices', '_wp_feature_policy_display_wp_version_notice' );
		return;
	}

	if ( ! file_exists( __DIR__ . '/vendor/autoload.php' ) ) {
		add_action( 'admin_notices', '_wp_feature_policy_display_composer_install_requirement' );
		return;
	}

	require_once __DIR__ . '/vendor/autoload.php';

	call_user_func( array( 'Google\\WP_Feature_Policy\\Plugin', 'load' ), __FILE__ );
}

/**
 * Displays an admin notice about an unmet PHP version requirement.
 *
 * @since 0.1.0
 */
function _wp_feature_policy_display_php_version_notice() {
	?>
	<div class="notice notice-error">
		<p>
			<?php
			sprintf(
				/* translators: 1: required version, 2: currently used version */
				__( 'Feature Policy requires at least PHP version %1$s. Your site is currently running on PHP %2$s.', 'feature-policy' ),
				'5.6',
				phpversion()
			);
			?>
		</p>
	</div>
	<?php
}

/**
 * Displays an admin notice about an unmet WordPress version requirement.
 *
 * @since 0.1.0
 */
function _wp_feature_policy_display_wp_version_notice() {
	?>
	<div class="notice notice-error">
		<p>
			<?php
			sprintf(
				/* translators: 1: required version, 2: currently used version */
				__( 'Feature Policy requires at least WordPress version %1$s. Your site is currently running on WordPress %2$s.', 'feature-policy' ),
				'4.7',
				get_bloginfo( 'version' )
			);
			?>
		</p>
	</div>
	<?php
}

/**
 * Displays an admin notice about the need to run composer install.
 *
 * @since 0.1.0
 */
function _wp_feature_policy_display_composer_install_requirement() {
	?>
	<div class="notice notice-error">
		<p>
			<?php
			printf(
				/* translators: %s is the composer install command */
				esc_html__(
					'The Feature Policy plugin appears to being run from source and requires %s to complete the plugin\'s installation.',
					'feature-policy'
				),
				'<code>composer install</code>'
			);
			?>
		</p>
	</div>
	<?php
}

_wp_feature_policy_load();
