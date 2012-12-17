<?php

namespace NP\Bundle\GuestBookBundle\Enum;

class StatusEnum {

    const PENDING = "pending";
    const VALIDATED = "validated";
    const REFUSED = "refused";
    
    public static function getValues() {
        return array(
            self::PENDING,
            self::VALIDATED,
            self::REFUSED
        );
    }
}