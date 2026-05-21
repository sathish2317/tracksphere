<?php

$data = json_decode(file_get_contents("php://input"), true);

$lat = $data['latitude'];
$lng = $data['longitude'];
$battery = $data['battery'];
$charging = $data['charging'];

$stmt = db()->prepare("
INSERT INTO locations (latitude, longitude, battery, charging)
VALUES (?, ?, ?, ?)
");

$stmt->execute([$lat, $lng, $battery, $charging]);

?>