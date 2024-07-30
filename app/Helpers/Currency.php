<?php

namespace App\Helpers;
use NumberFormatter;

class Currency
{
    public static function format($amount,$currencyType=null)
    {
        $formatter= new NumberFormatter(config('app.locale'),NumberFormatter::CURRENCY);
        if($currencyType === null)
        {
            $currencyType = config('app.currency','EGP');
        }
        return $formatter->formatCurrency($amount,$currencyType);
    }

}

