<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

use Image;
use File;

class Investment extends Model
{
    const LOGO_WIDTH = 150;
    const LOGO_HEIGHT = 60;
    const THUMB_WIDTH = 900;
    const THUMB_HEIGHT = 620;
    const PLAN_WIDTH = 1200;
    const PLAN_HEIGHT = 560;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'typ',
        'status',
        'name',
        'slug',
        'meta_title',
        'meta_description',
        'email',
        'phone',
        'address',
        'office',
        'content',
        'content_list',
        'plan',
        'thumb',
        'logo'
    ];

    public function makeLogo($name, $file)
    {

        if (File::exists(public_path('inwestycje/logo/' . $this->logo))) {
            File::delete(public_path('inwestycje/logo/' . $this->logo));
        }

        $filename = Str::slug($name) . '.' . $file->getClientOriginalExtension();
        $file->storeAs('logo', $filename, 'inwest_uploads');

        $filepath = public_path('inwestycje/logo/' . $filename);
        Image::make($filepath)->fit(self::LOGO_WIDTH, self::LOGO_HEIGHT)->save($filepath);

        $this->update(['logo' => $filename ]);
    }

    public function makeThumb($name, $file)
    {

        if (File::exists(public_path('inwestycje/thumbs/' . $this->thumb))) {
            File::delete(public_path('inwestycje/thumbs/' . $this->thumb));
        }

        $filename = Str::slug($name) . '.' . $file->getClientOriginalExtension();
        $file->storeAs('thumbs', $filename, 'inwest_uploads');

        $filepath = public_path('inwestycje/thumbs/' . $filename);
        Image::make($filepath)->fit(self::THUMB_WIDTH, self::THUMB_HEIGHT)->save($filepath);

        $this->update(['thumb' => $filename ]);
    }

    public function uploadPlan($file)
    {

        if (File::exists(public_path('inwestycje/plan/' . $this->plan))) {
            File::delete(public_path('inwestycje/plan/' . $this->plan));
        }

        $filename = explode('.', $file->getClientOriginalName())[0];
        $date = date('His');
        $name = Str::slug($filename) . '_'.$date.'.' . $file->getClientOriginalExtension();
        $file->storeAs('plan', $name, 'inwest_uploads');

        $filepath = public_path('inwestycje/plan/' . $name);
        Image::make($filepath)->fit(self::PLAN_WIDTH, self::PLAN_HEIGHT)->save($filepath);

        $this->update(['plan' => $name ]);
    }

    public function floors()
    {
        return $this->hasMany('App\Floor');
    }

    public function building()
    {
        return $this->hasMany('App\Building');
    }

    public function investrooms()
    {
        return $this->hasManyThrough(
            'App\Room',
            'App\Floor',
            'investment_id',
            'floor_id',
            'id',
            'id'
        );
    }
}
