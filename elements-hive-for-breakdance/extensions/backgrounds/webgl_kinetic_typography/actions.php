<?php

namespace ElementsHiveForBreakdance\Extensions\Backgrounds\WebglKineticTypography;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_filter( 'breakdance_element_actions', '\ElementsHiveForBreakdance\Extensions\Backgrounds\WebglKineticTypography\addActions', 100, 1 );

function addActions( $actions ) {
	$actions[] = [
		'onPropertyChange' => [
			[
				'script' => <<<'JS'
					( function() {
						if ('{{design.elements_hive.backgrounds.background_type}}' == 'webgl_kinetic_typography' ) {
							const containerEl = document.querySelector('%%SELECTOR%%');
							const settings = {{design.elements_hive.backgrounds.webgl_kinetic_typography|json_encode}} ?? {};
							let instance = null;
							if ( window.EhInstancesManager.instanceExists('EhWebglKineticTypography', '%%ID%%') ) {
								instance = window.EhInstancesManager.getInstance('EhWebglKineticTypography', '%%ID%%');
								instance.update(settings);
							} else {
								const options = {
									containerEl: containerEl,
									sectionContainer: containerEl.querySelector('.section-container'),
									eventsContainer: settings?.apply_to_page ? window : containerEl,
									id: %%ID%%,
									placeholderImage: "{{getElementsHivePluginUrl()}}assets/images/placeholders/elements-hive-text.jpg",
									...settings
								}
								const instance = new EhWebglKineticTypography(options);
								window.EhInstancesManager.registerInstance("EhWebglKineticTypography", "%%ID%%", instance);
							}
						} else {
							if ( window?.EhInstancesManager?.instanceExists('EhWebglKineticTypography', '%%ID%%') ) {
								window.EhInstancesManager.deleteInstance('EhWebglKineticTypography', '%%ID%%');
							}
							document.querySelector('.eh-webgl-kinetic-typography-%%ID%%')?.remove();
						}
					}());
				JS,
				'dependencies' => [
					'design.elements_hive.backgrounds',
				],
			],
		],
	];
	$actions[] = [
		'onPropertyChange' => [
			[
				'script' => <<<'JS'
					( function() {
						if ('{{design.elements_hive.backgrounds.background_type}}' == 'webgl_kinetic_typography' ) {
							const settings = {{design.elements_hive.backgrounds.webgl_kinetic_typography|json_encode}} ?? {};
							if (settings?.apply_to_page == false) {
								return
							}
							let doReset = false
							const containerEl = document.querySelector('%%SELECTOR%%');
							const fxLayers = containerEl.querySelector('.eh-fx-layers');
							const webglKineticTypography = containerEl.querySelector('.eh-webgl-kinetic-typography-%%ID%%');
							const sectionContainer = containerEl.querySelector('.section-container');
							const sectionChildren = Array.from(containerEl.children);
							const kineticIndex = sectionChildren.indexOf(webglKineticTypography);
							const fxLayersIndex = sectionChildren.indexOf(fxLayers);
							const sectionContainerIndex = sectionChildren.indexOf(sectionContainer);
							if ( fxLayers ) {
								if ( kineticIndex < fxLayersIndex ) {
									doReset = true
								}
							} else {
								if ( kineticIndex > sectionContainerIndex ) {
									doReset = true
								}
							}
							if ( doReset ) {
								if ( window?.EhInstancesManager?.instanceExists('EhWebglKineticTypography', '%%ID%%') ) {
									window.EhInstancesManager.deleteInstance('EhWebglKineticTypography', '%%ID%%');
								}
								document.querySelector('.eh-webgl-kinetic-typography-%%ID%%')?.remove();
								const options = {
									containerEl: containerEl,
									sectionContainer: sectionContainer,
									eventsContainer: settings?.apply_to_page ? window : containerEl,
									id: %%ID%%,
									placeholderImage: "{{getElementsHivePluginUrl()}}assets/images/placeholders/elements-hive-text.jpg",
									...settings
								}
								const instance = new EhWebglKineticTypography(options);
								window.EhInstancesManager.registerInstance("EhWebglKineticTypography", "%%ID%%", instance);
							}
						}
					}());
				JS,
				'dependencies' => [
					'design.fx_layers',
				],
			],
		],
	];

	return $actions;
}
