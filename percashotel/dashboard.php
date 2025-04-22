<?php
include 'db_connect.php'; // Include database connection

// Fetch booking history
$bookingHistoryQuery = "SELECT * FROM bookings ORDER BY arrival_date DESC";
$bookingHistoryResult = $conn->query($bookingHistoryQuery);

// Fetch available rooms
$availableRoomsQuery = "SELECT * FROM rooms WHERE is_available = 1";
$availableRoomsResult = $conn->query($availableRoomsQuery);

// Fetch most booked rooms
$mostBookedRoomsQuery = "SELECT * FROM statistics ORDER BY times_booked DESC LIMIT 5";
$mostBookedRoomsResult = $conn->query($mostBookedRoomsQuery);
?>

<?php
// admin_dashboard.php
$conn = new mysqli('localhost', 'root', '', 'admin_login');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT b.booking_id, b.room_number, r.room_type, b.arrival_date, b.departure_date, b.guests, b.total_price, b.booking_status
        FROM bookings b
        JOIN rooms r ON b.room_number = r.room_id";
$result = $conn->query($sql);

echo "<table border='1'>
        <tr>
            <th>Booking ID</th>
            <th>Room Number</th>
            <th>Room Type</th>
            <th>Arrival Date</th>
            <th>Departure Date</th>
            <th>Guests</th>
            <th>Total Price</th>
            <th>Status</th>
        </tr>";

while ($row = $result->fetch_assoc()) {
    echo "<tr>
            <td>" . $row['booking_id'] . "</td>
            <td>" . $row['room_number'] . "</td>
            <td>" . $row['room_type'] . "</td>
            <td>" . $row['arrival_date'] . "</td>
            <td>" . $row['departure_date'] . "</td>
            <td>" . $row['guests'] . "</td>
            <td>" . $row['total_price'] . "</td>
            <td>" . $row['booking_status'] . "</td>
        </tr>";
}

echo "</table>";
$conn->close();
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="dashboard.css">
</head>
<body>
    <div class="dashboard-container">
        <h1>Admin Dashboard</h1>

        <!-- Booking History -->
        <section>
            <h2>Booking History</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Customer Room</th>
                        <th>Room Type</th>
                        <th>Check-In Date</th>
                        <th>Check-Out Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $bookingHistoryResult->fetch_assoc()): ?>
                        <tr>
                            <td><?= $row['booking_id']; ?></td>
                            <td><?= $row['room_number']; ?></td>
                            <td><?= $row['room_type']; ?></td>
                            <td><?= $row['arrival_date']; ?></td>
                            <td><?= $row['departure_date']; ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </section>

        <!-- Available Rooms -->
        <section>
            <h2>Rooms Available</h2>
            <table>
                <thead>
                    <tr>
                        <th>Room Number</th>
                        <th>Room Type</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $availableRoomsResult->fetch_assoc()): ?>
                        <tr>
                            <td><?= $row['room_number']; ?></td>
                            <td><?= $row['room_type']; ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </section>

        <!-- Most Booked Rooms -->
        <section>
            <h2>Most Booked Rooms</h2>
            <table>
                <thead>
                    <tr>
                        <th>Room Number</th>
                        <th>Times Booked</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $mostBookedRoomsResult->fetch_assoc()): ?>
                        <tr>
                            <td><?= $row['room_number']; ?></td>
                            <td><?= $row['times_booked']; ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </section>
    </div>
</body>
</html>
