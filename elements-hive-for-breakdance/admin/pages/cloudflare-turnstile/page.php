<?php

namespace ElementsHiveForBreakdance\Admin\Pages\CloudflareTurnstile;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use function ElementsHiveForBreakdance\Admin\Utils\admin_notice;
use function ElementsHiveForBreakdance\Admin\Parts\Header\render as render_header;
use function ElementsHiveForBreakdance\Admin\Parts\Icons\render_icon;

/**
 * Register menu
 */
function register_menu() {
	add_submenu_page( 'elements_hive', 'Tools', 'Tools', 'manage_options', 'elements_hive', __NAMESPACE__ . '\render' );
}


/**
 * Render admin settings page
 *
 * @return void
 */
function render() {
	// Get current settings
	$site_key = get_option( 'eh_turnstile_site_key', '' );
	$secret_key = get_option( 'eh_turnstile_secret_key', '' );
	$breakdance_enabled = get_option( 'eh_turnstile_breakdance_enabled', '' );
	$disabled_ids = get_option( 'eh_turnstile_breakdance_disabled_ids', '' );
	$verified = get_option( 'eh_turnstile_verified', 'no' );
	$last_error = get_option( 'eh_turnstile_last_error', '' );

	// Prepare verification status message
	$verification_message = '';
	$verification_type = '';

	if ( 'yes' === $verified && ! empty( $site_key ) && ! empty( $secret_key ) ) {
		$verification_message = 'API keys verified successfully!';
		$verification_type = 'success';
	} elseif ( ! empty( $last_error ) ) {
		$verification_message = $last_error;
		$verification_type = 'error';
	} elseif ( 'no' === $verified && ! empty( $site_key ) && ! empty( $secret_key ) ) {
		$verification_message = 'API keys have not been verified yet.';
		$verification_type = 'warning';
	}
	?>

	<div class='eh-adm-body eh-adm-flex eh-adm-flex-col eh-adm-gap-lg eh-adm-p-lg eh-adm-bg eh-adm-rounded-xl'>

		<?php
		// Show admin notices based on URL parameters
		// phpcs:ignore WordPress.Security.NonceVerification.Recommended -- Displaying notice only, no action taken
		if ( isset( $_GET['settings-updated'] ) && sanitize_text_field( wp_unslash( $_GET['settings-updated'] ) ) === 'true' ) {
			admin_notice(
				__( 'Settings saved successfully!', 'elementshive' ),
				'success'
			);
		// phpcs:ignore WordPress.Security.NonceVerification.Recommended -- Displaying notice only, no action taken
		} elseif ( isset( $_GET['settings-error'] ) && sanitize_text_field( wp_unslash( $_GET['settings-error'] ) ) === 'true' ) {
			admin_notice(
				__( 'Error saving settings. Please try again.', 'elementshive' ),
				'error'
			);
		}

		render_header();
		?>

		<div class="eh-adm-main eh-adm-flex eh-adm-flex-col eh-adm-p-lg eh-adm-text-alt eh-adm-flex-1 eh-adm-gap-lg">
			<h2 class="eh-adm-text-4xl eh-adm-mb-lg "><?php esc_html_e( 'Cloudflare Turnstile for Breakdance Forms', 'elements-hive-for-breakdance' ); ?></h2>
			
			<!-- Enable Turnstile Toggle -->
			<div class="eh-adm-section eh-adm-section-highlight eh-adm-flex eh-adm-flex-col eh-adm-gap-xl eh-adm-p-lg eh-adm-rounded-md eh-adm-shadow-light">
				<h3 class="eh-adm-text-xl eh-adm-m-0"><?php esc_html_e( 'Enable Turnstile', 'elements-hive-for-breakdance' ); ?></h3>
				<div class="eh-adm-section__item eh-adm-flex eh-adm-items-center eh-adm-gap-sm eh-adm-p-lg eh-adm-rounded-sm eh-adm-shadow-light">
					<div class="eh-adm-section__item-details eh-adm-flex eh-adm-flex-col eh-adm-gap-sm eh-adm-w-30">
						<div class=" eh-adm-m-0"><?php esc_html_e( 'Enable Cloudflare Turnstile for Breakdance Forms', 'elements-hive-for-breakdance' ); ?></div>
						
					</div>
				<div class="eh-adm-section__item-action eh-adm-flex eh-adm-flex-col eh-adm-gap-sm eh-adm-flex-grow">
					<label class="eh-adm-toggle-label">
						<input 
							type="checkbox" 
							id="eh_turnstile_breakdance_enabled"
							name="eh_turnstile_breakdance_enabled" 
							value="1"
							class="eh-adm-toggle-input"
							<?php checked( $breakdance_enabled, '1' ); ?>
						/>
						<span class="eh-adm-toggle-slider"></span>
					</label>
				</div>
				</div>
			</div>

		<!-- API Key Settings Section -->
		<div class="eh-adm-section eh-adm-section-highlight eh-adm-flex eh-adm-flex-col eh-adm-gap-xl eh-adm-p-lg eh-adm-rounded-md eh-adm-shadow-light" id="eh-api-keys-section" style="display: <?php echo esc_attr( $breakdance_enabled ? 'flex' : 'none' ); ?>;">
			<h3 class="eh-adm-text-xl eh-adm-m-0"><?php esc_html_e( 'API Key Settings', 'elements-hive-for-breakdance' ); ?></h3>
			
			<div class="eh-adm-section__item eh-adm-flex eh-adm-items-center eh-adm-gap-sm eh-adm-p-lg eh-adm-rounded-sm eh-adm-shadow-light">
					<div class="eh-adm-section__item-details eh-adm-flex eh-adm-flex-row eh-adm-gap-sm">
						<div class=" eh-adm-m-0"><?php esc_html_e( 'Get your API keys from:', 'elements-hive-for-breakdance' ); ?></div>
					</div>
					<div class="eh-adm-section__item-action eh-adm-flex eh-adm-flex-col eh-adm-gap-sm eh-adm-flex-grow">
							<p class="eh-adm-section__item-description eh-adm-m-0">
								<a href="https://dash.cloudflare.com/?to=/:account/turnstile" target="_blank" rel="noopener">
									<?php esc_html_e( 'Cloudflare Turnstile Dashboard', 'elements-hive-for-breakdance' ); ?>
								</a>
							</p>
						</div>
				</div>
				
				<div class="eh-adm-section__item eh-adm-flex eh-adm-items-center eh-adm-gap-sm eh-adm-p-lg eh-adm-rounded-sm eh-adm-shadow-light">
					<div class="eh-adm-section__item-details eh-adm-flex eh-adm-flex-col eh-adm-gap-sm eh-adm-w-30">
						<div class=" eh-adm-m-0"><?php esc_html_e( 'Site Key', 'elements-hive-for-breakdance' ); ?></div>
					</div>
					<div class="eh-adm-section__item-action eh-adm-flex eh-adm-flex-col eh-adm-gap-sm eh-adm-flex-grow">
						<input 
							type="text" 
							id="eh_turnstile_site_key"
							name="eh_turnstile_site_key" 
							class="eh-adm-input"
							value="<?php echo esc_attr( $site_key ); ?>" 
							placeholder="<?php esc_attr_e( 'Enter your Cloudflare Turnstile site key', 'elements-hive-for-breakdance' ); ?>"
						/>
					</div>
				</div>
				
			<div class="eh-adm-section__item eh-adm-flex eh-adm-items-center eh-adm-gap-sm eh-adm-p-lg eh-adm-rounded-sm eh-adm-shadow-light">
				<div class="eh-adm-section__item-details eh-adm-flex eh-adm-flex-col eh-adm-gap-sm eh-adm-w-30">
					<div class=" eh-adm-m-0"><?php esc_html_e( 'Secret Key', 'elements-hive-for-breakdance' ); ?></div>
				</div>
				<div class="eh-adm-section__item-action eh-adm-flex eh-adm-flex-col eh-adm-gap-sm eh-adm-flex-grow">
					<input 
						type="text" 
						id="eh_turnstile_secret_key"
						name="eh_turnstile_secret_key" 
						class="eh-adm-input"
						value="<?php echo esc_attr( $secret_key ); ?>" 
						placeholder="<?php esc_attr_e( 'Enter your Cloudflare Turnstile secret key', 'elements-hive-for-breakdance' ); ?>"
					/>
				</div>
			</div>
			
			<!-- Verification Status Message -->
			<div id="eh-verification-message" class="eh-adm-message" style="<?php echo ! empty( $verification_message ) ? '' : 'display: none;'; ?>">
				<div class="eh-adm-message__content eh-adm-message--<?php echo esc_attr( $verification_type ); ?>">
					<span class="eh-adm-message__content-inner"><?php echo esc_html( $verification_message ); ?></span>
				</div>
			</div>
		</div>

		<!-- Test Response Card -->
		<div class="eh-adm-section eh-adm-section-highlight eh-adm-flex eh-adm-flex-col eh-adm-gap-xl eh-adm-p-lg eh-adm-rounded-md eh-adm-shadow-light" id="eh-test-section" style="display: <?php echo esc_attr( $breakdance_enabled ? 'flex' : 'none' ); ?>;">
			<h3 class="eh-adm-text-xl eh-adm-m-0"><?php esc_html_e( 'Verify Your API Keys', 'elements-hive-for-breakdance' ); ?></h3>
			<div class="eh-adm-section__item eh-adm-flex eh-adm-items-center eh-adm-gap-sm eh-adm-p-lg eh-adm-rounded-sm eh-adm-shadow-light">
				<div class="eh-adm-section__item-details eh-adm-flex eh-adm-gap-sm eh-adm-w-30 eh-adm-font-bold">
					<?php render_icon( 'info', 'eh-adm-stroke-accent' ); ?>
					<div><?php esc_html_e( 'You must verify your API Keys and Save the settings to activate Cloudflare Turnstile on Breakdance Forms.', 'elements-hive-for-breakdance' ); ?></div>
				</div>
				<div class="eh-adm-section__item-action eh-adm-flex eh-adm-flex-col eh-adm-gap-sm eh-adm-flex-grow">
					<form class="eh-adm-form" id="eh-test-form">
						<div id="eh-test-turnstile" 
							class="cf-turnstile"
							data-sitekey="<?php echo esc_attr( $site_key ); ?>"
							data-retry="never"
							data-theme="light"
							data-language="auto"
							data-size="normal"
							data-appearance="always">
						</div>
						
						<button type="submit" class="eh-adm-button eh-adm-self-start eh-adm-bg-accent eh-adm-text-alt eh-adm-border-none eh-adm-rounded-sm eh-adm-py-sm eh-adm-px-md eh-adm-transition-fast eh-adm-cursor-pointer eh-adm-font-bold" id="eh-test-button">
							<?php esc_html_e( 'Validate API Keys', 'elements-hive-for-breakdance' ); ?>
						</button>
					</form>
				</div>
			</div>
		</div>


			<!-- Save Button -->
			<div class="eh-adm-section eh-adm-flex eh-adm-flex-col eh-adm-gap-xl">
				<button type="button" class="eh-adm-button eh-adm-bg-black eh-adm-self-start eh-adm-text-light eh-adm-border-none eh-adm-rounded-sm eh-adm-py-sm eh-adm-px-md eh-adm-transition-fast eh-adm-cursor-pointer eh-adm-font-bold" id="eh-save-settings">
					<?php esc_html_e( 'Save Settings', 'elements-hive-for-breakdance' ); ?>
				</button>
			</div>
		</div>

	</div>

	<script>
		// Load Cloudflare Turnstile script for testing
		let turnstileWidgetId = null;
		
		// Store original values to detect changes
		let originalSiteKey = '<?php echo esc_js( $site_key ); ?>';
		let originalSecretKey = '<?php echo esc_js( $secret_key ); ?>';

		// Helper function to show verification messages
		function showVerificationMessage(message, type) {
			const messageContainer = document.getElementById('eh-verification-message');
			const messageContent = messageContainer.querySelector('.eh-adm-message__content');
			const messageParagraph = messageContent.querySelector('.eh-adm-message__content-inner');
			
			messageParagraph.textContent = message;
			messageContent.className = 'eh-adm-message__content eh-adm-message--' + type;
			messageContainer.style.display = 'block';
			messageContainer.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
		}

		// Function to render Turnstile widget with current site key value
		function renderTurnstileWidget() {
			const turnstileElement = document.getElementById('eh-test-turnstile');
			if (!turnstileElement || typeof turnstile === 'undefined') {
				return;
			}

			// Get current site key from input field
			const currentSiteKey = document.getElementById('eh_turnstile_site_key').value;
			
			if (!currentSiteKey) {
				return;
			}

			// Clear existing widget if it exists
			if (turnstileWidgetId !== null) {
				turnstile.remove(turnstileWidgetId);
			}

			// Clear the container
			turnstileElement.innerHTML = '';

			// Render new widget with current site key
			turnstileWidgetId = turnstile.render('#eh-test-turnstile', {
				sitekey: currentSiteKey,
				theme: turnstileElement.getAttribute('data-theme'),
				language: turnstileElement.getAttribute('data-language'),
				size: turnstileElement.getAttribute('data-size'),
				appearance: turnstileElement.getAttribute('data-appearance')
			});
		}

		// Handler for toggle checkbox change
		function handleToggleChange() {
			const sections = ['eh-api-keys-section', 'eh-test-section'];
			const isEnabled = this.checked;
			
			sections.forEach(sectionId => {
				const section = document.getElementById(sectionId);
				if (section) {
					section.style.display = isEnabled ? 'flex' : 'none';
				}
			});
		}

		// Handler for Turnstile script load
		function handleTurnstileScriptLoad() {
			renderTurnstileWidget();
		}

		// Function to reset verification status via AJAX
		function resetVerificationStatus() {
			const formData = new FormData();
			formData.append('action', 'eh_reset_turnstile_verification');
			formData.append('_wpnonce', '<?php echo wp_create_nonce( 'eh_turnstile_reset' ); ?>');

			fetch(ajaxurl, {
				method: 'POST',
				body: formData
			})
			.then(response => response.json())
			.catch(error => {
				console.error('Error resetting verification status:', error);
			});
		}

		// Handler for API key blur event (used for both site key and secret key)
		function handleApiKeyBlur() {
			const currentSiteKey = document.getElementById('eh_turnstile_site_key').value;
			const currentSecretKey = document.getElementById('eh_turnstile_secret_key').value;
			
			// Check if either key has changed from original values
			const siteKeyChanged = currentSiteKey !== originalSiteKey;
			const secretKeyChanged = currentSecretKey !== originalSecretKey;
			
			if (siteKeyChanged || secretKeyChanged) {
				// Reset verification status when keys change
				resetVerificationStatus();
				showVerificationMessage('Please verify your keys.', 'warning');
			} else {
				showVerificationMessage('API keys have not been verified yet.', 'warning');
			}
			
			if (typeof turnstile !== 'undefined') {
				renderTurnstileWidget();
			}
		}

		// Handler for save settings success response
		function handleSaveSettingsSuccess(data) {
			if (data.success) {
				// Update original values after successful save
				originalSiteKey = document.getElementById('eh_turnstile_site_key').value;
				originalSecretKey = document.getElementById('eh_turnstile_secret_key').value;
				window.location.href = window.location.href.split('?')[0] + '?page=elements_hive_cloudflare_turnstile&settings-updated=true';
			} else {
				window.location.href = window.location.href.split('?')[0] + '?page=elements_hive_cloudflare_turnstile&settings-error=true';
			}
		}

		// Handler for save settings error
		function handleSaveSettingsError(error) {
			window.location.href = window.location.href.split('?')[0] + '?page=elements_hive_cloudflare_turnstile&settings-error=true';
		}

		// Handler for save settings button click
		function handleSaveSettingsClick() {
			const formData = new FormData();
			formData.append('action', 'eh_save_turnstile_settings');
			formData.append('_wpnonce', '<?php echo wp_create_nonce( 'eh_turnstile_settings' ); ?>');
			formData.append('eh_turnstile_site_key', document.getElementById('eh_turnstile_site_key').value);
			formData.append('eh_turnstile_secret_key', document.getElementById('eh_turnstile_secret_key').value);
			formData.append('eh_turnstile_breakdance_enabled', document.getElementById('eh_turnstile_breakdance_enabled').checked ? '1' : '');

			fetch(ajaxurl, {
				method: 'POST',
				body: formData
			})
			.then(response => response.json())
			.then(handleSaveSettingsSuccess)
			.catch(handleSaveSettingsError);
		}

		// Handler for test verification success response
		function handleTestVerificationSuccess(data) {
			if (data.success) {
				showVerificationMessage(data.data.message || 'API keys verified successfully!', 'success');
			} else {
				showVerificationMessage(data.data || 'Verification failed', 'error');
			}
		}

		// Handler for test verification error
		function handleTestVerificationError(error) {
			showVerificationMessage('Error testing API keys: ' + error, 'error');
		}

		// Handler for test form submit
		function handleTestFormSubmit(e) {
			e.preventDefault();
			
			// Get current values from form inputs
			const siteKey = document.getElementById('eh_turnstile_site_key').value.trim();
			const secretKey = document.getElementById('eh_turnstile_secret_key').value.trim();

			
			
			// Validate keys are entered
			if (!siteKey || !secretKey) {
				showVerificationMessage('Please enter both Site Key and Secret Key before testing.', 'error');
				return;
			}
			
			const token = document.querySelector('[name="cf-turnstile-response"]');
			if (!token || !token.value) {
				showVerificationMessage('Please complete the Turnstile verification first.', 'error');
				return;
			}

			

			const formData = new FormData();
			formData.append('action', 'eh_test_turnstile');
			formData.append('_wpnonce', '<?php echo wp_create_nonce( 'eh_turnstile_test' ); ?>');
			formData.append('cf-turnstile-response', token.value);
			formData.append('eh_turnstile_site_key', siteKey);
			formData.append('eh_turnstile_secret_key', secretKey);

			fetch(ajaxurl, {
				method: 'POST',
				body: formData
			})
			.then(response => response.json())
			.then(handleTestVerificationSuccess)
			.catch(handleTestVerificationError);
		}

		// Toggle visibility of sections based on enable checkbox
		document.getElementById('eh_turnstile_breakdance_enabled').addEventListener('change', handleToggleChange);

		// Load Turnstile script if not already loaded
		if (!document.querySelector('script[src*="challenges.cloudflare.com"]')) {
			const script = document.createElement('script');
			script.src = 'https://challenges.cloudflare.com/turnstile/v0/api.js?render=explicit';
			script.defer = true;
			script.onload = handleTurnstileScriptLoad;
			document.head.appendChild(script);
		}

		// Re-render widget when API keys change
		document.getElementById('eh_turnstile_site_key').addEventListener('blur', handleApiKeyBlur);
		document.getElementById('eh_turnstile_secret_key').addEventListener('blur', handleApiKeyBlur);

		// AJAX form submission for settings save
		document.getElementById('eh-save-settings').addEventListener('click', handleSaveSettingsClick);

		// AJAX form submission for test verification
		document.getElementById('eh-test-form').addEventListener('submit', handleTestFormSubmit);
	</script>

		<?php
}