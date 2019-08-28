<?php

namespace App;

use File;
use Image;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Slider extends Model
{

    const PC_WIDTH = 1920;
    const PC_HEIGHT = 700;
    const ADMIN_WIDTH = 200;
    const ADMIN_HEIGHT = 73;

    protected $table = 'slider';
    protected $fillable = ['nazwa', 'plik'];

    public function makeSlider($nazwa, $file){

        if(File::exists(public_path('uploads/slider/' . $this->plik))){
            File::delete([
                public_path('uploads/slider/' . $this->plik),
                public_path('uploads/slider/thumbs/' . $this->plik)
            ]);
        }

        $name = Str::slug($nazwa) . '.' . $file->getClientOriginalExtension();
        $file->storeAs('slider', $name, 'public_uploads');

        $filepath = public_path('uploads/slider/' . $name);
        $thumbnailpath = public_path('uploads/slider/thumbs/' . $name);
        Image::make($filepath)->fit(self::PC_WIDTH, self::PC_HEIGHT)->save($filepath)
            ->fit(self::ADMIN_WIDTH, self::ADMIN_HEIGHT)->save($thumbnailpath);

        $this->update(['plik' => $name ]);
    }

    public function deleteSlider(){
        File::delete([
            public_path('uploads/slider/' . $this->plik),
            public_path('uploads/slider/thumbs/' . $this->plik)
        ]);
    }

    public function sort($array){
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
