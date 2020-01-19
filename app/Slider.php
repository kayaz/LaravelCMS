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

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'file'];

    public function makeSlider($name, $file)
    {
        if (File::exists(public_path('uploads/slider/' . $this->file))) {
            File::delete([
                public_path('uploads/slider/' . $this->file),
                public_path('uploads/slider/thumbs/' . $this->file)
            ]);
        }

        $file_name = Str::slug($name) . '.' . $file->getClientOriginalExtension();
        $file->storeAs('slider', $file_name, 'public_uploads');

        $filepath = public_path('uploads/slider/' . $file_name);
        $thumbnail = public_path('uploads/slider/thumbs/' . $file_name);
        Image::make($filepath)->fit(self::PC_WIDTH, self::PC_HEIGHT)->save($filepath)
            ->fit(self::ADMIN_WIDTH, self::ADMIN_HEIGHT)->save($thumbnail);

        $this->update(['file' => $file_name ]);
    }

    public function deleteSlider()
    {
        File::delete([
            public_path('uploads/slider/' . $this->file),
            public_path('uploads/slider/thumbs/' . $this->file)
        ]);
    }

    public function sort($array)
    {
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
