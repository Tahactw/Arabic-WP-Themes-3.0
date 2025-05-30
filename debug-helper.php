<?php
/**
 * ملف فحص الأخطاء
 * ضعه في مجلد القالب لفحص المشاكل
 */

// تفعيل عرض الأخطاء
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// فحص إصدار PHP
echo "إصدار PHP: " . phpversion() . "<br>";

// فحص إصدار ووردبريس
echo "إصدار ووردبريس: " . get_bloginfo('version') . "<br>";

// فحص الذاكرة
echo "ذاكرة PHP: " . ini_get('memory_limit') . "<br>";

// فحص المكتبات المطلوبة
$required_functions = array('curl_init', 'json_decode', 'mb_strlen');
foreach ($required_functions as $func) {
    if (function_exists($func)) {
        echo "✅ $func موجودة<br>";
    } else {
        echo "❌ $func غير موجودة<br>";
    }
}
?>