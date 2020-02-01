<?php
// Sprawdzamy status
use App\Photo;

if (! function_exists('page_status')) {
    function page_status($number)
    {
        if ($number == 1) {
            $result = "<span class=\"online\"></span>";
        } else {
            $result = "<span class=\"offline\"></span>";
        }
        return $result;
    }
}

// Sprawdzamy typ strony
if (! function_exists('page_type')) {
    function page_type($number)
    {
        if ($number == '3') {
            return 'Link';
        }
        if ($number == '2') {
            return 'Moduł CMS';
        }
        if ($number == '0') {
            return 'Strona';
        }
    }
}

// Pobieramy element dla inline
if (! function_exists('getInline')) {
    function getInline($array, $id, $element)
    {
        foreach ($array as $a) {
            if ($a->id == $id) {
                $elementArray = json_decode(json_encode($a), true);
                if ($element == 'obrazek') {
                    return '/uploads/inline/'.$elementArray[$element];
                } else {
                    return $elementArray[$element];
                }
            }
        }
    }
}

// Generujemy menu w adminie
if (! function_exists('recursive')) {
    function recursive($array, $level = 0, $child = null)
    {
        foreach ($array as $index => $node) {
            echo '<tr'.$child.'>';
            echo '<td>'.$node['title'].'</td>';
            echo '<td>'.$node['uri'].'</td>';
            echo '<td>'.page_type($node['typ']).'</td>';
            echo '<td class="text-center">'.$node['updated_at'].'</td>';
            echo '<td class="text-center">'.page_status($node['menu']).'</td>';
            echo '<td class="option-120"><div class="btn-group"><a href="'.route('admin.menu.edytuj', $node['id']).'" class="btn action-button mr-1" data-toggle="tooltip" data-placement="top" title="Edytuj wpis"><i class="fe-edit"></i></a><form method="POST" action="'.route('admin.menu.usun', $node['id']).'">'.csrf_field().''. method_field('DELETE') .'<button type="submit" class="btn action-button confirm" data-toggle="tooltip" data-placement="top" title="Usuń wpis" data-id="'.$node['id'].'"><i class="fe-trash-2"></i></button></form></div></td>';
            if (isset($node['child']) && !empty($node['child'])) {
                $newLevel = $level+1;
                recursive($node['child'], $newLevel, ' class="submenu submenu-'. $newLevel .'"');
            }
            echo "</tr>";
        }
    }
}

function settings($key = null, $default = null)
{
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

// Sprawdzamy status mieszkania
if (! function_exists('room_status')) {
    function room_status($number)
    {
        switch ($number) {
            case '1':
                return "Na sprzedaż";
            case '2':
                return "Sprzedane";
            case '3':
                return "Rezerwacja";
            case '4':
                return "Wynajęte";
        }
    }
}

// Odczytujemy cordy
if (! function_exists('cords')) {
    function cords($string)
    {
        $pattern = '/coords="([^"]*)"/';
        preg_match($pattern, $string, $matches);
        return $matches[1];
    }
}

// Robimy galerie w tresci
if (! function_exists('parse')) {
    function parse($string)
    {
        $output = preg_replace_callback('/\[gallery=(.*)](.*)\[\/gallery\]/', 'makeGallery', $string);
        return str_replace(
            array("</div>\n</p>","<p><div"),
            array("</div>", "<div"),
            $output
        );
    }
}
if (! function_exists('makeGallery')) {
    function makeGallery($input)
    {
        $photos = Photo::all()->sortBy("sort")->where('gallery_id', $input[2]);

        if ($input[1] == 'gallery') {
            return view('front.parse.gallery', ['list' => $photos])->render();
        }

        if ($input[1] == 'slider') {
            return view('front.parse.slider', ['list' => $photos])->render();
        }
    }
}
