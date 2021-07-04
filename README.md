# Webp Converter

Convert JPEG & PNG to WebP with PHP

This projects uses Webp-Convert Pack from [https://github.com/rosell-dk/webp-convert](https://github.com/rosell-dk/webp-convert),
and is just a wrapper that recursively finds images on folder. Any sugestion is welcome.

Usage:
```
$composer install 
```

Use php on terminal:
```

$php converter.php $path = null $removeOriginalFile = false $debug = false

args:
$path = Full path for recursively search
$removeOriginalFiles = Delete file after conversion
$debug = Display imagick log or other lib using for conversion 
```

Example:
```
$php .\converter.php C:\laragon\www\project\public\img true
```
