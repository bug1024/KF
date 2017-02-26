<?php namespace core\validate;

class Validator {

    public static function isPhoneNumber($value) {
        return (boolean) preg_match('/^1\d{10}$/', $value);
    }

    public static function isEmail($value) {
        return filter_var($value, FILTER_VALIDATE_EMAIL);
    }

    public static function isIp($value) {
        return filter_var($value, FILTER_VALIDATE_IP);
    }

    public static function isIdCard($value) {
    }

    public static function isUrl($value) {
        return filter_var($value, FILTER_VALIDATE_URL);
    }

}

