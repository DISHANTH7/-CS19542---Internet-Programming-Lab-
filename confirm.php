<?php
session_start();
include 'db.php';
include 'header.php'; // Include the header

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $car_id = $_POST['car_id'];

    $stmt = $conn->prepare("INSERT INTO bookings (user_id, car_id) VALUES (?, ?)");
    $stmt->bind_param("ii", $user_id, $car_id);
    $stmt->execute();
    $stmt->close();

    $car_query = $conn->prepare("SELECT model FROM cars WHERE id = ?");
    $car_query->bind_param("i", $car_id);
    $car_query->execute();
    $car_result = $car_query->get_result()->fetch_assoc();
    $car_model = $car_result['model'];
    $car_query->close();
} else {
    header("Location: car_list.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Booking Confirmation</title>
</head>
<body>
    <div class="container">
        <h2 class="mt-5">Booking Confirmation</h2>
        <p>You have successfully booked the <strong><?php echo $car_model; ?></strong>.</p>
        <p>Please wait for admin confirmation.</p>
        <a href="car_list.php" class="btn btn-primary">Back to Car List</a>
    </div>
</body>
</html>
