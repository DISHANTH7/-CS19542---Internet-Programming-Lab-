<?php
session_start();
include 'db.php';
include 'header.php'; // Include the header

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$query = "SELECT * FROM cars";
$cars = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Available Cars</title>
</head>
<body>
    <div class="container">
        <h2 class="mt-5">Available Cars</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Car Model</th>
                    <th>Price per Day (INR)</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($car = $cars->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $car['model']; ?></td>
                    <td><?php echo $car['price']; ?></td>
                    <td>
                        <form action='confirm.php' method='post'>
                            <input type='hidden' name='car_id' value='<?php echo $car['id']; ?>'>
                            <button type='submit' class='btn btn-success'>Book Now</button>
                        </form>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
