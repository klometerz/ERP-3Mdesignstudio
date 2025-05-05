@props(['text', 'search'])

@php
    if (!$search) {
        echo e($text);
    } else {
        $escapedText = e($text);
        $pattern = "/" . preg_quote($search, '/') . "/i";
        echo preg_replace_callback($pattern, function($match) {
            return '<span class="bg-warning">' . e($match[0]) . '</span>';
        }, $escapedText);
    }
@endphp
