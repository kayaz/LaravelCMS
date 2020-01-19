<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

use Image;
use File;


class Room extends Model
{
    const PLAN_WIDTH = 1024;
    const PLAN_HEIGHT = 1024;
    const THUMB_WIDTH = 500;
    const THUMB_HEIGHT = 500;
    const LIST_WIDTH = 100;
    const LIST_HEIGHT = 100;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'floor_id',
        'name',
        'number',
        'slug',
        'meta_description',
        'meta_title',
        'html',
        'cords',
        'status',
        'rooms',
        'file',
        'pdf',
        'area',
        'area_search',
        'price',
        'price_search',
        'price_m'
    ];

    public function makePlan($name, $file)
    {
        if (File::exists(public_path('inwestycje/mieszkanie/' . $this->file))) {
            File::delete([
                public_path('inwestycje/mieszkanie/' . $this->file),
                public_path('inwestycje/mieszkanie/thumbs/' . $this->file),
                public_path('inwestycje/mieszkanie/lista/' . $this->file)
            ]);
        }

        $filename = Str::slug($name) . '.' . $file->getClientOriginalExtension();
        $file->storeAs('mieszkanie', $filename, 'inwest_uploads');

        $filepath = public_path('inwestycje/mieszkanie/' . $filename);
        $thumbnailpath = public_path('inwestycje/mieszkanie/thumbs/' . $filename);
        $listpath = public_path('inwestycje/mieszkanie/lista/' . $filename);
        Image::make($filepath)
            ->resize(self::PLAN_WIDTH, null, function ($constraint) {$constraint->aspectRatio();})
            ->save($filepath)
            ->resize(self::THUMB_WIDTH, null, function ($constraint) {$constraint->aspectRatio();})
            ->save($thumbnailpath)
            ->fit(self::LIST_WIDTH, self::LIST_HEIGHT)->save($listpath);

        $this->update(['file' => $filename ]);
    }

    public function makePdf($name, $file){

        if (File::exists(public_path('inwestycje/mieszkanie/pdf/' . $this->pdf))) {
            File::delete([
                public_path('inwestycje/mieszkanie/pdf/' . $this->pdf)
            ]);
        }

        $pdfname = Str::slug($name) . '.' . $file->getClientOriginalExtension();
        $file->storeAs('mieszkanie/pdf', $pdfname, 'inwest_uploads');

        $this->update(['pdf' => $pdfname ]);
    }

}
