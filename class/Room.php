<?php
    class Room{
        private $vacantRooms;
        private $type;
        private $db;
        public function __construct(){
            $this->db = Database::$db;
        }
        
        public function getVacantRooms($start, $stop){
            $query = $this->db->prepare(
                "SELECT *
                FROM room AS R
                WHERE R.id NOT IN (	
                    SELECT B.room_id
                    FROM booking AS B
                    WHERE :start BETWEEN B.start_time AND B.stop_time
                    OR :stop BETWEEN B.start_time AND B.stop_time
                )"
            );
            $query->execute([
                ":start" => $start,
                ":stop" => $stop
            ]);
            $data = $query->fetchAll();
            return $data;
        }
    }
?>