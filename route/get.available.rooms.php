<?php
    $APP->get("/available/rooms", function($request, $response) {
        $checkInRaw = $request->getParsedBody()["check_in"];
        $checkOutRaw = $request->getParsedBody()["check_out"];
        $checkData = Helper::genericDataCheck([$checkInRaw, $checkOutRaw], $response);
        if ($checkData === false) {
            return $response->withStatus(400)->write(json_encode([
                "success" => false,
                "description" => "Missing data"
            ]));
        }
        $room = new Room();
        $checkInTime = Helper::formatTimestamp($checkInRaw);
        $checkOutTime = Helper::formatTimestamp($checkOutRaw);
        $vacantRooms = $room->getVacantRooms($checkInTime, $checkOutTime);
        return $response->withStatus(200)->write(json_encode([
            "success" => true,
            "description" => "Available rooms retrieved successfully",
            "results" => $vacantRooms
        ]));
    });
?>