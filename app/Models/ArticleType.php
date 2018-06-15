<?php

namespace App\Models;

use App\Models\BaseModel;

class ArticleType extends BaseModel
{
    const LANG_DEFAULT_ID = 0;
    const LANG_ENGLISH_ID = 1;
    const LANG_JAPANESE_ID = 2;

    const LANG_DISP = [
        self::LANG_DEFAULT_ID  => 'Default',
        self::LANG_ENGLISH_ID  => 'English',
        self::LANG_JAPANESE_ID => 'Japanenese'
    ];

    public function getLangDispAttribute()
    {
        return self::LANG_DISP[$this->lang_id];
    }
}
