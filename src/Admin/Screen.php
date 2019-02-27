<?php
/**
 * Class Google\WP_Feature_Policy\Admin\Screen
 *
 * @package   Google\WP_Feature_Policy
 * @copyright 2019 Google LLC
 * @license   GNU General Public License, version 2
 * @link      https://wordpress.org/plugins/feature-policy/
 */

namespace Google\WP_Feature_Policy\Admin;

use Google\WP_Feature_Policy\Policies;
use Google\WP_Feature_Policy\Policy;
use Google\WP_Feature_Policy\Policies_Setting;

/**
 * Class for the admin screen to control feature policies.
 *
 * @since 0.1.0
 */
class Screen {

	const PAGE_SLUG = 'feature_policy';

	/**
	 * Feature policies controller instance.
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
	 * Registers the admin screen with WordPress.
	 *
	 * @since 0.1.0
	 */
	public function register() {
		add_action(
			'admin_menu',
			function() {
				$hook_suffix = add_options_page(
					__( 'Feature Policy', 'feature-policy' ),
					__( 'Feature Policy', 'feature-policy' ),
					'manage_options',
					self::PAGE_SLUG,
					array( $this, 'render' )
				);
				add_action(
					"load-{$hook_suffix}",
					function() {
						$this->add_settings_ui();
					}
				);
			}
		);

	}

	/**
	 * Renders the admin screen.
	 *
	 * @since 0.1.0
	 */
	public function render() {
		?>
		<div class="wrap">
			<h1><?php esc_html_e( 'Feature Policy', 'feature-policy' ); ?></h1>

			<form action="options.php" method="post" novalidate="novalidate">
				<?php settings_fields( self::PAGE_SLUG ); ?>
				<?php do_settings_sections( self::PAGE_SLUG ); ?>
				<?php submit_button(); ?>
			</form>
		</div>
		<?php
	}

	/**
	 * Adds settings sections and fields.
	 *
	 * @since 0.1.0
	 */
	protected function add_settings_ui() {
		add_settings_section( 'default', '', null, self::PAGE_SLUG );

		$policies = $this->policies->get_all();
		$option   = $this->policies_setting->get();

		foreach ( $policies as $policy ) {
			add_settings_field(
				$policy->name,
				$policy->title,
				function( $args ) use ( $policy, $option ) {
					$origin = isset( $option[ $policy->name ] ) ? $option[ $policy->name ][0] : $policy->default_origin;
					$this->render_field( $policy, $origin );
				},
				self::PAGE_SLUG,
				'default',
				array( 'label_for' => $policy->name )
			);
		}
	}

	/**
	 * Renders the UI field for determining the status of a feature policy.
	 *
	 * @since 0.1.0
	 *
	 * @param Policy $policy Feature policy definition.
	 * @param string $origin Origin set for the feature policy.
	 */
	protected function render_field( Policy $policy, $origin ) {
		$choices = array(
			Policy::ORIGIN_ANY  => __( 'Any', 'feature-policy' ),
			Policy::ORIGIN_SELF => __( 'Self', 'feature-policy' ),
			Policy::ORIGIN_NONE => __( 'None', 'feature-policy' ),
		);

		?>
		<select id="<?php echo esc_attr( $policy->name ); ?>" name="<?php echo esc_attr( Policies_Setting::OPTION_NAME . '[' . $policy->name . '][]' ); ?>">
			<?php
			foreach ( $choices as $value => $label ) {
				?>
				<option value="<?php echo esc_attr( $value ); ?>"<?php selected( $origin, $value ); ?>>
					<?php echo esc_html( $label ); ?>
					<?php if ( $value === $policy->default_origin ) : ?>
						<?php esc_html_e( '(default)', 'feature-policy' ); ?>
					<?php endif; ?>
				</option>
				<?php
			}
			?>
		</select>
		<?php if ( $origin !== $policy->default_origin ) : ?>
			<?php esc_html_e( '(overridden)', 'feature-policy' ); ?>
		<?php endif; ?>
		<?php
	}
}
