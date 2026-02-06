<?php

namespace ElementsHiveForBreakdance\Admin\Parts\Header;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use function ElementsHiveForBreakdance\Admin\Parts\Logo\render as render_logo;
use function ElementsHiveForBreakdance\Admin\Parts\LinkButton\render as render_link_button;

/**
 * Render header for admin pages
 */
function render() {

	?>
	<style>
		.eh-adm-body * {
			padding: 0;
			margin: 0;
		}

		.eh-adm-body {
			--eh-adm-background-color: #f8f8f8;
			--eh-adm-background-color-alternative: #fff;
			--eh-adm-text-color: #1D1D1D;
			--eh-adm-text-color-alternative: #0C0B0B;
			--eh-adm-text-color-light: #f8f8f8;
			--eh-adm-accent-color: #FD5A00;
			--eh-adm-gap-small: 10px;
			--eh-adm-gap-large: 20px;
			--eh-adm-gap-xlarge: 40px;
			--eh-adm-padding-large: 20px;
			--eh-adm-padding-medium: 10px;
			--eh-adm-padding-small: 5px;
			--eh-adm-border-radius-xsmall: 2.5px;
			--eh-adm-border-radius-small: 5px;
			--eh-adm-border-radius-medium: 10px;
			--eh-adm-border-radius-large: 20px;
			--eh-adm-border-radius-xlarge: 40px;
			--eh-adm-box-shadow-dark: 0 0 5px rgba(0, 0, 0, 0.1);
			--eh-adm-box-shadow-light: 0 0 5px rgba(50, 50, 50, 0.1);
			--eh-adm-font-bold: 600;
			margin: 30px 30px 0 0px;
			min-height: 70vh;
		}

		/* Component Specific Styles */
		.eh-adm-video-container {
			width: 60%;
			aspect-ratio: 16/9;
		}

		.eh-adm-header__logo svg {
			width: 100%;
		}

		a.eh-adm-header__link:hover {
			color: var(--eh-adm-accent-color);
		}

		.eh-adm-heading {
			line-height: 1.2;
			font-size: 2rem;
		}

		.eh-adm-card__heading {
			font-size: 1.3rem;
		}

		.eh-adm-button:hover {
			background-color: var(--eh-adm-text-color-alternative);
			color: var(--eh-adm-background-color-alternative);
		}

		.eh-adm-selectors-upload-error-format {
			margin-top: 10px;
			color: red;
			transition: .3s ease.out .3s;
		}

		.eh-adm-selectors-upload-error-format.is-visible {
			display: block;
		}

		.eh-adm-error-animation {
			animation: eh-adm-error-animation 0.3s cubic-bezier(0.48, 0.2, 0.57, 0.89) both;
		}

		@keyframes eh-adm-error-animation {
			0%,
			100% {
				transform: translateX(0);
			}
			10%,
			30%,
			50%,
			70% {

				transform: translateX(15px);
			}
			20%,
			40%,
			60% {
				transform: translateX(-15px);
			}
			70% {
				transform: translateX(-10px);
			}
			90% {
				transform: translateX(10px);
			}
		}

		.eh-adm-icon {
			width: 2.5rem;
			height: 2.5rem;
			fill: none;
			stroke: currentColor;
			stroke-width: 2;
		}

		.eh-adm-icon svg {
			width: 100%;
			height: 100%;
		}

		/* Verification Message Styles */
		#eh-verification-message {
			margin-top: 20px;
		}

		.eh-adm-message__content {
			padding: 12px 16px;
			border-radius: 4px;
			border-left: 4px solid;
			font-size: 14px;
			line-height: 1.5;
		}

		.eh-adm-message__content span {
			display: block;
			margin: 0;
		}

		/* Success Message */
		.eh-adm-message--success {
			background-color: #d4edda;
			border-color: #28a745;
			color: #155724;
		}

		/* Error Message */
		.eh-adm-message--error {
			background-color: #f8d7da;
			border-color: #dc3545;
			color: #721c24;
		}

		/* Warning Message */
		.eh-adm-message--warning {
			background-color: #fff3cd;
			border-color: #ffc107;
			color: #856404;
		}

		/* Toggle Switch Styles */
		.eh-adm-toggle-label {
			position: relative;
			display: inline-block;
			width: 50px;
			height: 24px;
			cursor: pointer;
		}

		.eh-adm-toggle-input {
			opacity: 0;
			width: 0;
			height: 0;
			position: absolute;
		}

		.eh-adm-toggle-slider {
			position: absolute;
			top: 0;
			left: 0;
			right: 0;
			bottom: 0;
			background-color: #ccc;
			transition: 0.3s;
			border-radius: 24px;
		}

		.eh-adm-toggle-slider:before {
			position: absolute;
			content: "";
			height: 18px;
			width: 18px;
			left: 3px;
			bottom: 3px;
			background-color: white;
			transition: 0.3s;
			border-radius: 50%;
		}

		.eh-adm-toggle-input:checked + .eh-adm-toggle-slider {
			background-color: var(--eh-adm-accent-color);
		}

		.eh-adm-toggle-input:focus + .eh-adm-toggle-slider {
			box-shadow: 0 0 1px var(--eh-adm-accent-color);
		}

		.eh-adm-toggle-input:checked + .eh-adm-toggle-slider:before {
			transform: translateX(26px);
		}

		.eh-adm-toggle-input:disabled + .eh-adm-toggle-slider {
			opacity: 0.5;
			cursor: not-allowed;
		}

		/* Link Button Styles */
		.eh-adm-link-button:hover {
			background-color: var(--eh-adm-text-color-alternative);
			color: var(--eh-adm-background-color-alternative);
		}

		.eh-adm-link-button--secondary {
			background-color: var(--eh-adm-text-color-alternative);
			color: var(--eh-adm-text-color-light);
		}

		.eh-adm-link-button--secondary:hover {
			background-color: var(--eh-adm-accent-color);
			color: var(--eh-adm-text-color-alternative);
		}

		.eh-adm-link-button--large {
			padding: var(--eh-adm-padding-medium) var(--eh-adm-padding-large);
			border-radius: var(--eh-adm-border-radius-medium);
		}

		/* Utility Classes */
		/* Layout */
		.eh-adm-flex { display: flex; }
		.eh-adm-flex-col { flex-direction: column; }
		.eh-adm-flex-row { flex-direction: row; }
		.eh-adm-items-center { align-items: center; }
		.eh-adm-items-start { align-items: flex-start; }
		.eh-adm-justify-between { justify-content: space-between; }
		.eh-adm-justify-center { justify-content: center; }
		.eh-adm-flex-1 { flex: 1; }
		.eh-adm-flex-grow { flex-grow: 1; }
		.eh-adm-self-start { align-self: flex-start; }

		/* Grid */
		.eh-adm-grid { display: grid; }
		.eh-adm-grid-auto-fit {
			grid-template-columns: repeat(auto-fit, minmax(300px,1fr));
		}

		/* Gap */
		.eh-adm-gap-sm { gap: var(--eh-adm-gap-small); }
		.eh-adm-gap-lg { gap: var(--eh-adm-gap-large); }
		.eh-adm-gap-xl { gap: var(--eh-adm-gap-xlarge); }

		/* Padding */
		.eh-adm-p-sm { padding: var(--eh-adm-padding-small); }
		.eh-adm-p-md { padding: var(--eh-adm-padding-medium); }
		.eh-adm-p-lg { padding: var(--eh-adm-padding-large); }
		.eh-adm-px-sm { padding-left: var(--eh-adm-padding-small); padding-right: var(--eh-adm-padding-small); }
		.eh-adm-px-md { padding-left: var(--eh-adm-padding-medium); padding-right: var(--eh-adm-padding-medium); }
		.eh-adm-px-lg { padding-left: var(--eh-adm-padding-large); padding-right: var(--eh-adm-padding-large); }
		.eh-adm-py-sm { padding-top: var(--eh-adm-padding-small); padding-bottom: var(--eh-adm-padding-small); }
		.eh-adm-py-md { padding-top: var(--eh-adm-padding-medium); padding-bottom: var(--eh-adm-padding-medium); }

		/* Border Radius */
		.eh-adm-rounded-xs { border-radius: var(--eh-adm-border-radius-xsmall); }
		.eh-adm-rounded-sm { border-radius: var(--eh-adm-border-radius-small); }
		.eh-adm-rounded-md { border-radius: var(--eh-adm-border-radius-medium); }
		.eh-adm-rounded-lg { border-radius: var(--eh-adm-border-radius-large); }
		.eh-adm-rounded-xl { border-radius: var(--eh-adm-border-radius-xlarge); }

		/* Background */
		.eh-adm-bg { background-color: var(--eh-adm-background-color); }
		.eh-adm-bg-alt { background-color: var(--eh-adm-background-color-alternative); }
		.eh-adm-bg-accent { background-color: var(--eh-adm-accent-color); }
		.eh-adm-bg-black { background-color: var(--eh-adm-text-color-alternative); }

		/* Text Color */
		.eh-adm-text { color: var(--eh-adm-text-color); }
		.eh-adm-text-alt { color: var(--eh-adm-text-color-alternative); }
		.eh-adm-text-accent { color: var(--eh-adm-accent-color); }
		.eh-adm-text-light { color: var(--eh-adm-text-color-light); }

		/* Text Alignment */
		.eh-adm-text-center { text-align: center; }

		/* Font Size  */
		.eh-adm-text-xs { font-size: clamp(0.625rem, 0.5rem + 0.25vw, 0.75rem); } /* 10-12px */
		.eh-adm-text-sm { font-size: clamp(0.75rem, 0.65rem + 0.25vw, 0.875rem); } /* 12-14px */
		.eh-adm-text-base { font-size: clamp(0.875rem, 0.8rem + 0.25vw, 1rem); } /* 14-16px */
		.eh-adm-text-lg { font-size: clamp(1rem, 0.9rem + 0.5vw, 1.125rem); } /* 16-18px */
		.eh-adm-text-xl { font-size: clamp(1.125rem, 1rem + 0.625vw, 1.25rem); } /* 18-20px */
		.eh-adm-text-2xl { font-size: clamp(1.25rem, 1rem + 1.25vw, 1.5rem); } /* 20-24px */
		.eh-adm-text-3xl { font-size: clamp(1.5rem, 1.2rem + 1.5vw, 1.875rem); } /* 24-30px */
		.eh-adm-text-4xl { font-size: clamp(1.875rem, 1.5rem + 1.875vw, 2.25rem); } /* 30-36px */
		.eh-adm-text-5xl { font-size: clamp(2.25rem, 1.75rem + 2.5vw, 3rem); } /* 36-48px */

		/* Font Weight */
		.eh-adm-font-bold { font-weight: var(--eh-adm-font-bold); }

		/* Line Height */
		.eh-adm-line-height-lg { line-height: 1.25; }

		/* Box Shadow */
		.eh-adm-shadow-light { box-shadow: var(--eh-adm-box-shadow-light); }
		.eh-adm-shadow-dark { box-shadow: var(--eh-adm-box-shadow-dark); }

		/* Width */
		.eh-adm-w-full { width: 100%; }
		.eh-adm-w-30 { width: 30%; }
		.eh-adm-w-60 { width: 60%; }

		/* Display */
		.eh-adm-hidden { display: none; }
		.eh-adm-block { display: block; }

		/* Margin */
		.eh-adm-m-0 { margin: 0; }
		.eh-adm-mt-auto { margin-top: auto; }
		.eh-adm-mt-lg { margin-top: 40px; }
		.eh-adm-mb-lg { margin-bottom: 40px; }
		

		/* Transitions */
		.eh-adm-transition { transition: all .3s ease-in-out; }
		.eh-adm-transition-fast { transition: .2s ease-out; }

		/* Cursor */
		.eh-adm-cursor-pointer { cursor: pointer; }

		/* Border */
		.eh-adm-border-none { border: none; }

		/* Text Decoration */
		.eh-adm-no-underline { text-decoration: none; }

		/* Icons */
		.eh-adm-stroke-accent { stroke: var(--eh-adm-accent-color); }

	</style>
	<div class="eh-adm-header eh-adm-flex eh-adm-justify-between eh-adm-items-center eh-adm-py-md eh-adm-px-md eh-adm-rounded-lg eh-adm-bg-alt">
		<?php
			render_logo();
			render_link_button( 'https://elementshive.com/#pricing', 'Get Elements Hive Pro', 'primary', 'large', 'rounded-md' );
		?>
	</div>

	<?php
}
