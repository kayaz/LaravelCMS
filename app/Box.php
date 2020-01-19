<?php

namespace App;

use File;
use Image;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Box extends Model
{
    const ICON_WIDTH = 120;
    const ICON_HEIGHT = 120;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'content', 'url', 'file'];

    public function makeIcon($name, $file)
    {
        if (File::exists(public_path('uploads/boksy/' . $this->file))) {
            File::delete(public_path('uploads/boksy/' . $this->file));
        }

        $file_name = Str::slug($name) . '.' . $file->getClientOriginalExtension();
        $file->storeAs('boksy', $file_name, 'public_uploads');

        $filepath = public_path('uploads/boksy/' . $file_name);
        Image::make($filepath)->fit(self::ICON_WIDTH, self::ICON_HEIGHT)->save($filepath);

        $this->update(['file' => $file_name ]);
    }

    public function deleteIcon()
    {
        File::delete(public_path('uploads/boksy/' . $this->file));
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
