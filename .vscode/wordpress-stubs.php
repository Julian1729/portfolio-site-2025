<?php

/**
 * WordPress function stubs for Intelephense
 * This file helps the PHP language server understand WordPress functions
 */

// Ensure Intelephense knows we're in a WordPress environment
if (!defined('ABSPATH')) {
  define('ABSPATH', '/Users/julian1729/Local Sites/julian2025/app/public/');
}

// Include WordPress core functions path for better IntelliSense
if (!function_exists('get_header')) {
  require_once ABSPATH . 'wp-includes/functions.php';
  require_once ABSPATH . 'wp-includes/template-loader.php';
}
