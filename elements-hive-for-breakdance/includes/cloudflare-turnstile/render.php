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
	$site_key = get_option( 'eh_turnstile_site_key' );

	if ( empty( $site_key ) ) {
		return;
	}

	$cloudflare_turnstile = isset( $form['cloudflare_turnstile'] ) ? $form['cloudflare_turnstile'] : [];

	$size = isset( $cloudflare_turnstile['size'] ) ? $cloudflare_turnstile['size'] : 'normal';
	$appearance = isset( $cloudflare_turnstile['appearance'] ) ? $cloudflare_turnstile['appearance'] : 'always';
	$theme = isset( $cloudflare_turnstile['theme'] ) ? $cloudflare_turnstile['theme'] : 'light';

	?>
	<div id="eh-turnstile-<?php echo esc_attr( $unique_id ); ?>"
		class="cf-turnstile"
		data-sitekey="<?php echo esc_attr( $site_key ); ?>"
		data-theme="<?php echo esc_attr( $theme ); ?>"
		data-language="auto"
		data-size="<?php echo esc_attr( $size ); ?>"
		data-appearance="<?php echo esc_attr( $appearance ); ?>"
		data-action="breakdance-form-<?php echo esc_attr( $unique_id ); ?>"
		data-retry="auto"
		data-retry-interval="1000">
	</div>
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

