<?php

namespace App;

use File;
use Image;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Photo extends Model
{
    const IMG_WIDTH = 250;
    const IMG_HEIGHT = 150;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'photos';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'file', 'gallery_id'];

    public $timestamps = false;

    public function uploadPhoto($file, $gallery_id)
    {
        $filename = explode('.', $file->getClientOriginalName())[0];
        $date = date('His');
        $name = Str::slug($filename) . '_'.$date.'.' . $file->getClientOriginalExtension();
        $file->storeAs('galeria', $name, 'public_uploads');

        $filepath = public_path('uploads/galeria/' . $name);
        $thumbnail = public_path('uploads/galeria/thumbs/' . $name);
        Image::make($filepath)->fit(self::IMG_WIDTH, self::IMG_HEIGHT)->save($thumbnail);

        self::create([
            'gallery_id' => $gallery_id,
            'file' => $name,
            'name' => $filename,
        ]);
    }

    public function deletePhoto()
    {
        File::delete([
            public_path('uploads/galeria/' . $this->file),
            public_path('uploads/galeria/thumbs/' . $this->file)
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
