<?php
/**
 * Turnstile Validation Functions
 *
 * @package ElementsHiveForBreakdance
 */

namespace ElementsHiveForBreakdance\CloudflareTurnstile;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * @param array $form Form settings.
 * @return array<string, mixed>
 */
function get_turnstile_settings( $form ) {
	return isset( $form['cloudflare_turnstile'] ) && is_array( $form['cloudflare_turnstile'] ) ? $form['cloudflare_turnstile'] : [];
}

/**
 * @param array|null $form Form settings.
 * @return bool
 */
function has_custom_turnstile_key_source( $form = null ) {
	if ( ! is_array( $form ) ) {
		return false;
	}

	$settings = get_turnstile_settings( $form );

	return 'custom' === ( $settings['api_key_source'] ?? 'default' );
}

/**
 * @param array|null $form Form settings.
 * @return bool
 */
function should_use_custom_turnstile_keys( $form = null ) {
	if ( ! has_custom_turnstile_key_source( $form ) ) {
		return false;
	}

	$secret_key = get_form_turnstile_secret_key( $form );
	$site_key = get_form_turnstile_site_key( $form );

	return '' !== $secret_key && '' !== $site_key;
}

/**
 * @param array|null $form Form settings.
 * @return string
 */
function get_form_turnstile_site_key( $form = null ) {
	if ( ! has_custom_turnstile_key_source( $form ) ) {
		return '';
	}

	$settings = get_turnstile_settings( $form );

	if ( isset( $settings['site_key'] ) ) {
		return trim( (string) $settings['site_key'] );
	}

	$api_key_input = isset( $settings['api_key_input'] ) && is_array( $settings['api_key_input'] ) ? $settings['api_key_input'] : [];
	return isset( $api_key_input['apiUrl'] ) ? trim( (string) $api_key_input['apiUrl'] ) : '';
}

/**
 * @param array|null $form Form settings.
 * @return string
 */
function get_turnstile_site_key( $form = null ) {
	if ( should_use_custom_turnstile_keys( $form ) ) {
		return get_form_turnstile_site_key( $form );
	}

	return trim( (string) get_option( 'eh_turnstile_site_key', '' ) );
}

/**
 * @param array|null $form Form settings.
 * @return string
 */
function get_form_turnstile_secret_key( $form = null ) {
	if ( ! has_custom_turnstile_key_source( $form ) ) {
		return '';
	}

	$settings = get_turnstile_settings( $form );

	if ( isset( $settings['secret_key'] ) ) {
		return trim( (string) $settings['secret_key'] );
	}

	$api_key_input = isset( $settings['api_key_input'] ) && is_array( $settings['api_key_input'] ) ? $settings['api_key_input'] : [];
	return isset( $api_key_input['apiKey'] ) ? trim( (string) $api_key_input['apiKey'] ) : '';
}

/**
 * @param array|null $form Form settings.
 * @return string
 */
function get_turnstile_secret_key( $form = null ) {
	if ( should_use_custom_turnstile_keys( $form ) ) {
		return get_form_turnstile_secret_key( $form );
	}

	return trim( (string) get_option( 'eh_turnstile_secret_key', '' ) );
}

/**
 * Verify Turnstile token with Cloudflare API
 *
 * @param string $token Turnstile response token.
 * @param string $secret_key Optional secret key to use instead of the one in the options ( used in the admin page test).
 * @return array Array with 'success' and 'error' keys.
 */
function verify_token( $token, $secret_key = null ) {

	$secret = ! empty( $secret_key ) ? trim( (string) $secret_key ) : get_turnstile_secret_key();

	if ( empty( $secret ) ) {
		return [
			'success' => false,
			'error' => 'no_secret_key',
		];
	}

	if ( empty( $token ) ) {
		return [
			'success' => false,
			'error' => 'missing_token',
		];
	}

	$response = wp_remote_post( 'https://challenges.cloudflare.com/turnstile/v0/siteverify', [
		'body' => [
			'secret' => $secret,
			'response' => $token,
		],
		'timeout' => 10,
	] );

	if ( is_wp_error( $response ) ) {
		return [
			'success' => false,
			'error' => 'api_request_failed',
		];
	}

	$body = wp_remote_retrieve_body( $response );
	$result = json_decode( $body, true );

	if ( ! is_array( $result ) ) {
		return [
			'success' => false,
			'error' => 'invalid_response',
		];
	}

	return [
		'success' => isset( $result['success'] ) && true === $result['success'],
		'error' => isset( $result['error-codes'][0] ) ? $result['error-codes'][0] : null,
	];
}

/**
 * Get user-friendly error message
 *
 * @param string $error_code Error code from Cloudflare.
 * @return string Error message.
 */
function get_error_message( $error_code ) {
	$messages = [
		'missing-input-secret' => __( 'Cloudflare Turnstile: The secret parameter is missing.', 'elementshive' ),
		'invalid-input-secret' => __( 'Cloudflare Turnstile: The secret parameter is invalid or malformed.', 'elementshive' ),
		'missing-input-response' => __( 'Cloudflare Turnstile: Please complete the verification challenge.', 'elementshive' ),
		'invalid-input-response' => __( 'Cloudflare Turnstile: The response parameter is invalid or malformed.', 'elementshive' ),
		'bad-request' => __( 'Cloudflare Turnstile: The request is invalid or malformed.', 'elementshive' ),
		'timeout-or-duplicate' => __( 'Cloudflare Turnstile: The response is no longer valid. Please try again.', 'elementshive' ),
		'internal-error' => __( 'Cloudflare Turnstile: An internal error occurred. Please try again later.', 'elementshive' ),
		'no_secret_key' => __( 'Cloudflare Turnstile: Turnstile is not configured properly. Please contact the site administrator.', 'elementshive' ),
		'missing_token' => __( 'Cloudflare Turnstile: Please complete the verification challenge.', 'elementshive' ),
		'api_request_failed' => __( 'Cloudflare Turnstile: Unable to verify. Please try again.', 'elementshive' ),
		'invalid_response' => __( 'Cloudflare Turnstile: Invalid verification response. Please try again.', 'elementshive' ),
	];

	return isset( $messages[ $error_code ] ) ? $messages[ $error_code ] : __( 'Cloudflare Turnstile: Verification failed. Please try again.', 'elementshive' );
}
