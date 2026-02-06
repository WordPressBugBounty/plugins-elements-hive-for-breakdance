<?php

namespace ElementsHiveForBreakdance\Extensions;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use function Breakdance\Elements\control;
use function Breakdance\Elements\controlSection;

add_filter( 'breakdance_element_controls', 'ElementsHiveForBreakdance\Extensions\addControls', 69, 2 );


/**
 * @param Control[] $controls
 * @param Element   $element
 * @return Control[]
 */
function addControls( $controls, $element ) {
	$slug = $element->slug();

	/**
	 * Sections Extensions
	 */
	if ( 'EssentialElements\\Section' === $slug || 'ElementsHiveForBreakdancePro\\EhSection' === $slug ) {

		$controls['designSections'][] = controlSection(
			'elements_hive',
			'Elements Hive',
			[
				\ElementsHiveForBreakdance\Extensions\Backgrounds\controls(),
				\ElementsHiveForBreakdance\Extensions\MouseCursors\controls(),
				\ElementsHiveForBreakdance\Extensions\Backlight\controls(),
				\ElementsHiveForBreakdance\Extensions\EdgeMask\controls(),
			],
			[ 'isExternal' => true ]
		);
	} else {
		$controls['designSections'][] = controlSection(
			'elements_hive',
			'Elements Hive',
			[
				\ElementsHiveForBreakdance\Extensions\Backlight\controls(),
				\ElementsHiveForBreakdance\Extensions\EdgeMask\controls(),
			],
			[ 'isExternal' => true ]
		);
	}

	/** Cloudflare Turnstile */
	if ( get_option( 'eh_turnstile_breakdance_enabled' ) && 'yes' === get_option( 'eh_turnstile_verified' ) ) {

		/** Breakdance Forms */
		if ( 'EssentialElements\\FormBuilder' === $slug ||
			'EssentialElements\\LoginForm' === $slug ||
			'EssentialElements\\RegisterForm' === $slug ||
			'EssentialElements\\ForgotPasswordForm' === $slug
			) {

			$controls['contentSections'][] = controlSection(
				'cloudflare_turnstile',
				'Cloudflare Turnstile',
				[
						...\ElementsHiveForBreakdance\Extensions\Forms\CloudflareTurnstile\controls(),
					],
				[ 'isExternal' => true ],
				'popout'
			);
		}
	}

	/** @var Control[] $controls */
	return $controls;
}
