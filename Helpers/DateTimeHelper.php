<?php

namespace Helpers;

use DateTime;
use DateInterval;

class DateTimeHelper {
    public static function addDays(int $days, DateTime $d = new DateTime()): DateTime {
        $d->add(new DateInterval("P{$days}D"));
        return $d;
    }

    public static function addHours(int $hours, DateTime $d = new DateTime()): DateTime {
        $d->add(new DateInterval("PT{$hours}H"));
        return $d;
    }

    public static function addMinutes(int $minutes, DateTime $d = new DateTime()): DateTime {
        $d->add(new DateInterval("PT{$minutes}M"));
        return $d;
    }

    public static function isExpired(DateTime $current, DateTime $expiration): bool {
        return $current > $expiration;
    }
}
