<?php
    class Room{
        public function getVacantRooms($checkIn, $checkOut){
            $query = Database::$db->prepare(
                "SELECT 
                    id,
                    type
                FROM room
                WHERE hotel_id = 1"
            );
            $query->execute();
            $rooms = $query->fetchAll();
            $bookings = Booking::getAllBookingsInRange($checkIn, $checkOut);
            $dates = Utilities::getDatesFromRange($checkIn, $checkOut);
            $vacantRooms = [];
            foreach($dates as $date){
                $result = Utilities::dateInRangeOfBookings($date, $bookings);
                $vacantRooms[] = Utilities::createResponseString($date, $rooms, $result);
            }
            return $vacantRooms;
        }
    }
?>