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
}
