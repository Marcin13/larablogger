<?php

namespace App\Services;

use App\Models\Tag;

class TagsParsingService
{
    public static function parse($text)
    {
        $list = preg_split('/ +/', $text);
        $ids = [];

        foreach ($list as $tag) {
            $tag = Tag::firstOrCreate(['name' => $tag]);
            $ids[] = $tag->id;
        }

        return $ids;
    }
}

