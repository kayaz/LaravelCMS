<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Nestable\NestableTrait;

class Menu extends Model
{
    use NestableTrait;

    protected $table = 'menu';
    protected $parent = 'id_parent';
    protected $fillable = [
        'menu',
        'slug',
        'id_parent',
        'nazwa',
        'meta_tytul',
        'meta_opis',
        'tekst'
    ];

    public static function renderMenu(){

        $checkSlug = request()->route()->uri();
        if($checkSlug == '{slug}'){
            $currentURI = request()->route()->parameters['slug'];
        } else {
            $currentURI = $checkSlug;
        }

        return Menu::firstUlAttr(['class' => 'mainmenu mb-0 list-unstyled clearfix'])
            ->ulAttr(['class' => 'submenu'])
            ->active($currentURI)
            ->renderAsHtml();
    }
}
