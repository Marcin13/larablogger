<?php

namespace App\Services;
//Pamiętajmy o dodaniu namespace
use App\Models\Tag;
//tu też możemy używać model
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

