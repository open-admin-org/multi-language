<?php

namespace OpenAdmin\MultiLanguage\Http\Controllers;

use OpenAdmin\Admin\Layout\Content;
use Illuminate\Routing\Controller;

class MultiLanguageController extends Controller
{
    public function index(Content $content)
    {
        return $content
            ->title('Title')
            ->description('Description')
            ->body(view('multi-language::index'));
    }
}