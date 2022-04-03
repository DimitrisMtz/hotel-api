<?php
class Utilities{

    public static function genericDataCheck($values){
        foreach($values as $value){
            if(!isset($value) || empty($value)){
                return false;
            }
        }
    }

    public static function formatTimestamp($date){
        $date = new DateTime($date);
        return $date->format("Y-m-d");
    }
    
    public static function getDatesFromRange($start, $end){
        $dates = [];
        $period = new DatePeriod(
            new DateTime($start),
            new DateInterval('P1D'),
            new DateTime($end)
        );
        foreach ($period as $key => $value) {
            $dates[] = $value->format('Y-m-d');
        }
        return $dates;
    }

    public static function dateInRangeOfBookings($date, $bookings){
        $result = [];
        foreach ($bookings as $booking) {
            if($booking["check_in"] <= $date && $booking["check_out"] >= $date){
                $result[] = $booking["room_id"];
            }else{
                $result[] = false;
            }
        }
        return $result;
    }

    public static function createResponseString($date, $rooms, $result){
        if($result == false){
            $tripleRooms = count(array_filter($rooms, function($room) {
                return $room["type"] == "triple";
            }));
            $doubleRooms = count(array_filter($rooms, function($room) {
                return $room["type"] == "double";
            }));
            return (object)[
                "available" => true,
                "description" => "For {$date}, there are {$tripleRooms} triple room(s) and {$doubleRooms} double room(s) available"
            ];
        }else{
            $tripleRooms = count(array_filter($rooms, function($room) use ($result) {
                return $room["type"] == "triple" && !in_array($room["id"], $result);
            }));
            $doubleRooms = count(array_filter($rooms, function($room) use ($result) {
                return $room["type"] == "double" && !in_array($room["id"], $result);
            }));
            return (object)[
                "available" => $tripleRooms || $doubleRooms ? true : false,
                "description" => "For {$date}, there are {$tripleRooms} triple room(s) and {$doubleRooms} double room(s) available"
            ];
        }
    }
}