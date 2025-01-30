<?php

namespace App\Services;


use App\Models\Wallet;

class StringService
{
    public function setDevTitle($string,$removeSpace=false)
    {
        $title = trim(preg_replace('/\s\s+/', ' ', str_replace("\n", " ", $string)));
        $title = str_replace("ي", "ی", $title);
        $title = str_replace("ك", "ک", $title);
        $title = str_replace("آ", "ا", $title);
        if ($removeSpace)
        {
            $title = str_replace(" ", "", $title);
            $title = str_replace("", "", $title);
            $title = str_replace("‌", "", $title);
            $title = mb_strtolower($title);
        }

        return $title ;
    }
}
