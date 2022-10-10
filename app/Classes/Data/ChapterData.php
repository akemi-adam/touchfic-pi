<?php

namespace App\Classes\Data;

use App\Models\Chapter;

class ChapterData
{
    public function create(array $options = []) : Chapter
    {
        return Chapter::factory()->create($options);
    }
}