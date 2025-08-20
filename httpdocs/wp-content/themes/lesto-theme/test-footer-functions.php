<?php
/**
 * Test Footer Functions - Debug Script
 * Verify that all footer functions support the new link_url field
 */

// Basic WordPress environment
if (!defined('ABSPATH')) {
    define('ABSPATH', dirname(__FILE__) . '/../../../');
}

echo "=== FOOTER FUNCTIONS TEST ===\n\n";

// Check if functions exist
$functions_to_test = [
    'lesto_get_footer_navigation',
    'lesto_get_footer_social', 
    'lesto_get_footer_contacts',
    'lesto_get_footer_company_info'
];

foreach ($functions_to_test as $function_name) {
    if (function_exists($function_name)) {
        echo "✅ Function $function_name exists\n";
    } else {
        echo "❌ Function $function_name NOT found\n";
    }
}

echo "\n=== LINK_URL FIELD SUPPORT CHECK ===\n";

// Check if the functions contain link_url field handling
$functions_file = file_get_contents(__DIR__ . '/functions.php');

foreach ($functions_to_test as $function_name) {
    $pattern = "/$function_name.*?link_url/s";
    if (preg_match($pattern, $functions_file)) {
        echo "✅ Function $function_name supports link_url field\n";
    } else {
        echo "❌ Function $function_name does NOT support link_url field\n";
    }
}

echo "\n=== TEST COMPLETED ===\n";
?>
