<?php

namespace ElementsHiveForBreakdance\Admin\Pages\CloudflareTurnstile;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use function ElementsHiveForBreakdance\CloudflareTurnstile\verify_token;

/**
 * Check if Turnstile API keys need verification
 */
function needs_verification(): bool {
	$site_key = get_option( 'eh_turnstile_site_key', '' );
	$secret_key = get_option( 'eh_turnstile_secret_key', '' );
	$verified = get_option( 'eh_turnstile_verified', 'no' );

	return ! empty( $site_key ) && ! empty( $secret_key ) && 'yes' !== $verified;
}

/**
 * AJAX handler for saving Turnstile settings
 */
function handle_save_settings() {
	// Verify nonce
	if ( ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['_wpnonce'] ?? '' ) ), 'eh_turnstile_settings' ) ) {
		wp_die( 'Security check failed' );
	}

	// Check user capabilities
	if ( ! current_user_can( 'manage_options' ) ) {
		wp_die( 'Insufficient permissions' );
	}

	// Sanitize and save settings
	$site_key = sanitize_text_field( wp_unslash( $_POST['eh_turnstile_site_key'] ?? '' ) );
	$secret_key = sanitize_text_field( wp_unslash( $_POST['eh_turnstile_secret_key'] ?? '' ) );
	$breakdance_enabled = sanitize_text_field( wp_unslash( $_POST['eh_turnstile_breakdance_enabled'] ?? '' ) );

	update_option( 'eh_turnstile_site_key', $site_key );
	update_option( 'eh_turnstile_secret_key', $secret_key );
	update_option( 'eh_turnstile_breakdance_enabled', $breakdance_enabled );

	wp_send_json_success( 'Settings saved successfully' );
}

/**
 * AJAX handler for testing Turnstile API keys
 */
function handle_test_turnstile() {
	// Verify nonce
	if ( ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['_wpnonce'] ?? '' ) ), 'eh_turnstile_test' ) ) {
		wp_die( 'Security check failed' );
	}

	// Check user capabilities
	if ( ! current_user_can( 'manage_options' ) ) {
		wp_die( 'Insufficient permissions' );
	}

	$token = sanitize_text_field( wp_unslash( $_POST['cf-turnstile-response'] ?? '' ) );
	$site_key = sanitize_text_field( wp_unslash( $_POST['eh_turnstile_site_key'] ?? '' ) );
	$secret_key = sanitize_text_field( wp_unslash( $_POST['eh_turnstile_secret_key'] ?? '' ) );

	if ( empty( $token ) ) {
		wp_send_json_error( 'No verification token provided' );
	}

	if ( empty( $site_key ) || empty( $secret_key ) ) {
		wp_send_json_error( 'Please enter both Site Key and Secret Key before testing' );
	}

	$result = verify_token( $token, $secret_key );

	if ( $result['success'] ) {
		update_option( 'eh_turnstile_verified', 'yes' );
		delete_option( 'eh_turnstile_last_error' ); // Clear any previous errors
		wp_send_json_success( [
			'message' => 'API keys verified successfully! Your Turnstile integration is active.',
		] );
	} else {
		update_option( 'eh_turnstile_verified', 'no' );
		$error_message = 'Verification failed: ' . ( $result['error'] ?? 'Unknown error' );
		// Store the error persistently for display on page load
		update_option( 'eh_turnstile_last_error', $error_message );
		wp_send_json_error( $error_message );
	}
}

/**
 * AJAX handler for resetting verification status when API keys change
 */
function handle_reset_verification() {
	// Verify nonce
	if ( ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['_wpnonce'] ?? '' ) ), 'eh_turnstile_reset' ) ) {
		wp_die( 'Security check failed' );
	}

	// Check user capabilities
	if ( ! current_user_can( 'manage_options' ) ) {
		wp_die( 'Insufficient permissions' );
	}

	// Reset verification status to 'no' when keys are changed
	update_option( 'eh_turnstile_verified', 'no' );
	delete_option( 'eh_turnstile_last_error' ); // Clear any previous errors

	wp_send_json_success( 'Verification status reset' );
}

// Register AJAX actions
add_action( 'wp_ajax_eh_save_turnstile_settings', __NAMESPACE__ . '\handle_save_settings' );
add_action( 'wp_ajax_eh_test_turnstile', __NAMESPACE__ . '\handle_test_turnstile' );
add_action( 'wp_ajax_eh_reset_turnstile_verification', __NAMESPACE__ . '\handle_reset_verification' );
