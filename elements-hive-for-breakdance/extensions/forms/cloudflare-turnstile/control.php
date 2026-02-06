<?php

namespace ElementsHiveForBreakdance\Extensions\Forms\CloudflareTurnstile;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use function Breakdance\Elements\control;
use function Breakdance\Elements\controlSection;

/**
 * @return Control[]
 */
function controls() {
	return [
		control(
			'enable_turnstile',
			'Enable Cloudflare Turnstile',
			[
				'type' => 'toggle',
				'layout' => 'inline',
			],
		),
		control(
			'size',
			'Size',
			[
				'type' => 'dropdown',
				'layout' => 'inline',
				'items' => [
					'0' => [ 'text' => 'Normal', 'value' => 'normal' ],
					'1' => [ 'text' => 'Flexible', 'value' => 'flexible' ],
					'2' => [ 'text' => 'Compact', 'value' => 'compact' ],
				],
				'condition' => [
							'path' => '%%CURRENTPATH%%.enable_turnstile',
							'operand' => 'is set',
				],
			],
		),
		control(
			'appearance',
			'Appearance',
			[
				'type' => 'dropdown',
				'layout' => 'inline',
				'items' => [
					'0' => [ 'text' => 'Always', 'value' => 'always' ],
					'1' => [ 'text' => 'Execute', 'value' => 'execute' ],
					'2' => [ 'text' => 'Interaction Only', 'value' => 'interaction-only' ],
				],
				'condition' => [
							'path' => '%%CURRENTPATH%%.enable_turnstile',
							'operand' => 'is set',
				],
			],
		),
		control(
			'theme',
			'Theme',
			[
				'type' => 'button_bar',
				'layout' => 'inline',
				'items' => [
					'0' => [ 'text' => 'Auto', 'value' => 'auto' ],
					'1' => [ 'text' => 'Light', 'value' => 'light' ],
					'2' => [ 'text' => 'Dark', 'value' => 'dark' ],
				],
				'condition' => [
							'path' => '%%CURRENTPATH%%.enable_turnstile',
							'operand' => 'is set',
				],
			],
		),
		control(
			'cloudflare_documentation',
			'Cloudflare Documentation',
			[
				'type' => 'alert_box',
				'layout' => 'vertical',
				'alertBoxOptions' => [
					'style' => 'info',
					'content' => '<a href="https://developers.cloudflare.com/turnstile/get-started/client-side-rendering/widget-configurations/" target="_blank">Cloudflare Documentation</a>',
				],
				'condition' => [
							'path' => '%%CURRENTPATH%%.enable_turnstile',
							'operand' => 'is set',
				],
			]
		),
	];
}
