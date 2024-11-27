<?php

use OpenAdmin\MultiLanguage\Http\Controllers\MultiLanguageController;

Route::get('multi-language', MultiLanguageController::class.'@index');