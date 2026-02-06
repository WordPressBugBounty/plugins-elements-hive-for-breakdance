<?php

namespace ElementsHiveForBreakdance;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class GlueMenuButton extends \ElementsHiveForBreakdance\GlueButton {

	public static function name() {
		return 'Glue Menu Button';
	}

	public static function slug() {
		return __CLASS__;
	}

	public static function nestingRule() {
		return [ 'type' => 'final', 'restrictedToBeADirectChildOf' => [ 'EssentialElements\MenuBuilder' ] ];
	}
}
