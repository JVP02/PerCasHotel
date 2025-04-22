<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'hotel_booking');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$arrival_date = $_POST['arrival_date'];
$departure_date = $_POST['departure_date'];
$guests = $_POST['guests'];

// Query rooms from hotel_booking database
$sql = "SELECT * FROM hotel_booking.roomlist WHERE room_capacity >= ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $guests);
$stmt->execute();
$result = $stmt->get_result();

// Fetch rooms
$rooms = [];
while ($row = $result->fetch_assoc()) {
    $rooms[] = $row;
}
$stmt->close();
$conn->close();

// Connect to admin_login database to handle bookings (if needed later in the script)
$conn_admin = new mysqli('localhost', 'root', '', 'admin_login');

if ($conn_admin->connect_error) {
    die("Connection to admin_login failed: " . $conn_admin->connect_error);
}

// Example for inserting a booking record (ensure proper data is available):
// $booking_sql = "INSERT INTO admin_login.bookings (fields...) VALUES (values...)";
// $conn_admin->query($booking_sql);

$conn_admin->close();
?>

<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Available Rooms</title>
</head>
<body>
    <section class="room_container" id="room">
        <p class="section_subheader">ROOMS</p>
        <h2 class="section_header">Available Rooms</h2>
        <div class="room_grid">
            <?php if (!empty($rooms)): ?>
                <?php foreach ($rooms as $room): ?>
                    <div class="room_card">
                        <img src="assets/<?php echo htmlspecialchars($room['room_img']); ?>" alt="room">
                        <div class="room_card_detail">
                            <div>
                                <h4><?php echo htmlspecialchars($room['room_type']); ?></h4>
                                <p><?php echo htmlspecialchars($room['room_desc']); ?></p>
                            </div>
                            <h3>$<?php echo htmlspecialchars($room['room_price']); ?> <span>/night</span></h3>
                            <a href="booking.php?room_number=<?php echo htmlspecialchars($room['room_number']); ?>&room_price=<?php echo htmlspecialchars($room['room_price']); ?>&room_type=<?php echo urlencode($room['room_type']); ?>" class="btn">Book Now</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No rooms available for the selected criteria.</p>
            <?php endif; ?>
        </div>
    </section>
</body>
</html> -->
