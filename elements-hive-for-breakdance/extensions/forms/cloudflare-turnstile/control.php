<?php

namespace ElementsHiveForBreakdance\Extensions\Forms\CloudflareTurnstile;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use function Breakdance\Elements\control;

/**
 * @return Control[]
 */
function formbuilder_controls() {
	$enabled_condition = [
		'path' => '%%CURRENTPATH%%.enable_turnstile',
		'operand' => 'is set',
	];

	$enabled_condition_group = [ $enabled_condition ];
	$custom_source_condition = [
		'path' => '%%CURRENTPATH%%.api_key_source',
		'operand' => 'equals',
		'value' => 'custom',
	];

	$custom_keys_condition = [
		'0' => [
            '0' => $enabled_condition,
		    '1' => $custom_source_condition
        ]
	];

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
			'api_key_source',
			'API Key Source',
			[
				'type' => 'button_bar',
				'layout' => 'vertical',
				'items' => [
					'0' => [ 'text' => 'Default', 'value' => 'default' ],
					'1' => [ 'text' => 'Custom', 'value' => 'custom' ],
				],
				'condition' => [ $enabled_condition_group ],
			],
		),
		control(
			'site_key',
			'Site Key',
			[
				'type' => 'text',
				'layout' => 'vertical',
				'condition' => $custom_keys_condition,
			],
		),
		control(
			'secret_key',
			'Secret Key',
			[
				'type' => 'text',
				'layout' => 'vertical',
				'condition' => $custom_keys_condition,
			],
		),
		...shared_controls(),
	];
}

/**
 * @return Control[]
 */
function global_only_controls() {
	return [
		control(
			'enable_turnstile',
			'Enable Cloudflare Turnstile',
			[
				'type' => 'toggle',
				'layout' => 'inline',
			],
		),
		...shared_controls(),
	];
}

/**
 * @return Control[]
 */
function shared_controls() {
	$enabled_condition = [
		'path' => '%%CURRENTPATH%%.enable_turnstile',
		'operand' => 'is set',
	];

	return [
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
				'condition' => $enabled_condition,
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
				'condition' => $enabled_condition,
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
				'condition' => $enabled_condition,
			],
		),
		control(
			'disable_submit_until_verified',
			'Disable Submit Button Until Verified',
			[
				'type' => 'toggle',
				'layout' => 'inline',
				'condition' => $enabled_condition,
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
				'condition' => $enabled_condition,
			]
		),
	];
}
