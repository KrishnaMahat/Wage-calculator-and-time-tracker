<?php
session_start();
$uid = $_SESSION['id'];
$mysqli = new mysqli('localhost', 'root', '', 'hourly_pay');

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $date = $_POST['work_date'];
    $start_time = $_POST['start_time'];
    $end_time = $_POST['end_time'];

    $to_time = strtotime($start_time);
    $from_time = strtotime($end_time);
    if ($to_time > $from_time) {
        $hour_worked = 86400 - abs($to_time - $from_time);
    } else {
        $hour_worked = abs($to_time - $from_time);
    }
    $hour_worked = $hour_worked / 3600;

    $stmt = $mysqli->prepare("INSERT INTO hourly_tracker (work_date, start_time, end_time, hour_worked, user_id) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssdd", $date, $start_time, $end_time, $hour_worked, $uid);
    $stmt->execute();

    $stmt->close();
    $mysqli->close();
}
?>
