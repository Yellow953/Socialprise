<?php

namespace App\Helpers;

class Helper
{
    public static function compare($a, $b)
    {
        if ($a > $b) {
            return "danger";
        } else if ($b > $a) {
            return "success";
        } else {
            return "info";
        }
    }

    public static function compare_hex_bg($a, $b)
    {
        if ($a > $b) {
            return "#FF7F7F";
        } else if ($b > $a) {
            return "#90EE90";
        } else {
            return "#ADD8E6";
        }
    }

    public static function compare_hex_border($a, $b)
    {
        if ($a > $b) {
            return "red";
        } else if ($b > $a) {
            return "green";
        } else {
            return "blue";
        }
    }
}
