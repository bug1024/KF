<?php namespace core\util;

class ArrayUtil {

    public static function get($arr, $key, $default = false) {
        return isset($arr[$key]) ? $arr[$key] : $default;
    }

    public static function toHash($arr, $key) {
        $hash = [];
        foreach ($arr as $value) {
            if (isset($value[$key])) {
                $hash[$value[$key]] = $value;
            }
        }

        return $hash;
    }

    public static function getCols($arr, $key, $unique = true) {
        $cols = [];
        foreach ($arr as $value) {
            if (isset($value[$key])) {
                $cols[] = $value[$key];
            }
        }

        if ($unique) {
            $cols = array_unique($cols);
        }

        return $cols;
    }


}

