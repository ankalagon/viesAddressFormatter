<?php

namespace Ankalagon\ViesAddressFormatter;

class ViesFormatter
{
    /**
     * @var null|ViesObjectFormatter
     */
    private static $instance = null;

    public static function recognize($isoCode, $addressLine)
    {
        if (self::$instance instanceof ViesObjectFormatter == false) {
            self::$instance = new ViesObjectFormatter($isoCode);
        } else {
            self::$instance->setIsoCode($isoCode);
        }

        return self::$instance->getFormatedData($addressLine);
    }
}