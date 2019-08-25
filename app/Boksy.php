<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Image;
use File;

class Boksy extends Model
{
    const ICON_WIDTH = 120;
    const ICON_HEIGHT = 120;

    protected $table = 'boksy';
    protected $fillable = ['nazwa', 'plik', 'tekst'];

    public static function addIcon($slug, $file, $id){
        $name = $slug . '.' . $file->getClientOriginalExtension();
        $file->storeAs('boksy', $name, 'public_uploads');

        $filepath = public_path('uploads/boksy/' . $name);
        Image::make($filepath)->fit(self::ICON_WIDTH, self::ICON_HEIGHT)->save($filepath);

        self::find($id)->update(['plik' => $name]);
    }

    public static function deleteIcon($file){
        File::delete( public_path('uploads/boksy/' . $file));
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
