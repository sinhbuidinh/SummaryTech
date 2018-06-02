<?php

namespace App\Models;

use App\Models\BaseModel;

class Article extends BaseModel
{
    /**
     * Get article type
     */
    public function articleType()
    {
        return $this->hasOne('App\Models\ArticleType', 'id', 'article_type_id');
    }
}
