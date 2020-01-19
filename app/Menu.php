<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Nestable\NestableTrait;

class Menu extends Model
{
    use NestableTrait;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'menu';

    protected $parent = 'parent_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'menu',
        'slug',
        'parent_id',
        'title',
        'meta_title',
        'meta_description',
        'content',
        'uri'
    ];

    public static function renderMenu()
    {
        $checkUri = request()->route()->uri();
        if ($checkUri == '{uri}') {
            $currentURI = request()->route()->parameters['uri'];
        } else {
            $currentURI = $checkUri;
        }

        return static::orderBy('sort', 'asc')->firstUlAttr(['class' => 'mainmenu mb-0 list-unstyled clearfix'])
            ->ulAttr(['class' => 'submenu'])
            ->active($currentURI)
            ->renderAsHtml();
    }

    public static function urigenerate($id)
    {
        $data = static::all()->sortBy("sort");
        $crumbs = Array();
        $c = count($data);

        do {
            $found = false;
            for($i = 0; $i<$c; ++$i){
                if($data[$i]['id'] == $id){

                    $url = $data[$i]['slug'];
                    array_unshift($crumbs, empty($crumbs)?($data[$i]['slug']):($url));

                    $id = $data[$i]['parent_id'];
                    $found = true;
                    break;
                }
            }
        } while ($id != 0 AND $found);
        return implode('/', $crumbs);
    }
}
