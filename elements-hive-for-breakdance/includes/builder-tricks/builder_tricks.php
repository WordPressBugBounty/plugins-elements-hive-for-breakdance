<?php

namespace ElementsHiveForBreakdance\BuilderTricks;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_action( 'wp_enqueue_scripts', __NAMESPACE__ . '\enqueue_builder_tricks_scripts' );


function enqueue_builder_tricks_scripts() {

	if ( ! \Breakdance\isRequestFromBuilderIframe() ) {
		return;
	}

	wp_enqueue_script(
		'eh-builder-tricks-js',
		ELEMENTS_HIVE_ASSETS_DIR . 'builder/builder-tricks/eh_builder_tricks@1.1.0.min.js',
		[],
		'1.1',
		true
	);
}
