<?php

namespace ElementsHiveForBreakdance;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use function Breakdance\Elements\c;
use function Breakdance\Elements\PresetSections\getPresetSection;


\Breakdance\ElementStudio\registerElementForEditing(
	'ElementsHiveForBreakdance\\GlueButton',
	\Breakdance\Util\getdirectoryPathRelativeToPluginFolder( __DIR__ )
);

class GlueButton extends \Breakdance\Elements\Element {

	public static function uiIcon() {
		return 'HoverIcon';
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
		return 'Glue Button';
	}

	public static function className() {
		return 'eh-glue-button';
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
		getPresetSection(
			'EssentialElements\\AtomV1ButtonDesign',
			'Button',
			'button',
			[ 'type' => 'popout' ]
		),
		getPresetSection(
			'EssentialElements\\lightbox_single_design',
			'Lightbox',
			'lightbox',
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
		return [
		getPresetSection(
			'EssentialElements\\AtomV1ButtonContent',
			'Content',
			'content',
			[ 'type' => 'popout' ]
		),
		];
	}

	public static function settingsControls() {
		return [];
	}

	public static function dependencies() {
		return [
		'0' => [
		'inlineScripts' => [
		'( () => {
	const containerElement = document.querySelector(\'%%SELECTOR%%\');
	const button = containerElement.querySelector(\'.eh-glue-button\');
	const options = {
	  container: containerElement,
	  button
	}
	new EhGlueButton(options);

	})()',
		],
		'scripts' => [ ELEMENTS_HIVE_DIR . 'elements/Glue_Button/assets/js/eh_glue_button.min.js' ],
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
		return false;
	}

	public static function nestingRule() {
		return [ 'type' => 'final' ];
	}

	public static function spacingBars() {
		return [ '0' => [ 'location' => 'outside-top', 'cssProperty' => 'margin-top', 'affectedPropertyPath' => 'design.spacing.margin_top.%%BREAKPOINT%%' ], '1' => [ 'location' => 'outside-bottom', 'cssProperty' => 'margin-bottom', 'affectedPropertyPath' => 'design.spacing.margin_bottom.%%BREAKPOINT%%' ] ];
	}

	public static function attributes() {
		return false;
	}

	public static function experimental() {
		return false;
	}

	public static function order() {
		return 6;
	}

	public static function dynamicPropertyPaths() {
		return [ '0' => [ 'accepts' => 'string', 'path' => 'content.content.text' ], '1' => [ 'accepts' => 'string', 'path' => 'content.content.link.url' ] ];
	}

	public static function additionalClasses() {
		return [ [ 'name' => 'bde-button', 'template' => 'yes' ] ];
	}

	public static function projectManagement() {
		return false;
	}

	public static function propertyPathsToWhitelistInFlatProps() {
		return [ 'design.button.custom.size.full_width_at', 'design.button.style' ];
	}

	public static function propertyPathsToSsrElementWhenValueChanges() {
		return false;
	}
}
