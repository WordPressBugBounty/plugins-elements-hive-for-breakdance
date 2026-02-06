<?php

namespace ElementsHiveForBreakdance;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class LinkMediaRevealMenu extends \ElementsHiveForBreakdance\LinkMediaReveal {

	public static function name() {
		return 'Link Media Reveal Menu';
	}

	public static function slug() {
		return __CLASS__;
	}

	public static function nestingRule() {
		return [ 'type' => 'final', 'restrictedToBeADirectChildOf' => [ 'EssentialElements\MenuBuilder' ] ];
	}
}
