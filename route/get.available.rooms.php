<?php
    $APP->get("/available/rooms", function($request, $response) {
        $checkIn = $request->getParsedBody()["check_in"];
        $checkOut = $request->getParsedBody()["check_out"];
        $checkData = Utilities::genericDataCheck([$checkIn, $checkOut]);
        if ($checkData === false) {
            return $response->withStatus(400)->write(json_encode([
                "success" => false,
                "description" => "Missing data"
            ]));
        }
        $hotelId = 1;
        $room = new Room($hotelId);
        $vacantRooms = $room->getVacantRooms($checkIn, $checkOut);
        return $response->withStatus(200)->write(json_encode([
            "success" => true,
            "description" => "Available rooms retrieved successfully",
            "results" => $vacantRooms
        ]));
    });
?>