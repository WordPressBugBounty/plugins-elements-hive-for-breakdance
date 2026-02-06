<?php
/**
 * Breakdance Forms Integration for Cloudflare Turnstile
 *
 * This integration adds Cloudflare Turnstile support to Breakdance Forms
 * by hooking into the form rendering and validation processes.
 *
 * @package ElementsHiveForBreakdance
 */

namespace ElementsHiveForBreakdance\CloudflareTurnstile;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Add Turnstile field to Breakdance forms
 * Hook into the form footer before rendering
 */
add_action( 'breakdance_form_before_footer', __NAMESPACE__ . '\add_turnstile_to_form', 10, 1 );

/**
 * Add turnstile to Breakdance form
 *
 * @param array $form Form data.
 * @return void
 */
function add_turnstile_to_form( $form ) {

	if ( ! should_show_turnstile( $form ) ) {

		return;
	}

	$unique_id = wp_rand();

	echo '<div class="breakdance-form-field eh-bdform-turnstile-wrapper" style="display: block;">';
	render_turnstile_field( $form, $unique_id );
	echo '</div>';

	enqueue_scripts();

	// avaScript for form handling
	?>
	<script>
	document.addEventListener("DOMContentLoaded", function() {
		// Initialize Turnstile form handling for multiple forms
		initTurnstileFormHandling();
	});

	function initTurnstileFormHandling() {
		// Find all forms with Turnstile widgets
		const turnstileWidgets = document.querySelectorAll('.eh-bdform-turnstile-wrapper > .cf-turnstile');
		
		turnstileWidgets.forEach(function(widget) {
			
			const formElement = widget.closest('form');
			
			if (formElement) {
				setupFormHandling(formElement);
			}
		});
	}

	function setupFormHandling(formElement) {

		// Intercept form submission to validate Turnstile
		formElement.addEventListener('submit', function(e) {

			const turnstileElement = formElement.querySelector('.eh-bdform-turnstile-wrapper > .cf-turnstile');
			
			if(!turnstileElement) return;

			
			// Check if Turnstile has been completed
			const turnstileResponse = turnstileElement.querySelector('input[name="cf-turnstile-response"]');
			
			if (!turnstileResponse || !turnstileResponse.value) {
				e.preventDefault();
				e.stopPropagation();
				e.stopImmediatePropagation();
				
				// Show error message using Breakdance style
				createTurnstileMessage(
					formElement,
					'<?php esc_html_e( 'Please complete the verification challenge.', 'elementshive' ); ?>',
					'error'
				);
				
				return false;

			} else {
				// Clear any existing Turnstile error messages for this form
				var existingMessages = formElement.parentElement.querySelectorAll('.eh-turnstile-message');
				existingMessages.forEach(function(msg) {
					msg.remove();
				});
				
			}
			
		}, true); // Use capture phase to ensure this runs first
	}

	// Helper function to create Breakdance-style message
	function createTurnstileMessage(form, text, type) {
			type = type || 'error';
			
			// Remove any existing Turnstile messages for this form
			var existingMessages = form.parentElement.querySelectorAll('.eh-turnstile-message');
			existingMessages.forEach(function(msg) {
				msg.remove();
			});
			
			var node = document.createElement('div');
			node.innerHTML = text;
			node.classList.add('breakdance-form-message');
			node.classList.add('breakdance-form-message--' + type);
			node.classList.add('eh-turnstile-message');
			
			form.parentElement.insertBefore(node, form.nextSibling);
			
			// Scroll to message
			node.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
		}
	</script>
	<?php
}

/**
 * Hook into Breakdance form submission handling
 */
add_action( 'init', __NAMESPACE__ . '\init_validation', 5 );

/**
 * Initialize Breakdance form validation hooks
 *
 * @return void
 */
function init_validation() {
	// Form Builder
	add_action( 'wp_ajax_nopriv_breakdance_form_custom', __NAMESPACE__ . '\validate_turnstile', 1 );
	add_action( 'wp_ajax_breakdance_form_custom', __NAMESPACE__ . '\validate_turnstile', 1 );

	// Register Form
	add_action( 'wp_ajax_nopriv_breakdance_form_register', __NAMESPACE__ . '\validate_turnstile', 1 );
	add_action( 'wp_ajax_breakdance_form_register', __NAMESPACE__ . '\validate_turnstile', 1 );

	// Login Form
	add_action( 'wp_ajax_nopriv_breakdance_form_login', __NAMESPACE__ . '\validate_turnstile', 1 );
	add_action( 'wp_ajax_breakdance_form_login', __NAMESPACE__ . '\validate_turnstile', 1 );

	// Forgot Password Form
	add_action( 'wp_ajax_nopriv_breakdance_form_forgot_password', __NAMESPACE__ . '\validate_turnstile', 1 );
	add_action( 'wp_ajax_breakdance_form_forgot_password', __NAMESPACE__ . '\validate_turnstile', 1 );
}

/**
 * Intercept Breakdance AJAX form submission to validate turnstile
 *
 * @return void
 */
/**
 * Intercept Breakdance AJAX form submission to validate turnstile
 *
 * @return void
 */
function validate_turnstile() {

	// Do we have a turnstile response?
	if ( ! isset( $_POST['cf-turnstile-response'] ) ) {
		return;
	}

	// Validate turnstile response
	if ( empty( $_POST['cf-turnstile-response'] ) ) {
		wp_send_json_error([
			'type' => 'error',
			'message' => get_error_message( 'missing_token' ),
		], 400);
		wp_die();
	}

	$token = sanitize_text_field( wp_unslash( $_POST['cf-turnstile-response'] ) );
	$result = verify_token( $token );

	if ( ! $result['success'] ) {
		$error_message = $result['error'] ? get_error_message( $result['error'] ) : get_error_message( 'invalid_response' );

		wp_send_json_error([
			'type' => 'error',
			'message' => $error_message,
		], 400);
	}
}

/**
 * Check if turnstile should be shown for a specific Breakdance form
 *
 * @param array $form Form data.
 * @return bool
 */
function should_show_turnstile( $form ) {

	// Check if Breakdance forms are enabled and turnstile is verified in global settings
	if ( ! get_option( 'eh_turnstile_breakdance_enabled' ) || 'no' === get_option( 'eh_turnstile_verified' ) ) {
		return false;
	}

	// Check form settings
	if ( true === $form['cloudflare_turnstile']['enable_turnstile'] ) {

		return true;
	}

	return false;
}

/**
 * Check if turnstile validation should be performed for a specific form
 *
 * @param array $form Form data.
 * @return bool
 */
function should_validate_form( $form ) {

	// Check if Breakdance forms are enabled in settings
	if ( ! get_option( 'eh_turnstile_breakdance_enabled' ) || 'no' === get_option( 'eh_turnstile_verified' ) ) {

		return false;
	}

	if ( true === $form['cloudflare_turnstile']['enable_turnstile'] ) {

		return true;
	}

	return false;
}
