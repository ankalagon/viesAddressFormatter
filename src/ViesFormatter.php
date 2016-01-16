<?php

namespace Ankalagon\ViesAddressFormatter;

class ViesFormatter
{
    /**
     * @var null|ViesObjectFormatter
     */
    private static $_instance = null;

    public static function recognize($isoCode, $addressLine)
    {
        if (self::$_instance instanceof ViesObjectFormatter == false) {
            self::$_instance = new ViesObjectFormatter($isoCode);
        } else {
            self::$_instance->setIsoCode($isoCode);
        }

        return self::$_instance->getFormatedData($addressLine);
    }
}