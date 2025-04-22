<?php
// Database connection
$servername = "localhost";
$username = "root";  // default XAMPP username
$password = "";  // default XAMPP password
$dbname = "hotel_booking";  // your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to select all rooms
$sql = "SELECT * FROM roomlist";
$result = $conn->query($sql);

// Check if there are any rooms
if ($result->num_rows > 0) {
    // Output data of each room
    while($row = $result->fetch_assoc()) {
        echo "<div class='room_card'>";
        echo "<img src='assets/rooms/" . $row['room_image'] . "' alt='room'>";
        echo "<div class='room_card_detail'>";
        echo "<h4>" . $row['room_number'] . " - " . $row['room_type'] . "</h4>";
        echo "<p>" . $row['room_description'] . "</p>";
        echo "<h3>$" . $row['room_price'] . " <span>/night</span></h3>";
        echo "<p>Status: " . $row['room_status'] . "</p>";
        echo "</div>";
        echo "</div>";
    }
} else {
    echo "No rooms available.";
}

// Close the connection
$conn->close();
?>
