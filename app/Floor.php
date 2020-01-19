<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

use Image;
use File;

class Floor extends Model
{
    const PLAN_WIDTH = 1200;
    const PLAN_HEIGHT = 560;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'investment_id',
        'building',
        'typ',
        'name',
        'slug',
        'number',
        'file',
        'meta_description',
        'meta_title',
        'area_range',
        'rooms_range',
        'price_range',
        'html',
        'cords'
    ];

    public function makePlan($name, $file)
    {
        if (File::exists(public_path('inwestycje/pietro/' . $this->file))) {
            File::delete(public_path('inwestycje/pietro/' . $this->file));
        }

        $filename = Str::slug($name) . '.' . $file->getClientOriginalExtension();
        $file->storeAs('pietro', $filename, 'inwest_uploads');

        $filepath = public_path('inwestycje/pietro/' . $filename);
        Image::make($filepath)->fit(self::PLAN_WIDTH, self::PLAN_HEIGHT)->save($filepath);

        $this->update(['file' => $filename]);
    }

    public function rooms()
    {
        return $this->hasMany('App\Room');
    }
}
