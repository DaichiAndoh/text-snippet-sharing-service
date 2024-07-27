<?php

namespace Helpers;

class ValidationHelper {
    public static function string(string $value, int $min = -INF, int $max = INF): string | bool {
        if (strlen($value) < $min || strlen($value) > $max) {
            return false;
        }
        return $value;
    }
}
