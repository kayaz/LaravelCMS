<?php
// Sprawdzamy status
if (! function_exists('page_status')) {
    function page_status($number)
    {
        if($number == 1) {
            $result = "<span class=\"online\"></span>";
        } else {
            $result = "<span class=\"offline\"></span>";
        }
        return $result;
    }
}

// Sprawdzamy typ strony
if (! function_exists('page_type')) {
    function page_type($number) {
        if($number == '3'){
            return 'Link';
        }
        if($number == '0'){
            return 'Strona';
        }
    }
}

function settings($key = null, $default = null) {
    if ($key === null) {
        return app(App\Settings::class);
    }

    return app(App\Settings::class)->get($key, $default);
}
