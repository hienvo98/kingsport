<?php
namespace App\Libraries;
class Helper{
    public static function customName($name,$limit){
        $array = explode(' ',$name);
        if(count($array)<$limit) return $name;
        $newName = implode(' ', array_slice($array, 0, $limit)) . '....';
        return $newName;
    }
}
?>