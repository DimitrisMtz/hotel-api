<?php

class Booking{
    private $db;
    public function __construct(){
        $this->db = Database::$db;
    }
    
    public function getBookings($checkIn, $checkOut){
        $query = $this->db->prepare(
            "SELECT *
            FROM booking AS B
            WHERE :checkIn BETWEEN B.check_in AND B.check_out
            OR :checkOut BETWEEN B.check_in AND B.check_out"
        );
        $query->execute([
            ":checkIn" => $checkIn,
            ":checkOut" => $checkOut
        ]);
        $data = $query->fetchAll();
        var_dump($data);die();
        return $data;
    }
}