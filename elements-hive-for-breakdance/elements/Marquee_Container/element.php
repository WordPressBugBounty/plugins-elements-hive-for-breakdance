<?php

namespace ElementsHiveForBreakdance;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use function Breakdance\Elements\c;
use function Breakdance\Elements\PresetSections\getPresetSection;


\Breakdance\ElementStudio\registerElementForEditing(
	'ElementsHiveForBreakdance\\MarqueeContainer',
	\Breakdance\Util\getdirectoryPathRelativeToPluginFolder( __DIR__ )
);

class MarqueeContainer extends \Breakdance\Elements\Element {

	public static function uiIcon() {
		return 'SquareIcon';
	}

	public static function tag() {
		return 'div';
	}

	public static function tagOptions() {
		return [];
	}

	public static function tagControlPath() {
		return false;
	}

	public static function name() {
		return 'Marquee Container';
	}

	public static function className() {
		return 'eh-marquee-container';
	}

	public static function category() {
		return 'elements_hive';
	}

	public static function badge() {
		return [ 'backgroundColor' => 'var(--yellow300)', 'textColor' => 'var(--black)', 'label' => 'EH' ];
	}

	public static function slug() {
		return __CLASS__;
	}

	public static function template() {
		return file_get_contents( __DIR__ . '/html.twig' );
	}

	public static function defaultCss() {
		return file_get_contents( __DIR__ . '/default.css' );
	}

	public static function defaultProperties() {
		return false;
	}

	public static function defaultChildren() {
		return false;
	}

	public static function cssTemplate() {
		$template = file_get_contents( __DIR__ . '/css.twig' );
		return $template;
	}

	public static function designControls() {
		return [
		c(
			'container',
			'Container',
			[
			c(
				'layout',
				'Layout',
				[],
				[ 'type' => 'button_bar', 'layout' => 'inline', 'items' => [ [ 'value' => 'row', 'text' => '', 'icon' => 'LeftAndRightArrowsIcon' ], [ 'value' => 'column', 'text' => '', 'icon' => 'UpAndDownArrowsIcon' ] ] ],
				true,
				false,
				[],
			),
			c(
				'align',
				'Align',
				[],
				[ 'type' => 'button_bar', 'layout' => 'inline', 'items' => [ [ 'value' => 'flex-start', 'text' => 'Start' ], [ 'value' => 'center', 'text' => 'Center' ], [ 'value' => 'flex-end', 'text' => 'End' ] ] ],
				true,
				false,
				[],
			),
			c(
				'gap',
				'Gap',
				[],
				[ 'type' => 'unit', 'layout' => 'inline' ],
				true,
				false,
				[],
			),
			c(
				'width',
				'Width',
				[],
				[ 'type' => 'unit', 'layout' => 'inline' ],
				true,
				false,
				[],
			),
			c(
				'height',
				'Height',
				[],
				[ 'type' => 'unit', 'layout' => 'inline' ],
				true,
				false,
				[],
			),
			c(
				'fade_edges',
				'Fade Edges',
				[],
				[ 'type' => 'toggle', 'layout' => 'inline' ],
				false,
				false,
				[],
			),
			c(
				'fade_size',
				'Fade Size',
				[],
				[ 'type' => 'unit', 'layout' => 'inline', 'condition' => [ [ [ 'path' => 'design.container.fade_edges', 'operand' => 'is set', 'value' => '' ] ] ] ],
				true,
				false,
				[],
			),
			],
			[ 'type' => 'section' ],
			false,
			false,
			[],
		),
		c(
			'animation',
			'Animation',
			[
			c(
				'direction',
				'Direction',
				[],
				[ 'type' => 'button_bar', 'layout' => 'inline', 'items' => [ [ 'value' => 'flex-start', 'text' => 'Default' ], [ 'text' => 'Reverse', 'value' => 'flex-end' ] ] ],
				true,
				false,
				[],
			),
			c(
				'speed',
				'Speed',
				[],
				[ 'type' => 'number', 'layout' => 'inline', 'unitOptions' => [ 'types' => [ 's' ] ], 'rangeOptions' => [ 'min' => 1, 'max' => 10, 'step' => 1 ] ],
				true,
				false,
				[],
			),
			c(
				'pause_on_hover',
				'Pause on Hover',
				[],
				[ 'type' => 'toggle', 'layout' => 'inline' ],
				false,
				false,
				[],
			),
			],
			[ 'type' => 'section' ],
			false,
			false,
			[],
		),
		getPresetSection(
			'EssentialElements\\spacing_padding_all',
			'Padding',
			'padding',
			[ 'type' => 'popout' ]
		),
		getPresetSection(
			'EssentialElements\\spacing_margin_y',
			'Spacing',
			'spacing',
			[ 'type' => 'popout' ]
		),
		];
	}

	public static function contentControls() {
		return [];
	}

	public static function settingsControls() {
		return [];
	}

	public static function dependencies() {
		return [
		'0' => [
		'title' => 'Init',
		'inlineScripts' => [
		'( function() {

 const containerEl = document.querySelector(\'%%SELECTOR%%\')
 if( !containerEl || containerEl.classList.contains(\'breakdance--empty-container\') ) return

 const options = {
 	containerEl,
   ...{{design|json_encode}}
 }
 new EhMarqueeContainer(options)

})();',
		],
		'scripts' => [ ELEMENTS_HIVE_DIR . 'elements/Marquee_Container/assets/js/eh_marquee_container.min.js' ],
		],
		];
	}

	public static function settings() {
		return false;
	}

	public static function addPanelRules() {
		return false;
	}

	public static function actions() {
		return [

		'onPropertyChange' => [
		[
		'script' => '( function() {

 const containerEl = document.querySelector(\'%%SELECTOR%%\')
 if( !containerEl || containerEl.classList.contains(\'breakdance--empty-container\') ) return

 const options = {
 	containerEl,
    ...{{design|json_encode}}
 }
 new EhMarqueeContainer(options)

})();',
		],
		],

		'onActivatedElement' => [
		[
		'script' => '( function() {

 const containerEl = document.querySelector(\'%%SELECTOR%%\')
 if( !containerEl || containerEl.classList.contains(\'breakdance--empty-container\') ) return

 const options = {
 	containerEl,
    ...{{design|json_encode}}
 }
 new EhMarqueeContainer(options)

})();',
		],
		],
		];
	}

	public static function nestingRule() {
		return [ 'type' => 'container' ];
	}

	public static function spacingBars() {
		return [ [ 'cssProperty' => 'margin-top', 'location' => 'outside-top', 'affectedPropertyPath' => 'design.spacing.margin_top.%%BREAKPOINT%%' ], [ 'cssProperty' => 'margin-bottom', 'location' => 'outside-bottom', 'affectedPropertyPath' => 'design.spacing.margin_bottom.%%BREAKPOINT%%' ] ];
	}

	public static function attributes() {
		return [ [ 'name' => 'data-fade-edges', 'template' => '{{design.container.fade_edges}}' ] ];
	}

	public static function experimental() {
		return false;
	}

	public static function order() {
		return 8;
	}

	public static function dynamicPropertyPaths() {
		return [];
	}

	public static function additionalClasses() {
		return false;
	}

	public static function projectManagement() {
		return false;
	}

	public static function propertyPathsToWhitelistInFlatProps() {
		return false;
	}

	public static function propertyPathsToSsrElementWhenValueChanges() {
		return false;
	}
}
