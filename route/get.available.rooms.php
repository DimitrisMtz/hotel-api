<?php
    $APP->get("/available/rooms", function($request, $response) {
        $start = $request->getParsedBody()["start_time"];
        $stop = $request->getParsedBody()["stop_time"];
        $room = new Room();
        $vacantRooms = $room->getVacantRooms($start, $stop);
        return $response->withStatus(200)->write(json_encode([
            "success" => true,
            "description" => "Available rooms retrieved successfully",
            "results" => $vacantRooms
        ]));
    });
?>