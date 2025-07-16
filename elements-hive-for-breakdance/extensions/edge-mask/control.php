<?php

namespace ElementsHiveForBreakdance\Extensions\EdgeMask;

use function Breakdance\Elements\control;
use function Breakdance\Elements\controlSection;

/**
 * @return Control
 */
function controls() {
	/** @var Control */
	return controlSection(
		'edge_mask',
		'Edge Mask',
		[
			control(
				'enabled',
				'Enabled',
				[
					'type' => 'toggle',
					'layout' => 'inline',
				],
			),
			control(
				'style',
				'Style',
				[
					'type' => 'button_bar',
					'layout' => 'inline',
					'items' => [
						['value' => 'linear', 'text' => 'Linear', 'icon' => 'BarsIcon'],
						['value' => 'radial', 'text' => 'Radial', 'icon' => 'CircleIcon'],
					],
					'condition' => [
						'0' => [ 
							'0' => [
								'path' => '%%CURRENTPATH%%.enabled', 
								'operand' => 'equals', 
								'value' => true
							] 
						] 
					],
				]
			),
			control(
				'mask_size',
				'Mask Size',
				[
					'type' => 'unit',
					'layout' => 'inline',
					'rangeOptions' => [
						'min' => 10,
						'max' => 100,
						'step' => 1,
					],
					'condition' => [
						'0' => [ 
							'0' => [
								'path' => '%%CURRENTPATH%%.enabled', 
								'operand' => 'equals', 
								'value' => true
							],
							'1' => [
								'path' => '%%CURRENTPATH%%.style', 
								'operand' => 'equals', 
								'value' => 'radial'
							],
						] 
					],
				],
				true
			),
			control(
				'axis',
				'Axis',
				[
					'type' => 'button_bar',
					'layout' => 'inline',
					'items' => [
						['value' => 'horizontal', 'text' => 'Horizontal', 'icon' => 'LeftAndRightArrowsIcon'], 
						['value' => 'vertical', 'text' => 'Vertical', 'icon' => 'UpAndDownArrowsIcon']
					],
					'condition' => [
						'0' => [ 
							'0' => [
								'path' => '%%CURRENTPATH%%.enabled', 
								'operand' => 'equals', 
								'value' => true],
							'1' => [
								'path' => '%%CURRENTPATH%%.style', 
								'operand' => 'equals', 
								'value' => 'linear']
						] 
					],
				],
			),
			control(
				'mask_size_top',
				'Mask Size Top',
				[
					'type' => 'unit',
					'layout' => 'inline',
					'rangeOptions' => [
						'min' => 10,
						'max' => 100,
						'step' => 1,
					],
					'condition' => [
						'0' => [ 
							'0' => [
								'path' => '%%CURRENTPATH%%.enabled', 
								'operand' => 'equals', 
								'value' => true
							],
							'1' => [
								'path' => '%%CURRENTPATH%%.style', 
								'operand' => 'equals', 
								'value' => 'linear'
							],
							'2' => [
								'path' => '%%CURRENTPATH%%.axis', 
								'operand' => 'equals', 
								'value' => 'vertical'
							],
						] 
					],
				],
				true
			),
			control(
				'mask_size_bottom',
				'Mask Size Bottom',
				[
					'type' => 'unit',
					'layout' => 'inline',
					'rangeOptions' => [
						'min' => 10,
						'max' => 100,
						'step' => 1,
					],
					'condition' => [
						'0' => [ 
							'0' => [
								'path' => '%%CURRENTPATH%%.enabled', 
								'operand' => 'equals', 
								'value' => true
							],
							'1' => [
								'path' => '%%CURRENTPATH%%.style', 
								'operand' => 'equals', 
								'value' => 'linear'
							],
							'2' => [
								'path' => '%%CURRENTPATH%%.axis', 
								'operand' => 'equals', 
								'value' => 'vertical'
							],
						] 
					],
				],
				true
			),
			control(
				'mask_size_left',
				'Mask Size Left',
				[
					'type' => 'unit',
					'layout' => 'inline',
					'rangeOptions' => [
						'min' => 10,
						'max' => 100,
						'step' => 1,
					],
					'condition' => [
						'0' => [ 
							'0' => [
								'path' => '%%CURRENTPATH%%.enabled', 
								'operand' => 'equals', 
								'value' => true
							],
							'1' => [
								'path' => '%%CURRENTPATH%%.style', 
								'operand' => 'equals', 
								'value' => 'linear'
							],
							'2' => [
								'path' => '%%CURRENTPATH%%.axis', 
								'operand' => 'equals', 
								'value' => 'horizontal'
							],
						] 
					],
				],
				true
			),
			control(
				'mask_size_right',
				'Mask Size Right',
				[
					'type' => 'unit',
					'layout' => 'inline',
					'rangeOptions' => [
						'min' => 10,
						'max' => 100,
						'step' => 1,
					],
					'condition' => [
						'0' => [ 
							'0' => [
								'path' => '%%CURRENTPATH%%.enabled', 
								'operand' => 'equals', 
								'value' => true
							],
							'1' => [
								'path' => '%%CURRENTPATH%%.style', 
								'operand' => 'equals', 
								'value' => 'linear'
							],
							'2' => [
								'path' => '%%CURRENTPATH%%.axis', 
								'operand' => 'equals', 
								'value' => 'horizontal'
							],
						] 
					],
				],
				true
			),
		],
		[ 'isExternal' => true ],
		'popout'
	);
}

