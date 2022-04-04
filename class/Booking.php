<?php

class Booking{
    public static function getAllBookingsInRange($checkIn, $checkOut){
        $query = Database::$db->prepare(
            "SELECT *
            FROM booking AS B
            WHERE :checkIn <= B.check_in OR :checkOut >= B.check_out"
        );
        $query->execute([
            ":checkIn" => $checkIn,
            ":checkOut" => $checkOut
        ]);
        $data = $query->fetchAll();
        return $data;
    }
}