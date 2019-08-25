<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Image;
use File;

class Slider extends Model
{

    const PC_WIDTH = 1920;
    const PC_HEIGHT = 700;
    const ADMIN_WIDTH = 200;
    const ADMIN_HEIGHT = 73;

    protected $table = 'slider';
    protected $fillable = ['nazwa', 'plik'];

    public static function addThumb($slug, $file, $id){
        $name = $slug . '.' . $file->getClientOriginalExtension();
        $file->storeAs('slider', $name, 'public_uploads');

        $filepath = public_path('uploads/slider/' . $name);
        $thumbnailpath = public_path('uploads/slider/thumbs/' . $name);
        Image::make($filepath)->fit(self::PC_WIDTH, self::PC_HEIGHT)->save($filepath)
            ->fit(self::ADMIN_WIDTH, self::ADMIN_HEIGHT)->save($thumbnailpath);

        self::find($id)->update(['plik' => $name ]);
    }

    public static function deletePanel($file){
        File::delete([
            public_path('uploads/slider/' . $file),
            public_path('uploads/slider/thumbs/' . $file)
        ]);
    }

    public static function sort($array){
        $updateRecordsArray = $array->get('recordsArray');
        $listingCounter = 1;
        foreach ($updateRecordsArray as $recordIDValue) {
            $entry = self::find($recordIDValue);
            $entry->sort = $listingCounter;
            $entry->save();
            $listingCounter = $listingCounter + 1;
        }
    }
}
