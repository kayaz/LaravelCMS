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


/* DeveloPro */

// Sprawdzamy typ inwestycji
if (! function_exists('inwest_typ')) {
    function inwest_typ($number)
    {
        switch ($number) {
            case '1':
                return "Inwestycja osiedlowa";
            case '2':
                return "Inwestycja budynkowa";
            case '3':
                return "Inwestycja z domami";
            case '4':
                return "Inna oferta";
        }
    }

}

// Sprawdzamy status inwestycji
if (! function_exists('inwest_status')) {
    function inwest_status($number)
    {
        switch ($number) {
            case '1':
                return "Inwestycja aktualna";
            case '2':
                return "Inwestycja zrealizowana";
            case '3':
                return "Inwestycja planowana";
        }
    }

}
