<?php

namespace App\Helpers;

use DateTime;

/**
 * Helper for all things related to displaying post content
 */
class PostContentHelper
{
    public static function formatPostDate(string $date): string
    {
        $datetime = new DateTime($date);
        return $datetime->format('M d, Y');
    }

    public static function limitPostText(string $content, int $limit)
    {
        $strippedContent = preg_replace('/&nbsp;/', ' ', strip_tags($content));
        if (strlen($strippedContent) > $limit) {
            return substr($strippedContent,0,$limit)."...";
        } else {
            return $strippedContent;
        }
    }
}
