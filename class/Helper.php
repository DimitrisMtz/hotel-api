<?php
class Helper{
    public static function genericDataCheck($values){
        foreach($values as $value){
            if(!isset($value) || empty($value)){
                return false;
            }
        }
    }
    public static function formatTimestamp($timestamp){
        $date = new DateTime($timestamp);
        return $date->format("Y-m-d H:i:s");
    }
}