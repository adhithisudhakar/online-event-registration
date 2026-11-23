<?php
session_start();
include "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $event = $_POST["event_name"];
    $dept = $_POST["department"];
    $date = $_POST["booking_date"];

    $today = date("Y-m-d");

    // ❌ Past date
    if ($date < $today) {
        $_SESSION['msg'] = "past";
        header("Location: available.php");
        exit;
    }

    // Check booking
    $check = $conn->prepare("SELECT * FROM bookings WHERE booking_date=?");
    $check->bind_param("s", $date);
    $check->execute();
    $result = $check->get_result();

    // ❌ Already booked
    if ($result->num_rows > 0) {

        $year = date("Y", strtotime($date));
        $month = date("m", strtotime($date));

        // get booked dates
        $res = $conn->prepare("SELECT booking_date FROM bookings WHERE YEAR(booking_date)=? AND MONTH(booking_date)=?");
        $res->bind_param("ii", $year, $month);
        $res->execute();
        $r = $res->get_result();

        $booked = [];
        while ($row = $r->fetch_assoc()) {
            $booked[] = $row['booking_date'];
        }

        // find available dates
        $days = cal_days_in_month(CAL_GREGORIAN, $month, $year);

        $available = [];
        for ($i = 1; $i <= $days; $i++) {
            $d = $year . "-" . $month . "-" . str_pad($i, 2, "0", STR_PAD_LEFT);
            if (!in_array($d, $booked)) {
                $available[] = $d;
            }
        }

        $_SESSION['msg'] = "booked";
        $_SESSION['selected'] = $date;
        $_SESSION['dates'] = $available;

        header("Location: available.php");
        exit;

    } else {

        // ✅ Insert booking
        $stmt = $conn->prepare("INSERT INTO bookings (department, event_name, booking_date) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $dept, $event, $date);
        $stmt->execute();

        $_SESSION['msg'] = "success";
        $_SESSION['selected'] = $date;

        header("Location: available.php");
        exit;
    }
}
?>