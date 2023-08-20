<?php
session_start();
$mysqli = new mysqli('localhost', 'root', '', 'hourly_pay');
$uid = $_SESSION['id'];
$usernameQuery = "SELECT * FROM personal_info WHERE id = $uid";
$usernameResult = $mysqli->query($usernameQuery);
$row = $usernameResult->fetch_assoc();
$name = $row['name'];
$organization = $row['organization'];
$phone = $row['phone'];
$rate = $row['rate'];

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $serializedData = $_POST["formData"];
    parse_str($serializedData, $formData);
    $startDate = $formData["start_date"];
    $endDate = $formData["end_date"];
    $total_hour = 0;
    $query = "SELECT * FROM hourly_tracker WHERE user_id = $uid AND work_date BETWEEN '$startDate' AND '$endDate'";
    $result = $mysqli->query($query);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $total_hour += $row['hour_worked'];
        }
    }

    $response = array(
        'name' => $name,
        'organization' => $organization,
        'phone' => $phone,
        'total_hour' => round($total_hour, 2),
        'rate' => $rate,
        'total_pay' => round($rate * $total_hour, 2),
    );

    echo json_encode($response);
}
?>
