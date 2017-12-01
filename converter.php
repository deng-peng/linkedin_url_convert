<?php

//str_contains is a helper function in laravel

function getVanityNameFromLinkedinUrl($linkedin_url)
{
    $url_parts = explode('/', $linkedin_url);
    if (str_contains($linkedin_url, 'linkedin.com/in/')) {
        $li_vanity = parseVanityFromArray($url_parts);
        if ($li_vanity && !empty($li_vanity))
            return $li_vanity;
    } else if (str_contains($linkedin_url, 'linkedin.com/pub/')) {
        $li_vanity = parseVanityFromArray($url_parts, true);
        if ($li_vanity && !empty($li_vanity))
            return $li_vanity;
    }
    return '';
}

function parseVanityFromArray($arr, $isPub = false)
{
    if (!$isPub) {
        if (count($arr) < 5)
            return false;
        $query = $arr[4];
        return explode('?', $query)[0];
    } else {
        if (count($arr) < 8)
            return false;
        $first_part = explode('?', $arr[7])[0];
        if (strlen($first_part) === 2)
            $first_part = '0' . $first_part;
        if (strlen($first_part) === 1)
            $first_part = '00' . $first_part;
        $second_part = $arr[6];
        if (strlen($second_part) === 2)
            $second_part = '0' . $second_part;
        $third_part = $arr[5];
        if ($third_part == '0')
            $third_part = '';

        return sprintf("%s-%s%s%s", $arr[4], $first_part, $second_part, $third_part);
    }
}