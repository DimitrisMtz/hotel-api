<?php

class Booking{
    private $db;
    public function __construct(){
        $this->db = Database::$db;
    }
    
    public function getBookings($start, $stop){
        $query = $this->db->prepare(
            "SELECT *
            FROM booking AS B
            WHERE :start BETWEEN B.start_time AND B.stop_time
            OR :stop BETWEEN B.start_time AND B.stop_time"
        );
        $query->execute([
            ":start" => $start,
            ":stop" => $stop
        ]);
        $data = $query->fetchAll();
        var_dump($data);die();
        return $data;
    }
}