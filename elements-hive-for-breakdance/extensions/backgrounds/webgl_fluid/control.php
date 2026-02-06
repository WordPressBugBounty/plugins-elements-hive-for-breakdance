<?php

namespace ElementsHiveForBreakdance\Extensions\Backgrounds\WebglFluid;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use function Breakdance\Elements\control;
use function Breakdance\Elements\controlSection;

/**
 * @return Control
 */
function controls() {
	/** @var Control */
	return controlSection(
		'webgl_fluid',
		'WebGL Fluid',
		[
			control(
				'fluid_preset',
				'Fluid Preset',
				[
					'type' => 'dropdown',
					'layout' => 'inline',
					'items' => [
						'0' => [ 'text' => 'Preset 1', 'value' => 'preset1' ],
						'1' => [ 'text' => 'Preset 2', 'value' => 'preset2' ],
						'2' => [ 'text' => 'Preset 3', 'value' => 'preset3' ],
						'3' => [ 'text' => 'Preset 4', 'value' => 'preset4' ],
						'4' => [ 'text' => 'Preset 5', 'value' => 'preset5' ],
						'5' => [ 'text' => 'Preset 6', 'value' => 'preset6' ],
						'6' => [ 'text' => 'Preset 7', 'value' => 'preset7' ],
						'7' => [ 'text' => 'Preset 8', 'value' => 'preset8' ],
					],
				]
			),
			control(
				'relative_to',
				'Relative To',
				[
					'type' => 'dropdown',
					'layout' => 'inline',
					'items' => [
						'0' => [ 'text' => 'Section', 'value' => 'section' ],
						'1' => [ 'text' => 'Page', 'value' => 'page' ],
					],
				]
			),
			control(
				'color_type',
				'Color Type',
				[
					'type' => 'dropdown',
					'layout' => 'inline',
					'items' => [
						'0' => [ 'text' => 'Colorful', 'value' => 'colorful' ],
						'1' => [ 'text' => 'Random', 'value' => 'random' ],
						'2' => [ 'text' => 'Custom', 'value' => 'custom' ],
					],
				]
			),
			control(
				'color',
				'Color',
				[
					'type' => 'color',
					'layout' => 'vertical',
					'colorOptions' => [ 'type' => 'solidOnly' ],
					'condition' => [ 'path' => '%%CURRENTPATH%%.color_type', 'operand' => 'equals', 'value' => 'custom' ],
				]
			),
			control('splat_radius', 'Radius', [
				'type' => 'number',
				'rangeOptions' => [
					'min' => 0.01,
					'max' => 1,
					'step' => 0.01,
				],
			]),
			control(
				'immediate',
				'Draw on Load',
				[
					'type' => 'toggle',
				]
			),
			control(
				'bloom',
				'Bloom',
				[
					'type' => 'toggle',
				]
			),
			control(
				'sunrays',
				'Sunrays',
				[
					'type' => 'toggle',
				]
			),
			control(
				'disable_on_touch_devices',
				'Disable on Touch Devices',
				[
					'type' => 'toggle',
				]
			),
			control(
				'inject_below_fxlayers',
				'Inject Below FX Layers',
				[
					'type' => 'toggle',
					'condition' => [
						'0' => [
							'0' => [ 'path' => 'design.fx_layers', 'operand' => 'is set', 'value' => '' ],
							'1' => [ 'path' => '%%CURRENTPATH%%.relative_to', 'operand' => 'not equals', 'value' => 'page' ],
						],
					],
				]
			),
			control(
				'infobox',
				'Infobox',
				[
					'type' => 'alert_box',
					'layout' => 'vertical',
					'alertBoxOptions' => [
						'style' => 'info',
						'content' => '<p>Injecting the background extension below the FX layers allows you to create advanced blending setups.</p>',
					],
					'condition' => [
						'0' => [
							'0' => [ 'path' => 'design.fx_layers', 'operand' => 'is set', 'value' => '' ],
							'1' => [ 'path' => '%%CURRENTPATH%%.relative_to', 'operand' => 'not equals', 'value' => 'page' ],
						],
					],
				],
			),
		],
		[
			'condition' => [ 'path' => 'design.elements_hive.backgrounds.background_type', 'operand' => 'equals', 'value' => 'webgl_fluid' ],
			'isExternal' => true,
		],
		'popout'
	);
}
