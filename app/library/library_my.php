<?php
namespace App\library;
class library_my{

    public static function getId_CateProduct($list)

    {
        $filter=array();
        foreach($list as $item)
        {
         $filter[]=$item->id_categoryproducts;

        }
        return array_unique($filter);
    }


    public static function formatMoney($number, $fractional=false) {
	    if ($fractional) {
	        $number = sprintf('%.2f', $number);
	    }
	    while (true) {
	        $replaced = preg_replace('/(-?\d+)(\d\d\d)/', '$1,$2', $number);
	        if ($replaced != $number) {
	            $number = $replaced;
	        } else {
	            break;
	        }
	    }
	    return $number;
	}
}
