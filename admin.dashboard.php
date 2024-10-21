<?php
session_start();
include 'db.php';

if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}

// Fetch bookings or any admin-related functionalities
$query = "SELECT * FROM bookings";
$bookings = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Admin Dashboard</title>
</head>
<body>
    <div class="container">
        <h2 class="mt-5">Admin Dashboard</h2>
        <h4>Bookings</h4>
        <table class="table">
            <thead>
                <tr>
                    <th>Booking ID</th>
                    <th>User ID</th>
                    <th>Car ID</th>
                    <th>Booking Date</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($booking = $bookings->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $booking['id']; ?></td>
                    <td><?php echo $booking['user_id']; ?></td>
                    <td><?php echo $booking['car_id']; ?></td>
                    <td><?php echo $booking['booking_date']; ?></td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        <a href="admin_logout.php" class="btn btn-danger">Logout</a>
    </div>
</body>
</html>
