<?php

namespace App\PageTypes;

use DNADesign\Elemental\Extensions\ElementalPageExtension;
use Page;

class BlockPage extends Page
{
    /**
     * @var array
     */
    private static $extensions = [
        ElementalPageExtension::class,
    ];

    private static $table_name = 'BlockPage';
}
