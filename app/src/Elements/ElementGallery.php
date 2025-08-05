<?php

namespace App\Elements;

use App\Model\GalleryImage;
use DNADesign\Elemental\Models\BaseElement;
use SilverStripe\Assets\Image;
use SilverStripe\Control\Controller;
use SilverStripe\Forms\GridField\GridField;
use SilverStripe\Forms\GridField\GridFieldConfig_RecordEditor;
use SilverStripe\Forms\HeaderField;
use SilverStripe\ORM\ArrayList;
use SilverStripe\ORM\DataList;
use SilverStripe\ORM\FieldType\DBField;
use SilverStripe\ORM\HasManyList;
use Symbiote\GridFieldExtensions\GridFieldOrderableRows;

class ElementGallery extends BaseElement
{
    private static $singular_name = 'Gallery';

    private static $plural_name = 'Galleries';

    private static $description = 'This is a gallery';

    private static $has_many = [
        'GalleryImages' => GalleryImage::class,
    ];

    private static $owns = [
        'GalleryImages',
    ];
    private static $inline_editable = false;
    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        $fields->removeByName(['GalleryImages']);

        $welcome_msg = HeaderField::create('WelcomeMsg', 'Welcome to the gallery...');
        $fields->addFieldToTab('Root.Main', $welcome_msg);

        $config = GridFieldConfig_RecordEditor::create();
        $config->addComponent(new GridFieldOrderableRows('SortOrder'));
        $grid = GridField::create(
            'GalleryImages',
            'Gallery Images',
            $this->GalleryImages(),
            $config
        );
        $fields->addFieldToTab('Root.Main', $grid);

        return $fields;
    }


    public function getSummary(): string
    {
        return DBField::create_field('HTMLText', $this->Title)->Summary(20);
    }

    public function getType()
    {
        return 'Gallery';
    }
    /**
     * @param int $offset use 0 for no limit
     * @param int $limit
     * @return HasManyList
     */
    public function OffsetGalleryImages(int $offset = 0, int $limit = 6): HasManyList
    {
        $images = $this->GalleryImages();

        $request = Controller::curr()->getRequest();
        $gallery_all = (string)$request->getVar('gallery_all');

        if ($images->exists() && $limit > 0 && $gallery_all !== 'true') {
            return $images->limit($limit, $offset);
        } elseif ($images->exists()) {
            return $images;
        }

        return HasManyList::create(); // empty
    }
    public function LoadAllLink()
    {
        $request = Controller::curr()->getRequest();
        $gallery_all = (string)$request->getVar('gallery_all');
        if ($gallery_all !== 'true') {
            $link = '<a href="/?gallery_all=true">Load All</a>';
        } else {
            $link = '<a href="/">Show Fewer</a>';
        }

        return $link;
    }
}
