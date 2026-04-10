<?php
/**
 * Turnstile Rendering Functions
 *
 * @package ElementsHiveForBreakdance
 */

namespace ElementsHiveForBreakdance\CloudflareTurnstile;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Render Turnstile widget field
 *
 * @param array      $form Form data.
 * @param string|int $unique_id Unique ID for this instance.
 * @return void
 */
function render_turnstile_field( $form, $unique_id ) {
	$site_key = get_turnstile_site_key( $form );

	if ( empty( $site_key ) ) {
		return;
	}

	$cloudflare_turnstile = isset( $form['cloudflare_turnstile'] ) ? $form['cloudflare_turnstile'] : [];
	$widget_id = 'eh-turnstile-' . $unique_id;
	$success_callback = 'ehTurnstileSuccess' . $unique_id;
	$state_change_callback = 'ehTurnstileStateChange' . $unique_id;
	$error_callback = 'ehTurnstileError' . $unique_id;

	$size = isset( $cloudflare_turnstile['size'] ) ? $cloudflare_turnstile['size'] : 'normal';
	$appearance = isset( $cloudflare_turnstile['appearance'] ) ? $cloudflare_turnstile['appearance'] : 'always';
	$theme = isset( $cloudflare_turnstile['theme'] ) ? $cloudflare_turnstile['theme'] : 'light';
	$disable_submit_until_verified = isset( $cloudflare_turnstile['disable_submit_until_verified'] ) ? true === $cloudflare_turnstile['disable_submit_until_verified'] : false;

	?>
	<div id="<?php echo esc_attr( $widget_id ); ?>"
		class="cf-turnstile"
		data-sitekey="<?php echo esc_attr( $site_key ); ?>"
		data-theme="<?php echo esc_attr( $theme ); ?>"
		data-language="auto"
		data-size="<?php echo esc_attr( $size ); ?>"
		data-appearance="<?php echo esc_attr( $appearance ); ?>"
		data-action="breakdance-form-<?php echo esc_attr( $unique_id ); ?>"
		data-disable-submit-until-verified="<?php echo esc_attr( $disable_submit_until_verified ? 'true' : 'false' ); ?>"
		data-callback="<?php echo esc_attr( $success_callback ); ?>"
		data-expired-callback="<?php echo esc_attr( $state_change_callback ); ?>"
		data-error-callback="<?php echo esc_attr( $error_callback ); ?>"
		data-retry="auto"
		data-retry-interval="1000">
	</div>
	<script>
	window.<?php echo esc_js( $success_callback ); ?> = function() {
		if (typeof window.ehTurnstileHandleSuccessForWidget === 'function') {
			window.ehTurnstileHandleSuccessForWidget('<?php echo esc_js( $widget_id ); ?>');
		}
	};
	window.<?php echo esc_js( $state_change_callback ); ?> = function() {
		if (typeof window.ehTurnstileHandleStateChangeForWidget === 'function') {
			window.ehTurnstileHandleStateChangeForWidget('<?php echo esc_js( $widget_id ); ?>');
		}
	};
	window.<?php echo esc_js( $error_callback ); ?> = function(errorCode) {
		if (typeof window.ehTurnstileHandleErrorForWidget === 'function') {
			window.ehTurnstileHandleErrorForWidget('<?php echo esc_js( $widget_id ); ?>', errorCode);
		}
	};
	</script>
	<?php
}

/**
 * Enqueue Cloudflare Turnstile script
 *
 * @return void
 */
function enqueue_scripts() {
	static $enqueued = false;

	if ( $enqueued ) {
		return;
	}

	wp_enqueue_script( 'eh-cfturnstile', 'https://challenges.cloudflare.com/turnstile/v0/api.js', [], null, [ 'strategy' => 'defer' ] );

	$enqueued = true;
}

