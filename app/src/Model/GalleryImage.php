<?php

namespace App\Model;

use App\Elements\ElementGallery;
use SilverStripe\AssetAdmin\Forms\UploadField;
use SilverStripe\Assets\Image;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\HTMLEditor\HTMLEditorField;
use SilverStripe\Forms\TextField;
use SilverStripe\ORM\DataList;
use SilverStripe\ORM\DataObject;
use SilverStripe\View\ArrayData;
use SilverStripe\View\ViewableData;


class GalleryImage extends DataObject
{
    private static $db = [
        'Title' => 'Varchar(255)',
        'Description' => 'HTMLText',
        'Alt' => 'Text',
        'Caption' => 'HTMLText',
        'SortOrder' => 'Int',
    ];
    private static $has_one = [
        'Image' => Image::class,
        'ElementGallery' => ElementGallery::class,
    ];
    private static $owns = ['Image'];

    private static $default_sort = 'SortOrder ASC';

    private static $summary_fields = [
        'Image.CMSThumbnail' => 'Thumbnail',
        'Alt' => 'Alt',
    ];
    public function getCMSFields()
    {
        return FieldList::create([
            TextField::create('Title', 'Title'),
            UploadField::create('Image'),
            TextField::create('Alt'),
            HTMLEditorField::create('Caption'),
            HTMLEditorField::create('Description'),
        ]);
    }
    public function getNewDimensions(Int $width = 100, Int $height = 100)
    {
        return new ArrayData([
            'Width' => $width,
            'Height' => $height,
        ]);
    }
    public function ResizedImage(int $percent = 100, int $max_size = 800)
    {
        $percent = max(1, min($percent, 100));

        $image = $this->Image();

        $new_width = round($image->Width * ($percent / 100), 0);
        $new_height = round($image->Height * ($percent / 100), 0);

        if ($image && $image->exists()) {
            $image_new_width = $image->FocusCropWidth($new_width);
            $image_new_height = $image_new_width->FocusCropHeight($new_height);
            return $image_new_height->Fit($max_size, $max_size);
        }
        return null;
    }

}
