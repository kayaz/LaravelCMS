<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

use Image;
use File;

class News extends Model
{
    const THUMB_WIDTH = 920;
    const THUMB_HEIGHT = 520;
    const SMALL_THUMB_WIDTH = 350;
    const SMALL_THUMB_HEIGHT = 200;
    const ADMIN_THUMB_WIDTH = 175;
    const ADMIN_THUMB_HEIGHT = 90;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'slug',
        'date',
        'content',
        'content_entry',
        'file',
        'meta_title',
        'meta_description',
        'status'
    ];

    public function makeThumb($name, $file){

        if (File::exists(public_path('uploads/news/' . $this->file))) {
            File::delete([
                public_path('uploads/news/' . $this->file),
                public_path('uploads/news/thumbs/' . $this->file),
                public_path('uploads/news/adminthumbs/' . $this->file)
            ]);
        }

        $filename = Str::slug($name) . '.' . $file->getClientOriginalExtension();
        $file->storeAs('news', $filename, 'public_uploads');

        $filepath = public_path('uploads/news/' . $filename);
        $thumbnailpath = public_path('uploads/news/thumbs/' . $filename);
        $thumbnailadminpath = public_path('uploads/news/adminthumbs/' . $filename);
        Image::make($filepath)->fit(self::THUMB_WIDTH, self::THUMB_HEIGHT)->save($filepath)
            ->fit(self::SMALL_THUMB_WIDTH, self::SMALL_THUMB_HEIGHT)->save($thumbnailpath)
            ->fit(self::ADMIN_THUMB_WIDTH, self::ADMIN_THUMB_HEIGHT)->save($thumbnailadminpath);

        $this->update(['file' => $filename ]);
    }

    public function deleteThumb(){
        File::delete([
            public_path('uploads/news/' . $this->file),
            public_path('uploads/news/thumbs/' . $this->file),
            public_path('uploads/news/adminthumbs/' . $this->file)
        ]);
    }
}
