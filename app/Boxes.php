<?php

namespace App;

use File;
use Image;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Boxes extends Model
{
    const ICON_WIDTH = 120;
    const ICON_HEIGHT = 120;

    protected $table = 'boks';
    protected $fillable = ['nazwa', 'tekst', 'link', 'plik'];

    public function makeIcon($nazwa, $file){

        if(File::exists(public_path('uploads/boksy/' . $this->plik))){
            File::delete(public_path('uploads/boksy/' . $this->plik));
        }

        $name = Str::slug($nazwa) . '.' . $file->getClientOriginalExtension();
        $file->storeAs('boksy', $name, 'public_uploads');

        $filepath = public_path('uploads/boksy/' . $name);
        Image::make($filepath)->fit(self::ICON_WIDTH, self::ICON_HEIGHT)->save($filepath);

        $this->update(['plik' => $name ]);
    }

    public function deleteIcon(){
        File::delete( public_path('uploads/boksy/' . $this->plik));
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
