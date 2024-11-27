<?php

namespace OpenAdmin\MultiLanguage;

use OpenAdmin\Admin\Extension;

class MultiLanguage extends Extension
{
    public $name = 'multi-language';

    public $views = __DIR__ . '/../resources/views';

    public $assets = __DIR__ . '/../resources/assets';

    public $menu = [
        'title' => 'Multilanguage',
        'path'  => 'multi-language',
        'icon'  => 'icon-cogs',
    ];
}
