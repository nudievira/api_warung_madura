<?php

namespace App\Helpers;

use App\Models\Purchase;

/**
 * Helpers for return format of SPK Number
 */
class NumberFormat
{
    public static function spk($fpb_num, $create_date)
    {
        $month_num = date('m', strtotime($create_date));
        $year_num = date('Y', strtotime($create_date));
        return $fpb_num . '/SPK/' . $month_num . '/' . $year_num;
    }

    public static function stockCodeProduct($number)
    {
        $explode_number = str_split($number);
        $generate_number = '';
        foreach ($explode_number as $index => $explode_item) {
            if (($index + 1) % 3 == 0 && $index > 0) {
                $generate_number .= '.';
            } else {
                $generate_number .= $explode_item;
            }
        }
        return $generate_number;
    }

    public static function fileNamePurchaseRequest($purchase_type, $purchase_category, $date)
    {
        $date_format = date('d/m/y', strtotime($date));
        if ($purchase_type == Purchase::FPB_TYPE) {
            return 'FPB/' . $purchase_category . '/' . $date_format;
        } else {
            return 'PP/' . $purchase_category . '/' . $date_format;
        }
    }

    public static function numberCurrencyFormat($number)
    {
       return number_format($number, 0, ',', '.');
    }
}
