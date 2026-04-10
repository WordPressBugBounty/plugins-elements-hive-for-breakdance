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
	render_turnstile_form_script();
}

/**
 * @return void
 */
function render_turnstile_form_script() {
	static $rendered = false;

	if ( $rendered ) {
		return;
	}

	$rendered = true;
	?>
	<script>
	(function() {
		const FORM_SELECTOR = 'form';
		const WIDGET_SELECTOR = '.eh-bdform-turnstile-wrapper > .cf-turnstile';
		const SUBMIT_SELECTOR = 'button[type="submit"]';
		const MESSAGE_SELECTOR = '.eh-turnstile-message';
		const FORM_INIT_FLAG = 'ehTurnstileInitialized';

		function getForms() {
			return document.querySelectorAll(FORM_SELECTOR);
		}

		function getWidget(form) {
			return form.querySelector(WIDGET_SELECTOR);
		}

		function getSubmitButtons(form) {
			return form.querySelectorAll(SUBMIT_SELECTOR);
		}

		function getFormByWidgetId(widgetId) {
			const widget = document.getElementById(widgetId);
			return widget ? widget.closest('form') : null;
		}

		function shouldDisableSubmitUntilVerified(form) {
			const widget = getWidget(form);
			return !!(widget && widget.dataset.disableSubmitUntilVerified === 'true');
		}

		function getResponseInput(form) {
			return form.querySelector('input[name="cf-turnstile-response"]');
		}

		function hasValidToken(form) {
			const responseInput = getResponseInput(form);
			return !!(responseInput && responseInput.value);
		}

		function clearTurnstileMessage(form) {
			if (!form.parentElement) {
				return;
			}

			form.parentElement.querySelectorAll(MESSAGE_SELECTOR).forEach(function(message) {
				message.remove();
			});
		}

		function setSubmitState(form, enabled) {
			getSubmitButtons(form).forEach(function(button) {
				button.disabled = !enabled;
				button.setAttribute('aria-disabled', enabled ? 'false' : 'true');
				button.classList.toggle('eh-turnstile-submit-disabled', !enabled);
			});
		}

		function syncFormState(form) {
			if (!getWidget(form)) {
				return;
			}

			if (!shouldDisableSubmitUntilVerified(form)) {
				setSubmitState(form, true);
				return;
			}

			setSubmitState(form, hasValidToken(form));
		}

		function syncAllForms() {
			getForms().forEach(function(form) {
				syncFormState(form);
			});
		}

		function createTurnstileMessage(form, text, type) {
			type = type || 'error';

			if (!form.parentElement) {
				return;
			}

			clearTurnstileMessage(form);

			const node = document.createElement('div');
			node.innerHTML = text;
			node.classList.add('breakdance-form-message');
			node.classList.add('breakdance-form-message--' + type);
			node.classList.add('eh-turnstile-message');

			form.parentElement.insertBefore(node, form.nextSibling);
			node.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
		}

		function getTurnstileErrorReason(errorCode) {
			if (!errorCode) {
				return '';
			}

			const normalizedErrorCode = String(errorCode);
			const errorReasons = {
				'110100': '<?php echo esc_js( __( 'Invalid sitekey', 'elementshive' ) ); ?>',
				'110110': '<?php echo esc_js( __( 'Sitekey not found', 'elementshive' ) ); ?>',
				'110200': '<?php echo esc_js( __( 'Domain not authorized', 'elementshive' ) ); ?>',
				'110600': '<?php echo esc_js( __( 'Challenge timed out', 'elementshive' ) ); ?>',
				'110620': '<?php echo esc_js( __( 'Interaction timed out', 'elementshive' ) ); ?>',
				'200100': '<?php echo esc_js( __( 'Clock or cache problem', 'elementshive' ) ); ?>',
				'200500': '<?php echo esc_js( __( 'Iframe load error', 'elementshive' ) ); ?>',
				'300*': '<?php echo esc_js( __( 'Generic challenge failure', 'elementshive' ) ); ?>',
				'400020': '<?php echo esc_js( __( 'Invalid sitekey', 'elementshive' ) ); ?>',
				'400070': '<?php echo esc_js( __( 'Sitekey disabled', 'elementshive' ) ); ?>',
				'600*': '<?php echo esc_js( __( 'Generic challenge failure', 'elementshive' ) ); ?>'
			};

			if (errorReasons[normalizedErrorCode]) {
				return errorReasons[normalizedErrorCode];
			}

			const wildcardCode = Object.keys(errorReasons).find(function(pattern) {
				const regexPattern = '^' + pattern.replace(/\*/g, '\\d+') + '$';
				return new RegExp(regexPattern).test(normalizedErrorCode);
			});

			return wildcardCode ? errorReasons[wildcardCode] : '';
		}

		function setupFormHandling(form) {
			if (!getWidget(form) || form.dataset[FORM_INIT_FLAG] === 'true') {
				return;
			}

			form.dataset[FORM_INIT_FLAG] = 'true';
			syncFormState(form);

			form.addEventListener('submit', function(event) {
				if (hasValidToken(form)) {
					clearTurnstileMessage(form);
					return;
				}

				event.preventDefault();
				event.stopPropagation();
				event.stopImmediatePropagation();
				syncFormState(form);
				createTurnstileMessage(
					form,
					'<?php esc_html_e( 'Please complete the verification challenge.', 'elementshive' ); ?>',
					'error'
				);
				return false;
			}, true);
		}

		function initTurnstileFormHandling() {
			document.querySelectorAll(WIDGET_SELECTOR).forEach(function(widget) {
				const form = widget.closest('form');
				if (form) {
					setupFormHandling(form);
				}
			});

			syncAllForms();
		}

		function queueSyncAllForms() {
			window.setTimeout(syncAllForms, 0);
		}

		function queueSyncFormByWidgetId(widgetId) {
			window.setTimeout(function() {
				const form = getFormByWidgetId(widgetId);
				if (form) {
					syncFormState(form);
				}
			}, 0);
		}

		window.ehTurnstileHandleSuccessForWidget = function(widgetId) {
			const form = getFormByWidgetId(widgetId);
			if (form) {
				clearTurnstileMessage(form);
			}
			queueSyncFormByWidgetId(widgetId);
		};

		window.ehTurnstileHandleStateChangeForWidget = function(widgetId) {
			queueSyncFormByWidgetId(widgetId);
		};

		window.ehTurnstileHandleErrorForWidget = function(widgetId, errorCode) {
			const form = getFormByWidgetId(widgetId);
			if (!form) {
				return;
			}

			const normalizedErrorCode = errorCode ? String(errorCode) : '<?php echo esc_js( __( 'unknown', 'elementshive' ) ); ?>';
			const reason = getTurnstileErrorReason(normalizedErrorCode) || '<?php echo esc_js( __( 'Unknown client-side error', 'elementshive' ) ); ?>';
			const message = 'Cloudflare Turnstile Error (' + normalizedErrorCode + ') -- ' + reason;

			queueSyncFormByWidgetId(widgetId);
			createTurnstileMessage(form, message, 'error');
		};

		window.ehTurnstileHandleSuccess = queueSyncAllForms;
		window.ehTurnstileHandleStateChange = queueSyncAllForms;
		window.initTurnstileFormHandling = initTurnstileFormHandling;

		document.addEventListener('DOMContentLoaded', initTurnstileFormHandling);

		const observer = new MutationObserver(function() {
			initTurnstileFormHandling();
		});

		observer.observe(document.documentElement, {
			childList: true,
			subtree: true,
		});
	})();
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
 * @return array|null
 */
function get_submitted_breakdance_form() {
	$post_id = isset( $_POST['post_id'] ) ? absint( wp_unslash( $_POST['post_id'] ) ) : 0;
	$form_id = isset( $_POST['form_id'] ) ? absint( wp_unslash( $_POST['form_id'] ) ) : 0;

	if ( ! $post_id || ! $form_id || ! function_exists( '\\Breakdance\\Forms\\getFormSettings' ) ) {
		return null;
	}

	$settings = \Breakdance\Forms\getFormSettings( $post_id, $form_id );

	return is_array( $settings ) ? $settings : null;
}

/**
 * Intercept Breakdance AJAX form submission to validate turnstile
 *
 * @return void
 */
function validate_turnstile() {

	if ( ! isset( $_POST['cf-turnstile-response'] ) ) {
		return;
	}

	$form = get_submitted_breakdance_form();

	if ( $form ) {
		if ( ! should_validate_form( $form ) ) {
			return;
		}
	} elseif ( ! get_option( 'eh_turnstile_breakdance_enabled' ) || 'yes' !== get_option( 'eh_turnstile_verified' ) ) {
		return;
	}

	if ( empty( $_POST['cf-turnstile-response'] ) ) {
		wp_send_json_error([
			'type' => 'error',
			'message' => get_error_message( 'missing_token' ),
		], 400);
		wp_die();
	}

	$token = sanitize_text_field( wp_unslash( $_POST['cf-turnstile-response'] ) );
	$result = verify_token( $token, get_turnstile_secret_key( $form ) );

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
	$settings = get_turnstile_settings( $form );

	if ( true !== ( $settings['enable_turnstile'] ?? false ) ) {
		return false;
	}

	if ( should_use_custom_turnstile_keys( $form ) ) {
		return '' !== get_turnstile_site_key( $form );
	}

	if ( ! get_option( 'eh_turnstile_breakdance_enabled' ) || 'yes' !== get_option( 'eh_turnstile_verified' ) ) {
		return false;
	}

	return '' !== get_turnstile_site_key();
}

/**
 * Check if turnstile validation should be performed for a specific form
 *
 * @param array $form Form data.
 * @return bool
 */
function should_validate_form( $form ) {
	$settings = get_turnstile_settings( $form );

	if ( true !== ( $settings['enable_turnstile'] ?? false ) ) {
		return false;
	}

	if ( should_use_custom_turnstile_keys( $form ) ) {
		return '' !== get_turnstile_secret_key( $form );
	}

	if ( ! get_option( 'eh_turnstile_breakdance_enabled' ) || 'yes' !== get_option( 'eh_turnstile_verified' ) ) {
		return false;
	}

	return '' !== get_turnstile_secret_key();
}
