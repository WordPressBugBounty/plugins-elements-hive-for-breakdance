<?php

namespace ElementsHiveForBreakdance;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class GooeyMenuLink extends \ElementsHiveForBreakdance\GooeyLink {

	public static function name() {
		return 'Gooey Menu Link';
	}

	public static function slug() {
		return __CLASS__;
	}

	public static function nestingRule() {
		return [ 'type' => 'final', 'restrictedToBeADirectChildOf' => [ 'EssentialElements\MenuBuilder' ] ];
	}
}
