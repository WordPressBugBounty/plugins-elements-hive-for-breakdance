<?php
/**
 * Turnstile Base Loader
 * 
 * @package ElementsHiveForBreakdance
 */

namespace ElementsHiveForBreakdance\CloudflareTurnstile;

if (!defined('ABSPATH')) {
    exit;
}

// Load turnstile components
require_once __DIR__ . '/render.php';
require_once __DIR__ . '/validation.php';
require_once __DIR__ . '/breakdance-integration.php';

