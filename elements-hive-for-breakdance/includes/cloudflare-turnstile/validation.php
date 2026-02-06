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
 * Verify Turnstile token with Cloudflare API
 *
 * @param string $token Turnstile response token.
 * @param string $secret_key Optional secret key to use instead of the one in the options ( used in the admin page test).
 * @return array Array with 'success' and 'error' keys.
 */
function verify_token( $token, $secret_key = null ) {

	$secret = ! empty( $secret_key ) ? $secret_key : get_option( 'eh_turnstile_secret_key' );

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

	// Make request to Cloudflare API
	$response = wp_remote_post('https://challenges.cloudflare.com/turnstile/v0/siteverify', [
		'body' => [
			'secret' => $secret,
			'response' => $token,
		],
		'timeout' => 10,
	]);

	// Check for WordPress errors
	if ( is_wp_error( $response ) ) {
		return [
			'success' => false,
			'error' => 'api_request_failed',
		];
	}

	// Parse response
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
