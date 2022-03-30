<?php
    class Room{
        private $vacantRooms;
        private $type;
        private $db;
        public function __construct(){
            $this->db = Database::$db;
        }
        
        public function getVacantRooms($checkIn, $checkOut){
            $query = $this->db->prepare(
                "SELECT *
                FROM room AS R
                WHERE R.id NOT IN (	
                    SELECT B.room_id
                    FROM booking AS B
                    WHERE :checkIn BETWEEN B.check_in AND B.check_out
                    OR :checkOut BETWEEN B.check_in AND B.check_out
                )"
            );
            $query->execute([
                ":checkIn" => $checkIn,
                ":checkOut" => $checkOut
            ]);
            $data = $query->fetchAll();
            return $data;
        }
    }
?>