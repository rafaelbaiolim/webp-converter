<?php
require 'vendor/autoload.php';

use WebPConvert\WebPConvert;
use WebPConvert\Loggers\EchoLogger;

if (empty($argv[1])) {
    echo "First arg: folder of images is required";
    exit;
}
$removeOriginalFile = false;
if (!empty($argv[2])) {
    $removeOriginalFile = true;
}

$debug = false;
if (!empty($argv[3])) {
    $debug = true;
}

$folder = $argv[1];
$folder = normalizePath($folder);

$dir = new RecursiveDirectoryIterator($folder);
$iterator = new RecursiveIteratorIterator($dir);
$files = new RegexIterator($iterator, '/^.+(.jpe?g|.png)$/i', RecursiveRegexIterator::GET_MATCH);

echo "======Converting images from {$folder} ...======\n";
$noFile = true;
foreach ($files as $file) {
    $noFile = false;
    $ext = $file[1];
    $file = $file[0];
    echo "\n======Converting: $file to .webp======\n";
    $destination = $file . '.webp';
    $destination = str_replace($ext, '', $destination); //remove a ext original
    $converted = WebPConvert::convert($file, $destination, [], ($debug ?  new EchoLogger() : null));
    if (empty($converted)) {
        if ($removeOriginalFile) unlink($file); //remove o arquivo original se argv[2] == true
    }
}
if($noFile) echo "\n======No file founded.======\n";
echo "\n======Conversion was done.======\n";

function normalizePath($path)
{
    $patterns = array('~/{2,}~', '~/(\./)+~', '~([^/\.]+/(?R)*\.{2,}/)~', '~\.\./~');
    $replacements = array('/', '/', '', '');
    return preg_replace($patterns, $replacements, $path);
}
