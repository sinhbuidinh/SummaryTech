<?php

function dateStr($date, $req_date = true, $format = null)
{
    if (empty($date)) {
        return null;
    }
    if (empty($format)) {
        $format = $req_date ? DATE_FORMAT_YMD : DATE_FORMAT_YM;
    }
    if (is_string($date)) {
        $date = now()->parse($date);
    }
    return $date->format($format);
}

function dateToday($req_date = true, $format = null)
{
    $date = today();
    return dateStr($date, $req_date, $format);
}

function dateLater($month, $day = null, $format = null)
{
    $date = now()->addMonths($month);
    //plus date
    if (!is_null($day)) {
        $date = $date->addDays($day);
        return dateStr($date, true, $format);
    }
    return dateStr($date, true, $format);
}

function dateAgo($month, $day = null, $format = null)
{
    $date = now()->subMonths($month);
    //sub
    if (!is_null($day)) {
        $date = $date->subDays($day);
        return dateStr($date, true, $format);
    }
    return dateStr($date, false, $format);
}
