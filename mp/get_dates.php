<?php
include "db.php";

$result = $conn->query("SELECT booking_date FROM bookings");

$booked = [];

while ($row = $result->fetch_assoc()) {
    $booked[] = $row['booking_date'];
}

echo json_encode($booked);
?>